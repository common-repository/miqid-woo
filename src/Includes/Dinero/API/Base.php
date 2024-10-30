<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\API;

use MIQID\Plugin\Core\Classes\DTO\{HttpResponse};
use MIQID\Plugin\WooCommerce\Util;

abstract class Base {
	/** @return self */
	abstract static function Instance();

	protected function RemoteGet( $url, array $headers = [], array $args = [] ): HttpResponse {

		$headers = wp_parse_args( $headers, [
			'Content-Type'  => 'application/json',
			'Authorization' => sprintf( 'bearer %s', $this->Authenticate()['access_token'] ?? '' ),
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
			'Content-Type'  => 'application/json',
			'Authorization' => sprintf( 'bearer %s', $this->Authenticate()['access_token'] ?? '' ),
		] );

		$args = wp_parse_args( $args, [
			'headers' => $headers,
			'method'  => 'POST',
			'body'    => $body,
			'timeout' => 30,
		] );

		return new HttpResponse( wp_remote_post( $url, $args ), $url, $args );
	}

	protected function GetEndpoint( ...$endpoint ): string {
		$class = $this;
		if ( empty( $endpoint ) ) {
			try {
				$endpoint[] = ( new \ReflectionClass( $this ) )->getShortName();
			} catch ( \ReflectionException $e ) {

			}
		}

		return implode( DIRECTORY_SEPARATOR, array_unique( array_filter( array_merge( [
			'https://api.dinero.dk/v1',
		], $endpoint ) ) ) );
	}

	private $authenticate;

	/**
	 * @return array|null
	 */
	public function Authenticate() {
		if ( is_null( $this->authenticate ) ) {
			$HttpResponse = wp_remote_post( 'https://authz.dinero.dk/dineroapi/oauth/token', [
				'headers' => [
					'Content-Type'  => 'application/x-www-form-urlencoded',
					'Authorization' => 'Basic ' . base64_encode( sprintf( '%s:%s',
							get_option( Util::generate_id( 'dinero', 'access', 'username' ) ),
							get_option( Util::generate_id( 'dinero', 'access', 'password' ) )
						) ),
				],
				'method'  => 'POST',
				'body'    => http_build_query( [
					'username'   => get_option( Util::generate_id( 'dinero', 'access', 'token' ) ),
					'password'   => get_option( Util::generate_id( 'dinero', 'access', 'token' ) ),
					'scope'      => 'read write',
					'grant_type' => 'password',
					//8CjPGo3m6Qp9JO79qVuPsCfUA02Lvvz!
				] ),
			] );
			if ( in_array( wp_remote_retrieve_response_code( $HttpResponse ), [ 200 ] ) ) {
				$this->authenticate               = json_decode( wp_remote_retrieve_body( $HttpResponse ), true );
				$this->authenticate['expires_in'] = date_create( sprintf( '+%d seconds', $this->authenticate['expires_in'] ) );
			}
		}

		return $this->authenticate;
	}

	protected function GetOrganizationId() {
		return get_option( Util::generate_id( 'dinero', 'access', 'organization_id' ) );//320738;
	}
}