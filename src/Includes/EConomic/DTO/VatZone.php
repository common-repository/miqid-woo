<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class VatZone extends Base {
	/** @var int|null */
	private $vatZoneNumber;
	/** @var string|null */
	private $name;
	/** @var bool */
	private $enabledForCustomer;
	/** @var bool */
	private $enabledForSupplier;
	/** @var string|null */
	private $self;

	public function __construct(
		$vatZoneNumber = null,
		$name = null,
		$enabledForCustomer = null,
		$enabledForSupplier = null,
		$self = null
	) {
		if ( is_array( $vatZoneNumber ) ) {
			$this->parse_array( $vatZoneNumber );
		}

		if ( isset( $vatZoneNumber ) ) {
			$this->set_vat_zone_number( $vatZoneNumber );
		}
		if ( isset( $name ) ) {
			$this->set_name( $name );
		}
		if ( isset( $enabledForCustomer ) ) {
			$this->set_enabled_for_customer( $enabledForCustomer );
		}
		if ( isset( $enabledForSupplier ) ) {
			$this->set_enabled_for_supplier( $enabledForSupplier );
		}
		if ( isset( $self ) ) {
			$this->set_self( $self );
		}
	}

	/**
	 * @param int|null $vatZoneNumber
	 */
	public function set_vat_zone_number( ?int $vatZoneNumber ): void {
		$this->vatZoneNumber = $vatZoneNumber ?? $this->vatZoneNumber;
	}

	/**
	 * @param bool|int|string|null $enabledForCustomer
	 */
	public function set_enabled_for_customer( $enabledForCustomer ): void {
		if ( ! is_null( $enabledForCustomer ) ) {
			$enabledForCustomer = filter_var( $enabledForCustomer, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->enabledForCustomer = $enabledForCustomer;
	}

	/**
	 * @param bool|int|string|null $enabledForSupplier
	 */
	public function set_enabled_for_supplier( $enabledForSupplier ): void {
		if ( ! is_null( $enabledForSupplier ) ) {
			$enabledForSupplier = filter_var( $enabledForSupplier, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->enabledForSupplier = $enabledForSupplier;
	}

	/**
	 * @return int|null
	 */
	public function get_vat_zone_number(): ?int {
		return $this->vatZoneNumber;
	}

	/**
	 * @return bool
	 */
	public function is_enabled_for_customer(): bool {
		return $this->enabledForCustomer ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_enabled_for_supplier(): bool {
		return $this->enabledForSupplier ?? false;
	}

	public function jsonSerialize(): array {
		$vars = get_object_vars( $this );
		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}