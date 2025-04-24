<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

// See if block editor is available.
if ( ! function_exists( 'register_block_type' ) ) {
	return;
}

// Register block type.
function pmpromd_register_directory_block() {

	wp_register_script( 
		'pmpromd-directory-block', 
		plugins_url( 'block.build.js', __FILE__ ), 
		array( 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-api', 'wp-editor', 'pmpro_admin' )
	);

	register_block_type( 'pmpro-member-directory/directory', array(
		'editor_script' => 'pmpromd-directory-block',
		'render_callback' => 'pmpromd_shortcode'
	) );

}
add_action( 'init', 'pmpromd_register_directory_block' );