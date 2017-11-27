<?php
/*
 * Plugin Name: Woo Mercury
 * Version: 1.0
 * Plugin URI: http://tolga.kaprol.net
 * Description: Increases cart total by %10 if selected item is in the cart.
 * Author: Tolga Kaprol
 * Author URI: http://tolga.kaprol.net
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: woo-mercury
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Tolga Kaprol
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-woo-mercury.php' );
require_once( 'includes/class-woo-mercury-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-woo-mercury-admin-api.php' );
require_once( 'includes/lib/class-woo-mercury-post-type.php' );
require_once( 'includes/lib/class-woo-mercury-taxonomy.php' );

/**
 * Returns the main instance of Woo_Mercury to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Woo_Mercury
 */
function Woo_Mercury () {
	$instance = Woo_Mercury::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = Woo_Mercury_Settings::instance( $instance );
	}

	add_action('woocommerce_cart_calculate_fees',array($instance,'price_increaser'), 10, 1);

	return $instance;
}

Woo_Mercury();
