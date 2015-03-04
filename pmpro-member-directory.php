<?php
/*
Plugin Name: Paid Memberships Pro - Member Directory Add On
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-member-directory/
Description: A very basic shortcode for display a member directory list on your site.
Version: .1
Author: Stranger Studios
Author URI: http://www.strangerstudios.com
*/

$path = dirname(__FILE__);
require_once($path . "/templates/directory.php");

function pmpromd_register_styles() {
	wp_register_style( 'pmpro-member-directory-styles', plugins_url( 'css/pmpro-member-directory.css', __FILE__ ) );
	wp_enqueue_style( 'pmpro-member-directory-styles' );
}
add_action( 'wp_enqueue_scripts', 'pmpromd_register_styles' );

/*
Function to add links to the plugin row meta
*/
function pmpromd_plugin_row_meta($links, $file) {
	if(strpos($file, 'pmpro-member-directory.php') !== false)
	{
		$new_links = array(
			'<a href="' . esc_url('http://www.paidmembershipspro.com/add-ons/plugins-on-github/pmpro-member-directory/')  . '" title="' . esc_attr( __( 'View Documentation', 'pmpro' ) ) . '">' . __( 'Docs', 'pmpro' ) . '</a>',
			'<a href="' . esc_url('http://paidmembershipspro.com/support/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro' ) ) . '">' . __( 'Support', 'pmpro' ) . '</a>',
		);
		$links = array_merge($links, $new_links);
	}
	return $links;
}
add_filter('plugin_row_meta', 'pmpromd_plugin_row_meta', 10, 2);