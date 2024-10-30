<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Util;

class Product extends Base {
	/** @var string|null */
	private $productNumber;
	/** @var string|null */
	private $description;
	/** @var float|null */
	private $costPrice;
	/** @var float|null */
	private $recommendedPrice;
	/** @var float|null */
	private $salesPrice;
	/** @var string|null */
	private $barCode;
	/** @var bool */
	private $barred;
	/** @var DateTime|null */
	private $lastUpdated;
	/** @var ProductInvoice[]|null */
	private $invoices;
	/** @var Inventory[]|null */
	private $inventory;
	/** @var Unit */
	private $unit;
	/** @var ProductGroup */
	private $productGroup;
	/** @var DepartmentalDistribution */
	private $departmentalDistribution;
	/** @var string|null */
	private $self;

	public function __construct(
		$productNumber = null,
		$description = null,
		$name = null,
		$costPrice = null,
		$recommendedPrice = null,
		$salesPrice = null,
		$barCode = null,
		$barred = null,
		$lastUpdated = null,
		$invoices = null,
		$inventory = null,
		$unit = null,
		$productGroup = null,
		$departmentalDistribution = null,
		$self = null
	) {
		if ( is_array( $productNumber ) ) {
			$this->parse_array( $productNumber );
		}
		if ( isset( $productNumber ) ) {
			$this->set_product_number( $productNumber );
		}
		if ( isset( $description ) ) {
			$this->set_description( $description );
		}
		if ( isset( $name ) ) {
			$this->set_name( $name );
		}
		if ( isset( $costPrice ) ) {
			$this->set_cost_price( $costPrice );
		}
		if ( isset( $recommendedPrice ) ) {
			$this->set_recommended_price( $recommendedPrice );
		}
		if ( isset( $salesPrice ) ) {
			$this->set_sales_price( $salesPrice );
		}
		if ( isset( $barCode ) ) {
			$this->set_bar_code( $barCode );
		}
		if ( isset( $barred ) ) {
			$this->set_barred( $barred );
		}
		if ( isset( $lastUpdated ) ) {
			$this->set_last_updated( $lastUpdated );
		}
		if ( isset( $invoices ) ) {
			$this->set_invoices( $invoices );
		}
		if ( isset( $inventory ) ) {
			$this->set_inventory( $inventory );
		}
		if ( isset( $unit ) ) {
			$this->set_unit( $unit );
		}
		if ( isset( $productGroup ) ) {
			$this->set_product_group( $productGroup );
		}
		if ( isset( $departmentalDistribution ) ) {
			$this->set_departmental_distribution( $departmentalDistribution );
		}
		if ( isset( $self ) ) {
			$this->set_self( $self );
		}
	}

	/**
	 * @param string|null $productNumber
	 *
	 * @return Product
	 */
	public function set_product_number( ?string $productNumber ): self {
		$this->productNumber = $productNumber;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_product_number(): ?string {
		return $this->productNumber;
	}

	/**
	 * @param string|null $description
	 *
	 * @return Product
	 */
	public function set_description( ?string $description ): self {
		$this->description = $description;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * @param float|null $costPrice
	 *
	 * @return Product
	 */
	public function set_cost_price( ?float $costPrice ): self {
		$this->costPrice = $costPrice;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_cost_price(): ?float {
		return $this->costPrice;
	}

	/**
	 * @param float|null $recommendedPrice
	 *
	 * @return Product
	 */
	public function set_recommended_price( ?float $recommendedPrice ): self {
		$this->recommendedPrice = $recommendedPrice;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_recommended_price(): ?float {
		return $this->recommendedPrice;
	}

	/**
	 * @param float|null $salesPrice
	 *
	 * @return Product
	 */
	public function set_sales_price( ?float $salesPrice ): self {
		$this->salesPrice = $salesPrice;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_sales_price(): ?float {
		return $this->salesPrice;
	}

	/**
	 * @param string|null $barCode
	 *
	 * @return Product
	 */
	public function set_bar_code( ?string $barCode ): self {
		$this->barCode = $barCode;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_bar_code(): ?string {
		return $this->barCode;
	}

	/**
	 * @param bool|int|string|null $barred
	 *
	 * @return Product
	 */
	public function set_barred( $barred ): self {
		if ( ! is_null( $barred ) ) {
			$barred = filter_var( $barred, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->barred = $barred;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function is_barred(): bool {
		return $this->barred ?? false;
	}

	/**
	 * @param DateTime|string|null $lastUpdated
	 *
	 * @return Product
	 */
	public function set_last_updated( $lastUpdated ): self {
		if ( is_string( $lastUpdated ) ) {
			$lastUpdated = date_create( $lastUpdated );
		}
		$this->lastUpdated = $lastUpdated;

		return $this;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_last_updated( $format = null ) {
		if ( $this->lastUpdated instanceof DateTime && ! empty( $format ) ) {
			return $this->lastUpdated->format( $format );
		}

		return $this->lastUpdated;
	}

	/**
	 * @param ProductInvoice[]|null $invoices
	 *
	 * @return Product
	 */
	public function set_invoices( ?array $invoices ): self {
		$this->invoices = $invoices;

		return $this;
	}

	/**
	 * @return ProductInvoice[]|null
	 */
	public function get_invoices(): ?array {
		return $this->invoices;
	}

	/**
	 * @param Inventory[]|null $inventory
	 *
	 * @return Product
	 */
	public function set_inventory( ?array $inventory ): self {
		$this->inventory = $inventory;

		return $this;
	}

	/**
	 * @return Inventory[]|null
	 */
	public function get_inventory(): ?array {
		return $this->inventory;
	}

	/**
	 * @param array|Unit|null $unit
	 *
	 * @return Product
	 */
	public function set_unit( $unit ): self {
		if ( is_array( $unit ) ) {
			$unit = new Unit( $unit );
		}
		$this->unit = $unit;

		return $this;
	}

	/**
	 * @return Unit
	 */
	public function get_unit(): Unit {
		return $this->unit;
	}

	/**
	 * @param array|ProductGroup|null $productGroup
	 *
	 * @return Product
	 */
	public function set_product_group( $productGroup ): self {
		if ( is_array( $productGroup ) ) {
			$productGroup = new ProductGroup( $productGroup );
		}
		$this->productGroup = $productGroup;

		return $this;
	}

	/**
	 * @return ProductGroup
	 */
	public function get_product_group(): ProductGroup {
		return $this->productGroup ?? new ProductGroup();
	}

	/**
	 * @param array|DepartmentalDistribution|null $departmentalDistribution
	 *
	 * @return Product
	 */
	public function set_departmental_distribution( $departmentalDistribution ): self {
		if ( is_array( $departmentalDistribution ) ) {
			$departmentalDistribution = new DepartmentalDistribution( $departmentalDistribution );
		}
		$this->departmentalDistribution = $departmentalDistribution;

		return $this;
	}

	/**
	 * @return DepartmentalDistribution
	 */
	public function get_departmental_distribution(): DepartmentalDistribution {
		return $this->departmentalDistribution ?? new DepartmentalDistribution();
	}

	public function jsonSerialize(): array {
		$vars                = get_object_vars( $this );
		$vars['name']        = $this->get_name();
		$vars['lastUpdated'] = $this->get_last_updated( 'c' );
		$vars                = Util::filter_null_from( $vars );

		return $vars;
	}
}