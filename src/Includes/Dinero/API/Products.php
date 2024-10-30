<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\Product;

class Products extends Base {
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
	 * @param $guid
	 *
	 * @return Product|HttpResponse
	 */
	function GetProduct( $guid ) {
		$HttpResponse = $this->RemoteGet(
			$this->GetEndpoint( $this->GetOrganizationId(), 'products', $guid )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return new Product( $HttpResponse->get_body() );
		}

		return $HttpResponse;
	}

	/**
	 * @param $guid
	 * @param Product $product
	 *
	 * @return Product|HttpResponse
	 */
	function UpdateProduct( $guid, Product $product ) {
		$HttpResponse = $this->RemotePost(
			$this->GetEndpoint( $this->GetOrganizationId(), 'products', $guid ),
			$product,
			[],
			[ 'method' => 'PUT' ]
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			return $product;
		}

		return $HttpResponse;
	}

	/**
	 * @return Product[]|HttpResponse
	 */
	function ListProducts( $fields = null, $freeTextSearch = null, $queryFilter = null ) {
		$HttpResponse = $this->RemoteGet(
			add_query_arg( [
				'fields'         => $fields,
				'freeTextSearch' => $freeTextSearch,
				'queryFilter'    => $queryFilter,
			], $this->GetEndpoint( $this->GetOrganizationId(), 'products' ) )
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 200 ] ) ) {
			$products = [];
			foreach ( $HttpResponse->get_body()['Collection'] as $item ) {
				$products[] = new Product( $item );
			}

			return $products;
		}

		return $HttpResponse;
	}

	function CreateProduct( Product $product ) {
		$HttpResponse = $this->RemotePost(
			$this->GetEndpoint( $this->GetOrganizationId(), 'products' ),
			$product
		);

		if ( in_array( $HttpResponse->get_response_code(), [ 201 ] ) ) {
			return $product->set_product_guid($HttpResponse->get_body()['ProductGuid']);
		}

		return $HttpResponse;
	}
}