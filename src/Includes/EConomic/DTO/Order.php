<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Util;

class Order extends Base {
	/** @var int|null */
	private $orderNumber;
	/** @var DateTime|null */
	private $date;
	/** @var Currency|null */
	private $currency;
	/** @var float|null */
	private $exchangeRate;
	/** @var float|null */
	private $netAmount;
	/** @var float|null */
	private $netAmountInBaseCurrency;
	/** @var float|null */
	private $grossAmount;
	/** @var float|null */
	private $grossAmountInBaseCurrency;
	/** @var float|null */
	private $marginInBaseCurrency;
	/** @var float|null */
	private $marginPercentage;
	/** @var float|null */
	private $vatAmount;
	/** @var float|null */
	private $roundingAmount;
	/** @var float|null */
	private $costPriceInBaseCurrency;
	/** @var DateTime|null */
	private $dueDate;

	/** @var array|null */
	private $notes;
	/** @var array|null */
	private $references;
	/** @var array|null */
	private $project;
	/** @var array|null */
	private $pdf;
	/** @var array|null */
	private $soap;
	/** @var array|null */
	private $templates;

	/** @var Customer|null */
	private $customer;
	/** @var Recipient|null */
	private $recipient;
	/** @var DeliveryLocation|null */
	private $deliveryLocation;
	/** @var Delivery|null */
	private $delivery;
	/** @var Layout|null */
	private $layout;
	/** @var PaymentTerm|null */
	private $paymentTerms;
	/** @var Line[]|null */
	private $lines;

	public function __construct( ?array $Order = null ) {
		if ( is_array( $Order ) ) {
			$this->parse_array( $Order );
		}
	}

	/**
	 * @param int|null $orderNumber
	 *
	 * @return Order
	 */
	public function set_order_number( ?int $orderNumber ): self {
		$this->orderNumber = $orderNumber;

		return $this;
	}

	/**
	 * @param DateTime|string|null $date
	 *
	 * @return Order
	 */
	public function set_date( $date ): self {
		if ( is_string( $date ) ) {
			$date = date_create( $date );
		}
		$this->date = $date;

		return $this;
	}

	/**
	 * @param Currency|array|string|null $currency
	 *
	 * @return Order
	 */
	public function set_currency( $currency ): self {
		if ( is_array( $currency ) || is_string( $currency ) ) {
			$currency = new Currency( $currency );
		}
		$this->currency = $currency;

		return $this;
	}

	/**
	 * @param float|null $exchangeRate
	 *
	 * @return Order
	 */
	public function set_exchange_rate( ?float $exchangeRate ): self {
		$this->exchangeRate = $exchangeRate;

		return $this;
	}

	/**
	 * @param float|null $netAmount
	 *
	 * @return Order
	 */
	public function set_net_amount( ?float $netAmount ): self {
		$this->netAmount = $netAmount;

		return $this;
	}

	/**
	 * @param float|null $netAmountInBaseCurrency
	 *
	 * @return Order
	 */
	public function set_net_amount_in_base_currency( ?float $netAmountInBaseCurrency ): self {
		$this->netAmountInBaseCurrency = $netAmountInBaseCurrency;

		return $this;
	}

	/**
	 * @param float|null $grossAmount
	 *
	 * @return Order
	 */
	public function set_gross_amount( ?float $grossAmount ): self {
		$this->grossAmount = $grossAmount;

		return $this;
	}

	/**
	 * @param float|null $grossAmountInBaseCurrency
	 *
	 * @return Order
	 */
	public function set_gross_amount_in_base_currency( ?float $grossAmountInBaseCurrency ): self {
		$this->grossAmountInBaseCurrency = $grossAmountInBaseCurrency;

		return $this;
	}

	/**
	 * @param float|null $marginInBaseCurrency
	 *
	 * @return Order
	 */
	public function set_margin_in_base_currency( ?float $marginInBaseCurrency ): self {
		$this->marginInBaseCurrency = $marginInBaseCurrency;

		return $this;
	}

	/**
	 * @param float|null $marginPercentage
	 *
	 * @return Order
	 */
	public function set_margin_percentage( ?float $marginPercentage ): self {
		$this->marginPercentage = $marginPercentage;

		return $this;
	}

