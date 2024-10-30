<?php

namespace MIQID\Plugin\WooCommerce\Frontend;

use MIQID\Plugin\Core\Classes\DTO\{HttpResponse};
use MIQID\Plugin\WooCommerce\Includes\Dinero\API\{Contacts, Invoices, Products};
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\{Contact, Invoice, Product, ProductLine};
use MIQID\Plugin\WooCommerce\Util;
use WC_Order_Item;
use WC_Order_Item_Product;
use WC_Order_Item_Shipping;

class Dinero {
	private static $instance;
	/** @var bool */
	private $sync_processing;
	/** @var bool */
	private $sync_completed;

	private const SECTION_SETTINGS = 'dinero';

	static function Instance(): self {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
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
		$wc_order = wc_get_order( $order_id );


		if ( ( $dtoContact = Contacts::Instance()->ListContacts( 'email,contactGuid', sprintf( "email eq '%s'", $wc_order->get_billing_email() ) ) ) && ! $dtoContact instanceof HttpResponse ) {
			$dtoContact = Contacts::Instance()->GetContact( current( $dtoContact )->get_contact_guid() );
		}

		if ( ! $dtoContact instanceof Contact ) {
			$dtoContact = new Contact();
		}

		$dtoContact
			->set_email( $wc_order->get_billing_email() )
			->set_name( $wc_order->get_formatted_billing_full_name() )
			->set_street( $wc_order->get_billing_address_1() )
			->set_zip_code( $wc_order->get_billing_postcode() )
			->set_city( $wc_order->get_billing_city() )
			->set_country_key( $wc_order->get_billing_country() );

		if ( empty( $dtoContact->get_contact_guid() ) ) {
			$dtoContact = Contacts::Instance()->CreateContact( $dtoContact );
		} else {
			$dtoContact = Contacts::Instance()->UpdateContact( $dtoContact->get_contact_guid(), $dtoContact );
		}

		$ProductLines = [];
		/** @var WC_Order_Item_Product|WC_Order_Item $order_item */
		foreach ( $wc_order->get_items() as $order_item ) {
			$product = $order_item->get_product();

			if ( ( $dtoProduct = Products::Instance()->ListProducts( null, $product->get_sku() ) ) && ! $dtoProduct instanceof HttpResponse ) {
				$dtoProduct = Products::Instance()->GetProduct( current( $dtoProduct )->get_product_guid() );
			}
			if ( ! $dtoProduct instanceof Product ) {
				$dtoProduct = new Product();
			}

			$AccountNumber = Product::WithoutVAT;
			if ( wc_tax_enabled() ) {
				$AccountNumber = Product::WithVAT;

				if ( ! $product->is_taxable() ) {
					$AccountNumber = Product::WithoutVAT;
				}
			}


			$dtoProduct
				->set_product_number( $product->get_sku() )
				->set_name( $product->get_name() )
				->set_quantity( $product->get_stock_quantity() )
				->set_account_number( $AccountNumber )
				->set_base_amount_value( wc_get_price_excluding_tax( $product ) )
				->set_unit( 'parts' );

			if ( empty( $dtoProduct->get_product_guid() ) ) {
				$dtoProduct = Products::Instance()->CreateProduct( $dtoProduct );
			} else {
				$dtoProduct = Products::Instance()->UpdateProduct( $dtoProduct->get_product_guid(), $dtoProduct );
			}

			$ProductLines[] = ( new ProductLine() )
				->set_product_guid( $dtoProduct->get_product_guid() )
				->set_quantity( $order_item->get_quantity() )
				->set_unit( $dtoProduct->get_unit() )
				->set_account_number( $dtoProduct->get_account_number() )
				->set_base_amount_value( $dtoProduct->get_base_amount_value() );
		}

		/** @var WC_Order_Item_Shipping|WC_Order_Item $order_item */
		foreach ( $wc_order->get_shipping_methods() as $order_item ) {
			$sku = sprintf( '%s-%s', $order_item->get_method_id(), $order_item->get_instance_id() );

			if ( ( $dtoProduct = Products::Instance()->ListProducts( null, $sku ) ) && ! $dtoProduct instanceof HttpResponse ) {
				$dtoProduct = Products::Instance()->GetProduct( current( $dtoProduct )->get_product_guid() );
			}

			if ( ! $dtoProduct instanceof Product ) {
				$dtoProduct = new Product();
			}

			$AccountNumber = Product::WithoutVAT;
			if ( wc_tax_enabled() ) {
				$AccountNumber = Product::WithVAT;

				if ( ! $product->is_taxable() ) {
					$AccountNumber = Product::WithoutVAT;
				}
			}

			$dtoProduct
				->set_product_number( $sku )
				->set_name( $order_item->get_name() )
				->set_account_number( $AccountNumber )
				->set_base_amount_value( $order_item->get_total() )
				->set_quantity( 1 )
				->set_unit( 'shipment' );

			if ( empty( $dtoProduct->get_product_guid() ) ) {
				$dtoProduct = Products::Instance()->CreateProduct( $dtoProduct );
			} else {
				$dtoProduct = Products::Instance()->UpdateProduct( $dtoProduct->get_product_guid(), $dtoProduct );
			}

			$ProductLines[] = ( new ProductLine() )
				->set_product_guid( $dtoProduct->get_product_guid() )
				->set_quantity( $order_item->get_quantity() )
				->set_unit( $dtoProduct->get_unit() )
				->set_account_number( $dtoProduct->get_account_number() )
				->set_base_amount_value( $dtoProduct->get_base_amount_value() );
		}

		if ( ( $dtoInvoice = Invoices::Instance()->ListInvoice( 'Guid', sprintf( "ExternalReference eq '%s'", $wc_order->get_order_number() ) ) ) && ! $dtoInvoice instanceof HttpResponse ) {
			$dtoInvoice = Invoices::Instance()->GetInvoice( current( $dtoInvoice )->get_guid() );
		}
		if ( ! $dtoInvoice instanceof Invoice ) {
			$dtoInvoice = new Invoice();
		}

		$dtoInvoice
			->set_currency( $wc_order->get_currency() )
			->set_external_reference( $wc_order->get_order_number() )
			->set_date( $wc_order->get_date_paid() ?? $wc_order->get_date_created() )
			->set_address( sprintf( "%s\n%s %s", $wc_order->get_billing_address_1(), $wc_order->get_billing_postcode(), $wc_order->get_billing_city() ) )
			->set_contact_guid( $dtoContact->get_contact_guid() )
			->set_product_lines( $ProductLines );


		if ( empty( $dtoInvoice->get_guid() ) ) {
			$dtoInvoice = Invoices::Instance()->CreateInvoice( $dtoInvoice );
		} else {
			$dtoInvoice = Invoices::Instance()->UpdateInvoice( $dtoInvoice->get_guid(), $dtoInvoice );
		}
	}

	function _completed( $order_id ) {
		$wc_order = wc_get_order( $order_id );

		if ( ( $dtoInvoice = Invoices::Instance()->ListInvoice( 'Guid', sprintf( "ExternalReference eq '%s'", $wc_order->get_order_number() ) ) ) && ! $dtoInvoice instanceof HttpResponse ) {
			$dtoInvoice = Invoices::Instance()->GetInvoice( current( $dtoInvoice )->get_guid() );
		}

		if ( ! $dtoInvoice instanceof Invoice ) {
			$dtoInvoice = new Invoice();
		}

		if ( ! empty( $dtoInvoice->get_guid() ) ) {
			$dtoInvoice = Invoices::Instance()->BookInvoice( $dtoInvoice->get_guid(), [ 'Timestamp' => $dtoInvoice->get_time_stamp() ] );
		}
	}
}