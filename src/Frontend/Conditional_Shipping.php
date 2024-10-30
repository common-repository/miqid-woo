<?php

namespace MIQID\Plugin\WooCommerce\Frontend;

use MIQID\Plugin\WooCommerce\Util;
use WC_Shipping_Rate;

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
		add_filter( 'woocommerce_before_cart', [ $this, 'clear_wc_shipping_rates_cache' ] );
		add_filter( 'woocommerce_before_checkout_form', [ $this, 'clear_wc_shipping_rates_cache' ] );
		add_filter( 'woocommerce_package_rates', [ $this, '_rates' ] );
		add_shortcode( 'miqid_woo_club_signup', [ $this, '_customer_club_signup' ] );
		add_action( 'woocommerce_review_order_before_submit', [ $this, '_order_before_submit' ] );
		add_action( 'wp_ajax_miqid_woo_club_signup', [ $this, '_handle_club_signup' ] );
		add_action( 'wp_ajax_nopriv_miqid_woo_club_signup', [ $this, '_handle_club_signup' ] );
		add_action( 'wp_enqueue_scripts', [ $this, '_enqueue' ] );
	}


	function clear_wc_shipping_rates_cache() {
		$packages = WC()->cart->get_shipping_packages();

		foreach ( $packages as $key => $value ) {
			$shipping_session = "shipping_for_package_$key";

			unset( WC()->session->$shipping_session );
		}
	}

	function _rates( $rates ) {
		$user                 = wp_get_current_user();
		$Conditional_Shipping = [];

		foreach ( $user->roles as $role ) {
			$option = get_option( Util::generate_id( self::SECTION_SETTINGS, 'role', $role ) );
			if ( ( $price = filter_var( $option, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) ) !== null ) {
				$Conditional_Shipping[ $role ] = [
					'price' => $price,
					'label' => get_option( Util::generate_id( self::SECTION_SETTINGS, 'role', $role, 'label' ) ),
				];
			}
		}

		uasort( $Conditional_Shipping, function ( $a, $b ) {
			return $a['price'] > $b['price'] ? 1 : - 1;
		} );

		$Conditional_Shipping = current( $Conditional_Shipping );

		/**
		 * @var int|string $key
		 * @var WC_Shipping_Rate $rate
		 */
		if ( ! empty( $Conditional_Shipping ) ) {
			foreach ( $rates as $key => $rate ) {
				if ( floatval( $rate->get_cost() ) > 0 ) {
					$cost = absint( min( floatval( $rate->get_cost() ), $Conditional_Shipping['price'] ) );

					$rate->set_cost( sprintf( '%s', $cost ) );
					$rate->set_label( trim( sprintf( '%s - %s',
						$rate->get_label(),
						$Conditional_Shipping['label']
					), " \t\n\r\0\x0B\-" ) );
				}

				$rates[ $key ] = $rate;
			}
		}

		return $rates;
	}

	function _order_before_submit() {
		do_shortcode( '[miqid_woo_club_signup]' );
	}

	function _customer_club_signup( $atts, $content = null ) {
		$user = wp_get_current_user();
		if ( ! in_array( get_option( 'miqid_woo_conditional_shipping_customer_club' ), $user->roles ) ) {
			$html   = [];
			$html[] = '<div class="miqid_woo_club_signup">';
			$html[] = sprintf( '<h3>%s</h3>', __( 'Kundeklub' ) );
			$html[] = sprintf( '<p>%s</p>', __( 'Tilmelder du dig kundeklubben, får du samtidig besked om nye produkter samt tips og tricks før andre. Du får derudover fri fragt på alle ordrer.' ) );
			$html[] = '<div style="display: flex">';
			$html[] = sprintf( '<input type="email" name="miqid_woo_club_signup" placeholder="%s" value="%s" />', __( 'Skriv din email her' ), esc_attr( $user->user_email ) );
			$html[] = sprintf( '<button type="button" class="button alt" style="white-space: nowrap">%s</button>', __( 'Signup' ) );
			$html[] = '</div>';
			$html[] = '</div>';
			$html[] = '<br><br>';

			print implode( $html );
		}
	}

	function _handle_club_signup() {

		$email = sanitize_email( $_POST['miqid_woo_club_signup'] ?? '' );
		if ( empty( $email ) ) {
			wp_send_json( false );
		}

		$user = get_user_by( 'email', $email );

		if ( ! $user ) {
			$user_id = wp_create_user( $email, wp_generate_password(), $email );
			if ( ! is_wp_error( $user_id ) ) {
				$user = get_user_by( 'id', $user_id );
			}
		}

		$user->add_role( get_option( 'miqid_woo_conditional_shipping_customer_club' ) );
		if ( ! is_user_logged_in() ) {
			wp_send_json( "Login" );
		}
		wp_send_json( true );

	}

	function _enqueue() {

		wp_enqueue_script(
			'Conditional_Shipping',
			sprintf( '%s/Conditional_Shipping.js', Util::get_assets_js_url() ),
			'jquery',
			date( 'Ymd-His', filemtime( sprintf( '%s/Conditional_Shipping.js', Util::get_assets_js_path() ) ) ),
			true
		);

		wp_localize_script(
			'Conditional_Shipping',
			'conditional_shipping',
			[
				'admin_ajax' => admin_url( 'admin-ajax.php' ),
			]
		);
	}
}