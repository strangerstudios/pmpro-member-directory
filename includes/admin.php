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
		'content' => '[pmpro_member_directory layout="3col" elements="avatar;display_name;membership_name"]',
		'hint' => esc_html__( 'Include the shortcode [pmpro_member_directory].', 'pmpro-member-directory' ),
	);
	$pages['profile'] = array(
		'title' => esc_html__( 'Profile', 'pmpro-member-directory' ),
		'content' => '[pmpro_member_profile elements="avatar|256;Membership,membership_name;Member Since,membership_startdate" show_search="false"]',
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
 * Add the profile URL slug setting to the PMPro Advanced Settings page.
 *
 * @since 2.4
 *
 * @param array $fields The existing fields on the PMPro Advanced Settings page.
 * @return array The modified fields.
 */
function pmpromd_add_profile_slug_setting( $fields ) {
	$fields['pmpromd_profile_slug_source'] = array(
		'field_name'  => 'pmpromd_profile_slug_source',
		'field_type'  => 'select',
		'label'       => __( 'Profile URL Slug', 'pmpro-member-directory' ),
		'options'     => array(
			'slug'       => __( 'Username', 'pmpro-member-directory' ),
			'id'         => __( 'User ID', 'pmpro-member-directory' ),
			'first_last' => __( 'First and Last Name', 'pmpro-member-directory' ),
		),
		'description' => __( 'Choose what is used in member profile URLs. First and Last Name only applies to members who have a first or last name set, and existing profile URLs will change when this setting is saved.', 'pmpro-member-directory' ),
	);

	return $fields;
}
add_filter( 'pmpro_custom_advanced_settings', 'pmpromd_add_profile_slug_setting', 5 );

/**
 * Get the slug source being applied, reading the submitted value while the Advanced Settings are being saved.
 *
 * @since 2.4
 *
 * @return string One of "slug", "id", or "first_last".
 */
function pmpromd_get_pending_slug_source() {
	$is_settings_save = ! empty( $_REQUEST['page'] ) && 'pmpro-advancedsettings' === $_REQUEST['page']
		&& ! empty( $_REQUEST['savesettings'] )
		&& ! empty( $_REQUEST['pmpro_advancedsettings_nonce'] )
		&& wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['pmpro_advancedsettings_nonce'] ) ), 'savesettings' );

	if ( $is_settings_save && isset( $_REQUEST['pmpromd_profile_slug_source'] ) ) {
		return pmpromd_sanitize_profile_slug_source( sanitize_text_field( wp_unslash( $_REQUEST['pmpromd_profile_slug_source'] ) ) );
	}

	return pmpromd_get_profile_slug_source();
}

/**
 * Whether the current user can manage the profile URL slug setting.
 *
 * PMPro allows access to its settings pages with the pmpro_advancedsettings
 * capability, which a delegated admin role may have without manage_options.
 *
 * @since 2.4
 *
 * @return bool
 */
function pmpromd_can_manage_profile_slugs() {
	return current_user_can( 'manage_options' ) || current_user_can( 'pmpro_advancedsettings' );
}

/**
 * Apply the chosen slug source to existing members.
 *
 * Members are converted in batches so large sites do not time out, and the run
 * continues on later admin page loads until every member has been updated.
 *
 * @since 2.4
 *
 * @return void
 */
function pmpromd_maybe_sync_profile_slugs() {
	global $wpdb;

	if ( ! pmpromd_can_manage_profile_slugs() ) {
		return;
	}

	$target       = pmpromd_get_pending_slug_source();
	$applied      = get_option( 'pmpromd_profile_slug_applied' );
	$state        = get_option( 'pmpromd_profile_slug_sync' );
	$sync_pending = is_array( $state ) && ! empty( $state['target'] );
	$sync_target  = $sync_pending ? $state['target'] : '';

	// A run started for a different setting cannot be resumed, but it still
	// means first and last names may have been written for some members, so the
	// current setting has to be applied from the start.
	if ( $sync_pending && $sync_target !== $target ) {
		delete_option( 'pmpromd_profile_slug_sync' );
		$sync_pending = false;
		$sync_target  = '';
	}

	// Members already match the setting and no run is left to finish.
	if ( $target === $applied && ! $sync_pending ) {
		return;
	}

	// The username and ID options do not change nicenames. When first and last
	// names are not in use (and no run is pending), the setting is just recorded
	// without scanning members.
	if ( 'first_last' !== $target && 'first_last' !== $applied && ! $sync_pending ) {
		update_option( 'pmpromd_profile_slug_applied', $target );
		return;
	}

	// Resume the pending run, or start a new one. An ID cursor is used instead of
	// an offset so members deleted mid-run cannot shift the results and be skipped.
	if ( ! $sync_pending || $sync_target !== $target ) {
		$state = array(
			'target'  => $target,
			'last_id' => 0,
		);
	}

	// Stop a second admin request from processing the same members at the same time.
	$lock = 'pmpromd_profile_slug_sync_lock';
	if ( get_transient( $lock ) ) {
		return;
	}
	set_transient( $lock, 1, MINUTE_IN_SECONDS );

	$last_id   = isset( $state['last_id'] ) ? (int) $state['last_id'] : 0;
	$batch     = 100;
	$processed = 0;
	$deadline  = microtime( true ) + 5;

	while ( $processed < 1000 && microtime( true ) < $deadline ) {
		// Walk the user table by ID so members added or removed mid-run are handled safely.
		$user_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT ID FROM {$wpdb->users} WHERE ID > %d ORDER BY ID ASC LIMIT %d",
				$last_id,
				$batch
			)
		);

		// No members left to update.
		if ( empty( $user_ids ) ) {
			delete_transient( $lock );
			update_option( 'pmpromd_profile_slug_applied', $target );
			delete_option( 'pmpromd_profile_slug_sync' );
			return;
		}

		$changed = false;

		foreach ( $user_ids as $user_id ) {
			if ( 'first_last' === $target ) {
				$changed = pmpromd_set_first_last_nicename( (int) $user_id, false ) || $changed;
			} else {
				$changed = pmpromd_restore_user_nicename( (int) $user_id, false ) || $changed;
			}

			// Move the cursor only after the member has been handled.
			$last_id = (int) $user_id;
		}

		// Invalidate cached directory results once per batch, not once per member.
		if ( $changed ) {
			pmpromd_bump_cache_version();
		}

		$processed += count( $user_ids );

		// The last batch was short, so we are done.
		if ( count( $user_ids ) < $batch ) {
			delete_transient( $lock );
			update_option( 'pmpromd_profile_slug_applied', $target );
			delete_option( 'pmpromd_profile_slug_sync' );
			return;
		}
	}

	delete_transient( $lock );

	// Ran out of time, save the position and pick up where we left off later.
	update_option( 'pmpromd_profile_slug_sync', array( 'target' => $target, 'last_id' => $last_id ) );
}
add_action( 'admin_init', 'pmpromd_maybe_sync_profile_slugs' );

/**
 * Let an admin know that existing member profile URLs are still being updated.
 *
 * @since 2.4
 *
 * @return void
 */
function pmpromd_profile_slug_sync_notice() {
	$state = get_option( 'pmpromd_profile_slug_sync' );

	if ( empty( $state['target'] ) || ! pmpromd_can_manage_profile_slugs() ) {
		return;
	}
	?>
	<div class="notice notice-info">
		<p><?php esc_html_e( 'Member Directory: updating the profile URLs of existing members. This continues automatically as you browse or reload the WordPress admin.', 'pmpro-member-directory' ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'pmpromd_profile_slug_sync_notice' );

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
