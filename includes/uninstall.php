<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * @since      	1.0.0
 *
 * @package    	roi_hunter_easy
 * @subpackage	roi_hunter_easy/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// inclueded required Classes
require_once( RH_EASY_DIR . 'includes/class-rh-easy-helper.php' );
$helper = new RH_Easy_Helper();

if ( $helper->get_option['cleanup'] !== false ) {
	delete_option( 'roi_hunter_easy' ); // remove settings
	// TODO smazat post meta z orders "rh_easy_tracking_fb" a "rh_easy_tracking_gtm"
}