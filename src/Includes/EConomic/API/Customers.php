<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\Customer;

class Customers extends Base {
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
	 * @param int|null $customerNumber
	 * @param string|null $filter
	 *
	 * @return Customer[]|HttpResponse
	 */
	function GET( $customerNumber = null, $filter = null ) {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint(), $customerNumber, $filter ] ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $key => $item ) {
					$Rows[] = new Customer( $item );
				}
			} else {
				$Rows[] = new Customer( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}

	function Post( Customer $customer ) {
		$HttpResponse = $this->RemotePost(
			$this->GetEndpoint(),
			$customer,
			[],
			[]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 201 ] ) ) {
			return new Customer( $HttpResponse->get_body() );
		}

		return new Customer( [
			'HttpResponse' => $HttpResponse,
		] );
	}

	function Put( $customer_id, Customer $customers ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint(), $customer_id ] ) ),
			$customers,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new Customer( $HttpResponse->get_body() );
		}

		return new Customer( [
			'HttpResponse' => $HttpResponse,
		] );
	}
}
