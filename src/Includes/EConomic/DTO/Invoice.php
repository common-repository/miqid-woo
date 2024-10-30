<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Util;

class Invoice extends Base {
	/** @var int|null */
	private $draftInvoiceNumber;
	/** @var DateTime|string|null */
	private $date;
	/** @var Currency|string|null */
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
	/** @var DateTime|string|null */
	private $dueDate;
	/** @var PaymentTerm|null */
	private $paymentTerms;
	/** @var Customer|null */
	private $customer;
	/** @var Recipient|null */
	private $recipient;
	/** @var DeliveryLocation|null */
	private $deliveryLocation;
	/** @var Delivery|null */
	private $delivery;
	/** @var array */
	private $notes;
	/** @var array */
	private $references;
	/** @var Layout */
	private $layout;
	/** @var array */
	private $project;
	/** @var array */
	private $pdf;
	/** @var array */
	private $lines;
	/** @var array */
	private $soap;
	/** @var array */
	private $templates;

	public function __construct( ?array $Invoice = null ) {
		if ( is_array( $Invoice ) ) {
			$this->parse_array( $Invoice );
		}
	}

	/**
	 * @param int|null $draftInvoiceNumber
	 */
	public function set_draft_invoice_number( ?int $draftInvoiceNumber ): self {
		$this->draftInvoiceNumber = $draftInvoiceNumber;

		return $this;

	}

	/**
	 * @return int|null
	 */
	public function get_draft_invoice_number(): ?int {
		return $this->draftInvoiceNumber;
	}

