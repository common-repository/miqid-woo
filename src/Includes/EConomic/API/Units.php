<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\{Unit};

class Units extends Base {
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
	 * @param null $unitNumber
	 *
	 * @return Unit|Unit[]|HttpResponse
	 */
	function Get( $unitNumber = null ) {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint(), $unitNumber ] ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $item ) {
					$Rows[] = new Unit( $item );
				}
			} else {
				$Rows[] = new Unit( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}
}