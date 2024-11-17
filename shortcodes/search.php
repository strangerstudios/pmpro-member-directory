<?php
/**
 * Show the content for the [pmpro_member_directory_search] shortcode.
 */
function pmpromd_search_shortcode() {
	echo pmpromd_search_form();
}
add_shortcode( 'pmpro_member_directory_search', 'pmpromd_search_shortcode' );
