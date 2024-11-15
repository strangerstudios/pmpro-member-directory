<?php
/**
 * Set up user fields for the directory and profile pages.
 *
 * @since TBD
 */
function pmpromd_add_user_fields() {
	global $pmpro_pages;

	// Don't break if PMPro is out of date or not loaded.
	if ( ! function_exists( 'pmpro_add_user_field' ) ) {
		return false;
	}

	// Add a user field group to put our fields into.
	$field_group_name = esc_html__( 'Directory and Profile Preferences', 'pmpro-member-directory' );
	pmpro_add_field_group( $field_group_name );

	// Get the title of the directory page to use in the field label.
	$directory_page_title = ! empty( $pmpro_pages['directory'] ) ? esc_html( get_the_title( $pmpro_pages['directory'] ) ) : __( 'directory', 'pmpro-member-directory' );

	// Show the "Hide from directory?" checkbox.
	pmpro_add_user_field(
		$field_group_name,
		new PMPro_Field(
			'pmpromd_hide_directory',
			'checkbox',
			array(
				'label' => sprintf( __('Hide from %s?','pmpro-member-directory'), $directory_page_title ),
				'profile' => 'only',
				'required' => false
			)
		)
	);
}
add_action( 'init', 'pmpromd_add_user_fields' );

/**
 * Filters the name to display for the member in the directory or profile page.
 *
 * @since 1.0
 *
 * @param object $user The WP_User object for the profile.
 * @param string $display_name The name to display for the user.
 */
function pmpro_member_directory_get_member_display_name( $user ) {
	// Make sure we have a user.
	if ( ! $user instanceof WP_User ) {
		return '';
	}

	// Get their display name.
	$display_name = apply_filters( 'pmpro_member_directory_display_name', $user->display_name, $user );
	
	return $display_name;
}

/**
 * Filters the user identifier used in permalinks
 *
 * @since 1.2.0
 *
 * @param string $display_name The name to display for the user.
 */
function pmpromd_user_identifier() {
	/**
	 * Filter to change how user identifiers are presented. Choose between slug and ID
	 * Note: Value is case sensitive
	 * 
	 * @since 1.2.0
	 */
	return apply_filters( 'pmpromd_user_identifier', 'slug' );
}

/**
 * Gets user based on their identifier
 *
 * @since 1.2.0
 *
 * @param object The user object
 */
function pmpromd_get_user_by_identifier( $value ) {
	$user_identifier = pmpromd_user_identifier();
	return get_user_by( $user_identifier, sanitize_text_field( $value ) );
}

/**
 * Gets a user from the pu URL value
 *
 * @since 1.2.0
 *
 */
function pmpromd_get_user( $user_id = false ){
	global $wp_query, $current_user;

	if ( $user_id ) {
		//We're specifying which user we want to display
		$pu = get_user_by( 'id', intval( $user_id ) );
	} elseif ( ! empty( $wp_query->get( 'pu' ) ) ) {
		//Using the new permalinks /profile/user
		$pu = pmpromd_get_user_by_identifier( $wp_query->get( 'pu' ) );
	} elseif ( ! empty( $_REQUEST['pu'] ) ) {
		//Using old url structure /profile/?pu=user
		$pu = pmpromd_get_user_by_identifier( $_REQUEST['pu'] );
	} elseif ( ! empty( $current_user->ID ) ) {
		$pu = $current_user;
	} else {
		$pu = false;
	}

	return $pu;
}

/**
 * We determine that the URL base is for the profile and then set up the rewrite rule
 */
function pmpromd_custom_rewrite_rules() {
	global $pmpro_pages;

	if ( empty( $pmpro_pages ) || empty( $pmpro_pages['profile'] ) ) {
		return;
	}

	$profile_permalink = get_the_permalink( $pmpro_pages['profile'] );
	$base_site_url = get_site_url();
	$profile_base = str_replace( $base_site_url . '/', '', $profile_permalink );

	add_rewrite_rule(
		$profile_base.'([^/]+)/?$',
		'index.php?pagename=' . $profile_base . '&pu=$matches[1]',
		'top'
	);
}
add_action( 'init', 'pmpromd_custom_rewrite_rules', 10 );

/**
 * Adding in the ?pu parameter so that we can retrieve the value from the pretty permalink
 */
function pmpromd_custom_query_vars( $query_vars ) {
    $query_vars[] = 'pu';
    return $query_vars;
}
add_filter( 'query_vars', 'pmpromd_custom_query_vars', 10, 1 );

/**
 * Redirect from the OLD profile URL to the new URL's
 */
function pmpromd_redirect_profile_links() {
	if ( ! empty( $_REQUEST['pu'] ) ) {
		$structure = get_option( 'permalink_structure' );	
		if ( ! empty( $structure ) ) {
			wp_redirect( pmpromd_build_profile_url( $_REQUEST['pu'], false, true ), 302, 'WordPress' );
			exit();
		}		
	}
}
add_action( 'init', 'pmpromd_redirect_profile_links' );

/**
 * Build profile URL
 */
function pmpromd_build_profile_url( $pu, $profile_url = false, $separator = false ) { 
	global $pmpro_pages;

	if ( ! empty( $pmpro_pages['profile'] ) && ! $profile_url ) {
		$profile_url = apply_filters( 'pmpromd_profile_url', get_permalink( $pmpro_pages['profile'] ) );
	}

	$structure = get_option( 'permalink_structure' );	

	if ( is_object( $pu ) ) {
		//We can't use 'slug' directly when getting the user nicename
		$user_identifier = strtolower( pmpromd_user_identifier() );

		if ( $user_identifier == 'id' ) {
			$pu = $pu->ID;
		} else {
			$pu = $pu->user_nicename;
		}
	}

	if ( empty( $pu ) ) {
		return '';
	}

	if ( empty( $structure ) ) {
		//We're using plain permalinks here. Query parameters to the rescue!
		return add_query_arg( array( 'pu' => $pu ), $profile_url );
	}

	if ( strpos( $structure, 'post_id' ) !== FALSE ) {
		//Numeric permalinks don't have a trailing slash for some readon
		$separator = true;
	}

	if ( $separator ) { 
		return $profile_url . '/' . sanitize_title( $pu );
	} else {
		return $profile_url . sanitize_title( $pu );
	}
}
