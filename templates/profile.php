<?php
/*
	This shortcode will display the profile for the user ID specified in the URL and additional content based on the defined attributes.
*/
function pmpromd_profile_preheader()
{
	global $post, $pmpro_pages, $current_user;

	// Bail if we're not on the profile page.
	if ( empty( $pmpro_pages['profile'] ) || ! is_page( $pmpro_pages['profile'] ) ) {
		return;
	}
		
	/*
		Preheader operations here.
	*/
	global $main_post_id;
	$main_post_id = $post->ID;

	$pu = pmpromd_get_user();

	// Is this user hidden from directory?
	if ( ! empty( $pu ) ) {
		$pmpromd_hide_directory = get_user_meta( $pu->ID, 'pmpromd_hide_directory', true );
	} else {
		$pmpromd_hide_directory = false;
	}

	// If no profile user, membership level, or hidden, go to directory or home.
	if(empty($pu) || empty($pu->ID) || !pmpro_hasMembershipLevel(null, $pu->ID) || $pmpromd_hide_directory == '1' ) {
		if(!empty($pmpro_pages['directory']))
	 		wp_redirect(get_permalink($pmpro_pages['directory']));
	 	else
	 		wp_redirect(home_url());
	 	exit;
	}

	// Integrate with Approvals.
	if ( class_exists( 'PMPro_Approvals' ) ){
		// Check that either the user has a membership level that does not require approval
		// or that the user has a membership level that does require approval and has been approved.
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
			if ( ! empty( $pmpro_pages['directory'] ) ) {
				wp_redirect( get_permalink( $pmpro_pages['directory'] ) );
			} else {
				wp_redirect(home_url());
				exit;
			}
		}
	}

	/*
		If a level is required for the profile page, make sure the profile user has it.
	*/

	// Check to see if the page's content is restricted by shortcode, if so we don't have to redirect away.
	if ( has_shortcode( $post->post_content, 'membership' ) || has_block( 'pmpro/membership', $post->post_content ) ) {
		return;
	}

	//check is levels are required within the profile's shortcode, if they don't have that level redirect away.
	$levels = pmpro_getMatches("/ levels?=[\"']([^\"^']*)[\"']/", $post->post_content, true);
	if(!empty($levels) && !pmpro_hasMembershipLevel(explode(",", $levels), $pu->ID))
	{
		if(!empty($pmpro_pages['directory']))
			wp_redirect(get_permalink($pmpro_pages['directory']));
		else
			wp_redirect(home_url());
		exit;
	}
}
add_action("wp", "pmpromd_profile_preheader", 1);

/*
	Update the head title and H1
*/
function pmpromd_the_title($title, $post_id = NULL)
{
	global $main_post_id, $current_user, $wp_query;
	if( $post_id == $main_post_id ) {
		$pu = pmpromd_get_user();

		$display_name = pmpro_member_directory_get_member_display_name( $pu );

		if( !empty( $display_name ) ){
			$title = $display_name;
		}
	}
	return $title;
}
add_filter("the_title", "pmpromd_the_title", 10, 2);

function pmpromd_wp_title($title, $sep)
{
	global $wpdb, $main_post_id, $post, $current_user, $wp_query;
	if( $post->ID == $main_post_id ) {

		$pu = pmpromd_get_user();

		$display_name = pmpro_member_directory_get_member_display_name( $pu );

		if( !empty( $display_name ) ) {
			$title = $display_name . ' ' . $sep . ' ';
		}

		$title .= get_bloginfo( 'name' );
	}
	return $title;
}
add_filter("wp_title", "pmpromd_wp_title", 10, 2);

/**
 * We're working with the menu now so remove the filters.
 *
 * @since TBD
 *
 * @param string|null $output Nav menu output to short-circuit with. Default null.
 *
 * @return string|null Nav menu output to short-circuit with. Default null.
 */
