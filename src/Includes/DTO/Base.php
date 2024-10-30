<?php

namespace MIQID\Plugin\WooCommerce\Includes\DTO;

abstract class Base extends \MIQID\Plugin\Core\Classes\DTO\Base {
	public function __construct( $must_be_null = null ) {
		if ( is_array( $must_be_null ) ) {
			wp_die( sprintf( '<pre>%s</pre>', print_r( [ 'Missing construct', $this, $must_be_null ], true ) ) );
		}
	}
}