<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class DeliveryLocation extends Base {
	/** @var int|null */
	private $deliveryLocationNumber;

	public function __construct(
		$deliveryLocationNumber = null,
		$self = null
	) {
		if ( is_array( $deliveryLocationNumber ) ) {
			$this->parse_array( $deliveryLocationNumber );
		}

		$this->set_delivery_location_number( $deliveryLocationNumber );
		$this->set_self( $self );
	}

	/**
	 * @param int|null $deliveryLocationNumber
	 */
	public function set_delivery_location_number( ?int $deliveryLocationNumber ): void {
		$this->deliveryLocationNumber = $deliveryLocationNumber ?? $this->deliveryLocationNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_delivery_location_number(): ?int {
		return $this->deliveryLocationNumber;
	}

	public function jsonSerialize(): array {
		$arr         = get_object_vars( $this );
		$arr['self'] = $this->get_self();
		$arr         = Util::filter_null_from( $arr );

		return $arr;
	}
}