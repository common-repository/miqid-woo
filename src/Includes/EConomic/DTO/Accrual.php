<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use DateTime;
use MIQID\Plugin\WooCommerce\Util;

class Accrual extends Base {
	/** @var DateTime|null */
	private $endDate;
	/** @var DateTime|null */
	private $startDate;

	public function __construct(
		$endDate = null,
		$startDate = null
	) {
		if ( is_array( $endDate ) ) {
			$this->parse_array( $endDate );
		}

		$this->set_end_date( $endDate );
		$this->set_start_date( $startDate );
	}

	/**
	 * @param DateTime|string|null $endDate
	 */
	public function set_end_date( $endDate ): void {
		if ( is_string( $endDate ) ) {
			$endDate = date_create( $endDate );
		}
		$this->endDate = $endDate ?? $this->endDate;
	}

	/**
	 * @param DateTime|string|null $startDate
	 */
	public function set_start_date( $startDate ): void {
		if ( is_string( $startDate ) ) {
			$startDate = date_create( $startDate );
		}
		$this->startDate = $startDate ?? $this->startDate;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_end_date( $format = null ) {
		if ( $this->endDate instanceof DateTime && ! empty( $format ) ) {
			return $this->endDate->format( $format );
		}

		return $this->endDate;
	}

	/**
	 * @return DateTime|string|null
	 */
	public function get_start_date( $format = null ) {
		if ( $this->startDate instanceof DateTime && ! empty( $format ) ) {
			return $this->startDate->format( $format );
		}

		return $this->startDate;
	}

	public function jsonSerialize(): array {
		$arr              = get_object_vars( $this );
		$arr['self']      = $this->get_self();
		$arr['endDate']   = $this->get_end_date( 'Y-m-d' );
		$arr['startDate'] = $this->get_start_date( 'Y-m-d' );
		$arr              = Util::filter_null_from( $arr );

		return $arr;
	}
}