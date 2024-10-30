<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\Order;

class Orders extends Base {
	private static $_instance;

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
	}

	function Get() {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint() ] ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $item ) {
					$Rows[] = new Order( $item );
				}
			} else {
				$Rows[] = new Order( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}

	function GetDrafts( $orderNumber = null, $filter = null ) {
		$HttpResponse = $this->RemoteGet(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'orders/drafts' ), $orderNumber ] ) ) . $filter
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$result = $HttpResponse->get_body();
			$Rows   = [];
			if ( isset( $result['collection'] ) ) {
				foreach ( $result['collection'] as $item ) {
					$Rows[] = new Order( $item );
				}
			} else {
				$Rows[] = new Order( $result );
			}

			if ( sizeof( $Rows ) === 1 ) {
				return current( $Rows );
			}

			return $Rows;
		}

		return $HttpResponse;
	}

	function PostDrafts( Order $order ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'orders/drafts' ) ] ) ),
			$order
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200, 201, 202 ] ) ) {
			return new Order( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	function PutDrafts( int $orderNumber, Order $order ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'orders/drafts' ), $orderNumber ] ) ),
			$order,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new Order( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	function PostSent( Order $order ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'orders/sent' ) ] ) ),
			$order
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200, 201, 202 ] ) ) {
			return new Order( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}
}