<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class VatType extends Base {
	/** @var int|null */
	private $vatTypeNumber;
	/** @var string|null */
	private $name;
	/** @var string|null */
	private $self;

	public function __construct(
		$vatTypeNumber = null,
		$name = null,
		$self = null
	) {
		if ( is_array( $vatTypeNumber ) ) {
			$this->parse_array( $vatTypeNumber );
		}
		if ( isset( $vatTypeNumber ) ) {
			$this->set_vat_type_number( $vatTypeNumber );
		}
		if ( isset( $name ) ) {
			$this->set_name( $name );
		}
		if ( isset( $self ) ) {
			$this->set_self( $self );
		}
	}

	/**
	 * @param int|null $vatTypeNumber
	 */
	public function set_vat_type_number( ?int $vatTypeNumber ): void {
		$this->vatTypeNumber = $vatTypeNumber;
	}

	public function jsonSerialize(): array {
		$vars         = get_object_vars( $this );
		$vars['name'] = $this->get_name();
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}