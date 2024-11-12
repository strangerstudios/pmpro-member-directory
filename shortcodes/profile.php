<?php
/*
	This shortcode will display the profile for the user ID specified in the URL and additional content based on the defined attributes.
*/

function pmpromd_profile_shortcode_elements($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_member_profile avatar="false" email="false"]

	extract(shortcode_atts(array(
		'avatar_size' => '128',
		'elements' => array(),
		'fields' => NULL,
		'user_id' => NULL,
		'show_search' => true,
	), $atts));

	global $current_user, $display_name, $wpdb, $pmpro_pages, $pmprorh_registration_fields, $wp_query;

	//some page vars
	if(!empty($pmpro_pages['directory']))
		$directory_url = get_permalink($pmpro_pages['directory']);
	else
		$directory_url = "";
	if(!empty($pmpro_pages['profile']))
		$profile_url = get_permalink($pmpro_pages['profile']);

	if($show_search === "0" || $show_search === "false" || $show_search === "no" || $show_search === false )
		$show_search = false;
	else
		$show_search = true;

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
	<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro' ) ); ?>">
		<?php if ( ! empty( $show_search ) ) { ?>
			<form action="<?php echo esc_url( $directory_url ); ?>" method="post" role="search" class="<?php echo pmpro_get_element_class( 'pmpro_form pmpro_member_directory_search', 'pmpro_member_directory_search' ); ?>">
				<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_fields' ) ); ?>">
					<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_field pmpro_form_field-text pmpro_form_field-ps', 'pmpro_form_field-ps' ) ); ?>">
						<label for="ps" class="screen-reader-text"><?php _e('Search for:','pmpro-member-directory'); ?></label>
						<input type="search" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_input pmpro_form_input-text' ) ); ?>" placeholder="<?php esc_attr_e( 'Search Members','pmpro-member-directory' ); ?>" name="ps" id="ps" value="<?php if(!empty($_REQUEST['ps'])) echo esc_attr($_REQUEST['ps']);?>" title="<?php esc_attr_e('Search Members','pmpro-member-directory'); ?>" />
						<input type="hidden" name="limit" value="<?php echo esc_attr($limit);?>" />
					</div> <!-- end pmpro_form_field-ps -->
				</div> <!-- end pmpro_form_fields -->
				<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_submit' ) ); ?>">
					<input type="submit" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_btn' ) ); ?>" value="<?php esc_attr_e( 'Submit','pmpro-member-directory'); ?>">
				</div>
			</form>
		<?php } ?>
		<?php
			if (! empty( $pu ) )
				{
				if ( ! empty( $fields ) )
					{
					// Check to see if the Block Editor is used or the shortcode.
					if ( strpos( $fields, "\n" ) !== FALSE ) {
						$fields = rtrim( $fields, "\n" ); // clear up a stray \n
						$fields_array = explode("\n", $fields); // For new block editor.
					} else {
						$fields = rtrim( $fields, ';' ); // clear up a stray ;
						$fields_array = explode(";",$fields);
					}

					if ( ! empty( $fields_array ) ) {
						for( $i = 0; $i < count($fields_array); $i++ ) {
							$fields_array[$i] = explode( ',', $fields_array[$i] );
						}
					}
				}
				else {
					$fields_array = false;
				}

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

				/**
				 * Allow filtering the elements to include on the member profile page.
				 *
				 * @since TBD
				 *
				 * @param array $elements_array The list of elements to include.
				 */
				$elements = apply_filters( 'pmpro_member_profile_elements', $elements );

				// Setup initial elements array.
				$elements_array = array(
					/*
					'avatar' => array(
						'label' => '',
						'visible' => false,
						'order' => 1,
					),
					'display_name' => array(
						'label' => __( 'Member', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 2,
					),
					*/
					'avatar_name' => array(
						'label' => '',
						'visible' => false,
						'order' => 1,
					),
					'bio' => array(
						'label' => __( 'Biographical Info', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 2,
					),
					'email' => array(
						'label' => __( 'Email', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 3,
					),
					'level' => array(
						'label' => __( 'Level', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 4,
					),
					'startdate' => array(
						'label' => __( 'Start Date', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 5,
					),
					'address' => array(
						'label' => __( 'Address', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 6,
					),
					'phone' => array(
						'label' => __( 'Phone Number', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 7,
					),
					'fields' => array(
						'label' => __( 'More Information', 'pmpro-member-directory' ),
						'visible' => false,
						'order' => 8,
					),
				);

				// Work with elements passed from shortcode/filter.
				if ( ! empty( $elements ) ) {

					$elements_data = explode( ';', $elements ); // Separate the elements by semi-colon.
					$order = 1;
					foreach ( $elements_data as $element_data_item ) {

						$element_custom_label = $element_field = '';
						if ( str_contains( $element_data_item, ',' ) ) {
							// If there is a comma, then we know it has label/field pair.
							$element_data_item = explode( ',', $element_data_item );
							$element_custom_label = $element_data_item[0];
							$element_field = $element_data_item[1];
						} else {
							// Otherwise we have just the field with no custom label.
							$element_field = $element_data_item;
						}

						// Update default values for the element if it exists.
						if ( array_key_exists( $element_field, $elements_array ) ) {

							// Override the default label if we have a custom one.
							if ( ! empty( $element_custom_label ) ) {
								$elements_array[ $element_field ]['label'] = $element_custom_label;
							}

							// Set the order.
							$elements_array[ $element_field ]['order'] = $order;
							$order++;

							// Set visibility.
							$elements_array[ $element_field ]['visible'] = true;

						}

					}

				}

				/**
				 * Filter to override the attributes passed into the shortcode.
				 * 
				 * @param array Contains all of the shortcode attributes used in the profile shortcode
				 */
				$shortcode_atts = apply_filters( 'pmpro_member_profile_before_atts', array(
					'fields_array' => $fields_array,
					'elements_array' => $elements_array,
				) );

				// If no custom elements, set all visible and use default order.
				if ( empty( $elements ) ) {

					// Set all to visible.
					foreach ( $elements_array as &$element ) {
						$element['visible'] = true;
					}

					// If there are no fields to show, then not visible.
					if ( empty( $fields_array ) ) {
						$elements_array['fields']['visible'] = false;
					}

				}

				// Sort the elements by order.
				uasort( $elements_array, function( $a, $b ) {
					return $a['order'] <=> $b['order'];
				} );

				?>
				<div id="pmpro_member_profile-<?php echo esc_attr( $pu->ID ); ?>" class="<?php echo pmpro_get_element_class( 'pmpro_card pmpro_member_profile pmpro_member_profile_elements', 'pmpro_member_profile'); ?>">
					<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_content' ) ); ?>">

					<?php do_action( 'pmpro_member_profile_before', $pu ); ?>

					<?php 
					foreach ( $elements_array as $element_name => $element ) {

						// Skip elements that are not visible.
						if ( ! $element['visible'] ) {
							continue;
						}

						if ( $element_name === 'display_name' && ! empty( $pu->display_name ) ) { 

							$heading_classes = array();
							$heading_classes[] = 'pmpro_card_title';
							$heading_classes[] = 'pmpro_font-x-large';
							$heading_classes = implode( ' ', $heading_classes );
							?>
							<h2 class="<?php echo esc_attr( pmpro_get_element_class( $heading_classes ) ); ?>">
								<?php echo esc_html( pmpro_member_directory_get_member_display_name( $pu ) ); ?>
							</h2>

						<?php } elseif ( $element_name === 'avatar' ) { ?>

							<div class="pmpro_member_directory_avatar">
								<?php echo get_avatar($pu->ID, $avatar_size, NULL, $pu->display_name ); ?>
							</div>

						<?php } elseif ( $element_name === 'avatar_name' ) {

							$heading_classes = array();
							$heading_classes[] = 'pmpro_card_title';
							$heading_classes[] = 'pmpro_font-x-large';
							$heading_classes[] = 'pmpro_heading-with-avatar';
							$heading_classes = implode( ' ', $heading_classes );
							?>
							<h2 class="<?php echo esc_attr( pmpro_get_element_class( $heading_classes ) ); ?>">
								<?php echo get_avatar($pu->ID, $avatar_size, NULL, $pu->display_name, array("class"=>"alignright")); ?>
								<?php echo esc_html( pmpro_member_directory_get_member_display_name( $pu ) ); ?>
							</h2>

						<?php } elseif ( $element_name === 'bio' && ! empty( $pu->description ) ) { ?>

							<div class="pmpro_member_directory_bio">
								<strong><?php echo esc_html( $element['label'] ); ?></strong>
								<?php echo $pu->description; ?>
							</div>

						<?php } elseif ( $element_name === 'email' ) { ?>

							<div class="pmpro_member_directory_email">
								<strong><?php echo esc_html( $element['label'] ); ?></strong>
								<?php echo pmpromd_format_profile_field( $pu->user_email, 'user_email' ); ?>
							</div>

						<?php } elseif ( $element_name === 'level' ) { ?>

							<div class="pmpro_member_directory_level">
								<strong><?php echo esc_html( $element['label'] ); ?></strong>
								<?php echo ! empty( $pu->membership_levels ) ? $pu->membership_levels : ''; ?>
							</div>
						
						<?php } elseif ( $element_name === 'startdate' ) { ?>

							<div class="pmpro_member_directory_date">
								<strong><?php echo esc_html( $element['label'] ); ?></strong>
								<?php
								$min_startdate = null;
								foreach($allmylevels as $level) {
									if ( empty( $min_startdate ) || $level->startdate < $min_startdate ) {
										$min_startdate = $level->startdate;
									}
								}
								echo ! empty( $min_startdate ) ? date_i18n( get_option( 'date_format' ), $min_startdate ) : '';
								?>
							</div>

						<?php } elseif ( $element_name === 'address' && ! empty( $pu->pmpro_baddress1 ) ) { ?>

							<div class="pmpro_member_directory_baddress">
								<strong><?php echo esc_html( $element['label'] ); ?></strong>
								<?php echo $pu->pmpro_baddress1; ?><br />
								<?php
									if(!empty($pu->pmpro_baddress2))
										echo $pu->pmpro_baddress2 . "<br />";
								?>
								<?php if($pu->pmpro_bcity && $pu->pmpro_bstate) { ?>
									<?php echo $pu->pmpro_bcity; ?>, <?php echo $pu->pmpro_bstate; ?> <?php echo $pu->pmpro_bzipcode; ?><br />
									<?php echo $pu->pmpro_bcountry; ?><br />
								<?php } ?>
							</div>

						<?php } elseif ( $element_name === 'phone' && ! empty( $pu->pmpro_bphone ) ) { ?>

							<div class="pmpro_member_directory_phone">
								<strong><?php echo esc_html( $element['label'] ); ?></strong>
								<?php echo formatPhone($pu->pmpro_bphone); ?>
							</div>

						<?php } elseif ( $element_name === 'fields' && ! empty( $fields_array ) ) {

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
										<div class="pmpro_member_directory_<?php echo esc_attr($field[1]); ?>">
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


										</div>
										<?php
									}
								}

						} 
					}
					?>
					<?php do_action( 'pmpro_member_profile_after', $pu ); ?>
					</div>
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
					</div> <!-- end pmpro_card_actions -->
				</div> <!-- end pmpro_card -->
				<?php
			}
		?>
	</div> <!-- end pmpro -->
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode("pmpromd_profile", "pmpromd_profile_shortcode_elements");
