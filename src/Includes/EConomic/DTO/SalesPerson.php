<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class SalesPerson extends Base {
	/** @var int|null */
	private $employeeNumber;

	public function __construct(
		$employeeNumber = null,
		$self = null
	) {
		if ( is_array( $employeeNumber ) ) {
			$this->parse_array( $employeeNumber );
		} else {
			$this->set_employee_number( $employeeNumber );
		}
		$this->set_self( $self );
	}

	/**
	 * @param int|null $employeeNumber
	 */
	public function set_employee_number( ?int $employeeNumber ): void {
		$this->employeeNumber = $employeeNumber ?? $this->employeeNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_employee_number(): ?int {
		return $this->employeeNumber;
	}

	public function jsonSerialize(): array {
		$vars         = get_object_vars( $this );
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}