	/**
	 * @param DateTime|string|null $date
	 */
	public function set_date( $date ): self {
		if ( is_string( $date ) ) {
			$date = date_create( $date );
		}
		$this->date = $date;

		return $this;

	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_date( ?string $format = null ) {
		if ( $this->date instanceof DateTime && ! empty( $format ) ) {
			return $this->date->format( $format );
		}

		return $this->date;
	}

	/**
	 * @param Currency|array|string|null $currency
	 */
	public function set_currency( $currency ): self {
		if ( is_array( $currency ) ) {
			$currency = new Currency( $currency );
		}
		$this->currency = $currency;

		return $this;

	}

	/**
	 * @return Currency|string|null
	 */
	public function get_currency() {
		return $this->currency;
	}

	/**
	 * @param float|null $exchangeRate
	 */
	public function set_exchange_rate( ?float $exchangeRate ): self {
		$this->exchangeRate = $exchangeRate;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_exchange_rate(): ?float {
		return $this->exchangeRate;
	}

	/**
	 * @param float|null $netAmount
	 */
	public function set_net_amount( ?float $netAmount ): self {
		$this->netAmount = $netAmount;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_net_amount(): ?float {
		return $this->netAmount;
	}

	/**
	 * @param float|null $netAmountInBaseCurrency
	 */
	public function set_net_amount_in_base_currency( ?float $netAmountInBaseCurrency ): self {
		$this->netAmountInBaseCurrency = $netAmountInBaseCurrency;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_net_amount_in_base_currency(): ?float {
		return $this->netAmountInBaseCurrency;
	}

	/**
	 * @param float|null $grossAmount
	 */
	public function set_gross_amount( ?float $grossAmount ): self {
		$this->grossAmount = $grossAmount;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_gross_amount(): ?float {
		return $this->grossAmount;
	}

	/**
	 * @param float|null $grossAmountInBaseCurrency
	 */
	public function set_gross_amount_in_base_currency( ?float $grossAmountInBaseCurrency ): self {
		$this->grossAmountInBaseCurrency = $grossAmountInBaseCurrency;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_gross_amount_in_base_currency(): ?float {
		return $this->grossAmountInBaseCurrency;
	}

	/**
	 * @param float|null $marginInBaseCurrency
	 */
	public function set_margin_in_base_currency( ?float $marginInBaseCurrency ): self {
		$this->marginInBaseCurrency = $marginInBaseCurrency;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_margin_in_base_currency(): ?float {
		return $this->marginInBaseCurrency;
	}

	/**
	 * @param float|null $marginPercentage
	 */
	public function set_margin_percentage( ?float $marginPercentage ): self {
		$this->marginPercentage = $marginPercentage;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_margin_percentage(): ?float {
		return $this->marginPercentage;
	}

	/**
	 * @param float|null $vatAmount
	 */
	public function set_vat_amount( ?float $vatAmount ): self {
		$this->vatAmount = $vatAmount;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_vat_amount(): ?float {
		return $this->vatAmount;
	}

	/**
	 * @param float|null $roundingAmount
	 */
	public function set_rounding_amount( ?float $roundingAmount ): self {
		$this->roundingAmount = $roundingAmount;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_rounding_amount(): ?float {
		return $this->roundingAmount;
	}

	/**
	 * @param float|null $costPriceInBaseCurrency
	 */
	public function set_cost_price_in_base_currency( ?float $costPriceInBaseCurrency ): self {
		$this->costPriceInBaseCurrency = $costPriceInBaseCurrency;

		return $this;

	}

	/**
	 * @return float|null
	 */
	public function get_cost_price_in_base_currency(): ?float {
		return $this->costPriceInBaseCurrency;
	}

	/**
	 * @param DateTime|string|null $dueDate
	 */
	public function set_due_date( $dueDate ): self {
		if ( is_string( $dueDate ) ) {
			$dueDate = date_create( $dueDate );
		}
		$this->dueDate = $dueDate;

		return $this;

	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_due_date( ?string $format = null ) {
		if ( $this->dueDate instanceof DateTime && ! empty( $format ) ) {
			return $this->dueDate->format( $format );
		}

		return $this->dueDate;
	}

	/**
	 * @param PaymentTerm|array|null $paymentTerms
	 */
	public function set_payment_terms( $paymentTerms ): self {
		if ( is_array( $paymentTerms ) ) {
			$paymentTerms = new PaymentTerm( $paymentTerms );
		}
		$this->paymentTerms = $paymentTerms;

		return $this;

	}

	/**
	 * @return PaymentTerm|null
	 */
	public function get_payment_terms(): ?PaymentTerm {
		return $this->paymentTerms;
	}

	/**
	 * @param Customer|array|null $customer
	 */
	public function set_customer( $customer ): self {
		if ( is_array( $customer ) ) {
			$customer = new Customer( $customer );
		}
		$this->customer = $customer;

		return $this;

	}

	/**
	 * @return Customer|null
	 */
	public function get_customer(): ?Customer {
		return $this->customer;
	}

	/**
	 * @param Recipient|array|null $recipient
	 */
	public function set_recipient( $recipient ): self {
		if ( is_array( $recipient ) ) {
			$recipient = new Recipient( $recipient );
		}
		$this->recipient = $recipient;

		return $this;

	}

	/**
	 * @return Recipient|null
	 */
	public function get_recipient(): ?Recipient {
		return $this->recipient;
	}

	/**
	 * @param DeliveryLocation|array|null $deliveryLocation
	 */
	public function set_delivery_location( $deliveryLocation ): self {
		if ( is_array( $deliveryLocation ) ) {
			$deliveryLocation = new DeliveryLocation( $deliveryLocation );
		}
		$this->deliveryLocation = $deliveryLocation;

		return $this;

	}

	/**
	 * @return DeliveryLocation|null
	 */
	public function get_delivery_location(): ?DeliveryLocation {
		return $this->deliveryLocation;
	}

	/**
	 * @param Delivery|array|null $delivery
	 */
	public function set_delivery( $delivery ): self {
		if ( is_array( $delivery ) ) {
			$delivery = new Delivery( $delivery );
		}
		$this->delivery = $delivery;

		return $this;

	}

	/**
	 * @return Delivery|null
	 */
	public function get_delivery(): ?Delivery {
		return $this->delivery;
	}

	/**
	 * @param array $notes
	 */
	public function set_notes( array $notes ): self {
		$this->notes = $notes;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_notes(): array {
		return $this->notes;
	}

	/**
	 * @param array $references
	 */
	public function set_references( array $references ): self {
		$this->references = $references;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_references(): array {
		return $this->references;
	}

	/**
	 * @param Layout|array|int|null $layout
	 */
	public function set_layout( $layout ): self {
		if ( is_array( $layout ) ) {
			$layout = new Layout( $layout );
		}
		$this->layout = $layout;

		return $this;

	}

	/**
	 * @return Layout
	 */
	public function get_layout(): Layout {
		return $this->layout;
	}

	/**
	 * @param array $project
	 */
	public function set_project( array $project ): self {
		$this->project = $project;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_project(): array {
		return $this->project;
	}

	/**
	 * @param array $pdf
	 */
	public function set_pdf( array $pdf ): self {
		$this->pdf = $pdf;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_pdf(): array {
		return $this->pdf;
	}

	/**
	 * @param array $lines
	 */
	public function set_lines( array $lines ): self {
		$this->lines = $lines;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_lines(): array {
		return $this->lines;
	}

	/**
	 * @param array $soap
	 */
	public function set_soap( array $soap ): self {
		$this->soap = $soap;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_soap(): array {
		return $this->soap;
	}

	/**
	 * @param array $templates
	 */
	public function set_templates( array $templates ): self {
		$this->templates = $templates;

		return $this;

	}

	/**
	 * @return array
	 */
	public function get_templates(): array {
		return $this->templates;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );

		$vars['date']     = $this->get_date( 'Y-m-d' );
		$vars['dueDate']  = $this->get_due_date( 'Y-m-d' );
		$vars['currency'] = $this->get_currency() instanceof Currency ? $this->get_currency()->get_code() : $this->get_currency();

		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}