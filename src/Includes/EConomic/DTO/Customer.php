<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Customer extends Base {
	/** @var int */
	private $customerNumber;
	/** @var string */
	private $address;
	/** @var float */
	private $balance;
	/** @var bool */
	private $barred;
	/** @var string */
	private $city;
	/** @var string */
	private $corporateIdentificationNumber;
	/** @var string */
	private $country;
	/** @var int */
	private $creditLimit;
	/** @var Currency */
	private $currency;
	/** @var CustomerGroup */
	private $customerGroup;
	/** @var string */
	private $ean;
	/** @var bool */
	private $eInvoicingDisabledByDefault;
	/** @var string */
	private $email;
	/** @var Layout */
	private $layout;
	/** @var string */
	private $mobilePhone;
	/** @var string */
	private $name;
	/** @var PaymentTerm */
	private $paymentTerms;
	/** @var string */
	private $pNumber;
	/** @var string */
	private $publicEntryNumber;
	/** @var SalesPerson */
	private $salesPerson;
	/** @var string */
	private $telephoneAndFaxNumber;
	/** @var string */
	private $vatNumber;
	/** @var VatZone */
	private $vatZone;
	/** @var string */
	private $website;
	/** @var string */
	private $zip;

	public function __construct( ?array $Customer = null ) {
		if ( is_array( $Customer ) ) {
			$this->parse_array( $Customer );
		}
	}

	/**
	 * @param string|null $address
	 *
	 * @return Customer
	 */
	public function set_address( ?string $address ): self {
		$this->address = $address;

		return $this;
	}

	/**
	 * @param int|null $balance
	 *
	 * @return Customer
	 */
	public function set_balance( ?int $balance ): self {
		$this->balance = $balance;

		return $this;
	}

	/**
	 * @param bool|null $barred
	 *
	 * @return Customer
	 */
	public function set_barred( ?bool $barred ): self {
		$this->barred = $barred;

		return $this;
	}

	/**
	 * @param string $city
	 *
	 * @return Customer
	 */
	public function set_city( ?string $city ): self {
		$this->city = $city;

		return $this;
	}

	/**
	 * @param string $corporateIdentificationNumber
	 *
	 * @return Customer
	 */
	public function set_corporate_identification_number( ?string $corporateIdentificationNumber ): self {
		$this->corporateIdentificationNumber = $corporateIdentificationNumber;

		return $this;
	}

	/**
	 * @param string $country
	 *
	 * @return Customer
	 */
	public function set_country( ?string $country ): self {
		$this->country = $country;

		return $this;
	}

	/**
	 * @param int|null $creditLimit
	 *
	 * @return Customer
	 */
	public function set_credit_limit( ?int $creditLimit ): self {
		$this->creditLimit = $creditLimit;

		return $this;
	}

	/**
	 * @param Currency|array|string|null $currency
	 *
	 * @return Customer
	 */
	public function set_currency( $currency ): self {
		if ( is_array( $currency ) || is_string( $currency ) ) {
			$currency = new Currency( $currency );
		}
		$this->currency = $currency;

		return $this;
	}

	/**
	 * @param array|CustomerGroup $customerGroup
	 *
	 * @return Customer
	 */
	public function set_customer_group( $customerGroup ): self {
		if ( is_array( $customerGroup ) ) {
			$customerGroup = new CustomerGroup( $customerGroup );
		}
		$this->customerGroup = $customerGroup;

		return $this;
	}

	/**
	 * @param int|null $customerNumber
	 *
	 * @return Customer
	 */
	public function set_customer_number( ?int $customerNumber ): self {
		$this->customerNumber = $customerNumber;

		return $this;
	}

	/**
	 * @param string $ean
	 *
	 * @return Customer
	 */
	public function set_ean( ?string $ean ): self {
		$this->ean = $ean;

		return $this;
	}

	/**
	 * @param bool|null $eInvoicingDisabledByDefault
	 *
	 * @return Customer
	 */
	public function set_e_invoicing_disabled_by_default( ?bool $eInvoicingDisabledByDefault ): self {
		$this->eInvoicingDisabledByDefault = $eInvoicingDisabledByDefault;

		return $this;
	}

	/**
	 * @param string $email
	 *
	 * @return Customer
	 */
	public function set_email( ?string $email ): self {
		$this->email = $email;

		return $this;
	}

	/**
	 * @param array|Layout $layout
	 *
	 * @return Customer
	 */
	public function set_layout( $layout ): self {
		if ( is_array( $layout ) ) {
			$layout = new Layout( $layout );
		}
		$this->layout = $layout;

		return $this;
	}

	/**
	 * @param string $mobilePhone
	 *
	 * @return Customer
	 */
	public function set_mobile_phone( ?string $mobilePhone ): self {
		$this->mobilePhone = $mobilePhone;

		return $this;
	}

	/**
	 * @param string $name
	 *
	 * @return Customer
	 */
	public function set_name( ?string $name ): self {
		$this->name = $name;

		return $this;
	}

	/**
	 * @param array|PaymentTerm $paymentTerms
	 *
	 * @return Customer
	 */
	public function set_payment_terms( $paymentTerms ): self {
		if ( is_array( $paymentTerms ) ) {
			$paymentTerms = new PaymentTerm( $paymentTerms );
		}
		$this->paymentTerms = $paymentTerms;

		return $this;
	}

	/**
	 * @param string $pNumber
	 *
	 * @return Customer
	 */
	public function set_p_number( ?string $pNumber ): self {
		$this->pNumber = $pNumber;

		return $this;
	}

	/**
	 * @param string $publicEntryNumber
	 *
	 * @return Customer
	 */
	public function set_public_entry_number( ?string $publicEntryNumber ): self {
		$this->publicEntryNumber = $publicEntryNumber;

		return $this;
	}

	/**
	 * @param array|SalesPerson $salesPerson
	 *
	 * @return Customer
	 */
	public function set_sales_person( $salesPerson ): self {
		if ( is_array( $salesPerson ) ) {
			$salesPerson = new SalesPerson( $salesPerson );
		}
		$this->salesPerson = $salesPerson;

		return $this;
	}

	/**
	 * @param string $telephoneAndFaxNumber
	 *
	 * @return Customer
	 */
	public function set_telephone_and_fax_number( ?string $telephoneAndFaxNumber ): self {
		$this->telephoneAndFaxNumber = $telephoneAndFaxNumber;

		return $this;
	}

	/**
	 * @param string $vatNumber
	 *
	 * @return Customer
	 */
	public function set_vat_number( ?string $vatNumber ): self {
		$this->vatNumber = $vatNumber;

		return $this;
	}

	/**
	 * @param array|VatZone $vatZone
	 *
	 * @return Customer
	 */
	public function set_vat_zone( $vatZone ): self {
		if ( is_array( $vatZone ) ) {
			$vatZone = new VatZone( $vatZone );
		}
		$this->vatZone = $vatZone;

		return $this;
	}

	/**
	 * @param string $website
	 *
	 * @return Customer
	 */
	public function set_website( ?string $website ): self {
		$this->website = $website;

		return $this;
	}

	/**
	 * @param string $zip
	 *
	 * @return Customer
	 */
	public function set_zip( ?string $zip ): self {
		$this->zip = $zip;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_address(): ?string {
		return $this->address;
	}

	/**
	 * @return int|null
	 */
	public function get_balance(): ?int {
		return $this->balance;
	}

	/**
	 * @return bool|null
	 */
	public function get_barred(): ?bool {
		return $this->barred;
	}

	/**
	 * @return string
	 */
	public function get_city(): ?string {
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function get_corporate_identification_number(): ?string {
		return $this->corporateIdentificationNumber;
	}

	/**
	 * @return string
	 */
	public function get_country(): ?string {
		return $this->country;
	}

	/**
	 * @return int|null
	 */
	public function get_credit_limit(): ?int {
		return $this->creditLimit;
	}

	/**
	 * @return Currency
	 */
	public function get_currency(): Currency {
		return $this->currency ?? new Currency();
	}

	/**
	 * @return CustomerGroup
	 */
	public function get_customer_group(): CustomerGroup {
		return $this->customerGroup ?? new CustomerGroup();
	}

	/**
	 * @return int|null
	 */
	public function get_customer_number(): ?int {
		return $this->customerNumber;
	}

	/**
	 * @return string
	 */
	public function get_ean(): ?string {
		return $this->ean;
	}

	/**
	 * @return bool
	 */
	public function get_e_invoicing_disabled_by_default(): bool {
		return $this->eInvoicingDisabledByDefault ?? false;
	}

	/**
	 * @return string
	 */
	public function get_email(): ?string {
		return $this->email;
	}

	/**
	 * @return Layout
	 */
	public function get_layout(): Layout {
		return $this->layout ?? new Layout();
	}

	/**
	 * @return string
	 */
	public function get_mobile_phone(): ?string {
		return $this->mobilePhone;
	}

	/**
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * @return PaymentTerm
	 */
	public function get_payment_terms(): PaymentTerm {
		return $this->paymentTerms ?? new PaymentTerm();
	}

	/**
	 * @return string
	 */
	public function get_p_number(): ?string {
		return $this->pNumber;
	}

	/**
	 * @return string
	 */
	public function get_public_entry_number(): ?string {
		return $this->publicEntryNumber;
	}

	/**
	 * @return SalesPerson
	 */
	public function get_sales_person(): SalesPerson {
		return $this->salesPerson ?? new SalesPerson();
	}

	/**
	 * @return string
	 */
	public function get_telephone_and_fax_number(): ?string {
		return $this->telephoneAndFaxNumber;
	}

	/**
	 * @return string
	 */
	public function get_vat_number(): ?string {
		return $this->vatNumber;
	}

	/**
	 * @return VatZone
	 */
	public function get_vat_zone(): VatZone {
		return $this->vatZone ?? new VatZone();
	}

	/**
	 * @return string
	 */
	public function get_website(): ?string {
		return $this->website;
	}

	/**
	 * @return string
	 */
	public function get_zip(): ?string {
		return $this->zip;
	}

	public function jsonSerialize(): array {
		$vars             = get_object_vars( $this );
		$vars['currency'] = $this->get_currency()->get_code();
		$vars             = Util::filter_null_from( $vars );

		return $vars;
	}
}
