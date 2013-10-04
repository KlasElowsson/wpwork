<?php
/*
Plugin Name: WP Hashgrid
Plugin URI: http://morganestes.me/wp-hashgrid
Description: A basic implementation of <a href="http://www.hashgrid.com/" title="#grid website" target="_blank">hashgrid.js</a> (#grid) for use in designing and developing WordPress themes.
Version: 0.1.1
Author: Morgan Estes
Author URI: http://morganestes.me
License: GPLv3
*/

/**
 * Class WP_Hashgrid
 */
class WP_Hashgrid {

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'load_assets' ) );
	}

	function load_assets() {
		/** @todo Make the CSS customizable via Admin page. */
		wp_enqueue_script( 'wp-hashgrid', plugins_url( 'hashgrid.js', __FILE__ ), array( 'jquery' ), '9', true );
		wp_enqueue_style( 'wp-hashgrid', plugins_url( 'hashgrid.css', __FILE__ ) );
	}
}

$hashgrid = new WP_Hashgrid();
