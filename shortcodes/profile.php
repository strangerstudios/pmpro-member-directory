<?php
/**
 * Show the content for the [pmpromd_profile] shortcode.
 *
 * @since TBD
 * @return string $content Content for the shortcode.
 */
function pmpromd_member_profile_shortcode( $atts, $content = null, $code="" ) {
	extract(shortcode_atts(array(
		'elements' => 'display_name;avatar;' . __( 'Biographical Info', 'pmpro-member-directory' ) . ',description;' . __( 'Email Address', 'pmpro-member-directory' ) . ',user_email;' . __( 'Membership', 'pmpro-member-directory' ) . ',membership_name;' . __( 'Start Date', 'pmpro-member-directory' ) . ',startdate;',
		'user_id' => NULL,
		'show_search' => true,
	), $atts));

	global $current_user, $pmpro_pages;

	// Get the directory and profile page URLs.
	$directory_url = ! empty( $pmpro_pages['directory'] ) ? get_permalink( $pmpro_pages['directory'] ) : '';
	$profile_url = ! empty( $pmpro_pages['profile'] ) ? get_permalink( $pmpro_pages['profile'] ) : '';

	// Convert the value of 'show_search' to a boolean.
	$show_search = filter_var( $show_search, FILTER_VALIDATE_BOOLEAN );

	// Get the user ID.
	$pu = pmpromd_get_user( $user_id );

	// If we have a user, get their membership level(s).
	if ( ! empty( $pu ) ) {
		$pu->membership_level = pmpro_getMembershipLevelForUser( $pu->ID );
		$allmylevels = pmpro_getMembershipLevelsForUser( $pu->ID );
		$membership_levels = array();
		foreach ( $allmylevels as $curlevel ) {
			$membership_levels[] = $curlevel->name;
		}
		$pu->membership_levels = implode(', ', $membership_levels);
	}

	ob_start();
	?>
	<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro' ) ); ?>">
		<?php if ( ! empty( $show_search ) ) { ?>
			<form action="<?php echo esc_url( $directory_url ); ?>" method="post" role="search" class="<?php echo pmpro_get_element_class( 'pmpro_form pmpro_member_directory_search', 'pmpro_member_directory_search' ); ?>">
				<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_fields' ) ); ?>">
					<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_field pmpro_form_field-text pmpro_form_field-ps', 'pmpro_form_field-ps' ) ); ?>">
						<label for="ps" class="screen-reader-text"><?php _e('Search for:','pmpro-member-directory'); ?></label>
						<input type="search" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_input pmpro_form_input-text' ) ); ?>" placeholder="<?php esc_attr_e( 'Search Members','pmpro-member-directory' ); ?>" name="ps" id="ps" value="<?php if(!empty($_REQUEST['ps'])) echo esc_attr($_REQUEST['ps']);?>" title="<?php esc_attr_e('Search Members','pmpro-member-directory'); ?>" />
					</div> <!-- end pmpro_form_field-ps -->
				</div> <!-- end pmpro_form_fields -->
				<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_submit' ) ); ?>">
					<input type="submit" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_btn' ) ); ?>" value="<?php esc_attr_e( 'Submit','pmpro-member-directory'); ?>">
				</div>
			</form>
		<?php } ?>
		
		<?php
			// Set up the elements data array.
			$elements_array = array();

			// Work with elements passed from shortcode/filter.
			if ( ! empty( $elements ) ) {
				// Remove a trailing comma or semicolon if it exists.
				$elements = rtrim( $elements, ',;' );

				// Explode the elements string.
				$elements = explode( ';', $elements );
				foreach ( $elements as $element ) {
					// Remove spaces from the beginning and end of the element.
					$element = trim( $element );

					if ( str_contains( $element, ',' ) ) {
						// If there is a comma, then we know it has label/field pair.
						$elements_array[] = array_map( 'trim', explode( ',', $element ) );
					} else {
						// Otherwise we have just the field with no label.
						$elements_array[] = array( '', trim( $element ) );
					}
				}
			}
		?>
		<div id="pmpro_member_profile-<?php echo esc_attr( $pu->ID ); ?>" class="<?php echo pmpro_get_element_class( 'pmpro_card pmpro_member_profile', 'pmpro_member_profile'); ?>">
			<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_content' ) ); ?>">

				<?php do_action( 'pmpro_member_profile_before', $pu ); ?>

				<?php foreach ( $elements_array as $element ) { ?>
					<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_profile_field pmpro_member_profile_field-' . $element[0] ) ); ?>">
						<?php if ( ! empty( $element[0] ) ) { ?>
							<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_profile_field_label' ) ); ?>">
								<?php echo esc_html( $element[0] ); ?>
							</div>
						<?php } ?>

						<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_profile_field_data' ) ); ?>">
							<?php echo pmpromd_get_element( $element[1], $pu, true, 'profile' ); ?>
						</div>
					</div> <!-- end pmpro_member_profile_field -->
				<?php } ?>

				<?php do_action( 'pmpro_member_profile_after', $pu ); ?>
			</div>
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
						$pmpro_member_profile_action_links['edit-profile'] = sprintf( '<a id="pmpro_actionlink-profile" href="%s">%s</a>', esc_url( $edit_profile_url ), esc_html__( 'Edit Profile', 'paid-memberships-pro' ) );
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
			
				if ( ! empty( $pmpro_member_profile_action_links ) ) {
					?>
					<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_actions' ) ); ?>">
						<?php
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
					<?php
				}
			?>
		</div> <!-- end pmpro_card -->
	</div> <!-- end pmpro -->
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode( 'pmpromd_profile', 'pmpromd_member_profile_shortcode' );
