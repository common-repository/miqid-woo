<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class ProductGroup extends Base {
	/** @var int|null */
	private $productGroupNumber;
	/** @var string|null */
	private $name;
	/** @var string|null */
	private $salesAccounts;
	/** @var string|null */
	private $products;
	/** @var bool */
	private $inventoryEnabled;
	/** @var Accrual|null */
	private $accrual;
	/** @var string|null */
	private $self;

	public function __construct(
		$productGroupNumber = null,
		$name = null,
		$salesAccounts = null,
		$products = null,
		$inventoryEnabled = null,
		$accrual = null,
		$self = null
	) {
		if ( is_array( $productGroupNumber ) ) {
			$this->parse_array( $productGroupNumber );
		}
		if ( isset( $productGroupNumber ) ) {
			$this->set_product_group_number( $productGroupNumber );
		}
		if ( isset( $name ) ) {
			$this->set_name( $name );
		}
		if ( isset( $salesAccounts ) ) {
			$this->set_sales_accounts( $salesAccounts );
		}
		if ( isset( $products ) ) {
			$this->set_products( $products );
		}
		if ( isset( $inventoryEnabled ) ) {
			$this->set_inventory_enabled( $inventoryEnabled );
		}
		if ( isset( $accrual ) ) {
			$this->set_accrual( $accrual );
		}
		if ( isset( $self ) ) {
			$this->set_self( $self );
		}
	}

	/**
	 * @param int|null $productGroupNumber
	 */
	public function set_product_group_number( ?int $productGroupNumber ): void {
		$this->productGroupNumber = $productGroupNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_product_group_number(): ?int {
		return $this->productGroupNumber;
	}

	/**
	 * @param string|null $salesAccounts
	 */
	public function set_sales_accounts( ?string $salesAccounts ): void {
		$this->salesAccounts = $salesAccounts;
	}

	/**
	 * @return string|null
	 */
	public function get_sales_accounts(): ?string {
		return $this->salesAccounts;
	}

	/**
	 * @param string|null $products
	 */
	public function set_products( ?string $products ): void {
		$this->products = $products;
	}

	/**
	 * @return string|null
	 */
	public function get_products(): ?string {
		return $this->products;
	}

	/**
	 * @param bool|int|string|null $inventoryEnabled
	 */
	public function set_inventory_enabled( $inventoryEnabled ): void {
		if ( ! is_null( $inventoryEnabled ) ) {
			$inventoryEnabled = filter_var( $inventoryEnabled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->inventoryEnabled = $inventoryEnabled;
	}

	/**
	 * @return bool
	 */
	public function is_inventory_enabled(): bool {
		return $this->inventoryEnabled ?? false;
	}

	/**
	 * @param array|Accrual|null $accrual
	 */
	public function set_accrual( $accrual ): void {
		if ( is_array( $accrual ) ) {
			$accrual = new Accrual( $accrual );
		}
		$this->accrual = $accrual;
	}

	/**
	 * @return Accrual
	 */
	public function get_accrual(): Accrual {
		return $this->accrual ?? new Accrual();
	}

	public function jsonSerialize(): array {
		$vars = get_object_vars( $this );
		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}