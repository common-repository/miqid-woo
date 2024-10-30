<?php

namespace MIQID\Plugin\WooCommerce\Frontend;

use Automattic\WooCommerce\Admin\DateTimeProvider\CurrentDateTimeProvider;
use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\{Includes\EConomic\API\Currencies, Includes\EConomic\API\CustomerGroups, Includes\EConomic\API\Customers, Includes\EConomic\API\Invoices, Includes\EConomic\API\Layouts, Includes\EConomic\API\Orders, Includes\EConomic\API\PaymentTerms, Includes\EConomic\API\ProductGroups, Includes\EConomic\API\Products, Includes\EConomic\API\Units, Includes\EConomic\API\VatZones, Includes\EConomic\DTO\Currency, Includes\EConomic\DTO\Customer, Includes\EConomic\DTO\CustomerGroup, Includes\EConomic\DTO\Invoice, Includes\EConomic\DTO\Layout, Includes\EConomic\DTO\Line, Includes\EConomic\DTO\Order, Includes\EConomic\DTO\PaymentTerm, Includes\EConomic\DTO\Product, Includes\EConomic\DTO\ProductGroup, Includes\EConomic\DTO\Recipient, Includes\EConomic\DTO\Unit, Includes\EConomic\DTO\VatZone, Util};

class EConomic {
	private static $_instance;
	/** @var bool */
	private $sync_processing;
	/** @var bool */
	private $sync_completed;

	private const SECTION_SETTINGS = 'e-conomic';

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		$this->sync_processing = filter_var( get_option( Util::generate_id( self::SECTION_SETTINGS, 'sync', 'processing' ) ), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		$this->sync_completed  = filter_var( get_option( Util::generate_id( self::SECTION_SETTINGS, 'sync', 'completed' ) ), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );

		if ( $this->sync_processing ) {
			add_action( 'woocommerce_order_status_processing', [ $this, '_processing' ], 10, 1 );
		}
		if ( $this->sync_completed ) {
			add_action( 'woocommerce_order_status_completed', [ $this, '_completed' ], 10, 1 );
		}
	}

