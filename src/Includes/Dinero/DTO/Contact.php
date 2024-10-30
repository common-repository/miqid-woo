<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;
use MIQID\Plugin\WooCommerce\Util;

class Contact extends DTO {
	/** @var string|null */
	private $ExternalReference;
	/** @var string */
	private $Name;
	/** @var string|null */
	private $Street;
	/** @var string|null */
	private $ZipCode;
	/** @var string|null */
	private $City;
	/** @var string */
	private $CountryKey;
	/** @var string|null */
	private $Phone;
	/** @var string|null */
	private $Email;
	/** @var string|null */
	private $Webpage;
	/** @var string|null */
	private $AttPerson;
	/** @var string|null */
	private $VatNumber;
	/** @var string|null */
	private $EanNumber;
	/** @var string|null */
	private $PaymentConditionType;
	/** @var int|null */
	private $PaymentConditionNumberOfDays;
	/** @var bool */
	private $IsPerson;
	/** @var bool */
	private $IsMember;
	/** @var string|null */
	private $MemberNumber;
	/** @var bool */
	private $UseCrv;
	/** @var string|null */
	private $CompanyTypeKey;
	/** @var string|null */
	private $ContactGuid;
	/** @var DateTime */
	private $CreatedAt;
	/** @var DateTime */
	private $UpdatedAt;
	/** @var DateTime */
	private $DeletedAt;
	/** @var bool */
	private $IsDebitor;
	/** @var bool */
	private $IsCreditor;
	/** @var string|null */
	private $CompanyStatus;
	/** @var string|null */
	private $VatRegionKey;

	public function __construct(
		$ExternalReference = null,
		$Name = null,
		$Street = null,
		$ZipCode = null,
		$City = null,
		$CountryKey = null,
		$Phone = null,
		$Email = null,
		$Webpage = null,
		$AttPerson = null,
		$VatNumber = null,
		$EanNumber = null,
		$PaymentConditionType = null,
		$PaymentConditionNumberOfDays = null,
		$IsPerson = null,
		$IsMember = null,
		$MemberNumber = null,
		$UseCrv = null,
		$CompanyTypeKey = null,
		$ContactGuid = null,
		$CreatedAt = null,
		$UpdatedAt = null,
		$DeletedAt = null,
		$IsDebitor = null,
		$IsCreditor = null,
		$CompanyStatus = null,
		$VatRegionKey = null
	) {
		if ( is_array( $ExternalReference ) ) {
			$this->parse_array( $ExternalReference );
		}

		if ( isset( $ExternalReference ) ) {
			$this->set_external_reference( $ExternalReference );
		}
		if ( isset( $Name ) ) {
			$this->set_name( $Name );
		}
		if ( isset( $Street ) ) {
			$this->set_street( $Street );
		}
		if ( isset( $ZipCode ) ) {
			$this->set_zip_code( $ZipCode );
		}
		if ( isset( $City ) ) {
			$this->set_city( $City );
		}
		if ( isset( $CountryKey ) ) {
			$this->set_country_key( $CountryKey );
		}
		if ( isset( $Phone ) ) {
			$this->set_phone( $Phone );
		}
		if ( isset( $Email ) ) {
			$this->set_email( $Email );
		}
		if ( isset( $Webpage ) ) {
			$this->set_webpage( $Webpage );
		}
		if ( isset( $AttPerson ) ) {
			$this->set_att_person( $AttPerson );
		}
		if ( isset( $VatNumber ) ) {
			$this->set_vat_number( $VatNumber );
		}
		if ( isset( $EanNumber ) ) {
			$this->set_ean_number( $EanNumber );
		}
		if ( isset( $PaymentConditionType ) ) {
			$this->set_payment_condition_type( $PaymentConditionType );
		}
		if ( isset( $PaymentConditionNumberOfDays ) ) {
			$this->set_payment_condition_number_of_days( $PaymentConditionNumberOfDays );
		}
		if ( isset( $IsPerson ) ) {
			$this->set_is_person( $IsPerson );
		}
		if ( isset( $IsMember ) ) {
			$this->set_is_member( $IsMember );
		}
		if ( isset( $MemberNumber ) ) {
			$this->set_member_number( $MemberNumber );
		}
		if ( isset( $UseCrv ) ) {
			$this->set_use_crv( $UseCrv );
		}
		if ( isset( $CompanyTypeKey ) ) {
			$this->set_company_type_key( $CompanyTypeKey );
		}
		if ( isset( $ContactGuid ) ) {
			$this->set_contact_guid( $ContactGuid );
		}
		if ( isset( $CreatedAt ) ) {
			$this->set_created_at( $CreatedAt );
		}
		if ( isset( $UpdatedAt ) ) {
			$this->set_updated_at( $UpdatedAt );
		}
		if ( isset( $DeletedAt ) ) {
			$this->set_deleted_at( $DeletedAt );
		}
		if ( isset( $IsDebitor ) ) {
			$this->set_is_debitor( $IsDebitor );
		}
		if ( isset( $IsCreditor ) ) {
			$this->set_is_creditor( $IsCreditor );
		}
		if ( isset( $CompanyStatus ) ) {
			$this->set_company_status( $CompanyStatus );
		}
		if ( isset( $VatRegionKey ) ) {
			$this->set_vat_region_key( $VatRegionKey );
		}
	}

