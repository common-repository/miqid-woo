<?php

namespace MIQID\Plugin\WooCommerce\Admin;


use MIQID\Plugin\WooCommerce\Includes\Dinero\{API\Accounts, API\Contacts, API\Invoices, API\Organizations, API\Products, DTO\Contact, DTO\Invoice, DTO\Organization, DTO\Product, DTO\ProductLine};
use MIQID\Plugin\WooCommerce\Includes\EConomic\{DTO\Account, DTO\Accrual};
use MIQID\Plugin\WooCommerce\Includes\Extensions;

class Admin {
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
		add_action( 'admin_menu', [ $this, '_menu' ] );
		add_action( 'admin_init', [ $this, '_settings' ] );
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
	}

	public function _menu() {
		add_submenu_page(
			'miqid',
			'WooCommerce',
			'WooCommerce',
			'manage_options',
			'miqid-woo',
			[ $this, '_page' ],
			10
		);
	}

	public function _page() {
		$this->extensions = new Extensions( get_option( 'miqid-woo' ) );
		?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?= get_admin_page_title() ?></h1>
            <hr class="wp-header-end"/>
            <p>Upload Test</p>
            <form action="<?= esc_attr( admin_url( 'options.php' ) ) ?>" method="post">
				<?php
				settings_fields( 'miqid-woo' );
				do_settings_sections( 'miqid-woo' );
				submit_button();
				?>
            </form>
        </div>
		<?php
	}

	function _settings() {
		register_setting(
			'miqid-woo',
			'miqid-woo',
			[ $this, '_sanitize' ]
		);
		add_settings_section(
			'miqid-woo',
			'Settings',
			null,
			'miqid-woo'
		);
		add_settings_field(
			'gtin',
			'GTIN',
			function () {
				printf( '<input type="checkbox" name="miqid-woo[gtin]" %1$s />',
					$this->extensions->is_gtin() ? 'checked' : '' );
			},
			'miqid-woo',
			'miqid-woo',
			''
		);
		add_settings_field(
			'conditional_shipping',
			'Conditional Shipping',
			function () {
				printf( '<input type="checkbox" name="miqid-woo[conditional_shipping]" %1$s />',
					$this->extensions->is_conditional_shipping() ? 'checked' : '' );
			},
			'miqid-woo',
			'miqid-woo',
			''
		);
		add_settings_field(
			'e_conomic',
			'e-conomic',
			function () {
				printf( '<input type="checkbox" name="miqid-woo[e_conomic]" %1$s />',
					$this->extensions->is_e_conomic() ? 'checked' : '' );
			},
			'miqid-woo',
			'miqid-woo',
			''
		);
		add_settings_field(
			'dinero',
			'Dinero',
			function () {
				printf( '<input type="checkbox" name="miqid-woo[dinero]" %1$s />',
					$this->extensions->is_dinero() ? 'checked' : '' );
			},
			'miqid-woo',
			'miqid-woo',
			''
		);
	}

	function _sanitize( $input ) {

		return $input;
	}
}