	/**
	 * @param float|null $vatAmount
	 *
	 * @return Order
	 */
	public function set_vat_amount( ?float $vatAmount ): self {
		$this->vatAmount = $vatAmount;

		return $this;
	}

	/**
	 * @param float|null $roundingAmount
	 *
	 * @return Order
	 */
	public function set_rounding_amount( ?float $roundingAmount ): self {
		$this->roundingAmount = $roundingAmount;

		return $this;
	}

	/**
	 * @param float|null $costPriceInBaseCurrency
	 *
	 * @return Order
	 */
	public function set_cost_price_in_base_currency( ?float $costPriceInBaseCurrency ): self {
		$this->costPriceInBaseCurrency = $costPriceInBaseCurrency;

		return $this;
	}

	/**
	 * @param DateTime|string|null $dueDate
	 *
	 * @return Order
	 */
	public function set_due_date( $dueDate ): self {
		if ( is_string( $dueDate ) ) {
			$dueDate = date_create( $dueDate );
		}
		$this->dueDate = $dueDate;

		return $this;
	}

	/**
	 * @param array|PaymentTerm|null $paymentTerms
	 *
	 * @return Order
	 */
	public function set_payment_terms( $paymentTerms ): self {
		if ( is_array( $paymentTerms ) ) {
			$paymentTerms = new PaymentTerm( $paymentTerms );
		}
		$this->paymentTerms = $paymentTerms;

		return $this;
	}

	/**
	 * @param array|Customer|null $customer
	 *
	 * @return Order
	 */
	public function set_customer( $customer ): self {
		if ( is_array( $customer ) ) {
			$customer = new Customer( $customer );
		}
		$this->customer = $customer;

		return $this;
	}

	/**
	 * @param Recipient|array|null $recipient
	 *
	 * @return Order
	 */
	public function set_recipient( $recipient ): self {
		if ( is_array( $recipient ) ) {
			$recipient = new Recipient( $recipient );
		}
		$this->recipient = $recipient;

		return $this;
	}

	/**
	 * @param array|DeliveryLocation|null $deliveryLocation
	 *
	 * @return Order
	 */
	public function set_delivery_location( $deliveryLocation ): self {
		if ( is_array( $deliveryLocation ) ) {
			$deliveryLocation = new DeliveryLocation( $deliveryLocation );
		}
		$this->deliveryLocation = $deliveryLocation;

		return $this;
	}

	/**
	 * @param Delivery|array|null $delivery
	 *
	 * @return Order
	 */
	public function set_delivery( $delivery ): self {
		if ( is_array( $delivery ) ) {
			$delivery = new Delivery( $delivery );
		}
		$this->delivery = $delivery;

		return $this;
	}

	/**
	 * @param array|null $notes
	 *
	 * @return Order
	 */
	public function set_notes( ?array $notes ): self {
		$this->notes = $notes;

		return $this;
	}

	/**
	 * @param array|null $references
	 *
	 * @return Order
	 */
	public function set_references( ?array $references ): self {
		$this->references = $references;

		return $this;
	}

	/**
	 * @param array|null $project
	 *
	 * @return Order
	 */
	public function set_project( ?array $project ): self {
		$this->project = $project;

		return $this;
	}

	/**
	 * @param array|null $pdf
	 *
	 * @return Order
	 */
	public function set_pdf( ?array $pdf ): self {
		$this->pdf = $pdf;

		return $this;
	}

	/**
	 * @param array|null $soap
	 *
	 * @return Order
	 */
	public function set_soap( ?array $soap ): self {
		$this->soap = $soap;

		return $this;
	}

	/**
	 * @param array|null $templates
	 *
	 * @return Order
	 */
	public function set_templates( ?array $templates ): self {
		$this->templates = $templates;

		return $this;
	}

	/**
	 * @param Line[]|null $lines
	 *
	 * @return Order
	 */
	public function set_lines( ?array $lines ): self {
		$this->lines = $lines;

		return $this;
	}

