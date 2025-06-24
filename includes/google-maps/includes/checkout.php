<?php
/**
 * Displays the address fields for the user on the checkout page
 *
 * @since TBD
 * @return string HTML output
 */
function pmpromd_map_fields_checkout_boxes(){
    pmpromd_show_map_address_fields();
}
add_action( 'pmpro_checkout_boxes', 'pmpromd_map_fields_checkout_boxes' );

/**
 * Displays the address fields for the user on the profile page
 *
 * @since TBD
 * @return string HTML output
 */
function pmpromd_map_fields_show_user_profile( $current_user ){
    pmpromd_show_map_address_fields( $current_user->ID );
}
add_action( 'pmpro_show_user_profile', 'pmpromd_map_fields_show_user_profile', 10, 1 );

/**
 * Geocode the address fields after checkout and save the location data.
 *
 * @param [type] $user_id
 * @param [type] $morder
 * @return void
 */
function pmpromd_map_process_map_address_after_checkout( $user_id, $morder ){
	pmpromd_save_marker_location_for_user( $user_id );
}
add_action( 'pmpro_after_checkout', 'pmpromd_map_process_map_address_after_checkout', 10, 2 );

