<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\API;

use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\{Account};

class Accounts extends Base {
	private static $_instance;

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
	}

	function ListEntryAccounts( $fields = 'AccountNumber,Name,IsHidden', $categoryFilter = null ) {
		$HttpResponse = $this->RemoteGet(
			add_query_arg( [
				'fields'         => $fields,
				'categoryFilter' => $categoryFilter,
			], $this->GetEndpoint( $this->GetOrganizationId(), 'accounts', 'entry' ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$contacts = [];
			foreach ( $HttpResponse->get_body() as $item ) {
				$contacts[] = new Account( $item );
			}

			return $contacts;
		}

		return $HttpResponse;
	}
}