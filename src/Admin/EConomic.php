<?php

namespace MIQID\Plugin\WooCommerce\Admin;

use MIQID\Plugin\Core\Classes\DTO\HttpResponse;
use MIQID\Plugin\WooCommerce\Includes\EConomic\API\CustomerGroups;
use MIQID\Plugin\WooCommerce\Includes\EConomic\API\Layouts;
use MIQID\Plugin\WooCommerce\Includes\EConomic\API\Misc;
use MIQID\Plugin\WooCommerce\Includes\EConomic\API\PaymentTerms;
use MIQID\Plugin\WooCommerce\Includes\EConomic\API\VatZones;
use MIQID\Plugin\WooCommerce\Includes\EConomic\DTO\objSelf;
use MIQID\Plugin\WooCommerce\Util;

class EConomic {
	private static $_instance;
	private const SECTION_SETTINGS = 'e-conomic';

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_filter( 'woocommerce_get_sections_advanced', [ $this, 'add_section' ] );
		add_filter( 'woocommerce_get_settings_advanced', [ $this, 'add_settings' ], 10, 2 );
	}

	function add_section( $sections ) {
		$sections[ self::SECTION_SETTINGS ] = __( 'e-conomic', 'miqid-woo' );

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
			'desc' => __( 'Sync Customer, Product and Order over to e-conomic.', 'miqid-woo' ),
		];

		$settings[] = [
			'type' => 'checkbox',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'sync', 'completed' ),
			'name' => __( 'Sync when completed', 'miqid-woo' ),
			'desc' => __( 'Set order to sent in e-conomic', 'miqid-woo' ),
		];

		if ( ( $result = CustomerGroups::Instance()->Get() ) && ! $result instanceof HttpResponse ) {
			if ( ! is_array( $result ) ) {
				$result = [ $result ];
			}

			$options = [];
			foreach ( $result as $row ) {
				$options[ $row->get_customer_group_number() ] = $row->get_name();
			}

			$settings[] = [
				'type'    => 'select',
				'id'      => Util::generate_id( self::SECTION_SETTINGS, 'CustomerGroup' ),
				'name'    => __( 'Customer Group', 'miqid-woo' ),
				'options' => $options,
			];
		}

		if ( ( $result = PaymentTerms::Instance()->Get() ) && ! $result instanceof HttpResponse ) {
			if ( ! is_array( $result ) ) {
				$result = [ $result ];
			}

			$options = [];
			foreach ( $result as $row ) {
				$options[ $row->get_payment_terms_number() ] = $row->get_name();
			}

			$settings[] = [
				'type'    => 'select',
				'id'      => Util::generate_id( self::SECTION_SETTINGS, 'PaymentTerm' ),
				'name'    => __( 'Payment Terms', 'miqid-woo' ),
				'options' => $options,
			];
		}

		if ( ( $result = VatZones::Instance()->Get() ) && ! $result instanceof HttpResponse ) {
			if ( ! is_array( $result ) ) {
				$result = [ $result ];
			}

			$options = [];
			foreach ( $result as $row ) {
				$options[ $row->get_vat_zone_number() ] = $row->get_name();
			}

			$settings[] = [
				'type'    => 'select',
				'id'      => Util::generate_id( self::SECTION_SETTINGS, 'VatZone' ),
				'name'    => __( 'Vat Zones', 'miqid-woo' ),
				'options' => $options,
			];
		}

		if ( ( $result = Layouts::Instance()->Get() ) && ! $result instanceof HttpResponse ) {
			if ( ! is_array( $result ) ) {
				$result = [ $result ];
			}

			$options = [];
			foreach ( $result as $row ) {
				$options[ $row->get_layout_number() ] = $row->get_name();
			}

			$settings[] = [
				'type'    => 'select',
				'id'      => Util::generate_id( self::SECTION_SETTINGS, 'Layout' ),
				'name'    => __( 'Layout', 'miqid-woo' ),
				'options' => $options,
			];
		}

		$settings[] = [
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'section', 'settings', 'end' ),
			'type' => 'sectionend',
		];


		// <editor-fold desc=Integration>
		$settings[] = [
			'type' => 'title',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'section', 'integration' ),
			'name' => __( 'Integration', 'miqid-woo' ),
		];

		$desc = __( 'No connected with e-conomic', 'miqid-woo' );
		if ( ( $result = Misc::Instance()->Self() ) && $result instanceof objSelf ) {
			$desc = sprintf( 'Signup Date: %s', $result->get_signup_date( get_option( 'date_format' ) ) );
		}

		$settings[] = [
			'type' => 'password',
			'id'   => Util::generate_id( self::SECTION_SETTINGS, 'access', 'token' ),
			'name' => __( 'Adgangs-ID', 'miqid-woo' ),
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