	function _processing( $order_id ) {
		$order = wc_get_order( $order_id );

		$Currency      = Currencies::Instance()->Get( $order->get_currency() );
		$CustomerGroup = CustomerGroups::Instance()->Get( get_option( Util::generate_id( self::SECTION_SETTINGS, 'CustomerGroup' ) ) );
		$Layout        = Layouts::Instance()->Get( get_option( Util::generate_id( self::SECTION_SETTINGS, 'Layout' ) ) );
		$PaymentTerm   = PaymentTerms::Instance()->Get( get_option( Util::generate_id( self::SECTION_SETTINGS, 'PaymentTerm' ) ) );
		$VatZone       = VatZones::Instance()->Get( get_option( Util::generate_id( self::SECTION_SETTINGS, 'VatZone' ) ) );
		$Unit          = Units::Instance()->Get( 1 );

		if ( is_array( $PaymentTerm ) ) {
			$PaymentTerm = current( $PaymentTerm );
		}

		if ( is_array( $CustomerGroup ) ) {
			$CustomerGroup = current( $CustomerGroup );
		}

		if ( is_array( $VatZone ) ) {
			$VatZone = current( $VatZone );
		}

		if ( is_array( $Layout ) ) {
			$Layout = current( $Layout );
		}

		if ( ! $PaymentTerm instanceof PaymentTerm ) {
			$PaymentTerm = PaymentTerms::Instance()->Get( 1 );
		}

		if ( ! $CustomerGroup instanceof CustomerGroup ) {
			$CustomerGroup = CustomerGroups::Instance()->Get( 1 );
		}

		if ( ! $VatZone instanceof VatZone ) {
			$VatZone = VatZones::Instance()->Get( 1 );
		}

		if ( ! $Layout instanceof Layout ) {
			$VatZone = VatZones::Instance()->Get( 21 );
		}

		if ( ( $dtoCustomer = Customers::Instance()->GET( null, sprintf( '?filter=email$eq:%s', $order->get_billing_email() ) ) ) && ! $dtoCustomer instanceof Customer || empty( $dtoCustomer ) ) {
			$dtoCustomer = new Customer();
		}

		$dtoCustomer
			->set_currency( $Currency )
			->set_customer_group( $CustomerGroup )
			->set_payment_terms( $PaymentTerm )
			->set_vat_zone( $VatZone )
			->set_email( $order->get_billing_email() )
			->set_name( $order->get_formatted_billing_full_name() )
			->set_address( $order->get_billing_address_1() )
			->set_city( $order->get_billing_city() )
			->set_zip( $order->get_billing_postcode() )
			->set_country( $order->get_billing_country() )
			->set_mobile_phone( $order->get_billing_phone() );

		if ( empty( $dtoCustomer->get_customer_number() ) ) {
			$dtoCustomer = Customers::Instance()->Post( $dtoCustomer );
		} else {
			$dtoCustomer = Customers::Instance()->Put( $dtoCustomer->get_customer_number(), $dtoCustomer );
		}


		$LineNumber = 1;
		$Lines      = [];
		/** @var \WC_Order_Item_Product $order_item */
		foreach ( $order->get_items() as $order_item ) {
			/** @var \WC_Product|bool $wc_product */
			if ( $wc_product = $order_item->get_product() ) {
				if ( ( $dtoProduct = Products::Instance()->Get( null, '?filter=productNumber$eq:' . $wc_product->get_sku() ) ) && ! $dtoProduct instanceof Product || empty( $dtoProduct ) ) {
					$dtoProduct = new Product();
				}

				$ProductGroup = ProductGroups::Instance()->Get( ProductGroups::Product_Without_Vat );
				if ( wc_tax_enabled() ) {
					$ProductGroup = ProductGroups::Instance()->Get( ProductGroups::Product_With_Vat );

					if ( ! $wc_product->is_taxable() ) {
						$ProductGroup = ProductGroups::Instance()->Get( ProductGroups::Product_Without_Vat );
					}
				}

				$dtoProduct
					->set_product_number( $wc_product->get_sku() )
					->set_name( $wc_product->get_name() )
					->set_product_group( $ProductGroup )
					->set_sales_price( wc_get_price_excluding_tax( $wc_product ) );

				if ( empty( $dtoProduct->get_self() ) ) {
					$dtoProduct = Products::Instance()->Post( $dtoProduct );
				} else {
					$dtoProduct = Products::Instance()->PUT( $dtoProduct->get_product_number(), $dtoProduct );
				}

				$Lines[] = ( new Line() )
					->set_line_number( $LineNumber ++ )
					->set_product( $dtoProduct )
					->set_description( $order_item->get_name() )
					->set_unit( $Unit )
					->set_unit_net_price( $dtoProduct->get_sales_price() )
					->set_quantity( $order_item->get_quantity() );
			}
		}

		/** @var \WC_Order_Item_Shipping $order_item */
		foreach ( $order->get_items( 'shipping' ) as $order_item ) {
			$sku = sprintf( '%s-%s', $order_item->get_method_id(), $order_item->get_instance_id() );

			if ( ( $dtoProduct = Products::Instance()->Get( null, '?filter=productNumber$eq:' . $sku ) ) && ! $dtoProduct instanceof Product || empty( $dtoProduct ) ) {
				$dtoProduct = new Product();
			}

			$ProductGroup = ProductGroups::Instance()->Get( ProductGroups::Product_Without_Vat );
			if ( wc_tax_enabled() ) {
				$ProductGroup = ProductGroups::Instance()->Get( ProductGroups::Product_With_Vat );

				if ( ! $order_item->calculate_taxes() ) {
					$ProductGroup = ProductGroups::Instance()->Get( ProductGroups::Product_Without_Vat );
				}
			}


			$dtoProduct
				->set_product_number( $sku )
				->set_name( $order_item->get_name() )
				->set_product_group( $ProductGroup )
				->set_sales_price( $order_item->get_total() );

			if ( empty( $dtoProduct->get_self() ) ) {
				$dtoProduct = Products::Instance()->Post( $dtoProduct );
			} else {
				$dtoProduct = Products::Instance()->PUT( $dtoProduct->get_product_number(), $dtoProduct );
			}

			$Lines[] = new Line( [
				'LineNumber'   => $LineNumber ++,
				'Product'      => $dtoProduct,
				'description'  => $order_item->get_name(),
				'Unit'         => $Unit,
				'unitNetPrice' => $order_item->get_total(),
				'quantity'     => $order_item->get_quantity(),
			] );
		}


		if ( ( $dtoOrder = Orders::Instance()->GetDrafts( null, sprintf( '?filter=references.other$eq:%s', $order->get_order_number() ) ) ) && ! $dtoOrder instanceof Order || empty( $dtoOrder ) ) {
			$dtoOrder = new Order();
		}

		$dtoOrder
			->set_currency( $Currency )
			->set_customer( $dtoCustomer )
			->set_references( [
				'other' => sprintf( '%s', $order->get_order_number() ),
			] )
			->set_date( $order->get_date_paid() ?? $order->get_date_created() )
			->set_layout( $Layout )
			->set_payment_terms( $PaymentTerm )
			->set_recipient( ( new Recipient() )
				->set_name( ! empty( trim( $order->get_formatted_shipping_full_name() ) ) ? $order->get_formatted_shipping_full_name() : $order->get_formatted_billing_full_name() )
				->set_address( ! empty( trim( $order->get_shipping_address_1() ) ) ? $order->get_shipping_address_1() : $order->get_billing_address_1() )
				->set_zip( ! empty( trim( $order->get_shipping_postcode() ) ) ? $order->get_shipping_postcode() : $order->get_billing_postcode() )
				->set_city( ! empty( trim( $order->get_shipping_city() ) ) ? $order->get_shipping_city() : $order->get_billing_city() )
				->set_country( ! empty( trim( $order->get_shipping_country() ) ) ? $order->get_shipping_country() : $order->get_billing_country() )
				->set_mobile_phone( $order->get_billing_phone() )
				->set_vat_zone( $VatZone )
			)
			->set_lines( $Lines );

		$dtoOrder->set_delivery( $dtoOrder->get_recipient() );

		if ( empty( $dtoOrder->get_self() ) ) {
			$dtoOrder = Orders::Instance()->PostDrafts( $dtoOrder );
		} else {
			$dtoOrder = Orders::Instance()->PutDrafts( $dtoOrder->get_order_number(), $dtoOrder );
		}

		if ( ( $dtoInvoice = Invoices::Instance()->GetDrafts( null, sprintf( 'references.other$eq:%s', $order->get_order_number() ) ) ) && $dtoInvoice instanceof Invoice || empty( $dtoInvoice ) ) {
			$dtoInvoice = new Invoice( $dtoOrder->jsonSerialize() );
		}

		if ( is_array( $dtoInvoice ) ) {
			$dtoInvoice = current( $dtoInvoice );
		}

		$dtoInvoice
			->set_lines( $dtoOrder->get_lines() );

		if ( empty( $dtoInvoice->get_self() ) ) {
			$dtoInvoice = Invoices::Instance()->PostDrafts( $dtoInvoice );
		} else {
			$dtoInvoice = Invoices::Instance()->PutDrafts( $dtoInvoice->get_draft_invoice_number(), $dtoInvoice );
		}
	}

	function _completed( $order_id ) {
		$wc_order = wc_get_order( $order_id );

		if ( ( $dtoOrder = Orders::Instance()->GetDrafts( null, sprintf( '?filter=references.other$eq:%s', $wc_order->get_order_number() ) ) ) && ! $dtoOrder instanceof Order || empty( $dtoOrder ) ) {
			$dtoOrder = new Order();
		}



		if ( ! empty( $dtoOrder->get_order_number() ) ) {
			$dtoOrder = Orders::Instance()->PostSent( $dtoOrder );
		}

		if ( ( $dtoInvoice = Invoices::Instance()->GetDrafts( null, sprintf( 'references.other$eq:%s', $wc_order->get_order_number() ) ) ) && $dtoInvoice instanceof Invoice || empty( $dtoInvoice ) ) {
			$dtoInvoice = new Invoice();
		}

		if ( is_array( $dtoInvoice ) ) {
			$dtoInvoice = current( $dtoInvoice );
		}

		if ( ! empty( $dtoInvoice->get_draft_invoice_number() ) ) {
			$dtoInvoice = Invoices::Instance()->PostBooked( $dtoInvoice );
		}
	}

}
