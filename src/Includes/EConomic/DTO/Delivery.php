<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Util;

class Delivery extends Base {
	/** @var string|null */
	private $address;
	/** @var string|null */
	private $city;
	/** @var string|null */
	private $country;
	/** @var DateTime|null */
	private $deliveryDate;
	/** @var string|null */
	private $deliveryTerms;
	/** @var string|null */
	private $zip;

	public function __construct( ?array $Delivery = null ) {
		if ( is_array( $Delivery ) ) {
			$this->parse_array( $Delivery );
		}
	}


	/**
	 * @param string|null $address
	 */
	public function set_address( ?string $address ): void {
		$this->address = $address;
	}

	/**
	 * @return string|null
	 */
	public function get_address(): ?string {
		return $this->address;
	}

	/**
	 * @param string|null $city
	 */
	public function set_city( ?string $city ): void {
		$this->city = $city;
	}

	/**
	 * @return string|null
	 */
	public function get_city(): ?string {
		return $this->city;
	}

	/**
	 * @param string|null $country
	 */
	public function set_country( ?string $country ): void {
		$this->country = $country;
	}

	/**
	 * @return string|null
	 */
	public function get_country(): ?string {
		return $this->country;
	}

	/**
	 * @param DateTime|string|null
	 */
	public function set_delivery_date( $deliveryDate ): void {
		if ( is_string( $deliveryDate ) ) {
			$deliveryDate = date_create( $deliveryDate );
		}
		$this->deliveryDate = $deliveryDate;
	}

	/**
	 * @param string|null $format
	 *
	 * @return DateTime|string|null
	 */
	public function get_delivery_date( ?string $format = null ) {
		if ( $this->deliveryDate instanceof DateTime && ! empty( $format ) ) {
			return $this->deliveryDate->format( $format );
		}

		return $this->deliveryDate;
	}

	/**
	 * @param string|null $deliveryTerms
	 */
	public function set_delivery_terms( ?string $deliveryTerms ): void {
		$this->deliveryTerms = $deliveryTerms;
	}

	/**
	 * @return string|null
	 */
	public function get_delivery_terms(): ?string {
		return $this->deliveryTerms;
	}

	/**
	 * @param string|null $zip
	 */
	public function set_zip( ?string $zip ): void {
		$this->zip = $zip;
	}

	/**
	 * @return string|null
	 */
	public function get_zip(): ?string {
		return $this->zip;
	}

	public function jsonSerialize(): array {
		$vars                 = get_object_vars( $this );
		$vars['deliveryDate'] = $this->get_delivery_date( 'c' );
		$vars                 = Util::filter_null_from( $vars );

		return $vars;
	}
}