	/**
	 * @param Layout|array|null $layout
	 *
	 * @return Order
	 */
	public function set_layout( $layout ): self {
		if ( is_array( $layout ) ) {
			$layout = new Layout( $layout );
		}
		$this->layout = $layout;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_order_number(): ?int {
		return $this->orderNumber;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_date( $format = null ) {
		if ( $this->date instanceof DateTime && ! empty( $format ) ) {
			return $this->date->format( $format );
		}

		return $this->date;
	}

	/**
	 * @return Currency
	 */
	public function get_currency(): Currency {
		return $this->currency ?? new Currency();
	}

	/**
	 * @return float|null
	 */
	public function get_exchange_rate(): ?float {
		return $this->exchangeRate;
	}

	/**
	 * @return float|null
	 */
	public function get_net_amount(): ?float {
		return $this->netAmount;
	}

	/**
	 * @return float|null
	 */
	public function get_net_amount_in_base_currency(): ?float {
		return $this->netAmountInBaseCurrency;
	}

	/**
	 * @return float|null
	 */
	public function get_gross_amount(): ?float {
		return $this->grossAmount;
	}

	/**
	 * @return float|null
	 */
	public function get_gross_amount_in_base_currency(): ?float {
		return $this->grossAmountInBaseCurrency;
	}

	/**
	 * @return float|null
	 */
	public function get_margin_in_base_currency(): ?float {
		return $this->marginInBaseCurrency;
	}

	/**
	 * @return float|null
	 */
	public function get_margin_percentage(): ?float {
		return $this->marginPercentage;
	}

	/**
	 * @return float|null
	 */
	public function get_vat_amount(): ?float {
		return $this->vatAmount;
	}

	/**
	 * @return float|null
	 */
	public function get_rounding_amount(): ?float {
		return $this->roundingAmount;
	}

	/**
	 * @return float|null
	 */
	public function get_cost_price_in_base_currency(): ?float {
		return $this->costPriceInBaseCurrency;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_due_date( $format = null ) {
		if ( $this->dueDate instanceof DateTime && ! empty( $format ) ) {
			return $this->dueDate->format( $format );
		}

		return $this->dueDate;
	}

	/**
	 * @return PaymentTerm
	 */
	public function get_payment_terms(): PaymentTerm {
		return $this->paymentTerms ?? new PaymentTerm();
	}

	/**
	 * @return Customer
	 */
	public function get_customer(): Customer {
		return $this->customer ?? new Customer();
	}

	/**
	 * @return Recipient
	 */
	public function get_recipient(): Recipient {
		return $this->recipient ?? new Recipient();
	}

	/**
	 * @return DeliveryLocation
	 */
	public function get_delivery_location(): DeliveryLocation {
		return $this->deliveryLocation ?? new DeliveryLocation();
	}

	/**
	 * @return Delivery
	 */
	public function get_delivery(): Delivery {
		return $this->delivery ?? new Delivery();
	}

	/**
	 * @return array|null
	 */
	public function get_notes(): ?array {
		return $this->notes;
	}

	/**
	 * @return array|null
	 */
	public function get_references(): ?array {
		return $this->references;
	}

	/**
	 * @return array|null
	 */
	public function get_project(): ?array {
		return $this->project;
	}

	/**
	 * @return array|null
	 */
	public function get_pdf(): ?array {
		return $this->pdf;
	}

	/**
	 * @return array|null
	 */
	public function get_soap(): ?array {
		return $this->soap;
	}

	/**
	 * @return array|null
	 */
	public function get_templates(): ?array {
		return $this->templates;
	}

	/**
	 * @return Line[]
	 */
	public function get_lines(): ?array {
		return $this->lines ?? [];
	}

	/**
	 * @return Layout
	 */
	public function get_layout(): Layout {
		return $this->layout ?? new Layout();
	}

	public function jsonSerialize(): array {
		$vars                 = get_object_vars( $this );
		$vars['date']         = $this->get_date( 'Y-m-d' );
		$vars['dueDate']      = $this->get_due_date( 'Y-m-d' );
		$vars['currency']     = $this->get_currency()->get_code();
		$vars['customer']     = ( new Customer )->set_customer_number( $this->get_customer()->get_customer_number() );
		$vars['layout']       = ( new Layout )->set_layout_number( $this->get_layout()->get_layout_number() );
		$vars['paymentTerms'] = ( new PaymentTerm )->set_payment_terms_number( $this->get_payment_terms()->get_payment_terms_number() );
		$vars                 = Util::filter_null_from( $vars );

		return $vars;
	}
}