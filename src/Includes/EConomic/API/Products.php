<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\Product as dtoProduct;

class Products extends Base {
	private static $_instance;

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
	}

	/**
	 * @param null $productNumber
	 * @param null $filter
	 *
	 * @return HttpResponse|dtoProduct|dtoProduct[]
	 */
	function Get( $productNumber = null, $filter = null ) {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint(), $productNumber, $filter ] ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $item ) {
					$Rows[] = new dtoProduct( $item );
				}
			} else {
				$Rows[] = new dtoProduct( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}

	/**
	 * @param dtoProduct $products
	 *
	 * @return HttpResponse|dtoProduct
	 */
	function Post( dtoProduct $products ) {
		$HttpResponse = $this->RemotePost(
			$this->GetEndpoint(),
			$products,
			[],
			[]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 201 ] ) ) {
			return new dtoProduct( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	function PUT( $productNumber, dtoProduct $products ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint(), $productNumber ] ) ),
			$products,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new dtoProduct( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

}
