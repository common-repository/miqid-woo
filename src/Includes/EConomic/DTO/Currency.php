<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Currency extends Base {
	/** @var string|null */
	private $code;
	/** @var string|null */
	private $isoNumber;

	public function __construct(
		$code = null,
		$isoNumber = null,
		$name = null,
		$self = null
	) {
		parent::__construct( $name, $self );

		if ( is_array( $code ) ) {
			$this->parse_array( $code );
		}

		$this->set_code( $code );
		$this->set_iso_number( $isoNumber );
	}

	/**
	 * @param string|null $code
	 */
	public function set_code( ?string $code ): void {
		$this->code = $code ?? $this->code;
	}

	/**
	 * @param string|null $isoNumber
	 */
	public function set_iso_number( ?string $isoNumber ): void {
		$this->isoNumber = $isoNumber ?? $this->isoNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_code(): ?string {
		return $this->code;
	}

	/**
	 * @return string|null
	 */
	public function get_iso_number(): ?string {
		return $this->isoNumber;
	}

	public function jsonSerialize(): array {
		$vars         = get_object_vars( $this );
		$vars['name'] = $this->get_name();
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}