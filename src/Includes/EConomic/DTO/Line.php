<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Line extends Base {
	/** @var int|null */
	private $lineNumber;
	/** @var int|null */
	private $sortKey;
	/** @var string|null */
	private $description;
	/** @var Accrual|null */
	private $accrual;
	/** @var Unit|null */
	private $unit;
	/** @var Product|null */
	private $product;
	/** @var float|null */
	private $quantity;
	/** @var float|null */
	private $unitNetPrice;
	/** @var float|null */
	private $discountPercentage;
	/** @var float|null */
	private $unitCostPrice;
	/** @var float|null */
	private $marginInBaseCurrency;
	/** @var float|null */
	private $marginPercentage;
	/** @var DepartmentalDistribution|null */
	private $departmentalDistribution;

	public function __construct( ?array $Line = null ) {
		if ( is_array( $Line ) ) {
			$this->parse_array( $Line );
		}
	}

	/**
	 * @param array|Accrual|null $accrual
	 *
	 * @return Line
	 */
	public function set_accrual( $accrual ): self {
		if ( is_array( $accrual ) ) {
			$accrual = new Accrual( $accrual );
		}
		$this->accrual = $accrual;

		return $this;
	}

	/**
	 * @param array|DepartmentalDistribution|null $departmentalDistribution
	 *
	 * @return Line
	 */
	public function set_departmental_distribution( $departmentalDistribution ): self {
		if ( is_array( $departmentalDistribution ) ) {
			$departmentalDistribution = new DepartmentalDistribution( $departmentalDistribution );
		}
		$this->departmentalDistribution = $departmentalDistribution;

		return $this;
	}

	/**
	 * @param string|null $description
	 *
	 * @return Line
	 */
	public function set_description( ?string $description ): self {
		$this->description = $description;

		return $this;
	}

	/**
	 * @param float|null $discountPercentage
	 *
	 * @return Line
	 */
	public function set_discount_percentage( ?float $discountPercentage ): self {
		$this->discountPercentage = $discountPercentage;

		return $this;
	}

	/**
	 * @param int|null $lineNumber
	 *
	 * @return Line
	 */
	public function set_line_number( ?int $lineNumber ): self {
		$this->lineNumber = $lineNumber;

		return $this;
	}

	/**
	 * @param float|null $marginInBaseCurrency
	 *
	 * @return Line
	 */
	public function set_margin_in_base_currency( ?float $marginInBaseCurrency ): self {
		$this->marginInBaseCurrency = $marginInBaseCurrency;

		return $this;
	}

	/**
	 * @param float|null $marginPercentage
	 *
	 * @return Line
	 */
	public function set_margin_percentage( ?float $marginPercentage ): self {
		$this->marginPercentage = $marginPercentage;

		return $this;
	}

	/**
	 * @param array|Product|null $product
	 *
	 * @return Line
	 */
	public function set_product( $product ): self {
		if ( is_array( $product ) ) {
			$product = new Product( $product );
		}
		$this->product = $product;

		return $this;
	}

	/**
	 * @param float|null $quantity
	 *
	 * @return Line
	 */
	public function set_quantity( ?float $quantity ): self {
		$this->quantity = $quantity;

		return $this;
	}

	/**
	 * @param int|null $sortKey
	 *
	 * @return Line
	 */
	public function set_sort_key( ?int $sortKey ): self {
		$this->sortKey = $sortKey;

		return $this;
	}

	/**
	 * @param array|Unit|null $unit
	 *
	 * @return Line
	 */
	public function set_unit( $unit ): self {
		if ( is_array( $unit ) ) {
			$unit = new Unit( $unit );
		}
		$this->unit = $unit;

		return $this;
	}

	/**
	 * @param float|null $unitCostPrice
	 *
	 * @return Line
	 */
	public function set_unit_cost_price( ?float $unitCostPrice ): self {
		$this->unitCostPrice = $unitCostPrice;

		return $this;
	}

	/**
	 * @param float|null $unitNetPrice
	 *
	 * @return Line
	 */
	public function set_unit_net_price( ?float $unitNetPrice ): self {
		$this->unitNetPrice = $unitNetPrice;

		return $this;
	}

	/**
	 * @return Accrual|null
	 */
	public function get_accrual(): ?Accrual {
		return $this->accrual;
	}

	/**
	 * @return DepartmentalDistribution
	 */
	public function get_departmental_distribution(): DepartmentalDistribution {
		return $this->departmentalDistribution ?? new DepartmentalDistribution();
	}

	/**
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * @return float|null
	 */
	public function get_discount_percentage(): ?float {
		return $this->discountPercentage;
	}

	/**
	 * @return int|null
	 */
	public function get_line_number(): ?int {
		return $this->lineNumber;
	}

	/**
	 * @return float|null
	 */
	public function get_margin_in_base_currency(): ?float {
		return $this->marginInBaseCurrency;
	}

	/**
	 * @return float|null
	 */
	public function get_margin_percentage(): ?float {
		return $this->marginPercentage;
	}

	/**
	 * @return Product
	 */
	public function get_product(): Product {
		return $this->product ?? new Product();
	}

	/**
	 * @return float|null
	 */
	public function get_quantity(): ?float {
		return $this->quantity;
	}

	/**
	 * @return int|null
	 */
	public function get_sort_key(): ?int {
		return $this->sortKey;
	}

	/**
	 * @return Unit
	 */
	public function get_unit(): Unit {
		return $this->unit ?? new Unit();
	}

	/**
	 * @return float|null
	 */
	public function get_unit_cost_price(): ?float {
		return $this->unitCostPrice;
	}

	/**
	 * @return float|null
	 */
	public function get_unit_net_price(): ?float {
		return $this->unitNetPrice;
	}


	public function jsonSerialize(): array {
		$vars         = get_object_vars( $this );
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}