	/**
	 * @param string|null $ExternalReference
	 *
	 * @return Contact
	 */
	public function set_external_reference( ?string $ExternalReference ): Contact {
		$this->ExternalReference = $ExternalReference;

		return $this;
	}

	/**
	 * @param string $Name
	 *
	 * @return Contact
	 */
	public function set_name( string $Name ): Contact {
		$this->Name = $Name;

		return $this;
	}

	/**
	 * @param string|null $Street
	 *
	 * @return Contact
	 */
	public function set_street( ?string $Street ): Contact {
		$this->Street = $Street;

		return $this;
	}

	/**
	 * @param string|null $ZipCode
	 *
	 * @return Contact
	 */
	public function set_zip_code( ?string $ZipCode ): Contact {
		$this->ZipCode = $ZipCode;

		return $this;
	}

	/**
	 * @param string|null $City
	 *
	 * @return Contact
	 */
	public function set_city( ?string $City ): Contact {
		$this->City = $City;

		return $this;
	}

	/**
	 * @param string $CountryKey
	 *
	 * @return Contact
	 */
	public function set_country_key( string $CountryKey ): Contact {
		$this->CountryKey = $CountryKey;

		return $this;
	}

	/**
	 * @param string|null $Phone
	 *
	 * @return Contact
	 */
	public function set_phone( ?string $Phone ): Contact {
		$this->Phone = $Phone;

		return $this;
	}

	/**
	 * @param string|null $Email
	 *
	 * @return Contact
	 */
	public function set_email( ?string $Email ): Contact {
		$this->Email = $Email;

		return $this;
	}

	/**
	 * @param string|null $Webpage
	 *
	 * @return Contact
	 */
	public function set_webpage( ?string $Webpage ): Contact {
		$this->Webpage = $Webpage;

		return $this;
	}

	/**
	 * @param string|null $AttPerson
	 *
	 * @return Contact
	 */
	public function set_att_person( ?string $AttPerson ): Contact {
		$this->AttPerson = $AttPerson;

		return $this;
	}

	/**
	 * @param string|null $VatNumber
	 *
	 * @return Contact
	 */
	public function set_vat_number( ?string $VatNumber ): Contact {
		$this->VatNumber = $VatNumber;

		return $this;
	}

	/**
	 * @param string|null $EanNumber
	 *
	 * @return Contact
	 */
	public function set_ean_number( ?string $EanNumber ): Contact {
		$this->EanNumber = $EanNumber;

		return $this;
	}

	/**
	 * @param string|null $PaymentConditionType
	 *
	 * @return Contact
	 */
	public function set_payment_condition_type( ?string $PaymentConditionType ): Contact {
		$this->PaymentConditionType = $PaymentConditionType;

		return $this;
	}

	/**
	 * @param int|null $PaymentConditionNumberOfDays
	 *
	 * @return Contact
	 */
	public function set_payment_condition_number_of_days( ?int $PaymentConditionNumberOfDays ): Contact {
		$this->PaymentConditionNumberOfDays = $PaymentConditionNumberOfDays;

		return $this;
	}

	/**
	 * @param bool $IsPerson
	 *
	 * @return Contact
	 */
	public function set_is_person( bool $IsPerson ): Contact {
		$this->IsPerson = $IsPerson;

		return $this;
	}

	/**
	 * @param bool $IsMember
	 *
	 * @return Contact
	 */
	public function set_is_member( bool $IsMember ): Contact {
		$this->IsMember = $IsMember;

		return $this;
	}

	/**
	 * @param string|null $MemberNumber
	 *
	 * @return Contact
	 */
	public function set_member_number( ?string $MemberNumber ): Contact {
		$this->MemberNumber = $MemberNumber;

		return $this;
	}

	/**
	 * @param bool $UseCrv
	 *
	 * @return Contact
	 */
	public function set_use_crv( bool $UseCrv ): Contact {
		$this->UseCrv = $UseCrv;

		return $this;
	}

	/**
	 * @param string|null $CompanyTypeKey
	 *
	 * @return Contact
	 */
	public function set_company_type_key( ?string $CompanyTypeKey ): Contact {
		$this->CompanyTypeKey = $CompanyTypeKey;

		return $this;
	}

	/**
	 * @param string|null $ContactGuid
	 *
	 * @return Contact
	 */
	public function set_contact_guid( ?string $ContactGuid ): Contact {
		$this->ContactGuid = $ContactGuid;

		return $this;
	}

