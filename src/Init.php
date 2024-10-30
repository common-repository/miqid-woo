<?php

namespace MIQID\Plugin\WooCommerce;

use MIQID\Plugin\WooCommerce\Frontend\{Conditional_Shipping, Dinero, EConomic, gtin};
use MIQID\Plugin\WooCommerce\Includes\Extensions;

class Init {
	private static $_instance;
	/**
	 * @var Extensions
	 */
	private $extensions;

	public static function Instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		$this->_detect_miqid_core();

		$this->extensions = new Extensions( get_option( 'miqid-woo' ) );
		if ( $this->extensions->is_gtin() ) {
			gtin::Instance();
		}

		if ( $this->extensions->is_conditional_shipping() ) {
			Conditional_Shipping::Instance();
		}

		if ( $this->extensions->is_e_conomic() ) {
			EConomic::Instance();
		}

		if ( $this->extensions->is_dinero() ) {
			Dinero::Instance();
		}

		if ( is_admin() ) {
			Admin\Admin::Instance();
		}
	}

	public function _detect_miqid_core() {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
		if ( ! is_plugin_active( 'miqid-core/miqid-core.php' ) ) {
			$this->_deactivate_plugin();
		}
	}

	public function _deactivate_plugin() {
		deactivate_plugins( 'miqid-woo/miqid-woo.php' );
		add_action( 'admin_notices', [ $this, '_notice_missing_core' ], 15 );
	}

	public function _notice_missing_core() {
		?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( 'MIQID-Woo has been deactivated, missing MIQID-Core', 'miqid-woo' ) ?></p>
        </div>
		<?php
	}
}

