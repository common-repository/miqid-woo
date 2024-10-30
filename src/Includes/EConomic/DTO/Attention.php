<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Attention extends Base {
	/** @var int|null */
	private $customerContactNumber;

	public function __construct(
		$customerContactNumber = null,
		$name = null,
		$self = null
	) {
		parent::__construct( $name, $self );

		if ( is_array( $customerContactNumber ) ) {
			$this->parse_array( $customerContactNumber );
		}

		$this->set_customer_contact_number( $customerContactNumber );
	}

	/**
	 * @param int|null $customerContactNumber
	 */
	public function set_customer_contact_number( ?int $customerContactNumber ): void {
		$this->customerContactNumber = $customerContactNumber ?? $this->customerContactNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_customer_contact_number(): ?int {
		return $this->customerContactNumber;
	}

	public function jsonSerialize(): array {
		$vars         = get_object_vars( $this );
		$vars['name'] = $this->get_name();
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}