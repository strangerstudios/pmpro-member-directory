<?php
/**
 * Set up user fields for the directory and profile pages.
 *
 * @since 2.0
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
				// translators: placeholder is the title of the directory page.
				'label' => sprintf( __('Hide from %s?','pmpro-member-directory'), $directory_page_title ),
				'profile' => 'only',
				'required' => false
			)
		)
	);

	if ( get_option( 'pmpro_pmpromd_maps_api_key' ) ) {
		global $pmpro_default_country;
		// Add map address fields and checkbox.
		pmpro_add_user_field(
			$field_group_name,
			new PMPro_Field(
				'pmpromd_map_optin',
				'checkbox',
				array(
					'label' => esc_html__( 'Show location on map', 'pmpro-member-directory' ),
					'profile' => true,
					'required' => false
				)
			)
		);

		// Street address field. Note: We cannot support a street 2 address field (i.e. Apartment, Suite, etc.) because the Google Maps API does not support it.
		pmpro_add_user_field(
			$field_group_name,
			new PMPro_Field(
				'pmpromd_street_name',
				'text',
				array(
					'label' => esc_html__( 'Street Name', 'pmpro-member-directory' ),
					'profile' => true,
					'required' => false,
					'class' => 'pmpromd-map-address-field'
				)
			)
		);

		// City field.
		pmpro_add_user_field(
			$field_group_name,
			new PMPro_Field(
				'pmpromd_city',
				'text',
				array(
					'label' => esc_html__( 'City', 'pmpro-member-directory' ),
					'profile' => true,
					'required' => false,
					'class' => 'pmpromd-map-address-field'
				)
			)
		);

		// State
		pmpro_add_user_field(
			$field_group_name,
			new PMPro_Field(
				'pmpromd_state',
				'text',
				array(
					'label' => esc_html__( 'State', 'pmpro-member-directory' ),
					'profile' => true,
					'required' => false,
					'class' => 'pmpromd-map-address-field'
				)
			)
		);

		// Zip code
		pmpro_add_user_field(
			$field_group_name,
			new PMPro_Field(
				'pmpromd_zip',
				'text',
				array(
					'label' => esc_html__( 'Zip Code', 'pmpro-member-directory' ),
					'profile' => true,
					'required' => false,
					'class' => 'pmpromd-map-address-field'
				)
			)
		);

		// Get the list of countries from PMPro core.
		if ( function_exists( 'pmpro_get_countries' ) ) {
			$countries = pmpro_get_countries();
			$default_country = pmpro_get_default_country();
		} else {
			global $pmpro_countries, $pmpro_default_country;
			$countries = $pmpro_countries;
			$default_country = $pmpro_default_country;
		}

		// Generate this with the PMPro Country field.
		pmpro_add_user_field(
			$field_group_name,
			new PMPro_Field(
				'pmpromd_country',
				'select',
				array(
					'label' => esc_html__( 'Country', 'pmpro-member-directory' ),
					'profile' => true,
					'required' => false,
					'options' => $countries,
					'class' => 'pmpromd-map-address-field',
					'value' => $default_country
				)
			)
		);
	}
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
 * Sanitize a profile slug source value.
 *
 * @since 2.4
 *
 * @param string $source The slug source to check.
 * @return string One of "slug", "id", or "first_last", falling back to "slug".
 */
function pmpromd_sanitize_profile_slug_source( $source ) {
	if ( ! in_array( $source, array( 'slug', 'id', 'first_last' ), true ) ) {
		return 'slug';
	}

	return $source;
}

/**
 * Get the source used to identify members in profile URLs.
 *
 * @since 2.4
 *
 * @return string One of "slug", "id", or "first_last".
 */
function pmpromd_get_profile_slug_source() {
	return pmpromd_sanitize_profile_slug_source( get_option( 'pmpro_pmpromd_profile_slug_source', 'slug' ) );
}

/**
 * Filters the user identifier used in permalinks
 *
 * @since 1.2.0
 *
 * @return string The identifier to look users up by, either "slug" or "id".
 */
