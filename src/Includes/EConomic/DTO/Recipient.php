<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Recipient extends Base {
	/** @var string|null */
	private $publicEntryNumber;
	/** @var string|null */
	private $address;
	/** @var string|null */
	private $zip;
	/** @var string|null */
	private $city;
	/** @var string|null */
	private $country;
	/** @var string|null */
	private $ean;
	/** @var string|null */
	private $mobilePhone;
	/** @var string|null */
	private $nemHandelType;
	/** @var Attention|null */
	private $attention;
	/** @var VatZone|null */
	private $vatZone;

	public function __construct( ?array $Recipient = null ) {
		if ( is_array( $Recipient ) ) {
			$this->parse_array( $Recipient );
		}
	}

	/**
	 * @param string|null $publicEntryNumber
	 *
	 * @return Recipient
	 */
	public function set_public_entry_number( ?string $publicEntryNumber ): self {
		$this->publicEntryNumber = $publicEntryNumber;

		return $this;
	}

	/**
	 * @param string|null $address
	 *
	 * @return Recipient
	 */
	public function set_address( ?string $address ): self {
		$this->address = $address;

		return $this;
	}

	/**
	 * @param string|null $zip
	 *
	 * @return Recipient
	 */
	public function set_zip( ?string $zip ): self {
		$this->zip = $zip;

		return $this;
	}

	/**
	 * @param string|null $city
	 *
	 * @return Recipient
	 */
	public function set_city( ?string $city ): self {
		$this->city = $city;

		return $this;
	}

	/**
	 * @param string|null $country
	 *
	 * @return Recipient
	 */
	public function set_country( ?string $country ): self {
		$this->country = $country;

		return $this;
	}

	/**
	 * @param string|null $ean
	 *
	 * @return Recipient
	 */
	public function set_ean( ?string $ean ): self {
		$this->ean = $ean;

		return $this;
	}

	/**
	 * @param string|null $mobilePhone
	 *
	 * @return Recipient
	 */
	public function set_mobile_phone( ?string $mobilePhone ): self {
		$this->mobilePhone = $mobilePhone;

		return $this;
	}

	/**
	 * @param string|null $nemHandelType
	 *
	 * @return Recipient
	 */
	public function set_nem_handel_type( ?string $nemHandelType ): self {
		$this->nemHandelType = $nemHandelType;

		return $this;
	}

	/**
	 * @param Attention|array|null $attention
	 *
	 * @return Recipient
	 */
	public function set_attention( $attention ): self {
		if ( is_array( $attention ) ) {
			$attention = new Attention( $attention );
		}
		$this->attention = $attention;

		return $this;
	}

	/**
	 * @param VatZone|array|null $vatZone
	 *
	 * @return Recipient
	 */
	public function set_vat_zone( $vatZone ): self {
		if ( is_array( $vatZone ) ) {
			$vatZone = new VatZone( $vatZone );
		}
		$this->vatZone = $vatZone;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_public_entry_number(): ?string {
		return $this->publicEntryNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_address(): ?string {
		return $this->address;
	}

	/**
	 * @return string|null
	 */
	public function get_zip(): ?string {
		return $this->zip;
	}

	/**
	 * @return string|null
	 */
	public function get_city(): ?string {
		return $this->city;
	}

	/**
	 * @return string|null
	 */
	public function get_country(): ?string {
		return $this->country;
	}

	/**
	 * @return string|null
	 */
	public function get_ean(): ?string {
		return $this->ean;
	}

	/**
	 * @return string|null
	 */
	public function get_mobile_phone(): ?string {
		return $this->mobilePhone;
	}

	/**
	 * @return string|null
	 */
	public function get_nem_handel_type(): ?string {
		return $this->nemHandelType;
	}

	/**
	 * @return Attention|null
	 */
	public function get_attention(): ?Attention {
		return $this->attention;
	}

	/**
	 * @return VatZone|null
	 */
	public function get_vat_zone(): ?VatZone {
		return $this->vatZone;
	}

	public function jsonSerialize(): array {
		$vars            = get_object_vars( $this );
		$vars['name']    = $this->get_name();
		$vars['self']    = $this->get_self();
		$vars['vatZone'] = [ 'vatZoneNumber' => $this->get_vat_zone()->get_vat_zone_number() ];
		$vars            = Util::filter_null_from( $vars );

		return $vars;
	}
}