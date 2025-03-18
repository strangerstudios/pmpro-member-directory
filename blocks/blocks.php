<?php

/**
 * Require blocks.
 */
require_once( "profile/block.php" );
require_once( "directory/block.php" );

// Block styling
function pmpromd_register_profile_styling() {
	wp_enqueue_style(
		'pmpromd-block-styling',
		plugins_url( '/css/blocks.css', __FILE__ ),
		array(),
		PMPRO_MEMBER_DIRECTORY_VERSION
	);
}
add_action( 'enqueue_block_editor_assets', 'pmpromd_register_profile_styling' );