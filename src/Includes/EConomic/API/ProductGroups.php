<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\{ProductGroup, Unit};

class ProductGroups extends Base {
	private static $_instance;

	const Product_With_Vat    = 1;
	const Product_Without_Vat = 2;

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
	}

	/**
	 * @param null $unitNumber
	 *
	 * @return ProductGroup|ProductGroup[]|HttpResponse
	 */
	function Get( $unitNumber = null ) {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'product-groups' ), $unitNumber ] ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $item ) {
					$Rows[] = new ProductGroup( $item );
				}
			} else {
				$Rows[] = new ProductGroup( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}
}