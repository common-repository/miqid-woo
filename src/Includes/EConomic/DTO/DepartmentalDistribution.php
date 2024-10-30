<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class DepartmentalDistribution extends Base {
	/** @var int|null */
	private $departmentalDistributionNumber;
	/** @var string|null */
	private $name;
	/** @var string|null */
	private $distributionType;
	/** @var array|null */
	private $distributions;
	/** @var string|null */
	private $self;

	public function __construct(
		$departmentalDistributionNumber = null,
		$name = null,
		$distributionType = null,
		$distributions = null,
		$self = null
	) {
		if ( is_array( $departmentalDistributionNumber ) ) {
			$this->parse_array( $departmentalDistributionNumber );
		}
		if ( isset( $departmentalDistributionNumber ) ) {
			$this->set_departmental_distribution_number( $departmentalDistributionNumber );
		}
		if ( isset( $name ) ) {
			$this->set_name( $name );
		}
		if ( isset( $distributionType ) ) {
			$this->set_distribution_type( $distributionType );
		}
		if ( isset( $distributions ) ) {
			$this->set_distributions( $distributions );
		}
		if ( isset( $self ) ) {
			$this->set_self( $self );
		}
	}

	/**
	 * @param int|null $departmentalDistributionNumber
	 */
	public function set_departmental_distribution_number( ?int $departmentalDistributionNumber ): void {
		$this->departmentalDistributionNumber = $departmentalDistributionNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_departmental_distribution_number(): ?int {
		return $this->departmentalDistributionNumber;
	}

	/**
	 * @param string|null $distributionType
	 */
	public function set_distribution_type( ?string $distributionType ): void {
		$this->distributionType = $distributionType;
	}

	/**
	 * @return string|null
	 */
	public function get_distribution_type(): ?string {
		return $this->distributionType;
	}

	/**
	 * @param array|null $distributions
	 */
	public function set_distributions( ?array $distributions ): void {
		$this->distributions = $distributions;
	}

	/**
	 * @return array|null
	 */
	public function get_distributions(): ?array {
		return $this->distributions;
	}

	public function jsonSerialize(): array {
		$arr = get_object_vars( $this );
		$arr = Util::filter_null_from( $arr );

		return $arr;
	}
}