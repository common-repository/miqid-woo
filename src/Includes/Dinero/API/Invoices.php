<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\Invoice;

class Invoices extends Base {
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
	 * @param Invoice $invoice
	 *
	 * @return Invoice|HttpResponse
	 */
	function CreateInvoice( Invoice $invoice ) {
		$HttpResponse = $this->RemotePost(
			$this->GetEndpoint( $this->GetOrganizationId(), 'invoices' ),
			$invoice
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 201 ] ) ) {
			return self::GetInvoice( $HttpResponse->get_body()['Guid'] );
		}

		return $HttpResponse;
	}

	/**
	 * @param string $fields
	 * @param null $queryFilter
	 *
	 * @return Invoice[]|HttpResponse
	 */
	function ListInvoice( $fields = 'Guid,ContactName,Date,Description', $queryFilter = null ) {
		$HttpResponse = $this->RemoteGet(
			add_query_arg( [
				'fields'      => $fields,
				'queryFilter' => $queryFilter,
			], $this->GetEndpoint( $this->GetOrganizationId(), 'invoices' ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$invoices = [];
			foreach ( $HttpResponse->get_body()['Collection'] as $item ) {
				$invoices[] = new Invoice( $item );
			}

			return $invoices;
		}

		return $HttpResponse;
	}

	/**
	 * @param $guid
	 *
	 * @return Invoice|HttpResponse
	 */
	function GetInvoice( $guid ) {
		$HttpResponse = $this->RemoteGet(
			$this->GetEndpoint( $this->GetOrganizationId(), 'invoices', $guid )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new Invoice( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	/**
	 * @param $guid
	 * @param Invoice $invoice
	 *
	 * @return Invoice|HttpResponse
	 */
	function UpdateInvoice( $guid, Invoice $invoice ) {
		$HttpResponse = $this->RemotePost(
			strtr( $this->GetEndpoint( $this->GetOrganizationId(), 'invoices', $guid ), [ '/v1/' => '/v1.2/' ] ),
			$invoice,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return $invoice->set_guid( $HttpResponse->get_body()['Guid'] );
		}

		return $HttpResponse;
	}

	/**
	 * @param $guid
	 * @param array $body = [
	 *        'Timestamp' => required,
	 *        'Number'   => nullable
	 *    ]
	 *
	 * @return Invoice|HttpResponse
	 */
	function BookInvoice( $guid, $body = [] ) {
		$HttpResponse = $this->RemotePost(
		//https://api.dinero.dk/v1/{organizationId}/invoices/{guid}/book
			$this->GetEndpoint( $this->GetOrganizationId(), 'invoices', $guid, 'book' ),
			$body
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return self::GetInvoice( $guid );
		}

		return $HttpResponse;
	}
}