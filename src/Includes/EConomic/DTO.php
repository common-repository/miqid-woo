<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic;

use MIQID\Plugin\WooCommerce\Includes\DTO\Base;

abstract class DTO extends Base {
	/** @var string|null */
	private $name;
	/** @var string|null */
	private $self;

	public function __construct(
		$name = null,
		$self = null
	) {
		parent::__construct( $self );

		if ( is_array( $name ) ) {
			$this->parse_array( $name );
		}

		$this->set_name( $name );
		$this->set_self( $self );
	}

	/**
	 * @param string|null $name
	 */
	public function set_name( ?string $name ): void {
		$this->name = $name ?? $this->name;
	}

	public function set_self( ?string $self ): void {
		$this->self = $self ?? $this->self;
	}

	/**
	 * @return string|null
	 */
	public function get_name(): ?string {
		return $this->name;
	}

	/**
	 * @return string|null
	 */
	public function get_self() {
		return $this->self;
	}
}