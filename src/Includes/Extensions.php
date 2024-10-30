<?php

namespace MIQID\Plugin\WooCommerce\Includes;

use MIQID\Plugin\WooCommerce\Util;

class Extensions implements \JsonSerializable {
	/** @var bool */
	private $gtin;
	/** @var bool */
	private $ConditionalShipping;
	/** @var bool */
	private $EConomic;
	/** @var bool */
	private $Dinero;

	public function __construct(
		$gtin = null,
		$ConditionalShipping = null,
		$EConomic = null
	) {
		if ( is_array( $gtin ) ) {
			$this->parse_array( $gtin );
		}

		$this->set_gtin( $gtin );
		$this->set_conditional_shipping( $ConditionalShipping );
		$this->set_e_conomic( $EConomic );
	}

	/**
	 * @param bool|int|string|null $gtin
	 */
	public function set_gtin( $gtin ): void {
		if ( ! is_null( $gtin ) ) {
			$gtin = filter_var( $gtin, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->gtin = $gtin ?? $this->gtin;
	}

	/**
	 * @param bool|int|string|null $ConditionalShipping
	 */
	public function set_conditional_shipping( $ConditionalShipping ): void {
		if ( ! is_null( $ConditionalShipping ) ) {
			$ConditionalShipping = filter_var( $ConditionalShipping, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->ConditionalShipping = $ConditionalShipping ?? $this->ConditionalShipping;
	}

	/**
	 * @param bool|int|string|null $EConomic
	 *
	 * @return self
	 */
	public function set_e_conomic( $EConomic ): self {
		if ( ! is_null( $EConomic ) ) {
			$EConomic = filter_var( $EConomic, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->EConomic = $EConomic ?? $this->EConomic;

		return $this;
	}

	/**
	 * @param bool|int|string|null $Dinero
	 *
	 * @return self
	 */
	public function set_dinero( $Dinero ): self {
		if ( ! is_null( $Dinero ) ) {
			$Dinero = filter_var( $Dinero, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->Dinero = $Dinero;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function is_gtin(): bool {
		return $this->gtin ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_conditional_shipping(): bool {
		return $this->ConditionalShipping ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_e_conomic(): bool {
		return $this->EConomic ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_dinero(): bool {
		return $this->Dinero ?? false;
	}

	public function jsonSerialize() {
		$arr = get_object_vars( $this );

		return $arr;
	}

	/**
	 * @param array $array
	 *
	 * @return $this
	 */
	protected function parse_array( array &$array ) {
		foreach ( $array as $key => $value ) {
			$function = sprintf( 'set_%s', Util::snake_case( $key ) );
			if ( method_exists( $this, $function ) ) {
				$this->$function( $value );
			} else if ( property_exists( $this, $key ) ) {
				$this->{$key} = $value;
			}
		}
		$array = null;

		return $this;
	}
}