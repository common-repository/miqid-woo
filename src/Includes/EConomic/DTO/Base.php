<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

abstract class Base extends \MIQID\Plugin\WooCommerce\Includes\DTO\Base {
	/** @var string|null */
	private $name;

	/** @var string|null */
	private $self;

	/**
	 * @param string|null $name
	 *
	 * @return self;
	 */
	public function set_name( ?string $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @param string|null $self
	 *
	 * @return self
	 */
	public function set_self( ?string $self ) {
		$this->self = $self;

		return $this;
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
	public function get_self(): ?string {
		return $this->self;
	}

}