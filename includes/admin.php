<?php
/**
 * Adds an edit profile link when on the Profile page
 */
function pmpromd_add_edit_profile( $admin_bar ) {

	global $pmpro_pages, $post;

	// Only show the link to users who can edit members.
	if (! function_exists( 'pmpro_get_edit_member_capability') || ! current_user_can( pmpro_get_edit_member_capability() ) ) {
		return;
	}

	// Only show the link on the Profile page.
	if ( ! empty( $post ) && ! empty( $pmpro_pages['profile'] ) && $pmpro_pages['profile'] == $post->ID ) {

		$pu = pmpromd_get_user();

		if ( $pu ) {
		
			$edit_member_link = add_query_arg( array( 'page' => 'pmpro-member', 'user_id' => $pu->ID, 'pmpro_member_edit_panel' => 'memberships' ), admin_url( 'admin.php' ) );
			$admin_bar->add_menu( array(
				'id'    => 'pmpromd-edit-member',
				'title' => esc_html__( 'Edit Member', 'pmpro-member-directory' ),
				'href'  => esc_url( $edit_member_link ),
				'meta'  => array(
					'title' => __( 'Edit Member', 'pmpro-member-directory' ),
				),
			));		    

		}
	}

}
add_action( 'admin_bar_menu', 'pmpromd_add_edit_profile', 100 );

/**
 * Add a page setting for the Member Directory and Profile pages.
 *
 * @param array $pages Array of settings for the PMPro settings page.
 */
function pmpromd_extra_page_settings( $pages ) {
	$pages['directory'] = array(
		'title' => esc_html__( 'Directory', 'pmpro-member-directory' ),
		'content' => '[pmpro_member_directory]',
		'hint' => esc_html__( 'Include the shortcode [pmpro_member_directory].', 'pmpro-member-directory' ),
	);
	$pages['profile'] = array(
		'title' => esc_html__( 'Profile', 'pmpro-member-directory' ),
		'content' => '[pmpro_member_profile]',
		'hint' => esc_html__( 'Include the shortcode [pmpro_member_profile].', 'pmpro-member-directory' ),
	);

	return $pages;
}
add_filter( 'pmpro_extra_page_settings', 'pmpromd_extra_page_settings');

/**
 * On Page Settings Save, Flush Rewrite Rules
 */
function pmpromd_pagesettings_flush() {
	if ( 
		! empty( $_REQUEST['page'] ) && 
		$_REQUEST['page'] == 'pmpro-pagesettings' && //Are we on the PMPro Page Settings
		! empty( $_REQUEST['savesettings']) && //Are we hitting the save button
		! empty( $_REQUEST['profile_page_id'] ) //Is there a profile page present
	) {
		flush_rewrite_rules( true );
	}
}
add_action( 'admin_init', 'pmpromd_pagesettings_flush', 4 );

/**
 * We're saving a page, is it a Profile page
 */
function pmpromd_page_save_flush( $post_id ) {
	global $pmpro_pages;
	if( ! empty( $pmpro_pages['profile'] ) && 
		(int)$pmpro_pages['profile'] == $post_id && 
		did_action( 'init' ) 
	) {
		flush_rewrite_rules( true );
	}
}
add_action( 'save_post', 'pmpromd_page_save_flush', 10, 1 );

/**
 * Run an upgrade check to compare versions and flush rewrite rules
 *
 * @since 1.2
 * 
 * @return void
 */
function pmpromd_check_for_upgrade() {

	if ( ! function_exists( 'pmpro_init' ) ) {
		return;
	}

	$pmpromd_db_version = get_option("pmpro_md_db_version");

	if( empty( $pmpromd_db_version ) || version_compare( $pmpromd_db_version, '1.2', '<' ) ) {
		flush_rewrite_rules( true );
		pmpro_setOption("md_db_version", "1.2");
	}

}
add_action( 'admin_init', 'pmpromd_check_for_upgrade' );

