<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Unit extends Base {
	/** @var int|null */
	private $unitNumber;

	public function __construct(
		$unitNumber = null,
		$self = null
	) {
		if ( is_array( $unitNumber ) ) {
			$this->parse_array( $unitNumber );
		}

		$this->set_unit_number( $unitNumber );
		$this->set_self( $self );
	}

	/**
	 * @param int|null $unitNumber
	 */
	public function set_unit_number( ?int $unitNumber ): void {
		$this->unitNumber = $unitNumber ?? $this->unitNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_unit_number(): ?int {
		return $this->unitNumber;
	}

	public function jsonSerialize(): array {
		$vars         = get_object_vars( $this );
		$vars['name'] = $this->get_name();
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}