<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;
use MIQID\Plugin\WooCommerce\Util;

class Invoice extends DTO {
	/** @var string|null */
	private $Guid;
	/** @var string|null */
	private $ContactGuid;
	/** @var string|null */
	private $InvoiceTemplateId;
	/** @var string|null */
	private $ExternalReference;
	/** @var string|null */
	private $Language;
	/** @var string|null */
	private $Currency;
	/** @var DateTime|null */
	private $Date;
	/** @var string|null */
	private $TimeStamp;
	/** @var DateTime|null */
	private $CreatedAt;
	/** @var DateTime|null */
	private $UpdatedAt;
	/** @var DateTime|null */
	private $DeletedAt;
	/** @var DateTime|null */
	private $PaymentDate;
	/** @var string|null */
	private $Status;
	/** @var string|null */
	private $MailOutStatus;
	/** @var string|null */
	private $PaymentStatus;
	/** @var int|null */
	private $PaymentConditionNumberOfDays;
	/** @var string|null */
	private $PaymentConditionType;
	/** @var string|null */
	private $FikCode;
	/** @var int|null */
	private $DepositAccountNumber;
	/** @var string|null */
	private $LatestMailOutType;
	/** @var string|null */
	private $Description;
	/** @var string|null */
	private $Comment;
	/** @var string|null */
	private $Address;
	/** @var int|null */
	private $Number;
	/** @var string|null */
	private $ContactName;
	/** @var string|null */
	private $ShowLinesInclVat;
	/** @var ProductLine[]|null */
	private $ProductLines;
	/** @var array|null */
	private $TotalLines;
	/** @var float|null */
	private $TotalExclVat;
	/** @var float|null */
	private $TotalVatableAmount;
	/** @var float|null */
	private $TotalInclVat;
	/** @var float|null */
	private $TotalNonVatableAmount;
	/** @var float|null */
	private $TotalVat;
	/** @var bool */
	private $IsSentToDebtCollection;
	/** @var bool */
	private $IsMobilePayInvoiceEnabled;

	public function __construct( array $invoice_arr = null ) {
		if ( is_array( $invoice_arr ) ) {
			$this->parse_array( $invoice_arr );
		}
	}

