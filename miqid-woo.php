<?php
/**
 * Plugin Name:       MIQID-Woo
 * Description:       MIQID-Woo extension for WooCommerce.
 * Version:           1.6.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            MIQ ApS
 * Author URI:        https://miqid.com/
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       miqid-woo
 */

require_once __DIR__ . '/vendor/autoload.php';
ini_set( 'serialize_precision', - 1 );

\MIQID\Plugin\WooCommerce\Init::Instance();