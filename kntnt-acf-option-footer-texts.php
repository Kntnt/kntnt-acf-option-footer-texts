<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Advanced Custom Field Option Page For Footer Texts
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Allows ACF to add footer texts settings to the Apperence menu.
 * Version:           1.1.2
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

defined( 'ABSPATH' ) || die;

// Give administrator right to edit footer content if not already assigned.
// Use a role/capability plugin (e.g. Members by Justin Tadlock) to assign
// the capability to other roles. The reason to test that administrator
// not already has the capability is to avoid writing to the database on
// every page view. The capability needs to be set only once. Since this
// is a mu-plugin, we can't use the activation hook to do this.
add_action( 'init', function () {
	$admin = get_role( 'administrator' );
	if ( ! $admin->has_cap( 'kntnt_edit_footer' ) ) {
		$admin->add_cap( 'kntnt_edit_footer' );
	}
} );

add_action( 'acf/init', function () {
	acf_add_options_sub_page( [
		'parent_slug' => 'options-general.php',
		'menu_slug' => 'footer-texts',
		'menu_title' => __( 'Footer', 'kntnt-acf-option-footer-texts' ),
		'page_title' => __( 'Footer texts', 'kntnt-acf-option-footer-texts' ),
		'capability' => 'kntnt_edit_footer',
		'redirect' => false,
	] );
} );
