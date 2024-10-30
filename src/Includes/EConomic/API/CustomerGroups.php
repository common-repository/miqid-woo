<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\{CustomerGroup, VatType};

class CustomerGroups extends Base {
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
	 * @param null $customerGroupNumber
	 *
	 * @return CustomerGroup|CustomerGroup[]|HttpResponse
	 */
	function Get( $customerGroupNumber = null ) {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'customer-groups' ), $customerGroupNumber ] ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $item ) {
					$Rows[] = new CustomerGroup( $item );
				}
			} else {
				$Rows[] = new CustomerGroup( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}
}