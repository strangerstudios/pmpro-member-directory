<?php
/**
 * Show the content for the [pmpro_member_profile] shortcode.
 */
function pmpromd_profile_shortcode( $atts, $content=null, $code="" ) {
	global $current_user, $pmpro_pages;

	extract(shortcode_atts(array(
		'avatar_size' => '128',
		'elements' => NULL,
		'fields' => NULL,
		'level' => NULL,
		'levels' => NULL,
		'show_avatar' => true,
		'show_bio' => true,
		'show_billing' => false,
		'show_email' => true,
		'show_level' => true,
		'show_name' => true,
		'show_phone' => false,
		'show_search' => true,
		'show_startdate' => true,
		'user_id' => NULL,
		'show_map' => true,
		'map_zoom' => sanitize_text_field( apply_filters( 'pmpromm_default_zoom_level', '8' ) ),
		'map_height' => '400',
		'map_width' => '100',
		'map_max_zoom' => NULL,
		'map_infowindow_width' 	=> '300',
	), $atts));


	// Make sure that Paid Memberships Pro is enabled.
	if ( ! function_exists( 'pmpro_get_element_class' ) ) {
		if ( current_user_can( 'activate_plugins' ) ) {
			return esc_html__( 'Admin Only Alert: You must activate Paid Memberships Pro to use the Member Directory Add On.', 'pmpro-member-directory' );
		} else {
			return '';
		}
	}

	// Get the directory and profile page URLs.
	$directory_url = ! empty( $pmpro_pages['directory'] ) ? get_permalink( $pmpro_pages['directory'] ) : '';
	$profile_url = ! empty( $pmpro_pages['profile'] ) ? get_permalink( $pmpro_pages['profile'] ) : '';

	// Get the user for this profile.
	$pu = pmpromd_get_user( $user_id );

	// Did they use level instead of levels?
	if ( empty( $levels ) && ! empty( $level ) ) {
		$levels = $level;
	}

	// Convert the levels attribute to an array.
	if ( is_array( $levels ) ) {
		$levels = implode( ',', $levels );
	}

	// Validate boolean variables.
	$show_avatar = filter_var( $show_avatar, FILTER_VALIDATE_BOOLEAN );
	$show_billing = filter_var( $show_billing, FILTER_VALIDATE_BOOLEAN );
	$show_bio = filter_var( $show_bio, FILTER_VALIDATE_BOOLEAN );
	$show_email = filter_var( $show_email, FILTER_VALIDATE_BOOLEAN );
	$show_level = filter_var( $show_level, FILTER_VALIDATE_BOOLEAN );
	$show_name = filter_var( $show_name, FILTER_VALIDATE_BOOLEAN );
	$show_phone = filter_var( $show_phone, FILTER_VALIDATE_BOOLEAN );
	$show_search = filter_var( $show_search, FILTER_VALIDATE_BOOLEAN );
	$show_startdate = filter_var( $show_startdate, FILTER_VALIDATE_BOOLEAN );

	// Validate the avatar size.
	$avatar_size = intval( $avatar_size );

	// Build our elements array. If we have an elements attribute on the shortcode, use that and ignore any other legacy attributes.
	if ( ! empty( $elements ) ) {
		$elements_array = pmpromd_prepare_elements_array( $elements );
	} else {
		// We need to support the legacy attributes for backwards compatibility.
		$elements = '';
		if ( ! empty( $show_avatar ) ) {
			$elements .= 'avatar|' . $avatar_size . ';';
		}
		if ( ! empty( $show_name ) ) {
			$elements .= 'display_name;';
		}
		if ( ! empty( $show_bio ) ) {
			$elements .= __( 'Biographical Info', 'pmpro-member-directory' ) . ',description;';
		}
		if ( ! empty( $show_email ) ) {
			$elements .= __( 'Email Address', 'pmpro-member-directory' ) . ', user_email;';
		}
		// These are the fields that are not part of the user object and need special handling.
		if ( ! empty( $show_level ) ) {
			$elements .= __( 'Level', 'pmpro-member-directory' ) . ',membership_name;';
		}
		if ( ! empty( $show_startdate ) ) {
			$elements .= __( 'Start Date', 'pmpro-member-directory' ) . ',membership_startdate;';
		}
		if ( ! empty( $show_billing ) ) {
			$elements .= __( 'Address', 'pmpro-member-directory' ) . ',pmpro_billing_address;';
		}
		if ( ! empty( $show_phone ) ) {
			$elements .= __( 'Phone Number', 'pmpro-member-directory' ) . ',pmpro_bphone;';
		}
		if ( ! empty( $fields ) ) {
			$elements .= $fields;
		}
		$elements_array = pmpromd_prepare_elements_array( $elements );
	}

	/**
	 * Filter the elements array for the member profile.
	 *
	 * @since 2.0
	 * @param array $elements_array The array of elements to display on the member profile.
	 * @param object $pu The user object.
	 * @return array $elements_array The array of elements to display on the member profile.
	 */
	$elements_array = apply_filters( 'pmpro_member_profile_elements', $elements_array, $pu );

	// Set the displayed_levels variable to use for displaying values.
	$displayed_levels = empty( $levels ) ? 'all' : $levels;

	if(isset($_REQUEST['limit']))
		$limit = intval($_REQUEST['limit']);
	elseif(empty($limit))
		$limit = 15;


	/**
	 * Filter to override the attributes passed into the shortcode.
	 * 
	 * @since TBD
	 * 
	 * @param array Contains all of the shortcode attributes used in the profile shortcode
	 */
	$shortcode_atts = apply_filters( 'pmpro_member_profile_before_atts', array(
		'avatar_size' => $avatar_size,
		'elements' => $elements,
		'fields' => $fields,
		'level' => $level,
		'levels' => $levels,
		'show_avatar' => $show_avatar,
		'show_bio' => $show_bio,
		'show_billing' => $show_billing,
		'show_email' => $show_email,
		'show_level' => $show_level,
		'show_name' => $show_name,
		'show_phone' => $show_phone,
		'show_search' => $show_search,
		'show_startdate' => $show_startdate,
		'user_id' => $user_id,
		'show_map' => $show_map,
		'map_zoom' => $map_zoom,
		'map_height' => $map_height,
		'map_width' => $map_width,
		'map_max_zoom' => $map_max_zoom,
		'map_infowindow_width' 	=> $map_infowindow_width,
	) );

	ob_start();
	?>
	<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro' ) ); ?>">
		<?php
			if ( ! empty( $show_search ) ) {
				pmpromd_search_form();
			}
		?>

		<div id="pmpro_member_profile-<?php echo esc_attr( $pu->ID ); ?>" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card pmpro_member_profile', 'pmpro_member_profile') ); ?>">

			<?php
				/**
				 * Fires before the member profile fields are displayed.
				 *
				 * @since 0.8
				 * @param object $pu The user object.
				 *
				 */
				do_action( 'pmpro_member_profile_before', $pu );

				// Try to show the Google Map. The function will check if the API key is set to show the map or not.
				echo wp_kses_post( pmpromd_show_google_map( $shortcode_atts, $pu ) );
			?>

		

			<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_content' ) ); ?>">
				<?php
					foreach ( $elements_array as $element ) {
						$value = pmpromd_get_display_value( $element[1], $pu, $displayed_levels );
						if ( ! empty( $value ) || $value === '0' ) {
							// If this is the display_name, we need to wrap it in an h2 tag.
							if ( 'display_name' === $element[1] ) {
								$value = '<h2 class="' . pmpro_get_element_class( 'pmpro_font-x-large' ) . '">' . $value . '</h2>';
							}
							?>
							<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_profile_field pmpro_member_profile_field-' . strtok( $element[1], '|' ) ) ); ?>">
								<?php if ( ! empty( $element[0] ) ) { ?>
									<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_profile_field_label' ) ); ?>">
										<?php echo esc_html( $element[0] ); ?>
									</div>
								<?php } ?>
								<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_profile_field_data' ) ); ?>">
									<?php echo wp_kses( $value, pmpromd_allowed_html() ); ?>
								</div>
							</div> <!-- end pmpro_member_profile_field -->
							<?php
						}
					}
				?>

				<?php
					/**
					 * Fires before the member profile fields are displayed.
					 *
					 * @since 0.8
					 * @param object $pu The user object.
					 *
					 */
					do_action( 'pmpro_member_profile_after', $pu );
				?>
			</div> <!-- end pmpro_card_content -->
			<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_actions' ) ); ?>">
				<?php
					// Build the links to return.
					$pmpro_member_profile_action_links = array();

					if ( ! empty( $directory_url ) ) {
						$pmpro_member_profile_action_links['view-directory'] = sprintf( '<a id="pmpro_actionlink-view-all-members" href="%s">%s</a>', esc_url( $directory_url ), esc_html__( 'View All Members', 'pmpro-member-directory' ) );
					}

					if ( ! empty( $pu ) && $pu->ID === $current_user->ID ) {
						// User viewing their own profile. Show an edit profile link if 'Member Profile Edit Page' is set or dashboard access is allowed.
						if ( ! empty( get_option( 'pmpro_member_profile_edit_page_id' ) ) ) {
							$edit_profile_url = pmpro_url( 'member_profile_edit' );
						} elseif ( ! pmpro_block_dashboard() ) {
							$edit_profile_url = admin_url( 'profile.php' );
						}

						if ( ! empty( $edit_profile_url) ) {
							$pmpro_member_profile_action_links['edit-profile'] = sprintf( '<a id="pmpro_actionlink-profile" href="%s">%s</a>', esc_url( $edit_profile_url ), esc_html__( 'Edit Profile', 'pmpro-member-directory' ) );
						}
					}

					/**
					 * Filter which links are displayed on the single Member Directory Profile page.
					 *
					 * @since 1.0
					 *
					 * @param array $pmpro_member_profile_action_links Can be view-directory, edit-profile, or or custom.
					 *
					 * @return array $pmpro_member_profile_action_links
					 */
					$pmpro_member_profile_action_links = apply_filters( 'pmpromd_member_profile_action_links', $pmpro_member_profile_action_links );

					$allowed_html = array(
						'a' => array (
							'class' => array(),
							'href' => array(),
							'id' => array(),
							'target' => array(),
							'title' => array(),
						),
					);
					echo wp_kses( implode( pmpro_actions_nav_separator(), $pmpro_member_profile_action_links ), $allowed_html );
				?>
			</div> <!-- end pmpro_card_actions -->
		</div> <!-- end pmpro_card -->
	</div> <!-- end pmpro -->
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode( 'pmpro_member_profile', 'pmpromd_profile_shortcode' );

/**
 * This shortcode will display the profile for the user ID specified in the URL and additional content based on the defined attributes.
 *
 * @deprecated 2.0.1
 */
function pmpromd_profile_preheader()
{
	_deprecated_function( __FUNCTION__, '2.0.1' );
}

/**
 * Update the head title and H1
 *
 * @deprecated 2.0.1
 */
function pmpromd_the_title($title, $post_id = NULL)
{
	_deprecated_function( __FUNCTION__, '2.0.1' );
	return $title;
}

/**
 * Update the head title and H1
 *
 * @deprecated 2.0.1
 */
function pmpromd_wp_title($title, $sep)
{
	_deprecated_function( __FUNCTION__, '2.0.1' );
	return $title;
}

/**
 * We're working with the menu now so remove the filters.
 *
 * @deprecated 2.0.1
 */
function pmpromd_remove_filters_menu_title( $nav_menu ) {	
	_deprecated_function( __FUNCTION__, '2.0.1' );
	remove_filter( 'wp_title', 'pmpromd_wp_title', 10, 2 );
	remove_filter( 'the_title', 'pmpromd_the_title', 10, 2 );
	return $nav_menu;
}


/**
 * We're done working with the menu so add those filters back.
 *
 * @deprecated 2.0.1
 */
function pmpromd_readd_filters_menu_title( $items ) {
	_deprecated_function( __FUNCTION__, '2.0.1' );
	// we are done working with menu, so add the title filter back
	add_filter( 'wp_title', 'pmpromd_wp_title', 10, 2 );
	add_filter( 'the_title', 'pmpromd_the_title', 10, 2 );
	return $items;
}
