<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;


use DateTime;
use MIQID\Plugin\WooCommerce\Util;

class Inventory extends Base {
	/** @var float|null */
	private $available;
	/** @var float|null */
	private $inStock;
	/** @var float|null */
	private $orderedByCustomers;
	/** @var float|null */
	private $orderedFromSuppliers;
	/** @var float|null */
	private $packageVolume;
	/** @var float|null */
	private $grossWeight;
	/** @var float|null */
	private $netWeight;
	/** @var DateTime */
	private $inventoryLastUpdated;
	/** @var float|null */
	private $recommendedCostPrice;

	public function __construct(
		$available = null,
		$inStock = null,
		$orderedByCustomers = null,
		$orderedFromSuppliers = null,
		$packageVolume = null,
		$grossWeight = null,
		$netWeight = null,
		$inventoryLastUpdated = null,
		$recommendedCostPrice = null
	) {
		if ( is_array( $available ) ) {
			$this->parse_array( $available );
		}
		if ( isset( $available ) ) {
			$this->set_available( $available );
		}
		if ( isset( $inStock ) ) {
			$this->set_in_stock( $inStock );
		}
		if ( isset( $orderedByCustomers ) ) {
			$this->set_ordered_by_customers( $orderedByCustomers );
		}
		if ( isset( $orderedFromSuppliers ) ) {
			$this->set_ordered_from_suppliers( $orderedFromSuppliers );
		}
		if ( isset( $packageVolume ) ) {
			$this->set_package_volume( $packageVolume );
		}
		if ( isset( $grossWeight ) ) {
			$this->set_gross_weight( $grossWeight );
		}
		if ( isset( $netWeight ) ) {
			$this->set_net_weight( $netWeight );
		}
		if ( isset( $inventoryLastUpdated ) ) {
			$this->set_inventory_last_updated( $inventoryLastUpdated );
		}
		if ( isset( $recommendedCostPrice ) ) {
			$this->set_recommended_cost_price( $recommendedCostPrice );
		}
	}

	/**
	 * @param float|null $available
	 *
	 * @return Inventory
	 */
	public function set_available( ?float $available ): Inventory {
		$this->available = $available;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_available(): ?float {
		return $this->available;
	}

	/**
	 * @param float|null $inStock
	 *
	 * @return Inventory
	 */
	public function set_in_stock( ?float $inStock ): Inventory {
		$this->inStock = $inStock;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_in_stock(): ?float {
		return $this->inStock;
	}

	/**
	 * @param float|null $orderedByCustomers
	 *
	 * @return Inventory
	 */
	public function set_ordered_by_customers( ?float $orderedByCustomers ): Inventory {
		$this->orderedByCustomers = $orderedByCustomers;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_ordered_by_customers(): ?float {
		return $this->orderedByCustomers;
	}

	/**
	 * @param float|null $orderedFromSuppliers
	 *
	 * @return Inventory
	 */
	public function set_ordered_from_suppliers( ?float $orderedFromSuppliers ): Inventory {
		$this->orderedFromSuppliers = $orderedFromSuppliers;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_ordered_from_suppliers(): ?float {
		return $this->orderedFromSuppliers;
	}

	/**
	 * @param float|null $packageVolume
	 *
	 * @return Inventory
	 */
	public function set_package_volume( ?float $packageVolume ): Inventory {
		$this->packageVolume = $packageVolume;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_package_volume(): ?float {
		return $this->packageVolume;
	}

	/**
	 * @param float|null $grossWeight
	 *
	 * @return Inventory
	 */
	public function set_gross_weight( ?float $grossWeight ): Inventory {
		$this->grossWeight = $grossWeight;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_gross_weight(): ?float {
		return $this->grossWeight;
	}

	/**
	 * @param float|null $netWeight
	 *
	 * @return Inventory
	 */
	public function set_net_weight( ?float $netWeight ): Inventory {
		$this->netWeight = $netWeight;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_net_weight(): ?float {
		return $this->netWeight;
	}

	/**
	 * @param DateTime|string $inventoryLastUpdated
	 *
	 * @return Inventory
	 */
	public function set_inventory_last_updated( $inventoryLastUpdated ): Inventory {
		if ( is_string( $inventoryLastUpdated ) ) {
			$inventoryLastUpdated = date_create( $inventoryLastUpdated );
		}
		$this->inventoryLastUpdated = $inventoryLastUpdated;

		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function get_inventory_last_updated(): DateTime {
		return $this->inventoryLastUpdated;
	}

	/**
	 * @param float|null $recommendedCostPrice
	 *
	 * @return Inventory
	 */
	public function set_recommended_cost_price( ?float $recommendedCostPrice ): Inventory {
		$this->recommendedCostPrice = $recommendedCostPrice;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function get_recommended_cost_price(): ?float {
		return $this->recommendedCostPrice;
	}

	public function jsonSerialize(): array {
		$arr = get_object_vars( $this );
		$arr = Util::filter_null_from( $arr );

		return $arr;
	}
}