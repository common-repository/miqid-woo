<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\Organization;

class Organizations extends Base {
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
	 * @param null $fields
	 * @param null $queryFilter
	 *
	 * @return Organization[]|HttpResponse
	 */
	function ListOrganization( $fields = null, $queryFilter = null ) {
		$HttpResponse = $this->RemoteGet(
			add_query_arg( [ 'fields' => $fields, 'queryFilter' => $queryFilter, ], $this->GetEndpoint( 'organizations' ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$organizations = [];
			foreach ( $HttpResponse->get_body() as $item ) {
				$organizations[] = new Organization( $item );
			}

			return $organizations;
		}

		return $HttpResponse;
	}
}