function pmpromd_user_identifier() {
	$default = ( 'id' === pmpromd_get_profile_slug_source() ) ? 'id' : 'slug';

	/**
	 * Filter to change how user identifiers are presented. Choose between slug and ID
	 * Note: Value is case sensitive
	 * 
	 * @since 1.2.0
	 */
	return apply_filters( 'pmpromd_user_identifier', $default );
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
 * Trim a nicename so it fits in the user_nicename column.
 *
 * A percent escape that gets cut in half would leave an invalid character in
 * the URL, so an incomplete escape is dropped.
 *
 * @since 2.4
 *
 * @param string $nicename   The nicename to trim.
 * @param int    $max_length The number of characters to keep.
 * @return string The trimmed nicename.
 */
function pmpromd_truncate_nicename( $nicename, $max_length ) {
	$length = function_exists( 'mb_strlen' ) ? mb_strlen( $nicename ) : strlen( $nicename );

	if ( $length > $max_length ) {
		$nicename = function_exists( 'mb_substr' )
			? mb_substr( $nicename, 0, $max_length )
			: substr( $nicename, 0, $max_length );
	}

	// Remove a percent escape that was cut off part way through.
	$nicename = preg_replace( '/%[0-9a-fA-F]?$/', '', $nicename );

	return rtrim( $nicename, '-' );
}

/**
 * Build a nicename from a member's first and last name.
 *
 * @since 2.4
 *
 * @param WP_User $user The user to build a nicename for.
 * @return string The nicename, or an empty string when no usable name is found.
 */
function pmpromd_get_first_last_nicename( $user ) {
	if ( ! $user instanceof WP_User ) {
		return '';
	}

	$first_name = trim( (string) $user->first_name );
	$last_name  = trim( (string) $user->last_name );

	// Members without a name keep the nicename they already have.
	if ( '' === $first_name && '' === $last_name ) {
		return '';
	}

	$nicename = sanitize_title( trim( $first_name . '-' . $last_name, '-' ) );

	if ( '' === $nicename ) {
		return '';
	}

	// The user_nicename column is varchar(50), so leave room for a collision suffix.
	return pmpromd_truncate_nicename( $nicename, 45 );
}

/**
 * Make a nicename unique so two members with the same name get their own profile URL.
 *
 * @since 2.4
 *
 * @param string $nicename The nicename to check.
 * @param int    $user_id  The user the nicename belongs to, so their own nicename is not treated as a conflict.
 * @return string A unique nicename.
 */
function pmpromd_get_unique_nicename( $nicename, $user_id = 0 ) {
	$unique_nicename = $nicename;
	$suffix          = 2;

	while ( $suffix < 1000 ) {
		$existing_user = get_user_by( 'slug', $unique_nicename );

		// Nothing is using it, or the member already has it.
		if ( ! $existing_user || (int) $existing_user->ID === (int) $user_id ) {
			return $unique_nicename;
		}

		$unique_nicename = $nicename . '-' . $suffix;
		$suffix++;
	}

	// Fall back to the user ID when a name is already used an unusual number of times.
	if ( ! $user_id ) {
		return $unique_nicename;
	}

	$suffix = '-' . $user_id;

	return pmpromd_truncate_nicename( $nicename, 50 - strlen( $suffix ) ) . $suffix;
}

/**
 * Save a new nicename for a member and refresh anything that may have cached the old one.
 *
 * @since 2.4
 *
 * @param int    $user_id    The user ID.
 * @param string $nicename   The nicename to save.
 * @param bool   $bump_cache Whether to invalidate the directory cache. Pass false when converting many members at once.
 * @return bool True when the nicename was saved.
 */
function pmpromd_update_user_nicename( $user_id, $nicename, $bump_cache = true ) {
	global $wpdb;

	// Write directly so the profile_update hooks do not run again.
	$updated = $wpdb->update(
		$wpdb->users,
		array( 'user_nicename' => $nicename ),
		array( 'ID' => $user_id ),
		array( '%s' ),
		array( '%d' )
	);

	if ( false === $updated ) {
		return false;
	}

	clean_user_cache( $user_id );

	if ( $bump_cache ) {
		// Cached directory results may already hold the old profile URL.
		pmpromd_bump_cache_version();
	}

	return true;
}

/**
 * Set a member's nicename to match their first and last name.
 *
 * @since 2.4
 *
 * @param int  $user_id    The user ID.
 * @param bool $bump_cache Whether to invalidate the directory cache. Pass false when converting many members at once.
 * @return bool True when the nicename was changed.
 */
function pmpromd_set_first_last_nicename( $user_id, $bump_cache = true ) {
	$user = get_userdata( $user_id );

	if ( ! $user ) {
		return false;
	}

	$nicename = pmpromd_get_first_last_nicename( $user );

	if ( '' === $nicename ) {
		return false;
	}

	$nicename = pmpromd_get_unique_nicename( $nicename, $user_id );

	if ( $nicename === $user->user_nicename ) {
		return false;
	}

	// Keep the original nicename so it can be restored if the setting changes again.
	if ( ! metadata_exists( 'user', $user_id, 'pmpromd_original_nicename' ) ) {
		update_user_meta( $user_id, 'pmpromd_original_nicename', $user->user_nicename );
	}

	return pmpromd_update_user_nicename( $user_id, $nicename, $bump_cache );
}

/**
 * Restore the nicename a member had before their first and last name was used.
 *
 * @since 2.4
 *
 * @param int  $user_id    The user ID.
 * @param bool $bump_cache Whether to invalidate the directory cache. Pass false when converting many members at once.
 * @return bool True when the nicename was restored.
 */
function pmpromd_restore_user_nicename( $user_id, $bump_cache = true ) {
	$original_nicename = get_user_meta( $user_id, 'pmpromd_original_nicename', true );

	if ( empty( $original_nicename ) ) {
		return false;
	}

	$user = get_userdata( $user_id );

	if ( ! $user ) {
		return false;
	}

	$nicename = pmpromd_get_unique_nicename( $original_nicename, $user_id );

	// Nothing to change, so the stored value is no longer needed.
	if ( $nicename === $user->user_nicename ) {
		delete_user_meta( $user_id, 'pmpromd_original_nicename' );
		return false;
	}

	// Keep the stored original if the update fails so the restore can be retried.
	if ( ! pmpromd_update_user_nicename( $user_id, $nicename, $bump_cache ) ) {
		return false;
	}

	delete_user_meta( $user_id, 'pmpromd_original_nicename' );

	return true;
}

/**
 * Keep a member's nicename in step with their name when first and last names are used as the slug.
 *
 * @since 2.4
 *
 * @param int $user_id The user ID.
 * @return void
 */
function pmpromd_maybe_update_nicename( $user_id ) {
	if ( 'first_last' !== pmpromd_get_profile_slug_source() ) {
		return;
	}

	pmpromd_set_first_last_nicename( $user_id );
}
add_action( 'user_register', 'pmpromd_maybe_update_nicename', 20 );
add_action( 'profile_update', 'pmpromd_maybe_update_nicename', 20 );

/**
 * Update the nicename when a name is saved without a profile update.
 *
 * PMPro saves its profile fields straight to usermeta, which does not fire
 * profile_update, so the nicename has to follow the meta changes instead.
 *
 * @since 2.4
 *
 * @param int    $meta_id    Meta row ID.
 * @param int    $object_id  User ID.
 * @param string $meta_key   Meta key being changed.
 * @param mixed  $meta_value New value.
 * @return void
 */
function pmpromd_maybe_update_nicename_on_meta( $meta_id, $object_id, $meta_key, $meta_value ) {
	if ( ! in_array( $meta_key, array( 'first_name', 'last_name' ), true ) ) {
		return;
	}

	pmpromd_maybe_update_nicename( $object_id );
}
add_action( 'added_user_meta', 'pmpromd_maybe_update_nicename_on_meta', 20, 4 );
add_action( 'updated_user_meta', 'pmpromd_maybe_update_nicename_on_meta', 20, 4 );

/**
 * Gets a user from the pu URL value
 *
 * @since 1.2.0
 *
 */
function pmpromd_get_user( $user_id = false ) {
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

	// Get the profile permalink.
	$profile_permalink = get_permalink( $pmpro_pages['profile'] );

	// Parse the path from the permalink, taking subfolder installations into account.
	$profile_page = get_post( $pmpro_pages['profile'] );
	if ( ! is_object( $profile_page ) || empty( $profile_page->post_name ) ) {
		return;
	}
	$profile_base = $profile_page->post_name;

	// Add support for profile parent if it's configured.
	if ( ! empty( $profile_page->post_parent ) ) {
		$profile_parent = get_post( $profile_page->post_parent );
		if ( is_object( $profile_parent ) && ! empty( $profile_parent->post_name ) ) {
			$profile_base = $profile_parent->post_name . '/' . $profile_base;
		}
	}

	// Add the rewrite rule.
	add_rewrite_rule(
		'^' . preg_quote( $profile_base, '#' ) . '/([^/]+)/?$',
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

    global $pmpro_pages;

    //We don't have a profile page set
    if ( empty( $pmpro_pages['profile'] ) ) {
        return;
    }

    //We're not redirecting away from the profile page
    if ( ! is_page( $pmpro_pages['profile'] ) ) {
        return;
    }

    //The pu param isn't present
    if ( empty( $_REQUEST['pu'] ) ) {
        return;
    }
	
    $structure = get_option( 'permalink_structure' );	

    //We don't have custom permalinks set up
    if ( empty( $structure ) ) {
        return;
    }
	
    wp_redirect( pmpromd_build_profile_url( $_REQUEST['pu'], false, true ), 302, 'WordPress' );
    exit();
    
}
add_action( 'wp', 'pmpromd_redirect_profile_links' );

/**
 * Build a user-profile URL that respects the site's permalink structure.
 *
 * @param int|string|WP_User $pu           User object, user ID or nicename.
 * @param string|null        $profile_url  Base profile page URL (optional).
 * @param string|false       $separator    Unused param kept for backward compat.
 *
 * @return string The final profile URL or an empty string if user not found.
 */
function pmpromd_build_profile_url( $pu, $profile_url = null, $separator = false ) {
	global $pmpro_pages;

	// If there's no profile URL and the profile page is set, use it.
	if ( empty( $profile_url ) && ! empty( $pmpro_pages['profile'] ) ) {
		$profile_url = apply_filters(
			'pmpromd_profile_url',
			get_permalink( $pmpro_pages['profile'] )
		);
	}

	// Bail early if the profile page is missing.
	if ( empty( $profile_url ) ) {
		return '';
	}

	// Figure out the user identifier.
	if ( is_object( $pu ) ) {
		$user_identifier = strtolower( pmpromd_user_identifier() ); // id | slug
		$pu              = ( 'id' === $user_identifier ) ? $pu->ID : $pu->user_nicename;
	}

	// No user, no URL.
	if ( empty( $pu ) ) {
		return '';
	}

	// If there's no structure found let's do a query arg ?pu=nice_name
	if ( ! get_option( 'permalink_structure' ) ) {
		// Plain permalinks – use the query-string format.
		return add_query_arg( 'pu', $pu, $profile_url );
	}

	// Friendly permalinks – append the slug / ID as an extra path part.
	$pu          = sanitize_title( $pu );
	$profile_url = trailingslashit( $profile_url );

	/**
	 * Respect "trailing slash" option for the final URL.
	 * user_trailingslashit() adds or removes the slash in accordance
	 * with Settings → Permalinks trailing slash preference.
	 */
	return user_trailingslashit( $profile_url . $pu );
}
/**
 * Update the_title for the Profile page.
 */
function pmpromd_the_title_profile_page( $title, $post_id = NULL ) {
	// If we're in the admin, don't do anything.
	if ( is_admin() ) {
		return $title;
	}

	global $main_post_id;
	if ( $post_id == $main_post_id ) {
		$pu = pmpromd_get_user();

		$display_name = pmpro_member_directory_get_member_display_name( $pu );

		if( ! empty( $display_name ) ){
			$title = $display_name;
		}
	}
	return $title;
}
add_filter( 'the_title', 'pmpromd_the_title_profile_page', 10, 2 );

/**
 * Update the document title parts for the Profile page.
 */
function pmpromd_document_title_parts( $title_parts ) {
	global $main_post_id, $post;

	if ( isset( $post->ID ) && $post->ID == $main_post_id ) {

		$pu = pmpromd_get_user();

		$display_name = pmpro_member_directory_get_member_display_name( $pu );

		if ( ! empty( $display_name ) ) {
			$title_parts['title'] = $display_name; // Set the main title part.
		}
	}

	return $title_parts;
}
add_filter( 'document_title_parts', 'pmpromd_document_title_parts' );

/**
 * We're working with the menu now so remove the filters.
 *
 * @since 2.0
 *
 * @param string|null $output Nav menu output to short-circuit with. Default null.
 *
 * @return string|null Nav menu output to short-circuit with. Default null.
 */
function pmpromd_remove_title_filters_in_menus( $nav_menu ) {
	// Before we work with the menu, remove the title filter.
	remove_filter( 'the_title', 'pmpromd_the_title_profile_page', 10, 2 );

	// Remove the `pmpromd_wp_title` filter.
	// This is no longer used in the Add On but may be present in legacy custom templates.
	remove_filter( 'wp_title', 'pmpromd_wp_title', 10, 2 );
    return $nav_menu;
}
add_filter( 'pre_wp_nav_menu', 'pmpromd_remove_title_filters_in_menus' );

/**
 * We're done working with the menu so add those filters back.
 *
 * @since 2.0
 *
 * @param string $items The HTML list content for the menu items.
 *
 * @return string The HTML list content for the menu items.
 */
function pmpromd_readd_title_filters_in_menus( $items ) {
    // We are done working with menu, so add the title filter back.
    add_filter( 'the_title', 'pmpromd_the_title_profile_page', 10, 2 );

	// Add the `pmpromd_wp_title` filter back.
	// This is no longer used in the Add On but may be present in legacy custom templates.
	add_filter( 'wp_title', 'pmpromd_wp_title', 10, 2 );
    return $items;
}
add_filter( 'wp_nav_menu_items', 'pmpromd_readd_title_filters_in_menus' );

/**
 * Preheader operations for the profile page.
 *
 * @since 2.0
 * @return void
 */
function pmpromd_profile_page_preheader() {
	global $post, $pmpro_pages;

	// Bail if we're not on the profile page.
	if ( empty( $pmpro_pages['profile'] ) || ! is_page( $pmpro_pages['profile'] ) ) {
		return;
	}

	/**
	 * Preheader operations here.
	 */
	global $main_post_id;
	$main_post_id = $post->ID;

	// Get the profile user.
	$pu = pmpromd_get_user();

	// If we are going to redirect, set the page to redirect to.
	if ( ! empty( $pmpro_pages['directory'] ) ) {
		$redirect = get_permalink( $pmpro_pages['directory'] );
	} else {
		$redirect = home_url();
	}

	// If the profile user should not be visible, go to directory or home.
	if ( ! pmpromd_profile_user_is_visible( $pu ) ) {
		wp_redirect( $redirect );
		exit;
	}

	/**
	 * If a level is required for the profile page, make sure the profile user has it.
	 */

	// Check to see if the page's content is restricted by shortcode, if so we don't have to redirect away.
	if ( has_shortcode( $post->post_content, 'membership' ) || has_block( 'pmpro/membership', $post->post_content ) ) {
		return;
	}

	// Check if levels are required within the profile's shortcode.
	// If they don't have that level, redirect away.
	$levels = pmpro_getMatches( "/ levels?=[\"']([^\"^']*)[\"']/", $post->post_content, true );
	if ( ! empty( $levels ) && ! pmpro_hasMembershipLevel( explode( ",", $levels ), $pu->ID ) ) {
		wp_redirect( $redirect );
		exit;
	}
}
add_action( 'wp', 'pmpromd_profile_page_preheader', 1 );

/**
 * Check whether a member's profile should be visible.
 *
 * Used by both the profile page preheader and the profile shortcode/block,
 * since the shortcode can be placed on pages other than the assigned profile page.
 *
 * @since 2.3.1
 *
 * @param WP_User $pu The profile user.
 * @return bool Whether the profile should be shown.
 */
function pmpromd_profile_user_is_visible( $pu ) {
	// Must be a real user with an active membership level.
	if ( empty( $pu ) || ! ( $pu instanceof WP_User ) || empty( $pu->ID ) || ! function_exists( 'pmpro_hasMembershipLevel' ) || ! pmpro_hasMembershipLevel( null, $pu->ID ) ) {
		return false;
	}

	// Members can always view their own profile, even if hidden from the directory or pending approval.
	if ( get_current_user_id() === (int) $pu->ID ) {
		return true;
	}

	// Is this user hidden from the directory?
	if ( get_user_meta( $pu->ID, 'pmpromd_hide_directory', true ) == '1' ) {
		return false;
	}

	// Integrate with Approvals Add On.
	if ( class_exists( 'PMPro_Approvals' ) ) {
		$user_levels = pmpro_getMembershipLevelsForUser( $pu->ID );
		$approval_levels = PMPro_Approvals::getApprovalLevels();
		$okay = false;
		foreach ( $user_levels as $level ) {
			if ( ! in_array( $level->id, $approval_levels ) || PMPro_Approvals::isApproved( $pu->ID, $level->id ) ) {
				$okay = true;
				break;
			}
		}

		if ( ! $okay ) {
			return false;
		}
	}

	return true;
}

/**
 * Prepare the elements attribute of the shortcodes.
 */
function pmpromd_prepare_elements_array( $elements ) {
	// Initialize the elements array.
	$elements_array = array();

	if ( ! empty( $elements ) ) {
		// Remove a trailing comma or semicolon if it exists.
		$elements = rtrim( $elements, ',;' );

		// Convert line breaks to semicolons (for the block editor).
		if ( strpos( $elements, "\n" ) !== FALSE ) {
			$elements = str_replace( "\n", ';', $elements );
		}

		// Build the elements array.
		$elements = explode( ';', $elements );
		foreach ( $elements as $element ) {
			// Remove spaces from the beginning and end of the element.
			$element = trim( $element );

			// Check if the element is empty.
			if ( empty( $element ) ) {
				continue;
			}

			if ( str_contains( $element, ',' ) ) {
				// If there is a comma, then we know it has label/field pair.
				$elements_array[] = array_map( 'trim', explode( ',', $element ) );
			} else {
				// Otherwise we have just the field with no label.
				$elements_array[] = array( '', trim( $element ) );
			}
		}
	}

	return $elements_array;
}

/**
 * Get the value of a specific element from a string of HTML.
 */
function pmpromd_get_display_value( $element, $pu, $displayed_levels = null ) {

	// No user object, return an empty result instead.
	if ( ! ( $pu instanceof WP_User ) ) {
		return '';
	}

	// Initialize the value.
	$value = '';

	// Is this a user field?
	if ( class_exists( 'PMPro_Field_Group' ) ) {
		$user_field = PMPro_Field_Group::get_field( $element );
	} else {
		$user_field = pmpro_get_user_field( $element );
	}

	// Yes, this is a user field. Check that the user has the required level for this field.
	if ( ! empty( $user_field ) ) {

		if ( ! empty( $user_field->levels ) && ! pmpro_hasMembershipLevel( $user_field->levels, $pu->ID ) ) {
			// The user does not have the required level for this field.
			$value = '';
		} else {
			$value = $user_field->displayValue( $pu->{$element}, false );
		}
	} else {
		// Let's try to get the value from other places and format it for return.

		// Get a list of fields related to the user's level.
		$pmpro_level_fields = array(
			'membership_name',
			'membership_startdate',
			'membership_enddate',
		);

		// Get a list of fields that should be formatted as dates.
		$date_fields = array(
			'membership_startdate',
			'membership_enddate',
			'user_registered',
		);

		// Check if the $element is a PMPro level field.
		if ( in_array( $element, $pmpro_level_fields ) ) {
			// Get all levels for the user.
			$all_levels_to_display = pmpro_getMembershipLevelsForUser( $pu->ID );

			// Filter levels if $displayed_levels is set and not 'all'.
			if ( ! empty( $displayed_levels ) && $displayed_levels !== 'all' ) {
				$displayed_levels = explode( ',', $displayed_levels );
				$all_levels_to_display = array_filter( $all_levels_to_display, fn( $level ) => in_array( $level->id, $displayed_levels ) );
			}
			
			// Get the names of the levels to display.
			$pu->membership_levels = implode( ', ', array_column( $all_levels_to_display, 'name' ) );

			// Calculate the oldest start date and the soonest end date, if levels are available.
			$start_dates = array_column( $all_levels_to_display, 'startdate' );
			$end_dates = array_column( $all_levels_to_display, 'enddate' );

			// Only use real start and end dates (ignore null/empty values).
			$start_dates = array_filter( $start_dates, function( $startdate ) {
				return ! empty( $startdate );
			} );
			$end_dates = array_filter( $end_dates, function( $enddate ) {
				return ! empty( $enddate );
			} );

			$startdate = ! empty( $start_dates ) ? min( $start_dates ) : null;
			$enddate = ! empty( $end_dates ) ? min( $end_dates ) : null;
		}

		// Get the avatar_size for the avatar element.
		if ( str_contains( $element, 'avatar' ) ) {
			$element_parts = explode( '|', $element );
			$element = $element_parts[0];
			$avatar_size = ! empty( $element_parts[1] ) ? $element_parts[1] : 128;
		}

		// Additional formatting and special cases.
		switch ( $element ) {
			case 'display_name':
				$value = pmpro_member_directory_get_member_display_name( $pu );
				break;
			case 'avatar':
				$value = get_avatar( $pu->ID, $avatar_size, NULL, esc_attr( $pu->display_name ) );
				break;
			case 'membership_name':
				$value = $pu->membership_levels;
				break;
			case 'membership_startdate':
				$value = $startdate;
				break;
			case 'membership_enddate':
				$value = $enddate;
				break;
			case 'pmpro_billing_address':
				_doing_it_wrong( __FUNCTION__, esc_html__( 'The show_billing attribute is deprecated. We recommend collecting member addresses using the Mailing Address Add On or through User Fields.', 'pmpro-member-directory' ), '2.0' );
				$value = pmpro_formatAddress(
					trim( $pu->pmpro_bfirstname . ' ' . $pu->pmpro_blastname ),
					$pu->pmpro_baddress1,
					$pu->pmpro_baddress2,
					$pu->pmpro_bcity,
					$pu->pmpro_bstate,
					$pu->pmpro_bzipcode,
					$pu->pmpro_bcountry,
					$pu->pmpro_bphone
				);
				break;
			case 'pmpro_bphone':
				_doing_it_wrong( __FUNCTION__, esc_html__( 'The show_phone attribute is deprecated. We recommend collecting member phone numbers through a User Field.', 'pmpro-member-directory' ), '2.0' );
				break;
			case 'pmpro_shipping_address':
			case 'pmpro_mailing_address':
				$value = pmpro_formatAddress(
					trim( $pu->pmpro_sfirstname . ' ' . $pu->pmpro_slastname ),
					$pu->pmpro_saddress1,
					$pu->pmpro_saddress2,
					$pu->pmpro_scity,
					$pu->pmpro_sstate,
					$pu->pmpro_szipcode,
					$pu->pmpro_scountry,
					$pu->pmpro_sphone
				);
				break;
		}

		// If we still do not have a value, try user or usermeta. Format using User Fields display method.
		if ( empty( $value ) ) {
			if ( isset( $pu->data ) && in_array( $element, array_keys( get_object_vars( $pu->data ) ) ) ) {
				// This is a user table field. Only allow certain fields.
				$user_column_fields = array(
					'user_login',
					'user_email',
					'user_url',
					'user_registered',
					'display_name',
					'ID',
				);

				if ( in_array( $element, $user_column_fields ) ) {
					$value = $pu->data->$element;
				}
			} else {
				// This is a usermeta field.
				$value = $pu->$element;
			}

			if ( ! empty( $value ) ) {
				// Try to guess the field type, default to text.
				$field_type = 'text';

				// Special handling for arrays.
				if ( is_array( $value ) ) {
					if ( isset( $value['filename'] ) ) {
						$field_type = 'file';
					} else {
						$field_type = 'multiselect';
					}
				}

				// Create a new PMPro_Field object.
				$user_field = new PMPro_Field( $element, $field_type );
				$value = $user_field->displayValue( $value, false );
			}
		}

		// Format the date fields.
		if ( in_array( $element, $date_fields ) && ! empty( $value ) ) {
			if ( ! is_numeric( $value ) ) {
				$value = strtotime( $value );
			}
			$value = date_i18n( get_option('date_format'), $value );
		}

	}

	/**
	 * Filter the value of a specific element from a string of HTML.
	 *
	 * @since 2.0
	 * @param string $value The value of the element.
	 * @param string $element The element to get the value for.
	 * @param object $pu The user object.
	 * @param string $displayed_levels The levels to display.
	 *
	 * @return string The value of the element.
	 */
	$value = apply_filters( 'pmpromd_get_display_value', $value, $element, $pu, $displayed_levels );

	return $value;
}


/**
 * Function for allowed HTML tags in various templates
 *
 * @since 2.0.1
 * @return array $allowed_html The allowed HTML to be used for wp_kses escaping.
 */
function pmpromd_allowed_html() {
	$allowed_html = wp_kses_allowed_html('post');

	// Add support for iframes (YouTube, Vimeo, SoundCloud, etc.)
	$allowed_html['iframe'] = [
		'src'             => [],
		'width'           => [],
		'height'          => [],
		'frameborder'     => [],
		'allow'           => [],
		'allowfullscreen' => [],
		'loading'         => [],
		'referrerpolicy'  => [],
	];

	// Add support for embeds (older methods, fallback)
	$allowed_html['embed'] = [
		'src'             => [],
		'type'            => [],
		'width'           => [],
		'height'          => [],
		'allowfullscreen' => [],
	];

	// Add support for objects (legacy flash embeds, rare)
	$allowed_html['object'] = [
		'type'   => [],
		'width'  => [],
		'height' => [],
		'data'   => [],
	];

	// Add support for param inside object (legacy)
	$allowed_html['param'] = [
		'name'  => [],
		'value' => [],
	];

	// Add support for blockquotes (Twitter/X, Facebook)
	$allowed_html['blockquote'] = [
		'class'  => [],
		'cite'   => [],
		'lang'   => [],
	];

	// Add support for script (for Twitter/X and other embeds that rely on JS)
	$allowed_html['script'] = [
		'src'    => [],
		'async'  => [],
		'defer'  => [],
		'type'   => [],
	];

	// Add support for divs (for Facebook embeds)
	$allowed_html['div'] = [
		'class'          => [],
		'data-href'      => [],
		'data-width'     => [],
		'data-show-text' => [],
	];

	// Add support for Twitter embeds
	$allowed_html['a'] = [
		'href'            => [],
		'class'           => [],
		'target'          => [],
		'rel'             => [],
		'data-dnt'        => [],
		'data-show-count' => [],
	];

	// Add support for Audio Embed and Video Embed  HTML elements
	$allowed_html['source'] = [
		'src'  => [],
		'type' => [],
	];	

	/**
	 * Filters the allowed HTML tags for the Member Directory Add On
	 *
	 * @since 2.0.1
	 * @param array $allowed_html The allowed html elements for the Member Directory escaping where wp_kses is used
	 */
	return apply_filters( 'pmpromd_allowed_html', $allowed_html );
}
