<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class ProductInvoice extends Base {
	/** @var string|null */
	private $drafts;
	/** @var string|null */
	private $booked;

	/**
	 * Invoice constructor.
	 *
	 * @param array|string|null $drafts
	 * @param string|null $booked
	 */
	public function __construct(
		$drafts = null,
		$booked = null
	) {
		if ( is_array( $drafts ) ) {
			$this->parse_array( $drafts );
		}
		if ( isset( $drafts ) ) {
			$this->set_drafts( $drafts );
		}
		if ( isset( $booked ) ) {
			$this->set_booked( $booked );
		}
	}

	/**
	 * @param string|null $drafts
	 */
	public function set_drafts( ?string $drafts ): void {
		$this->drafts = $drafts;
	}

	/**
	 * @return string|null
	 */
	public function get_drafts(): ?string {
		return $this->drafts;
	}

	/**
	 * @param string|null $booked
	 */
	public function set_booked( ?string $booked ): void {
		$this->booked = $booked;
	}

	/**
	 * @return string|null
	 */
	public function get_booked(): ?string {
		return $this->booked;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );
		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}