function pmpromd_remove_filters_menu_title( $nav_menu ) {	

    remove_filter( 'wp_title', 'pmpromd_wp_title', 10, 2 );
    remove_filter( 'the_title', 'pmpromd_the_title', 10, 2 );
    return $nav_menu;
}
add_filter( 'pre_wp_nav_menu', 'pmpromd_remove_filters_menu_title' );


/**
 * We're done working with the menu so add those filters back.
 *
 * @since TBD
 *
 * @param string $items The HTML list content for the menu items.
 *
 * @return string The HTML list content for the menu items.
 */
function pmpromd_readd_filters_menu_title( $items ) {

    // we are done working with menu, so add the title filter back
    add_filter( 'wp_title', 'pmpromd_wp_title', 10, 2 );
    add_filter( 'the_title', 'pmpromd_the_title', 10, 2 );
    return $items;
}
add_filter( 'wp_nav_menu_items', 'pmpromd_readd_filters_menu_title' );

function pmpromd_profile_shortcode($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_member_profile avatar="false" email="false"]

	extract(shortcode_atts(array(
		'avatar_size' => '128',
		'fields' => NULL,
		'show_avatar' => true,
		'show_bio' => true,
		'show_billing' => true,
		'show_email' => true,
		'show_level' => true,
		'show_name' => true,
		'show_phone' => true,
		'show_search' => true,
		'show_startdate' => true,
		'user_id' => NULL
	), $atts));

	global $current_user, $display_name, $wpdb, $pmpro_pages, $pmprorh_registration_fields, $wp_query;

	//some page vars
	if(!empty($pmpro_pages['directory']))
		$directory_url = get_permalink($pmpro_pages['directory']);
	else
		$directory_url = "";
	if(!empty($pmpro_pages['profile']))
		$profile_url = get_permalink($pmpro_pages['profile']);

	//turn 0's into falses
	if($show_avatar === "0" || $show_avatar === "false" || $show_avatar === "no" || $show_avatar === false )
		$show_avatar = false;
	else
		$show_avatar = true;

	if($show_billing === "0" || $show_billing === "false" || $show_billing === "no" || $show_billing === false )
		$show_billing = false;
	else
		$show_billing = true;

	if($show_bio === "0" || $show_bio === "false" || $show_bio === "no" || $show_bio === false )
		$show_bio = false;
	else
		$show_bio = true;

	if($show_email === "0" || $show_email === "false" || $show_email === "no" || $show_email === false )
		$show_email = false;
	else
		$show_email = true;

	if($show_level === "0" || $show_level === "false" || $show_level === "no" || $show_level === false )
		$show_level = false;
	else
		$show_level = true;

	if($show_name === "0" || $show_name === "false" || $show_name === "no" || $show_name === false )
		$show_name = false;
	else
		$show_name = true;

	if($show_phone === "0" || $show_phone === "false" || $show_phone === "no" || $show_phone === false )
		$show_phone = false;
	else
		$show_phone = true;

	if($show_search === "0" || $show_search === "false" || $show_search === "no" || $show_search === false )
		$show_search = false;
	else
		$show_search = true;

	if($show_startdate === "0" || $show_startdate === "false" || $show_startdate === "no" || $show_startdate === false )
		$show_startdate = false;
	else
		$show_startdate = true;

	if(isset($_REQUEST['limit']))
		$limit = intval($_REQUEST['limit']);
	elseif(empty($limit))
		$limit = 15;

	$pu = pmpromd_get_user( $user_id );

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
	<?php if(!empty($show_search)) { ?>
	<form action="<?php echo esc_url( $directory_url ); ?>" method="post" role="search" class="<?php echo pmpro_get_element_class( 'pmpro_member_directory_search search-form', 'profile_search' ); ?>">

		<label>
			<span class="screen-reader-text"><?php _e('Search for:','pmpro-member-directory'); ?></span>
			<input type="search" class="search-field" placeholder="<?php esc_attr_e('Search Members','pmpro-member-directory'); ?>" name="ps" value="<?php if(!empty($_REQUEST['ps'])) echo esc_attr($_REQUEST['ps']);?>" title="<?php esc_attr_e('Search Members','pmpro-member-directory'); ?>" />
			<input type="hidden" name="limit" value="<?php echo esc_attr($limit);?>" />
		</label>
		<input type="submit" class="search-submit" value="<?php _e('Search Members','pmpro-member-directory'); ?>">
	</form>
	<?php } ?>
	<?php
		if(!empty($pu))
		{
			if(!empty($fields))
			{
				// Check to see if the Block Editor is used or the shortcode.
				if ( strpos( $fields, "\n" ) !== FALSE ) {
					$fields = rtrim( $fields, "\n" ); // clear up a stray \n
					$fields_array = explode("\n", $fields); // For new block editor.
				} else {
					$fields = rtrim( $fields, ';' ); // clear up a stray ;
					$fields_array = explode(";",$fields);
				}

				if( ! empty( $fields_array ) ) {
					for($i = 0; $i < count($fields_array); $i++ ) {
						$fields_array[$i] = explode(",", $fields_array[$i]);
					}
				}
			}
			else
				$fields_array = false;


			// Get Register Helper field options
			$rh_fields = array();
			if(!empty($pmprorh_registration_fields)) {
				foreach($pmprorh_registration_fields as $location) {
					foreach($location as $field) {
						if(!empty($field->options)){
							$rh_fields[$field->name] = $field->options;
						}
					}
				}
			}


			?>


			<div id="pmpro_member_profile-<?php echo esc_attr( $pu->ID ); ?>" class="<?php echo pmpro_get_element_class( 'pmpro_member_profile', 'profile'); ?>">

				<?php do_action( 'pmpro_member_profile_before', $pu ); ?>
				<?php if(!empty($show_avatar)) { ?>
					<p class="pmpro_member_directory_avatar">
						<?php echo get_avatar($pu->ID, $avatar_size, NULL, $pu->display_name, array("class"=>"alignright")); ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_name) && !empty($pu->display_name) ) { ?>
					<h2 class="pmpro_member_directory_name">
						<?php echo esc_html( pmpro_member_directory_get_member_display_name( $pu ) ); ?>
					</h2>
				<?php } ?>
				<?php if(!empty($show_bio) && !empty($pu->description) ) { ?>
					<p class="pmpro_member_directory_bio">
						<strong><?php _e('Biographical Info', 'pmpro-member-directory'); ?></strong>
						<?php echo $pu->description; ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_email)) { ?>
					<p class="pmpro_member_directory_email">
						<strong><?php _e('Email Address', 'pmpro-member-directory'); ?></strong>
						<?php echo pmpromd_format_profile_field( $pu->user_email, 'user_email' ); ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_level)) { ?>
					<p class="pmpro_member_directory_level">
						<strong><?php _e('Level', 'pmpro-member-directory'); ?></strong>
						<?php echo ! empty( $pu->membership_levels ) ? $pu->membership_levels : ''; ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_startdate)) { ?>
					<p class="pmpro_member_directory_date">
						<strong><?php _e('Start Date', 'pmpro-member-directory'); ?></strong>
						<?php
						$min_startdate = null;
						foreach($allmylevels as $level) {
							if ( empty( $min_startdate ) || $level->startdate < $min_startdate ) {
								$min_startdate = $level->startdate;
							}
						}
						echo ! empty( $min_startdate ) ? date_i18n( get_option( 'date_format' ), $min_startdate ) : '';
						?>
					</p>
				<?php } ?>
				<?php if(!empty($show_billing) && !empty($pu->pmpro_baddress1)) { ?>
					<p class="pmpro_member_directory_baddress">
						<strong><?php _e('Address', 'pmpro-member-directory'); ?></strong>
						<?php echo $pu->pmpro_baddress1; ?><br />
						<?php
							if(!empty($pu->pmpro_baddress2))
								echo $pu->pmpro_baddress2 . "<br />";
						?>
						<?php if($pu->pmpro_bcity && $pu->pmpro_bstate) { ?>
							<?php echo $pu->pmpro_bcity; ?>, <?php echo $pu->pmpro_bstate; ?> <?php echo $pu->pmpro_bzipcode; ?><br />
							<?php echo $pu->pmpro_bcountry; ?><br />
						<?php } ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_phone) && !empty($pu->pmpro_bphone)) { ?>
					<p class="pmpro_member_directory_phone">
						<strong><?php _e('Phone Number','pmpro-member-directory'); ?></strong>
						<?php echo formatPhone($pu->pmpro_bphone); ?>
					</p>
				<?php } ?>
				<?php
					//filter the fields
					$fields_array = apply_filters( 'pmpro_member_profile_fields', $fields_array, $pu );

					if(!empty($fields_array))
					{
						foreach($fields_array as $field)
						{

							if(empty($field[0]))
								break;

							// Fix for a trailing space in the 'fields' shortcode attribute.
							if ( $field[0] === ' ' ) {
								break;
							}

							// Get the field name and value here.
							$field_val = $field[1];
							$meta_field = $pu->$field_val;

							// If using PMPro 2.10, try use User Field function to display labels.
							if ( function_exists( 'pmpro_get_label_for_user_field_value' ) && ! empty( $field_val ) && ! empty( $meta_field ) ) {
								$meta_field = pmpro_get_label_for_user_field_value( $field_val, $meta_field );
							}

							if(!empty($meta_field))
							{
								?>
								<p class="pmpro_member_directory_<?php echo esc_attr($field[1]); ?>">
								<?php
									if(is_array($meta_field) && !empty($meta_field['filename']) ) {
										//this is a file field
										?>
										<strong><?php echo $field[0]; ?></strong>
										<?php echo pmpromd_display_file_field($meta_field); ?>
										<?php
									}elseif(is_array($meta_field)){
										//this is a general array, check for Register Helper options first
										if(!empty($rh_fields[$field[1]])) {
											foreach($meta_field as $key => $value)
												$meta_field[$key] = $rh_fields[$field[1]][$value];
										}
										?>
										<strong><?php echo $field[0]; ?></strong>
										<?php echo implode(", ",$meta_field); ?>
										<?php
									}
									elseif(!empty($rh_fields[$field[1]])  && is_array($rh_fields[$field[1]]) )
									{
									?>
										<strong><?php echo $field[0]; ?></strong>
										<?php echo $rh_fields[$field[1]][$meta_field]; ?>
										<?php
									}
									else
									{
										if($field[1] == 'user_url')
										{
											echo pmpromd_format_profile_field( $meta_field, $field[1], $field[0] );
										}
										else
										{
											?>
											<strong><?php echo $field[0]; ?></strong>
											<?php
												echo pmpromd_format_profile_field( $meta_field, $field[1] );
										}
									}
								?>


								</p>
								<?php
							}
						}
					}
				?>
				<?php do_action( 'pmpro_member_profile_after', $pu ); ?>
				<div class="pmpro_clear"></div>
			</div>			
			<hr />
			<p class="pmpro_actions_nav">
				<?php
					// Build the links to return.
					$pmpro_member_profile_action_links = array();

					if ( ! empty( $directory_url ) ) {
						$pmpro_member_profile_action_links['view-directory'] = sprintf( '<a id="pmpro_actionlink-view-all-members" href="%s">%s</a>', esc_url( $directory_url ), esc_html__( 'View All Members', 'pmpro-member-directory' ) );
					}

					if ( ! empty( $pu ) && $pu->ID === $current_user->ID ) {
						// User viewing their own profile. Show an edit profile link if 'Member Profile Edit Page' is set or dashboard access is allowed.
						if ( ! empty( pmpro_getOption( 'member_profile_edit_page_id' ) ) ) {
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
			</p> <!-- end pmpro_actions_nav -->
			<?php
		}
	?>
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode("pmpro_member_profile", "pmpromd_profile_shortcode");