	/**
	 * @param DateTime|string $CreatedAt
	 *
	 * @return Contact
	 */
	public function set_created_at( $CreatedAt ): Contact {
		if ( is_string( $CreatedAt ) ) {
			$CreatedAt = date_create( $CreatedAt );
		}
		$this->CreatedAt = $CreatedAt;

		return $this;
	}

	/**
	 * @param DateTime|string $UpdatedAt
	 *
	 * @return Contact
	 */
	public function set_updated_at( $UpdatedAt ): Contact {
		if ( is_string( $UpdatedAt ) ) {
			$UpdatedAt = date_create( $UpdatedAt );
		}
		$this->UpdatedAt = $UpdatedAt;

		return $this;
	}

	/**
	 * @param DateTime|string $DeletedAt
	 *
	 * @return Contact
	 */
	public function set_deleted_at( $DeletedAt ): Contact {
		if ( is_string( $DeletedAt ) ) {
			$DeletedAt = date_create( $DeletedAt );
		}
		$this->DeletedAt = $DeletedAt;

		return $this;
	}

	/**
	 * @param bool $IsDebitor
	 *
	 * @return Contact
	 */
	public function set_is_debitor( bool $IsDebitor ): Contact {
		$this->IsDebitor = $IsDebitor;

		return $this;

	}

	/**
	 * @param bool $IsCreditor
	 *
	 * @return Contact
	 */
	public function set_is_creditor( bool $IsCreditor ): Contact {
		$this->IsCreditor = $IsCreditor;

		return $this;
	}

	/**
	 * @param string|null $CompanyStatus
	 *
	 * @return Contact
	 */
	public function set_company_status( ?string $CompanyStatus ): Contact {
		$this->CompanyStatus = $CompanyStatus;

		return $this;
	}

	/**
	 * @param string|null $VatRegionKey
	 *
	 * @return Contact
	 */
	public function set_vat_region_key( ?string $VatRegionKey ): Contact {
		$this->VatRegionKey = $VatRegionKey;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_external_reference(): ?string {
		return $this->ExternalReference;
	}

	/**
	 * @return string
	 */
	public function get_name(): string {
		return $this->Name;
	}

	/**
	 * @return string|null
	 */
	public function get_street(): ?string {
		return $this->Street;
	}

	/**
	 * @return string|null
	 */
	public function get_zip_code(): ?string {
		return $this->ZipCode;
	}

	/**
	 * @return string|null
	 */
	public function get_city(): ?string {
		return $this->City;
	}

	/**
	 * @return string
	 */
	public function get_country_key(): string {
		return $this->CountryKey;
	}

	/**
	 * @return string|null
	 */
	public function get_phone(): ?string {
		return $this->Phone;
	}

	/**
	 * @return string|null
	 */
	public function get_email(): ?string {
		return $this->Email;
	}

	/**
	 * @return string|null
	 */
	public function get_webpage(): ?string {
		return $this->Webpage;
	}

	/**
	 * @return string|null
	 */
	public function get_att_person(): ?string {
		return $this->AttPerson;
	}

	/**
	 * @return string|null
	 */
	public function get_vat_number(): ?string {
		return $this->VatNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_ean_number(): ?string {
		return $this->EanNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_payment_condition_type(): ?string {
		return $this->PaymentConditionType;
	}

	/**
	 * @return int|null
	 */
	public function get_payment_condition_number_of_days(): ?int {
		return $this->PaymentConditionNumberOfDays;
	}

	/**
	 * @return bool
	 */
	public function is_is_person(): bool {
		return $this->IsPerson;
	}

	/**
	 * @return bool
	 */
	public function is_is_member(): bool {
		return $this->IsMember;
	}

	/**
	 * @return string|null
	 */
	public function get_member_number(): ?string {
		return $this->MemberNumber;
	}

	/**
	 * @return bool
	 */
	public function is_use_crv(): bool {
		return $this->UseCrv;
	}

	/**
	 * @return string|null
	 */
	public function get_company_type_key(): ?string {
		return $this->CompanyTypeKey;
	}

	/**
	 * @return string|null
	 */
	public function get_contact_guid(): ?string {
		return $this->ContactGuid;
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
	 * @param null $format
	 *
	 * @return DateTime|string|null
	 */
	public function get_updated_at( $format = null ) {
		if ( $this->UpdatedAt instanceof DateTime && ! empty( $format ) ) {
			return $this->UpdatedAt->format( $format );
		}

		return $this->UpdatedAt;
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
	 * @return bool
	 */
	public function is_is_debitor(): bool {
		return $this->IsDebitor ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_is_creditor(): bool {
		return $this->IsCreditor ?? false;
	}

	/**
	 * @return string|null
	 */
	public function get_company_status(): ?string {
		return $this->CompanyStatus;
	}

	/**
	 * @return string|null
	 */
	public function get_vat_region_key(): ?string {
		return $this->VatRegionKey;
	}


	public function jsonSerialize() {
		$vars = get_object_vars( $this );
		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}