<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\API;

use MIQID\Plugin\Core\Classes\DTO\{HttpResponse};
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\{Contact};

class Contacts extends Base {
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
	 * @param string $fields
	 * @param null $queryFilter
	 *
	 * @return Contact[]|HttpResponse
	 */
	function ListContacts( $fields = 'name,email,contactGuid', $queryFilter = null ) {
		$HttpResponse = $this->RemoteGet(
			add_query_arg( [
				'fields'      => $fields,
				'queryFilter' => $queryFilter,
			], $this->GetEndpoint( $this->GetOrganizationId(), 'contacts' ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$contacts = [];
			foreach ( $HttpResponse->get_body()['Collection'] as $item ) {
				$contacts[] = new Contact( $item );
			}

			return $contacts;
		}

		return $HttpResponse;
	}

	function CreateContact( Contact $contact ) {
		$HttpReponse = $this->RemotePost(
			$this->GetEndpoint( $this->GetOrganizationId(), 'contacts' ),
			$contact
		);

		if ( in_array( $HttpReponse->get_response_code(), [ 201 ] ) ) {
			return self::GetContact( $HttpReponse->get_body()['ContactGuid'] );
		}

		return $HttpReponse;
	}

	/**
	 * @param $guid
	 *
	 * @return Contact|HttpResponse
	 */
	function GetContact( $guid ) {
		$HttpResponse = $this->RemoteGet(
			$this->GetEndpoint( $this->GetOrganizationId(), 'contacts', $guid )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new Contact( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	function UpdateContact( $guid, Contact $contact ) {
		$httpResponse = $this->RemotePost(
			$this->GetEndpoint( $this->GetOrganizationId(), 'contacts', $guid ),
			$contact,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $httpResponse->get_response_code(), [ 200 ] ) ) {
			return $contact;
		}

		return $httpResponse;
	}
}