<?php

namespace MIQID\Plugin\WooCommerce\Admin;

use MIQID\Plugin\WooCommerce\Util;

class gtin {
	private static $_instance;

	const SECTION_SETTINGS = 'mw-gtin';

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		/*add_filter( 'woocommerce_get_sections_products', [ $this, 'add_section' ] );
		add_filter( 'woocommerce_get_settings_products', [ $this, 'add_settings' ], 10, 2 );*/
		add_action( 'woocommerce_product_options_sku', [ $this, 'add_product_options_gtin' ] );
		add_action( 'woocommerce_process_product_meta', [ $this, 'save_product_options_gtin' ] );
	}

	public function add_section( $sections ) {
		$sections[ self::SECTION_SETTINGS ] = __( 'GTIN', 'miqid-woo' );

		return $sections;
	}

	public function add_settings( $settings, $current_section ) {
		if ( $current_section !== self::SECTION_SETTINGS ) {
			return $settings;
		}

		$settings = [
			[
				'id'    => Util::generate_id( 'gtin' ),
				'type'  => 'settings_start',
				'class' => 'miqid-settings miqid-gtin',
			],

			[
				'id'   => Util::generate_id( 'gtin', 'merchant' ),
				'type' => 'title',
				'name' => __( 'Google Merchant Info', 'miqid-woo' ),
			],

			[
				'id'    => Util::generate_id( 'gtin', 'merchant_id' ),
				'type'  => 'text',
				'title' => __( 'Merchant ID', 'miqid-woo' ),
			],

			[
				'id'    => Util::generate_id( 'gtin', 'merchant_email' ),
				'type'  => 'text',
				'title' => __( 'Merchant Email', 'miqid-woo' ),
			],

			[
				'id'   => Util::generate_id( 'gtin', 'merchant' ),
				'type' => 'sectionend',
			],

			[
				'id'   => Util::generate_id( 'gtin', 'end' ),
				'type' => 'settings_end',
			],
		];

		return $settings;
	}

	public function add_product_options_gtin() {
		woocommerce_wp_text_input( [
			'id'          => Util::generate_id( 'gtin' ),
			'label'       => __( 'GTIN', 'miqid-woo' ),
			'description' => __( 'Global Trade Item Number', 'miqid-woo' ),
			'desc_tip'    => true,
		] );
	}

	public function save_product_options_gtin( $post_id ) {
		if ( isset( $_POST[ Util::generate_id( 'gtin' ) ] ) ) {
			update_post_meta(
				$post_id,
				Util::generate_id( 'gtin' ),
				sanitize_text_field( $_POST[ Util::generate_id( 'gtin' ) ] )
			);
		}
	}

}