<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\API;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Util;

abstract class Base {
	/** @return self */
	abstract static function Instance();

	protected function RemoteGet( $url, array $headers = [], array $args = [] ): HttpResponse {

		$headers = wp_parse_args( $headers, [
			'Content-Type'          => 'application/json; charset=utf-8',
			'X-AppSecretToken'      => 'jNnMtpsjYoRBEmWZpHYFPLyWlQ02QdSPcMWDCmWsuyM1',
			'X-AgreementGrantToken' => get_option( Util::generate_id( 'e-conomic', 'access', 'token' ) ),
		] );

		$args = wp_parse_args( $args, [
			'headers' => $headers,
			'timeout' => 30,
		] );

		return new HttpResponse( wp_remote_get( $url, $args ), $url, $args );
	}

	protected function RemotePost( $url, $body = null, array $headers = [], array $args = [] ): HttpResponse {

		if ( is_array( $body ) || is_object( $body ) ) {
			$body = json_encode( $body );
		}

		$headers = wp_parse_args( $headers, [
			'Content-Type'          => 'application/json; charset=utf-8',
			'X-AppSecretToken'      => 'jNnMtpsjYoRBEmWZpHYFPLyWlQ02QdSPcMWDCmWsuyM1',
			'X-AgreementGrantToken' => get_option( Util::generate_id( 'e-conomic', 'access', 'token' ) ),
		] );

		$args = wp_parse_args( $args, [
			'headers' => $headers,
			'method'  => 'POST',
			'body'    => $body,
			'timeout' => 30,
		] );

		return new HttpResponse( wp_remote_post( $url, $args ), $url, $args );
	}

	protected function GetEndpoint( $endpoint = null ): string {
		$class = $this;

		try {
			$class = new \ReflectionClass( $this );
		} catch ( \ReflectionException $e ) {

		}

		return implode( DIRECTORY_SEPARATOR, array_filter( [
			'https://restapi.e-conomic.com',
			$endpoint ?? mb_strtolower( $class->getShortName() ),
		] ) );
	}

	/**
	 * @param array $array
	 *
	 * @return array|string
	 * @deprecated
	 */
	protected function Filter( $array = [] ) {
		$array                          = [
			'name'  => 'Joe',
			'name2' => [ '=' => 'Joe' ],
			'name3' => [ '=' => [ 'Joe', 'Biden' ] ],
			'name4' => [ 'In' => [ 'Joe', 'Biden' ] ],
		];
		$operator_equals                = [ '=', 'eq', '$eq:' ];
		$operator_not_equals            = [ '!=', 'ne', '$ne:' ];
		$operator_greater_than          = [ '>' ];
		$operator_greater_than_or_equal = [ '>=' ];
		$operator_less_than             = [ '<' ];
		$operator_less_than_or_equal    = [ '<=' ];
		$operator_substring_match       = [ 'like' ];
		$operator_and_also              = [ '&&' ];
		$operator_or_else               = [ '||' ];
		$operator_in                    = [ 'in' ];
		$operator_not_in                = [ 'not in' ];
		$expression                     = [];

		/*foreach ( $array as $key => $item ) {
			if ( is_array( $item ) ) {
				foreach ( $item as $operator => $value ) {
					$filter_operator = mb_strtolower( $operator );
					if ( is_array( $value ) ) {
						if ( in_array( $filter_operator, [ 'in', '$in:' ] ) ) {
							$expression[ $key ] = sprintf( '%1$s$in:[%2$s]', $key, implode( ',', $value ) );
						} else if ( in_array( $filter_operator, [ 'not in', 'nin', '$nin:' ] ) ) {
							$expression[ $key ] = sprintf( '%1$s$nin:[%2$s]', $key, implode( ',', $value ) );
						}
					} else {

					}
				}
			} else {
				$expression[ $key ] = sprintf( '%s$eq:%s', $key, $item );
			}
		}*/

		return [
			$array,
			$expression,
		];

		return '';
	}
}