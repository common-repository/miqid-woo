<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;
use MIQID\Plugin\WooCommerce\Util;

class ProductLine extends DTO {
	/** @var string|null */
	private $ProductGuid;
	/** @var string|null */
	private $Description;
	/** @var string|null */
	private $Comments;
	/** @var float */
	private $Quantity = 1;
	/** @var int */
	private $AccountNumber = 1000;
	/** @var string|null */
	private $Unit = 'parts';
	/** @var float */
	private $Discount = 0;
	/** @var string|null */
	private $LineType = 'Product';
	/** @var float */
	private $BaseAmountValue;

	public function __construct(
		$ProductGuid = null,
		$Description = null,
		$Comments = null,
		$Quantity = null,
		$AccountNumber = null,
		$Unit = null,
		$Discount = null,
		$LineType = null,
		$BaseAmountValue = null
	) {
		if ( is_array( $ProductGuid ) ) {
			$this->parse_array( $ProductGuid );
		}

		if ( isset( $ProductGuid ) ) {
			$this->set_product_guid( $ProductGuid );
		}
		if ( isset( $Description ) ) {
			$this->set_description( $Description );
		}
		if ( isset( $Comments ) ) {
			$this->set_comments( $Comments );
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
		if ( isset( $Discount ) ) {
			$this->set_discount( $Discount );
		}
		if ( isset( $LineType ) ) {
			$this->set_line_type( $LineType );
		}
		if ( isset( $BaseAmountValue ) ) {
			$this->set_base_amount_value( $BaseAmountValue );
		}
	}

	/**
	 * @param string|null $ProductGuid
	 *
	 * @return ProductLine
	 */
	public function set_product_guid( ?string $ProductGuid ): ProductLine {
		$this->ProductGuid = $ProductGuid;

		return $this;
	}

	/**
	 * @param string|null $Description
	 *
	 * @return ProductLine
	 */
	public function set_description( ?string $Description ): ProductLine {
		$this->Description = $Description;

		return $this;
	}

	/**
	 * @param string|null $Comments
	 *
	 * @return ProductLine
	 */
	public function set_comments( ?string $Comments ): ProductLine {
		$this->Comments = $Comments;

		return $this;
	}

	/**
	 * @param float|null $Quantity
	 *
	 * @return ProductLine
	 */
	public function set_quantity( ?float $Quantity ): ProductLine {
		$this->Quantity = $Quantity;

		return $this;
	}

	/**
	 * @param int|null $AccountNumber
	 *
	 * @return ProductLine
	 */
	public function set_account_number( ?int $AccountNumber ): ProductLine {
		$this->AccountNumber = $AccountNumber;

		return $this;
	}

	/**
	 * @param string|null $Unit
	 *
	 * @return ProductLine
	 */
	public function set_unit( ?string $Unit ): ProductLine {
		$this->Unit = $Unit;

		return $this;
	}

	/**
	 * @param float|null $Discount
	 *
	 * @return ProductLine
	 */
	public function set_discount( ?float $Discount ): ProductLine {
		$this->Discount = $Discount;

		return $this;
	}

	/**
	 * @param string|null $LineType
	 *
	 * @return ProductLine
	 */
	public function set_line_type( ?string $LineType ): ProductLine {
		$this->LineType = $LineType;

		return $this;
	}

	/**
	 * @param float|null $BaseAmountValue
	 *
	 * @return ProductLine
	 */
	public function set_base_amount_value( ?float $BaseAmountValue ): ProductLine {
		$this->BaseAmountValue = $BaseAmountValue;

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
	public function get_description(): ?string {
		return $this->Description;
	}

	/**
	 * @return string|null
	 */
	public function get_comments(): ?string {
		return $this->Comments;
	}

	/**
	 * @return float|null
	 */
	public function get_quantity(): ?float {
		return $this->Quantity;
	}

	/**
	 * @return int|null
	 */
	public function get_account_number(): ?int {
		return $this->AccountNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_unit(): ?string {
		return $this->Unit;
	}

	/**
	 * @return float|null
	 */
	public function get_discount(): ?float {
		return $this->Discount;
	}

	/**
	 * @return string|null
	 */
	public function get_line_type(): ?string {
		return $this->LineType;
	}

	/**
	 * @return float|null
	 */
	public function get_base_amount_value(): ?float {
		return $this->BaseAmountValue;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );
		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}