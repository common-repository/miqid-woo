<?php

namespace MIQID\Plugin\WooCommerce;

use WC_Tax;

class Util {

	public static function get_option( $option, $default = false ) {
		return \get_option( sprintf( 'miqid_woo_%s', $option ), $default );
	}

	public static function update_option( $option, $value, $autoload = null ) {
		return \update_option( sprintf( 'miqid_woo_%s', $option ), $value, $autoload );
	}

	public static function generate_id( ...$name ) {
		return trim( sprintf( 'miqid_woo_%s', implode( '_', $name ) ), " \t\n\r\0\x0B\_" );
	}

	public static function get_assets_css_url() {
		return sprintf( '%s/%s', self::get_plugin_dir_url(), 'assets/css' );
	}

	public static function get_assets_images_url() {
		return sprintf( '%s/%s', self::get_plugin_dir_url(), 'assets/images' );
	}

	public static function get_assets_js_url() {
		return sprintf( '%s/%s', self::get_plugin_dir_url(), 'assets/js' );
	}

	public static function get_assets_css_path() {
		return sprintf( '%s/%s', self::get_plugin_dir_path(), 'assets/css' );
	}

	public static function get_assets_images_path() {
		return sprintf( '%s/%s', self::get_plugin_dir_path(), 'assets/images' );
	}

	public static function get_assets_js_path() {
		return sprintf( '%s/%s', self::get_plugin_dir_path(), 'assets/js' );
	}

	public static function get_plugin_dir_url() {
		return plugins_url( '', __DIR__ );
	}

	public static function get_plugin_dir_path() {
		return dirname( __DIR__ );
	}

	public static function snake_case( $str ) {
		return strtolower( strtr( preg_replace( [
			'/([a-z\d])([A-Z])/',
			'/([^_])([A-Z][a-z])/',
		], '$1_$2', $str ), [
			'-' => '_',
		] ) );
	}

	public static function filter_null_from( $array ) {
		return array_filter( $array, function ( $v ) {
			return ! is_null( $v );
		} );
	}

	public static function filter_nullable_boolean( $value ) {
		if ( is_null( $value ) ) {
			return $value;
		}

		return filter_var( $value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
	}

	private static function product_tax_rates( \WC_Product $product, $base_tax_rates = false ): array {
		$default_rates = [ 'rate' => 25, 'label' => 'Moms', 'shipping' => 'yes', 'compound' => 'no' ];

		$rates = WC_Tax::get_rates( $product->get_tax_class() );
		if ( $base_tax_rates ) {
			$rates = WC_Tax::get_base_tax_rates( $product->get_tax_class( 'unfiltered' ) );
		}
		if ( empty( $rates ) ) {
			array_push( $rates, $default_rates );
		}

		return $rates;
	}

	public static function product_price_excluding_tax( \WC_Product $product ): float {
		$price = $product->get_price();

		$tax_rates      = self::product_tax_rates( $product );
		$base_tax_rates = self::product_tax_rates( $product, true );

		$remove_taxes = apply_filters( 'woocommerce_adjust_non_base_location_prices', true )
			? WC_Tax::calc_tax( $price, $base_tax_rates, true )
			: WC_Tax::calc_tax( $price, $tax_rates, true );

		return $price - array_sum( $remove_taxes );
	}

	public static function shipping_price_excluding_tax( \WC_Order_Item_Shipping $order_item ): float {
		$default_rates = [ 'rate' => 25, 'label' => 'Moms', 'shipping' => 'no', 'compound' => 'no' ];

		$price = $order_item->get_total();

		$tax_rates = WC_Tax::get_shipping_tax_rates( $order_item->get_tax_class() );
		if ( empty( $tax_rates ) ) {
			$tax_rates = array_push( $tax_rates );
		}

		$price = $price - array_sum( WC_Tax::calc_shipping_tax( $order_item->get_total(), $tax_rates ) );

		return $price;
	}

}