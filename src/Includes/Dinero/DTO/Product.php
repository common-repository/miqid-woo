<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

use MIQID\Plugin\WooCommerce\Includes\{Dinero\DTO};

class Product extends DTO {
	const WithVAT    = 1000;
	const WithoutVAT = 1050;

	/** @var string|null */
	protected $ProductGuid;
	/** @var string|null */
	private $ProductNumber;
	/** @var string|null */
	private $Name;
	/** @var float */
	private $BaseAmountValue;
	/** @var float */
	private $Quantity;
	/** @var int */
	private $AccountNumber;
	/** @var string */
	private $Unit;
	/** @var string|null */
	private $ExternalReference;
	/** @var string|null */
	private $Comment;

	public function __construct(
		$ProductGuid = null,
		$ProductNumber = null,
		$Name = null,
		$BaseAmountValue = null,
		$Quantity = null,
		$AccountNumber = null,
		$Unit = null,
		$ExternalReference = null,
		$Comment = null
	) {
		if ( is_array( $ProductGuid ) ) {
			$this->parse_array( $ProductGuid );
		}

		if ( isset( $ProductGuid ) ) {
			$this->set_product_guid( $ProductGuid );
		}
		if ( isset( $ProductNumber ) ) {
			$this->set_product_number( $ProductNumber );
		}
		if ( isset( $Name ) ) {
			$this->set_name( $Name );
		}
		if ( isset( $BaseAmountValue ) ) {
			$this->set_base_amount_value( $BaseAmountValue );
		}
		if ( isset( $Quantity ) ) {
			$this->set_quantity( $Quantity );
		}
		if ( isset( $AccountNumber ) ) {
			$this->set_account_number( $AccountNumber );
		}
		if ( isset( $Unit ) ) {
			$this->set_unit( $Unit );
		}
		if ( isset( $ExternalReference ) ) {
			$this->set_external_reference( $ExternalReference );
		}
		if ( isset( $Comment ) ) {
			$this->set_external_reference( $ExternalReference );
		}
	}

	/**
	 * @param string|null $ProductGuid
	 *
	 * @return Product
	 */
	public function set_product_guid( ?string $ProductGuid ): Product {
		$this->ProductGuid = $ProductGuid;

		return $this;
	}

	/**
	 * @param string|null $ProductNumber
	 *
	 * @return Product
	 */
	public function set_product_number( ?string $ProductNumber ): Product {
		$this->ProductNumber = $ProductNumber;

		return $this;
	}

	/**
	 * @param string|null $Name
	 *
	 * @return Product
	 */
	public function set_name( ?string $Name ): Product {
		$this->Name = $Name;

		return $this;
	}

	/**
	 * @param float $BaseAmountValue
	 *
	 * @return Product
	 */
	public function set_base_amount_value( float $BaseAmountValue ): Product {
		$this->BaseAmountValue = $BaseAmountValue;

		return $this;
	}

	/**
	 * @param float $Quantity
	 *
	 * @return Product
	 */
	public function set_quantity( float $Quantity ): Product {
		$this->Quantity = $Quantity;

		return $this;
	}

	/**
	 * @param int $AccountNumber
	 *
	 * @return Product
	 */
	public function set_account_number( int $AccountNumber ): Product {
		$this->AccountNumber = $AccountNumber;

		return $this;
	}

	/**
	 * @param string $Unit
	 *
	 * @return Product
	 */
	public function set_unit( string $Unit ): Product {
		$this->Unit = $Unit;

		return $this;
	}

	/**
	 * @param string|null $ExternalReference
	 *
	 * @return Product
	 */
	public function set_external_reference( ?string $ExternalReference ): Product {
		$this->ExternalReference = $ExternalReference;

		return $this;
	}

	/**
	 * @param string|null $Comment
	 *
	 * @return Product
	 */
	public function set_comment( ?string $Comment ): Product {
		$this->Comment = $Comment;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_product_guid(): ?string {
		return $this->ProductGuid;
	}

	/**
	 * @return string|null
	 */
	public function get_product_number(): ?string {
		return $this->ProductNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_name(): ?string {
		return $this->Name;
	}

	/**
	 * @return float
	 */
	public function get_base_amount_value(): float {
		return $this->BaseAmountValue ?? 1;
	}

	/**
	 * @return float
	 */
	public function get_quantity(): float {
		return $this->Quantity ?? 1;
	}

	/**
	 * @return int
	 */
	public function get_account_number(): int {
		return $this->AccountNumber ?? 1;
	}

	/**
	 * @return string
	 */
	public function get_unit(): string {
		return $this->Unit ?? '';
	}

	/**
	 * @return string|null
	 */
	public function get_external_reference(): ?string {
		return $this->ExternalReference;
	}

	/**
	 * @return string|null
	 */
	public function get_comment(): ?string {
		return $this->Comment;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );
		unset( $vars['nullable'] );

		return $vars;
	}
}