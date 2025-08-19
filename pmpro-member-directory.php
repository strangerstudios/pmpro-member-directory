<?php
/*
Plugin Name: Paid Memberships Pro - Member Directory Add On
Plugin URI: https://www.paidmembershipspro.com/add-ons/member-directory/
Description: Adds a customizable Member Directory and Member Profiles to your membership site.
Version: 2.1.1
Author: Paid Memberships Pro
Author URI: https://www.paidmembershipspro.com/
Text Domain: pmpro-member-directory
Domain Path: /languages
*/

// Definitions
define( 'PMPRO_MEMBER_DIRECTORY_VERSION', '2.1.1' );
define( 'PMPRO_MEMBER_DIRECTORY_BASE_FILE', __FILE__ );
define( 'PMPRO_MEMBER_DIRECTORY_DIR', dirname( __FILE__ ) );
define( 'PMPRO_MEMBER_DIRECTORY_BASENAME', plugin_basename( __FILE__ ) );

// Load directory or profile templates from theme, then from plugin.
$custom_dir = get_stylesheet_directory() . '/paid-memberships-pro/pmpro-member-directory/';
$custom_directory_file = $custom_dir . 'directory.php';
$custom_profile_file = $custom_dir . 'profile.php';
file_exists( $custom_directory_file ) ? require_once( $custom_directory_file ) : require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/templates/directory.php' );
file_exists( $custom_profile_file ) ? require_once( $custom_profile_file ) : require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/templates/profile.php' );

// Includes
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/blocks/blocks.php');
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/includes/admin.php' );
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/includes/deprecated.php' );
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/includes/functions.php' );
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/includes/search.php' );
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/includes/google-maps/membership-maps.php' );

// Shortcodes
require_once( PMPRO_MEMBER_DIRECTORY_DIR . '/shortcodes/search.php' );

/**
 * Load the languages folder for translations.
 */
function pmpromd_load_textdomain() {
	load_plugin_textdomain( 'pmpro-member-directory', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'pmpromd_load_textdomain' );

/**
 * Register the Member Directory styles.
 */
function pmpromd_register_styles() {
	// Register the site's custom stylesheet, if it exists.
	if ( file_exists( get_stylesheet_directory() . '/paid-memberships-pro/member-directory/css/pmpro-member-directory.css' ) ) {
		$theme_version = wp_get_theme()->get( 'Version' );
		wp_register_style(
			'pmpro-member-directory-custom-styles',
			get_stylesheet_directory_uri() . '/paid-memberships-pro/member-directory/css/pmpro-member-directory.css',
			array(),
			$theme_version
		);
	} elseif ( file_exists( get_template_directory() . '/paid-memberships-pro/member-directory/css/pmpro-member-directory.css' ) ) {
		$theme_version = wp_get_theme()->parent()->get( 'Version' );
		wp_register_style(
			'pmpro-member-directory-custom-styles',
			get_template_directory_uri() . '/paid-memberships-pro/member-directory/css/pmpro-member-directory.css',
			array(),
			$theme_version
		);
	}

	// Enqueue the custom stylesheet if it exists, otherwise enqueue the default stylesheet.
	if ( wp_style_is( 'pmpro-member-directory-custom-styles', 'registered' ) ) {
		wp_enqueue_style( 'pmpro-member-directory-custom-styles' );
	} else {
		// Register and enqueue the default plugin stylesheet.
		wp_register_style(
			'pmpro-member-directory-styles',
			plugins_url( 'css/pmpro-member-directory.css', __FILE__ ),
			array(),
			PMPRO_MEMBER_DIRECTORY_VERSION
		);
		wp_enqueue_style( 'pmpro-member-directory-styles' );
	}

	// Customize our styles for the WP Admin Bar.
	$custom_css = '#wpadminbar #wp-admin-bar-pmpromd-edit-member .ab-item:before { content: "\f110"; top: 3px; }';
	wp_add_inline_style( 'pmpro-member-directory-styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'pmpromd_register_styles' );



/**
 *  TODO: Probably move some of this logic into core PMPro and then deprecate the rest of the functions in this file.
 */
function pmpromd_display_file_field($meta_field) {
	$meta_field_file_type = wp_check_filetype($meta_field['fullurl']);
	switch ($meta_field_file_type['type']) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			return '<a href="' . $meta_field['fullurl'] . '" title="' . $meta_field['filename'] . '" target="_blank"><img class="subtype-' . $meta_field_file_type['ext'] . '" src="' . $meta_field['fullurl'] . '"><span class="pmpromd_filename">' . $meta_field['filename'] . '</span></a>'; break;
	case 'video/mpeg':
	case 'video/mp4':
		return do_shortcode('[video src="' . $meta_field['fullurl'] . '"]'); break;
	case 'audio/mpeg':
	case 'audio/wav':
		return do_shortcode('[audio src="' . $meta_field['fullurl'] . '"]'); break;
	default:
		return '<a href="' . $meta_field['fullurl'] . '" title="' . $meta_field['filename'] . '" target="_blank"><img class="subtype-' . $meta_field_file_type['ext'] . '" src="' . wp_mime_type_icon($meta_field_file_type['type']) . '"><span class="pmpromd_filename">' . $meta_field['filename'] . '</span></a>'; break;
	}
}

/**
 * Formatting profile fields based on the field type
 *
 * @since 1.2
 *
 * @param string      $value   The value of the field
 * @param string      $field_name   The field ID or name that would be stored in the DB
 * @param string      $field_label   The field's front-facing label
 *
 * @return string The output that may have been clickable or embedded.
 */
function pmpromd_format_profile_field( $value, $field_name, $field_label = false ){

	if( empty( $field_name ) ) {
		$field_name = $value;
	}

	$original_value = $value;

	$is_email = false;
	if( is_email( $value ) ) {
		$is_email = true;
		$value = make_clickable( $value );	
	}

	/**
	 * Should we wp_oembed the URL that is provided
	 * 
	 * @param bool Should this url be sent through oembed to render
	 * @param string $field The type of field your changes should apply to
	 */
	$try_oembed = apply_filters( 'pmpromd_try_oembed_url', true, $field_name );

	//Should we try and run oembed on this link?
	if( $try_oembed && !$is_email ) {
		
		// Only try to embed if the URL is valid.
		if ( wp_http_validate_url( $value ) ) {
			$url_embed = wp_oembed_get( $value );		
		}

		if( !empty( $url_embed ) ){
			//Oembed returned a vlue
			$value = $url_embed;
		} else { 
			//Oembed did not return anything. Lets check if we have a label?
			if( $field_label ) {
				$value = sprintf( "<a href='%1s' title='%2s' target='_BLANK'>%3s</a>", $value, $field_label, $field_label );	
			} else {
				//We don't have a label (for cases like an email address)
				$value = make_clickable( $value );
			}
		}
	}	

	if ( function_exists( 'pmpro_get_label_for_user_field_value' ) && ! empty( $field_name ) ) { 
		$value = pmpro_get_label_for_user_field_value( $field_name, $value );
	}

	// Let's support checkboxes here instead.
	if ( $value === '1' ) {
		$value = esc_html__( 'Yes', 'pmpro-member-directory' );
	} elseif ( $value === '0' ) {
		$value = esc_html__( 'No', 'pmpro-member-directory' );
	}
	
	/**
	 * Format the profile field
	 *
	 * @param string $value The value or string that you want to format
	 * @param string $original_value The original value before formatting
	 * @param string $field The type of field your changes should apply to
	 */
	$value = apply_filters( 'pmpromd_format_profile_field', $value, $original_value, $field_name );

	return $value;

}