	/**
	 * @param string|null $Guid
	 *
	 * @return Invoice
	 */
	public function set_guid( ?string $Guid ): self {
		$this->Guid = $Guid;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_guid(): ?string {
		return $this->Guid;
	}

	/**
	 * @param string|null $ContactGuid
	 *
	 * @return Invoice
	 */
	public function set_contact_guid( ?string $ContactGuid ): self {
		$this->ContactGuid = $ContactGuid;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_contact_guid(): ?string {
		return $this->ContactGuid;
	}

	/**
	 * @param string|null $InvoiceTemplateId
	 *
	 * @return Invoice
	 */
	public function set_invoice_template_id( ?string $InvoiceTemplateId ): self {
		$this->InvoiceTemplateId = $InvoiceTemplateId;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_invoice_template_id(): ?string {
		return $this->InvoiceTemplateId;
	}

	/**
	 * @param string|null $ExternalReference
	 *
	 * @return Invoice
	 */
	public function set_external_reference( ?string $ExternalReference ): self {
		$this->ExternalReference = $ExternalReference;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_external_reference(): ?string {
		return $this->ExternalReference;
	}

	/**
	 * @param string|null $Language
	 *
	 * @return Invoice
	 */
	public function set_language( ?string $Language ): self {
		$this->Language = $Language;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_language(): ?string {
		return $this->Language;
	}

	/**
	 * @param string|null $Currency
	 *
	 * @return Invoice
	 */
	public function set_currency( ?string $Currency ): self {
		$this->Currency = $Currency;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_currency(): ?string {
		return $this->Currency;
	}

	/**
	 * @param DateTime|string|null $Date
	 *
	 * @return Invoice
	 */
	public function set_date( $Date ): self {
		if ( is_string( $Date ) ) {
			$Date = date_create( $Date );
		}
		$this->Date = $Date;

		return $this;
	}

	/**
	 * @param string|null $format
	 *
	 * @return DateTime|string|null
	 */
	public function get_date( ?string $format = null ) {
		if ( $this->Date instanceof DateTime && ! empty( $format ) ) {
			return $this->Date->format( $format );
		}

		return $this->Date;
	}

	/**
	 * @param string|null $TimeStamp
	 *
	 * @return Invoice
	 */
	public function set_time_stamp( ?string $TimeStamp ): self {
		$this->TimeStamp = $TimeStamp;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_time_stamp(): ?string {
		return $this->TimeStamp;
	}

	/**
	 * @param DateTime|string|null $CreatedAt
	 *
	 * @return Invoice
	 */
	public function set_created_at( $CreatedAt ): self {
		if ( is_string( $CreatedAt ) ) {
			$CreatedAt = date_create( $CreatedAt );
		}
		$this->CreatedAt = $CreatedAt;

		return $this;
	}

	/**
	 * @param null $format
	 *
	 * @return DateTime|string|null
	 */
	public function get_created_at( $format = null ) {
		if ( $this->CreatedAt instanceof DateTime && ! empty( $format ) ) {
			return $this->CreatedAt->format( $format );
		}

		return $this->CreatedAt;
	}

	/**
	 * @param DateTime|string|null $UpdatedAt
	 *
	 * @return Invoice
	 */
	public function set_updated_at( $UpdatedAt ): self {
		if ( is_string( $UpdatedAt ) ) {
			$UpdatedAt = date_create( $UpdatedAt );
		}
		$this->UpdatedAt = $UpdatedAt;

		return $this;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_updated_at( $format = null ) {
		if ( $this->UpdatedAt instanceof DateTime && ! empty( $format ) ) {
			return $this->UpdatedAt->format( $format );
		}

		return $this->UpdatedAt;
	}

	/**
	 * @param DateTime|string|null $DeletedAt
	 *
	 * @return Invoice
	 */
	public function set_deleted_at( $DeletedAt ): self {
		if ( is_string( $DeletedAt ) ) {
			$DeletedAt = date_create( $DeletedAt );
		}
		$this->DeletedAt = $DeletedAt;

		return $this;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_deleted_at( $format = null ) {
		if ( $this->DeletedAt instanceof DateTime && ! empty( $format ) ) {
			return $this->DeletedAt->format( $format );
		}

		return $this->DeletedAt;
	}

	/**
	 * @param DateTime|string|null $PaymentDate
	 *
	 * @return Invoice
	 */
	public function set_payment_date( $PaymentDate ): self {
		if ( is_string( $PaymentDate ) ) {
			$PaymentDate = date_create( $PaymentDate );
		}
		$this->PaymentDate = $PaymentDate;

		return $this;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_payment_date( $format = null ) {
		if ( $this->PaymentDate instanceof DateTime && ! empty( $format ) ) {
			return $this->PaymentDate->format( $format );
		}

		return $this->PaymentDate;
	}

	/**
	 * @param string|null $Status
	 *
	 * @return Invoice
	 */
	public function set_status( ?string $Status ): self {
		$this->Status = $Status;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_status(): ?string {
		return $this->Status;
	}

	/**
	 * @param string|null $MailOutStatus
	 *
	 * @return Invoice
	 */
	public function set_mail_out_status( ?string $MailOutStatus ): self {
		$this->MailOutStatus = $MailOutStatus;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_mail_out_status(): ?string {
		return $this->MailOutStatus;
	}

	/**
	 * @param string|null $PaymentStatus
	 *
	 * @return Invoice
	 */
	public function set_payment_status( ?string $PaymentStatus ): self {
		$this->PaymentStatus = $PaymentStatus;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_payment_status(): ?string {
		return $this->PaymentStatus;
	}

	/**
	 * @param int|null $PaymentConditionNumberOfDays
	 *
	 * @return Invoice
	 */
	public function set_payment_condition_number_of_days( ?int $PaymentConditionNumberOfDays ): self {
		$this->PaymentConditionNumberOfDays = $PaymentConditionNumberOfDays;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_payment_condition_number_of_days(): ?int {
		return $this->PaymentConditionNumberOfDays;
	}

	/**
	 * @param string|null $PaymentConditionType
	 *
	 * @return Invoice
	 */
	public function set_payment_condition_type( ?string $PaymentConditionType ): self {
		$this->PaymentConditionType = $PaymentConditionType;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_payment_condition_type(): ?string {
		return $this->PaymentConditionType;
	}

	/**
	 * @param string|null $FikCode
	 *
	 * @return Invoice
	 */
	public function set_fik_code( ?string $FikCode ): self {
		$this->FikCode = $FikCode;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_fik_code(): ?string {
		return $this->FikCode;
	}

	/**
	 * @param int|null $DepositAccountNumber
	 *
	 * @return Invoice
	 */
	public function set_deposit_account_number( ?int $DepositAccountNumber ): self {
		$this->DepositAccountNumber = $DepositAccountNumber;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_deposit_account_number(): ?int {
		return $this->DepositAccountNumber;
	}

	/**
	 * @param string|null $LatestMailOutType
	 *
	 * @return Invoice
	 */
	public function set_latest_mail_out_type( ?string $LatestMailOutType ): self {
		$this->LatestMailOutType = $LatestMailOutType;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_latest_mail_out_type(): ?string {
		return $this->LatestMailOutType;
	}

	/**
	 * @param string|null $Description
	 *
	 * @return Invoice
	 */
	public function set_description( ?string $Description ): self {
		$this->Description = $Description;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->Description;
	}

	/**
	 * @param string|null $Comment
	 *
	 * @return Invoice
	 */
	public function set_comment( ?string $Comment ): self {
		$this->Comment = $Comment;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_comment(): ?string {
		return $this->Comment;
	}

	/**
	 * @param string|null $Address
	 *
	 * @return Invoice
	 */
	public function set_address( ?string $Address ): self {
		$this->Address = $Address;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_address(): ?string {
		return $this->Address;
	}

	/**
	 * @param int|null $Number
	 *
	 * @return Invoice
	 */
	public function set_number( ?int $Number ): self {
		$this->Number = $Number;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_number(): ?int {
		return $this->Number;
	}

	/**
	 * @param string|null $ContactName
	 *
	 * @return Invoice
	 */
	public function set_contact_name( ?string $ContactName ): self {
		$this->ContactName = $ContactName;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_contact_name(): ?string {
		return $this->ContactName;
	}

	/**
	 * @param string|null $ShowLinesInclVat
	 *
	 * @return Invoice
	 */
	public function set_show_lines_incl_vat( ?string $ShowLinesInclVat ): self {
		$this->ShowLinesInclVat = $ShowLinesInclVat;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_show_lines_incl_vat(): ?string {
		return $this->ShowLinesInclVat;
	}

	/**
	 * @param ProductLine[]|null $ProductLines
	 *
	 * @return Invoice
	 */
	public function set_product_lines( ?array $ProductLines ): self {
		$this->ProductLines = $ProductLines;

		return $this;
	}

	/**
	 * @return ProductLine[]|null
	 */
	public function get_product_lines(): ?array {
		return $this->ProductLines;
	}

	/**
	 * @param array|null $TotalLines
	 *
	 * @return Invoice
	 */
	public function set_total_lines( ?array $TotalLines ): self {
		$this->TotalLines = $TotalLines;

		return $this;
	}

	/**
	 * @return array|null
	 */
	public function get_total_lines(): ?array {
		return $this->TotalLines;
	}

	/**
	 * @param float|null $TotalExclVat
	 *
	 * @return Invoice
	 */
	public function set_total_excl_vat( ?float $TotalExclVat ): self {
		$this->TotalExclVat = $TotalExclVat;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_total_excl_vat(): ?float {
		return $this->TotalExclVat;
	}

	/**
	 * @param float|null $TotalVatableAmount
	 *
	 * @return Invoice
	 */
	public function set_total_vatable_amount( ?float $TotalVatableAmount ): self {
		$this->TotalVatableAmount = $TotalVatableAmount;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_total_vatable_amount(): ?float {
		return $this->TotalVatableAmount;
	}

	/**
	 * @param float|null $TotalInclVat
	 *
	 * @return Invoice
	 */
	public function set_total_incl_vat( ?float $TotalInclVat ): self {
		$this->TotalInclVat = $TotalInclVat;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_total_incl_vat(): ?float {
		return $this->TotalInclVat;
	}

	/**
	 * @param float|null $TotalNonVatableAmount
	 *
	 * @return Invoice
	 */
	public function set_total_non_vatable_amount( ?float $TotalNonVatableAmount ): self {
		$this->TotalNonVatableAmount = $TotalNonVatableAmount;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_total_non_vatable_amount(): ?float {
		return $this->TotalNonVatableAmount;
	}

	/**
	 * @param float|null $TotalVat
	 *
	 * @return Invoice
	 */
	public function set_total_vat( ?float $TotalVat ): self {
		$this->TotalVat = $TotalVat;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_total_vat(): ?float {
		return $this->TotalVat;
	}

	/**
	 * @param bool $IsSentToDebtCollection
	 *
	 * @return Invoice
	 */
	public function set_is_sent_to_debt_collection( bool $IsSentToDebtCollection ): self {
		$this->IsSentToDebtCollection = $IsSentToDebtCollection;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function is_sent_to_debt_collection(): bool {
		return $this->IsSentToDebtCollection;
	}

	/**
	 * @param bool $IsMobilePayInvoiceEnabled
	 *
	 * @return Invoice
	 */
	public function set_is_mobile_pay_invoice_enabled( bool $IsMobilePayInvoiceEnabled ): self {
		$this->IsMobilePayInvoiceEnabled = $IsMobilePayInvoiceEnabled;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function is_mobile_pay_invoice_enabled(): bool {
		return $this->IsMobilePayInvoiceEnabled;
	}


	public function jsonSerialize() {
		$vars         = get_object_vars( $this );
		$vars['Date'] = $this->get_date( 'Y-m-d' );
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}