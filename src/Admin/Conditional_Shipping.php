<?php

namespace MIQID\Plugin\WooCommerce\Admin;

use MIQID\Plugin\WooCommerce\Util;

class Conditional_Shipping {
	private static $_instance;

	private const SECTION_SETTINGS = 'conditional_shipping';

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_filter( 'woocommerce_get_sections_products', [ $this, 'add_section' ] );
		add_filter( 'woocommerce_get_settings_products', [ $this, 'add_settings' ], 10, 2 );
	}

	function add_section( $sections ) {
		$sections[ self::SECTION_SETTINGS ] = __( 'Conditional Shipping', 'miqid-woo' );

		return $sections;
	}

	function add_settings( $settings, $current_section ) {
		if ( $current_section !== self::SECTION_SETTINGS ) {
			return $settings;
		}

		$roles          = [];
		$settings_roles = [];
		foreach ( wp_roles()->roles as $key => $role ) {
			$roles[ $key ]    = $role['name'];
			$settings_roles[] = [
				'type' => 'text',
				'id'   => Util::generate_id( self::SECTION_SETTINGS, 'role', $key ),
				'name' => sprintf( __( '%s - Price', 'miqid-woo' ), $role['name'] ),
			];
			$settings_roles[] = [
				'type' => 'text',
				'id'   => Util::generate_id( self::SECTION_SETTINGS, 'role', $key, 'label' ),
				'name' => sprintf( __( '%s - Label', 'miqid-woo' ), $role['name'] ),
			];
		}

		$settings   = [];
		$settings[] = [
			'type'  => 'settings_start',
			'id'    => Util::generate_id( self::SECTION_SETTINGS ),
			'class' => 'miqid-settings miqid-' . self::SECTION_SETTINGS,
		];
		$settings[] = [
			'type' => 'title',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'club_signup' ),
			'name' => __( 'Club', 'miqid-woo' ),
		];
		$settings[] = [
			'type'    => 'select',
			'id'      => Util::generate_id( self::SECTION_SETTINGS, 'customer_club' ),
			'name'    => __( 'Kunde Club Rolle' ),
			'options' => $roles,
		];
		$settings[] = [
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'club_signup' ),
			'type' => 'sectionend',
		];
		$settings[] = [
			'type' => 'title',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'section' ),
			'name' => __( 'Conditional Shipping', 'miqid-woo' ),
		];
		$settings   = array_merge( $settings, $settings_roles );
		$settings[] = [
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'section' ),
			'type' => 'sectionend',
		];
		$settings[] = [
			'type' => 'settings_end',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'end' ),
		];

		return $settings;
	}
}