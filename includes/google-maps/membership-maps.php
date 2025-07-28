<?php
/**
 * This is the main file for the PMPro Member Directory Maps functionality.
 * The contents of this directory are to self-contain the Google Maps functionality for the Member Directory.
 * 
 * This is to ensure a smooth transition for users and developers who have the Membership Maps Add On installed.
 * 
 * @since 2.1
 */
define( 'PMPRO_MEMBER_DIRECTORY_MAPS_DIR', dirname( __FILE__ ) );

include_once( PMPRO_MEMBER_DIRECTORY_MAPS_DIR . '/includes/functions.php' );
include_once( PMPRO_MEMBER_DIRECTORY_MAPS_DIR . '/includes/admin.php' );

/**
 * Unhook Membership Maps hooks to avoid duplicate functionality.
 * 
 * @since 2.1
 */
function pmpromd_compatibility_for_membership_maps() {
	if ( ! defined( 'PMPROMM_VERSION' ) ) {
		return;
	}

	// Let's unhook everything here.
	remove_action( 'wp_enqueue_scripts', 'pmpromm_enqueue_scripts' );
	remove_action( 'pmpro_after_checkout', 'pmpromm_after_checkout', 10, 2 );
	remove_filter( 'debug_information', 'pmpromm_sitehealth_information', 11, 1 );
	remove_action( 'pmpro_personal_options_update', 'pmpro_geocode_billing_address_fields_frontend', 10, 1 );
	remove_action( 'personal_options_update', 'pmpro_geocode_billing_address_fields_frontend', 10, 1 );
	remove_action( 'edit_user_profile_update', 'pmpro_geocode_billing_address_fields_frontend', 10, 1 );
	remove_action( 'pmpro_checkout_boxes', 'pmpromm_checkout_fields' );
	remove_filter( 'pmpro_custom_advanced_settings','pmpromm_advanced_settings_field', 20 );
	remove_action( 'pmpro_member_directory_before', 'pmpromm_load_map_directory_page', 10, 2 );
	remove_action( 'pmpro_show_user_profile', 'pmpromm_edit_profile_fields', 10, 1 );
}
add_action( 'init', 'pmpromd_compatibility_for_membership_maps', 5 );

/**
 * Add deprecated notice for Membership Maps with PMPro core.
 * 
 * @since 2.1
 */
function pmpromd_show_maps_deprecated_notice() {
	// Only run this if the Membership Maps Add On is active.
	if ( ! defined( 'PMPROMM_VERSION' ) ) {
		return;
	}


	// Only show on a certain page.
	if ( ! isset( $_REQUEST['page'] ) || strpos( sanitize_text_field( $_REQUEST['page'] ), 'pmpro' ) === false  ) {
			return;
	}

	// Show a warning notice that the Membership Maps Add On is deprecated.
	?>
	<div class="notice notice-warning">
		<p><?php esc_html_e( 'The Paid Memberships Pro - Membership Maps Add On is now part of the Member Directory and Profile Add On. Please deactivate the Paid Memberships Pro - Membership Maps Add On.', 'pmpro-member-directory' ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'pmpromd_show_maps_deprecated_notice', 1 );

