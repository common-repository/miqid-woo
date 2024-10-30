<?php


namespace MIQID\Plugin\WooCommerce\Admin;


use MIQID\Plugin\WooCommerce\Includes\Dinero\API\Base;
use MIQID\Plugin\WooCommerce\Includes\Dinero\API\Organizations;
use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO\Organization;
use MIQID\Plugin\WooCommerce\Util;

class Dinero {
	private static $instance;
	private const SECTION_SETTINGS = 'dinero';

	public static function Instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_filter( 'woocommerce_get_sections_advanced', [ $this, 'add_section' ] );
		add_filter( 'woocommerce_get_settings_advanced', [ $this, 'add_settings' ], 10, 2 );
	}

	function add_section( $sections ) {
		$sections[ self::SECTION_SETTINGS ] = __( 'Dinero', 'miqid-woo' );

		return $sections;
	}

	function add_settings( $settings, $current_section ) {
		if ( $current_section !== self::SECTION_SETTINGS ) {
			return $settings;
		}
		$settings = [];

		$settings[] = [
			'type'  => 'settings_start',
			'id'    => Util::generate_id( self::SECTION_SETTINGS, 'settings', 'start' ),
			'class' => 'miqid-settings miqid-' . self::SECTION_SETTINGS,
		];

		$settings[] = [
			'type' => 'title',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'section', 'settings' ),
			'name' => __( 'Settings', 'miqid-woo' ),
		];

		$settings[] = [
			'type' => 'checkbox',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'sync', 'processing' ),
			'name' => __( 'Sync when processing', 'miqid-woo' ),
			'desc' => __( 'Sync Customer, Product and Order over to Dinero.', 'miqid-woo' ),
		];

		$settings[] = [
			'type' => 'checkbox',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'sync', 'completed' ),
			'name' => __( 'Sync when completed', 'miqid-woo' ),
			'desc' => __( 'Set order to sent in Dinero', 'miqid-woo' ),
		];



		$desc = __( 'No connected with Dinero', 'miqid-woo' );
		if ( $Authenticate = Organizations::Instance()->Authenticate() ) {
			$desc = __( 'Connected to Dinero', 'miqid-woo' );
		}

		$settings[] = [
			'type' => 'text',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'access', 'username' ),
			'name' => __( 'Username', 'miqid-woo' ),
			'desc' => $desc,
		];

		$settings[] = [
			'type' => 'password',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'access', 'password' ),
			'name' => __( 'Password', 'miqid-woo' ),
			'desc' => $desc,
		];

		$settings[] = [
			'type' => 'password',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'access', 'token' ), //755ba08d8d8244cd8c593eb6c4852f3c
			'name' => __( 'Token', 'miqid-woo' ),
		];

		$settings[] = [
			'type' => 'number',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'access', 'organization_id' ),
			'name' => __( 'Organization Id', 'miqid-woo' ),
			'desc' => $desc,
		];

		$settings[] = [
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'section', 'integration', 'end' ),
			'type' => 'sectionend',
		];
		// </editor-fold>

		$settings[] = [
			'type' => 'settings_end',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'settings', 'end' ),
		];

		return $settings;
	}
}