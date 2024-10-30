<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Layout extends Base {
	/** @var int|null */
	private $layoutNumber;
	/** @var string|null */
	private $name;
	/** @var bool */
	private $deleted;
	/** @var string|null */
	private $self;

	public function __construct( ?array $Layout = null ) {
		if ( is_array( $Layout ) ) {
			$this->parse_array( $Layout );
		}
	}

	/**
	 * @param int|null $layoutNumber
	 *
	 * @return Layout
	 */
	public function set_layout_number( ?int $layoutNumber ): self {
		$this->layoutNumber = $layoutNumber;

		return $this;
	}

	/**
	 * @param bool|int|string|null $deleted
	 *
	 * @return Layout
	 */
	public function set_deleted( $deleted ): self {
		if ( ! is_null( $deleted ) ) {
			$deleted = filter_var( $deleted, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->deleted = $deleted;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_layout_number(): ?int {
		return $this->layoutNumber;
	}

	/**
	 * @return bool
	 */
	public function is_deleted(): bool {
		return $this->deleted ?? false;
	}


	public function jsonSerialize(): array {
		$arr = get_object_vars( $this );
		$arr = Util::filter_null_from( $arr );

		return $arr;
	}
}