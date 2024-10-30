<?php

namespace MIQID\Plugin\WooCommerce\Frontend;

use MIQID\Plugin\WooCommerce\Util;

class gtin {
	private static $_instance;

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_filter( 'woocommerce_structured_data_product', [ $this, 'extend_gtin' ], 10, 2 );
	}

	public function extend_gtin( $markup, $product ) {
		$gtin = get_post_meta( $product->get_id(), Util::generate_id( 'gtin' ), true );

		if ( ! empty( $gtin ) ) {
			$markup['gtin'] = $gtin;
		}

		return $markup;
	}

}