<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\Invoice;

class Invoices extends Base {
	private static $instance;

	static function Instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
	}

	/**
	 * @param null $orderNumber
	 * @param null $filter
	 *
	 * @return Invoice[]|HttpResponse
	 */
	function GetDrafts( $orderNumber = null, $filter = null ) {
		$HttpResponse = $this->RemoteGet(
			add_query_arg( [
				'filter' => $filter,
			], implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'invoices/drafts' ), $orderNumber ] ) ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200, 201, 202 ] ) ) {
			$body = $HttpResponse->get_body();
			$Rows = [];
			if ( isset( $body['collection'] ) ) {
				foreach ( $body['collection'] as $item ) {
					$Rows[] = new Invoice( $item );
				}
			} else {
				$Rows[] = new Invoice( $body );
			}

			return $Rows;
		}

		return $HttpResponse;
	}

	function PostDrafts( Invoice $invoice ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'invoices/drafts' ) ] ) ),
			$invoice
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200, 201, 202 ] ) ) {
			return new Invoice( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	function PutDrafts( int $draftInvoiceNumber, Invoice $invoice ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'invoices/drafts' ), $draftInvoiceNumber ] ) ),
			$invoice,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new Invoice( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	function PostBooked( Invoice $invoice ) {
		$HttpResponse = $this->RemotePost(
			implode( DIRECTORY_SEPARATOR, array_filter( [ $this->GetEndpoint( 'invoices/booked' ) ] ) ),
			[
				'draftInvoice' => [
					'draftInvoiceNumber' => $invoice->get_draft_invoice_number(),
				],
			]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200, 201, 202 ] ) ) {
			return new Invoice( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}
}