/**
 * Strip the [pmpro_member_directory] or [pmpro_member_profile] shortcode and blocks from content if the current user can't edit users.
 *
 * @since 2.0
 *
 * @return mixed The content with the shortcode removed. Will be the same type as the input.
 */
function pmpromd_maybe_strip_shortcodes( $content ) {
	// If the user can edit users, we don't need to strip the shortcode.
	if ( current_user_can( 'edit_users' ) ) {
		return $content;
	}

	// If an array is passed in, filter all elements recursively.
	if ( is_array( $content ) ) {
		foreach ( $content as $key => $value ) {
			$content[ $key ] = pmpromd_maybe_strip_shortcodes( $value );
		}
		return $content;
	}

	// If we're not looking at a string, just return it.
	if ( ! is_string( $content ) ) {
		return $content;
	}
	
	// Okay, we have a string, figure out the regex.
	$shortcodeRegex = get_shortcode_regex( array( 'pmpro_member_directory', 'pmpro_member_profile' ) );	

	// Remove various blocks.
	$blockWrapperPatterns = array(
		"<!-- wp:pmpro-member-directory/directory /-->",
		"<!-- wp:pmpro-member-directory/profile /-->",
		"/<!--\s*wp:pmpro-member-directory\/directory\s*{[^}]*}\s*\/-->/",
		"/<!--\s*wp:pmpro-member-directory\/profile\s*{[^}]*}\s*\/-->/",
		"/<!-- wp:shortcode -->\s*$shortcodeRegex\s*<!-- \/wp:shortcode -->/s",
		"/$shortcodeRegex/"
	);

	$content = preg_replace( $blockWrapperPatterns, '', $content );

	return $content;
}
add_filter( 'content_save_pre', 'pmpromd_maybe_strip_shortcodes' );
add_filter( 'excerpt_save_pre', 'pmpromd_maybe_strip_shortcodes' );
add_filter( 'widget_update_callback', 'pmpromd_maybe_strip_shortcodes' );

/**
 * Only allow those with the edit_users capability
 * to use the Directory or Profile shortcodes in post_meta.
 *
 * @since 2.0
 * @param int    $meta_id     ID of the meta data entry.
 * @param int    $object_id   ID of the object the meta is attached to.
 * @param string $meta_key    Meta key.
 * @param mixed  $_meta_value Meta value.
 * @return void
 */
function pmpromd_maybe_strip_shortcodes_from_post_meta( $meta_id, $object_id, $meta_key, $_meta_value ) {
	// Bail if the value is not a string or array.
	if ( ! is_string( $_meta_value ) && ! is_array( $_meta_value ) ) {
		return;
	}

	// Strip the shortcode from the meta value.
	$stripped_value = pmpromd_maybe_strip_shortcodes( $_meta_value );

	// If there was a change, save our stripped version.
	if ( $stripped_value !== $_meta_value ) {
		update_post_meta( $object_id, $meta_key, $stripped_value );
	}
}
add_action( 'updated_post_meta', 'pmpromd_maybe_strip_shortcodes_from_post_meta', 10, 4 );

/**
 * Function to add links to the plugin row meta
 */
function pmpromd_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'pmpro-member-directory.php' ) !== false ) {
		$new_links = array(
			'<a href="' . esc_url( 'https://www.paidmembershipspro.com/add-ons/pmpro-member-directory/' ) . '" title="' . esc_attr( __( 'View Documentation', 'pmpro-member-directory' ) ) . '">' . __( 'Docs', 'pmpro-member-directory' ) . '</a>',
			'<a href="' . esc_url( 'https://www.paidmembershipspro.com/support/' ) . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro-member-directory' ) ) . '">' . __( 'Support', 'pmpro-member-directory' ) . '</a>',
		);
		$links     = array_merge( $links, $new_links );
	}

	return $links;
}
add_filter( 'plugin_row_meta', 'pmpromd_plugin_row_meta', 10, 2 );
