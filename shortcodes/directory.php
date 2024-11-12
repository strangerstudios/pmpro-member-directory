<?php
/*
	This shortcode will display the members list and additional content based on the defined attributes.
*/
function pmpromd_shortcode_elements($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_member_directory show_avatar="false" show_email="false" levels="1,2"]

	extract(shortcode_atts(array(
		'avatar_size' => '64',
		'fields' => NULL,
		'layout' => 'div',
		'level' => NULL,
		'levels' => NULL,
		'limit' => NULL,
		'link' => true,
		'order_by' => 'u.display_name',
		'order' => 'ASC',
		'show_search' => true,
		'avatar_align' => NULL,
		'elements' => array(),
	), $atts, "pmpro_member_directory"));

	global $wpdb, $post, $pmpro_pages, $pmprorh_registration_fields;

	//some page vars
	if(!empty($pmpro_pages['directory'])) {
		$directory_url = get_permalink($pmpro_pages['directory']);
	}

	if(!empty($pmpro_pages['profile'])) {
		$profile_url = apply_filters( 'pmpromd_profile_url', get_permalink( $pmpro_pages['profile'] ) );
	}

	//turn 0's into falses
	if($link === "0" || $link === "false" || $link === "no" || $link === false)
		$link = false;
	else
		$link = true;

	//did they use level instead of levels?
	if(empty($levels) && !empty($level))
		$levels = $level;

	// convert array to string for levels when using the block editor.
	if ( is_array( $levels ) ) {
		$levels = implode( ',', $levels );
	}

	if($show_search === "0" || $show_search === "false" || $show_search === "no" || $show_search === false )
		$show_search = false;
	else
		$show_search = true;

	if(isset($_REQUEST['ps']))
		$s = $_REQUEST['ps'];
	else
		$s = "";

	// Set the default order value to be either ASC or DESC.
	if ( $order !== 'DESC' ) {
		$order = 'ASC';
	}

	if(isset($_REQUEST['pn']))
		$pn = intval($_REQUEST['pn']);
	else
		$pn = 1;

	if(isset($_REQUEST['limit']))
		$limit = intval($_REQUEST['limit']);
	elseif(empty($limit))
		$limit = 15;

	$end = $pn * $limit;
	$start = $end - $limit;

// Build SQL into parts to make it easier to add in specific sections to the SQL.
$sql_parts = array();

$sql_parts['SELECT'] = "SELECT SQL_CALC_FOUND_ROWS u.ID, u.user_login, u.user_email, u.user_nicename, u.display_name, UNIX_TIMESTAMP(u.user_registered) as joindate, mu.membership_id, mu.initial_payment, mu.billing_amount, mu.cycle_period, mu.cycle_number, mu.billing_limit, mu.trial_amount, mu.trial_limit, UNIX_TIMESTAMP(mu.startdate) as startdate, UNIX_TIMESTAMP(mu.enddate) as enddate, m.name as membership, umf.meta_value as first_name, uml.meta_value as last_name FROM $wpdb->users u ";

$sql_parts['JOIN'] = "LEFT JOIN $wpdb->usermeta umh ON umh.meta_key = 'pmpromd_hide_directory' AND u.ID = umh.user_id LEFT JOIN $wpdb->usermeta umf ON umf.meta_key = 'first_name' AND u.ID = umf.user_id LEFT JOIN $wpdb->usermeta uml ON uml.meta_key = 'last_name' AND u.ID = uml.user_id LEFT JOIN $wpdb->usermeta um ON u.ID = um.user_id LEFT JOIN $wpdb->pmpro_memberships_users mu ON u.ID = mu.user_id LEFT JOIN $wpdb->pmpro_membership_levels m ON mu.membership_id = m.id ";

$sql_parts['WHERE'] = "WHERE mu.status = 'active' AND (umh.meta_value IS NULL OR umh.meta_value <> '1') AND mu.membership_id > 0 ";

$sql_parts['GROUP'] = "GROUP BY u.ID ";

// Clean up order_by to only include text, underscores and periods.
$order_by = preg_replace( '/[^a-z._]/', '', $order_by );
$sql_parts['ORDER'] = "ORDER BY ". esc_sql( $order_by ) . " " . esc_sql( $order ) . " ";

$sql_parts['LIMIT'] = "LIMIT $start, $limit";

if( $s ) {
	$sql_search_where = "
		AND (
			u.user_login LIKE '%" . esc_sql( $s ) . "%'
			OR u.user_email LIKE '%" . esc_sql( $s ) . "%'
			OR u.display_name LIKE '%" . esc_sql( $s ) . "%'
			OR um.meta_value LIKE '%" . esc_sql( $s ) . "%'
		)
	";

	/**
	 * Allow filtering the member directory search SQL to be used.
	 *
	 * @since TBD
	 *
	 * @param string $sql_search_where The member directory search SQL to be used.
	 * @param string $search_text      The search text used.
	 */
	$sql_search_where = apply_filters( 'pmpro_member_directory_sql_search_where', $sql_search_where, $s );

	$sql_parts['WHERE'] .= $sql_search_where;
}

// If levels are passed in.
if ( $levels ) {
	$levels = preg_replace('/[^0-9,]/', '', $levels ); // Only allow commas and numeric values.
	$sql_parts['WHERE'] .= "AND mu.membership_id IN(" . esc_sql($levels) . ") ";
}

// Allow filters for SQL parts.
$sql_parts = apply_filters( 'pmpro_member_directory_sql_parts', $sql_parts, $levels, $s, $pn, $limit, $start, $end, $order_by, $order );

$sqlQuery = $sql_parts['SELECT'] . $sql_parts['JOIN'] . $sql_parts['WHERE'] . $sql_parts['GROUP'] . $sql_parts['ORDER'] . $sql_parts['LIMIT'];


	$sqlQuery = apply_filters("pmpro_member_directory_sql", $sqlQuery, $levels, $s, $pn, $limit, $start, $end, $order_by, $order);

	$theusers = $wpdb->get_results($sqlQuery);
	$totalrows = $wpdb->get_var("SELECT FOUND_ROWS() as found_rows");

	//update end to match totalrows if total rows is small
	if($totalrows < $end)
		$end = $totalrows;

	$theusers = apply_filters( 'pmpromd_user_directory_results', $theusers );

	$user_identifier = pmpromd_user_identifier();

	ob_start();
	?>
	<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro' ) ); ?>">
		<?php if ( ! empty( $show_search ) ) { ?>
			<form role="search" method="post" role="search" class="<?php echo pmpro_get_element_class( 'pmpro_form pmpro_member_directory_search', 'pmpro_member_directory_search' ); ?>">
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

		<h2 id="pmpro_member_directory_subheading" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_font-large' ) ); ?>">
			<?php if(!empty($s)) { ?>
				<?php /* translators: placeholder is for search string entered */ ?>
				<?php printf(__('Profiles Within <em>%s</em>.','pmpro-member-directory'), stripslashes( ucwords(esc_html($s)))); ?>
			<?php } else { ?>
				<?php _e('Viewing All Profiles','pmpro-member-directory'); ?>
			<?php } ?>
			<?php if($totalrows > 0) { ?>
				<small class="muted">
					(<?php
					if($totalrows == 1)
						printf(__('Showing 1 Result','pmpro-member-directory'), $start + 1, $end, $totalrows);
					else
						/* translators: placeholders are for result numbers */
						printf(__('Showing %1$s-%2$s of %3$s Results','pmpro-member-directory'), $start + 1, $end, $totalrows);
					?>)
				</small>
			<?php } ?>
		</h2>

		<?php
		if(!empty($theusers))
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

				if(!empty($fields_array))
				{
					for($i = 0; $i < count($fields_array); $i++ )
						$fields_array[$i] = explode(",", trim($fields_array[$i]));
				}
			}
			else
				$fields_array = false;


			/**
			 * Allow filtering the fields to include on the member directory list.
			 *
			 * @since TBD
			 *
			 * @param array $fields_array The list of fields to include.
			 */
			$fields_array = apply_filters( 'pmpro_member_directory_fields', $fields_array );

			// Get Register Helper field options
			$rh_fields = array();
			if(!empty($pmprorh_registration_fields)) {
				foreach($pmprorh_registration_fields as $location) {
					foreach($location as $field) {
						if(!empty($field->options))
							$rh_fields[$field->name] = $field->options;
					}
				}
			}

			/**
			 * Allow filtering the elements to include on the member directory list.
			 *
			 * @since TBD
			 *
			 * @param array $elements_array The list of elements to include.
			 */
			$elements = apply_filters( 'pmpro_member_directory_elements', $elements );

			// Setup initial elements array.
			$elements_array = array(
				/*
				'avatar' => array(
					'label' => __( 'Avatar', 'pmpro-member-directory' ),
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
					'order' => 3,
				),
				'email' => array(
					'label' => __( 'Email', 'pmpro-member-directory' ),
					'visible' => false,
					'order' => 4,
				),
				'fields' => array(
					'label' => __( 'More Information', 'pmpro-member-directory' ),
					'visible' => false,
					'order' => 5,
				),
				'level' => array(
					'label' => __( 'Level', 'pmpro-member-directory' ),
					'visible' => false,
					'order' => 6,
				),
				'startdate' => array(
					'label' => __( 'Start Date', 'pmpro-member-directory' ),
					'visible' => false,
					'order' => 7,
				),
				'link' => array(
					'label' => '',
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
			 * @param array Contains all of the shortcode attributes used in the directory shortcode
			 */
			$shortcode_atts = apply_filters( 'pmpro_member_directory_before_atts', array(
				'avatar_size' => $avatar_size,
				'fields' => $fields,
				'layout' => $layout,
				'level' => $level,
				'levels' => $levels,
				'limit' => $limit,
				'link' => $link,
				'order_by' => $order_by,
				'order' => $order,
				'show_search' => $show_search,
				'avatar_align' => $avatar_align,				
				'fields_array' => $fields_array,
				'elements_array' => $elements_array,
			) );

			// If no custom elements, set all visible and then use shortcode atts to determine individual visibility.
			if ( empty( $elements ) ) {

				// Set all to visible.
				foreach ( $elements_array as &$element ) {
					$element['visible'] = true;
				}

				if ( empty( $fields_array ) ) {
					$elements_array['fields']['visible'] = false;
				}

			}

			// Sort the elements by order.
			uasort( $elements_array, function( $a, $b ) {
				return $a['order'] <=> $b['order'];
			} );

			do_action( 'pmpro_member_directory_before', $sqlQuery, $shortcode_atts ); ?>
			
			<div class="pmpro_member_directory pmpro_member_directory_elements <?php
				if ( ! empty( $layout ) ) {
					echo ' pmpro_member_directory-' . $layout;
				}
			?>">			

				<?php
				if($layout == "table")
				{
					?>
					<div class="<?php echo pmpro_get_element_class( 'pmpro_card' ); ?>">
						<div class="<?php echo pmpro_get_element_class( 'pmpro_card_content' ); ?>">
							<table class="<?php echo pmpro_get_element_class( 'pmpro_table' ); ?>">
								<thead>

								<?php
								foreach ( $elements_array as $element_name => $element ) {

									// Skip elements that are not visible.
									if ( ! $element['visible'] ) {
										continue;
									}

									if ( $element_name === 'avatar' ) { ?>

										<th class="pmpro_member_directory_avatar" data-title="<?php echo esc_attr( $element['label'] ); ?>">
											<?php echo esc_html( $element['label'] ); ?>
										</th>

									<?php } elseif ( $element_name === 'display_name' ) { ?>

										<th class="pmpro_member_directory_display-name" data-title="<?php echo esc_attr( $element['label'] ); ?>">
											<?php echo esc_html( $element['label'] ); ?>
										</th>

									<?php } elseif ( $element_name === 'email' ) { ?>

										<th class="pmpro_member_directory_email" data-title="<?php echo esc_attr( $element['label'] ); ?>">
											<?php echo esc_html( $element['label'] ); ?>
										</th>

									<?php } elseif ( $element_name === 'fields' ) { ?>

										<th class="pmpro_member_directory_additional" data-title="<?php echo esc_attr( $element['label'] ); ?>">
											<?php echo esc_html( $element['label'] ); ?>
										</th>

									<?php } elseif ( $element_name === 'level' ) { ?>

										<th class="pmpro_member_directory_level" data-title="<?php echo esc_attr( $element['label'] ); ?>">
											<?php echo esc_html( $element['label'] ); ?>
										</th>

									<?php } elseif ( $element_name === 'startdate' ) { ?>

										<th class="pmpro_member_directory_date" data-title="<?php echo esc_attr( $element['label'] ); ?>">
											<?php echo esc_html( $element['label'] ); ?>
										</th>

									<?php } elseif ( $element_name === 'link' ) { ?>

										<th class="pmpro_member_directory_link">&nbsp;</th>

									<?php } ?>
								
								<?php } ?>
										
								</thead>
								<tbody>
								<?php
								$count = 0;
								foreach($theusers as $auser)
								{
									$auser = get_userdata($auser->ID);
									$auser->membership_level = pmpro_getMembershipLevelForUser($auser->ID);
									$user_fields_array = pmpromd_filter_profile_fields_for_levels( $fields_array, $auser );
									$count++;
									?>
									<tr id="pmpro_member_directory_row-<?php echo $auser->ID; ?>" class="pmpro_member_directory_row<?php if(!empty($link) && !empty($profile_url)) { echo " pmpro_member_directory_linked"; } ?>">
										
									<?php 
									foreach ( $elements_array as $element_name => $element ) {

										// Skip elements that are not visible.
										if ( ! $element['visible'] ) {
											continue;
										}

										if ( $element_name === 'avatar' ) { ?>

											<td class="pmpro_member_directory_avatar">
												<?php if(!empty($link) && !empty($profile_url)) { ?>
													<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ); ?>"><?php echo get_avatar( $auser->ID, $avatar_size, NULL, $auser->user_nicename ); ?></a>
												<?php } else { ?>
													<?php echo get_avatar( $auser->ID, $avatar_size, NULL, $auser->user_nicename ); ?>
												<?php } ?>
											</td>

										<?php } elseif ( $element_name === 'display_name' ) { ?>

											<td>
												<h2 class="pmpro_member_directory_display-name">
													<?php if(!empty($link) && !empty($profile_url)) { ?>
														<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ), $profile_url, true ); ?>"><?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?></a>
													<?php } else { ?>
														<?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?>
													<?php } ?>
												</h2>
											</td>

										<?php } elseif ( $element_name === 'email' ) { ?>

											<td class="pmpro_member_directory_email">
												<?php echo pmpromd_format_profile_field( $auser->user_email, 'user_email' ); ?>
											</td>

										<?php } elseif ( $element_name === 'fields' ) { ?>

											<td class="pmpro_member_directory_additional">
												<?php
												foreach($user_fields_array as $field)
												{
													if ( WP_DEBUG ) {
														error_log("Content of field data: " . print_r( $field, true));
													}

													// Fix for a trailing space in the 'fields' shortcode attribute.
													if ( $field[0] === '' ) {
														break;
													}

													$meta_field = $auser->{$field[1]};
													if(!empty($meta_field))
													{
														?>
														<p class="pmpro_member_directory_<?php echo $field[1]; ?>">
															<?php
															if(is_array($meta_field) && !empty($meta_field['filename']) )
															{
																//this is a file field
																?>
																<strong><?php echo $field[0]; ?></strong>
																<?php echo pmpromd_display_file_field($meta_field); ?>
																<?php
															}
															elseif(is_array($meta_field))
															{
																//this is a general array, check for Register Helper options first
																if(!empty($rh_fields[$field[1]])) {
																	foreach($meta_field as $key => $value)
																		$meta_field[$key] = $rh_fields[$field[1]][$value];
																}
																?>
																<strong><?php echo $field[0]; ?></strong>
																<?php echo implode(", ",$meta_field); ?>
																<?php
															}elseif( !empty($rh_fields[$field[1]]) && is_array($rh_fields[$field[1]])  ) {
															?>
																<strong><?php echo $field[0]; ?></strong>
																<?php echo $rh_fields[$field[1]][$meta_field]; ?>
																<?php
															}
															else
															{
																if($field[1] == 'user_url') {	
																	echo pmpromd_format_profile_field( $meta_field, $field[1], $field[0] );
																} else {
															?>
																<strong><?php echo $field[0]; ?></strong>
																<?php echo pmpromd_format_profile_field( $auser->{$field[1]}, $field[1] ); ?>
																		<?php
																}
															}
															?>
														</p>
														<?php
													}
												}
												?>
											</td>

										<?php } elseif ( $element_name === 'level' ) { ?>

											<td class="pmpro_member_directory_level">
												<?php
													$alluserlevels = pmpro_getMembershipLevelsForUser( $auser->ID );
													$membership_levels = array();
													if ( ! isset( $levels ) ) {
														// Show all the user's levels.
														foreach ( $alluserlevels as $curlevel ) {
															$membership_levels[] = $curlevel->name;
														}
													} else {
														$levels_array = explode(',', $levels);
														// Show only the levels included in the directory.
														foreach ( $alluserlevels as $curlevel ) {
															if ( in_array( $curlevel->id, $levels_array) ) {
																$membership_levels[] = $curlevel->name;
															}
														}
													}
													$auser->membership_levels = implode( ', ', $membership_levels );
													echo ! empty( $auser->membership_levels ) ? $auser->membership_levels : '';
												?>
											</td>

										<?php } elseif ( $element_name === 'startdate' ) { ?>

											<td class="pmpro_member_directory_date">
												<?php
												$min_startdate = null;
												foreach($alluserlevels as $level) {
													if ( empty( $min_startdate ) || $level->startdate < $min_startdate ) {
														$min_startdate = $level->startdate;
													}
												}
												echo ! empty( $min_startdate ) ? date_i18n( get_option( 'date_format' ), $min_startdate ) : '';
												?>
											</td>

										<?php } elseif ( $element_name === 'link' ) { ?>

											<td class="pmpro_member_directory_link">
												<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser ), $profile_url, true ); ?>"><?php _e('View Profile','pmpro-member-directory'); ?></a>
											</td>

										<?php } ?>

									<?php } ?>

									
									</tr>
									<?php
								}
								?>
								</tbody>
							</table>
						</div> <!-- end pmpro_card_content -->
					</div> <!-- end pmpro_card -->
					<?php
				}
				else
				{
					foreach($theusers as $auser):
						$auser = get_userdata($auser->ID);					
						$auser->membership_level = pmpro_getMembershipLevelForUser($auser->ID);
						$user_identifier = pmpromd_user_identifier();
						$user_fields_array = pmpromd_filter_profile_fields_for_levels( $fields_array, $auser );
						?>
						<div id="pmpro_member-<?php echo esc_attr( $auser->ID ); ?>" class="<?php echo pmpro_get_element_class( 'pmpro_member_directory-item pmpro_card', 'pmpro_member-' . esc_attr( $auser->ID ) ); ?>">
							<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_content' ) ); ?>">

								<?php 
								foreach ( $elements_array as $element_name => $element ) {

									// Skip elements that are not visible.
									if ( ! $element['visible'] ) {
										continue;
									}

									if ( $element_name === 'avatar' ) { ?>

										<div class="pmpro_member_directory_avatar">
											<?php if(!empty($link) && !empty($profile_url)) { ?>
												<a class="<?php echo $avatar_align; ?>" href="<?php echo esc_url( pmpromd_build_profile_url( $auser ), $profile_url ); ?>"><?php echo get_avatar($auser->ID, $avatar_size, NULL, $auser->display_name); ?></a>
											<?php } else { ?>
												<span class="<?php echo $avatar_align; ?>"><?php echo get_avatar($auser->ID, $avatar_size, NULL, $auser->display_name); ?></span>
											<?php } ?>
										</div>

									<?php } elseif ( $element_name === 'display_name' ) { ?>

										<h2 class="pmpro_member_directory_display-name">
											<?php if(!empty($link) && !empty($profile_url)) { ?>
												<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser ), $profile_url ); ?>"><?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?></a>
											<?php } else { ?>
												<?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?></a>
											<?php } ?>
										</h2>

									<?php } elseif ( $element_name === 'avatar_name' ) { ?>

										<?php
										$heading_classes = array();
										$heading_classes[] = 'pmpro_card_title';
										$heading_classes[] = 'pmpro_font-large';
										$heading_classes[] = 'pmpro_member_directory_display-name';
										$heading_classes[] = 'pmpro_heading-with-avatar';
										if ( ! empty( $avatar_align ) ) {
											$heading_classes[] = 'pmpro_heading-avatar-' . $avatar_align;
										}
										$heading_classes = implode( ' ', $heading_classes );
										?>
										<h3 class="<?php echo esc_attr( pmpro_get_element_class( $heading_classes ) ); ?>">
											<?php if ( ! empty( $link ) && ! empty( $profile_url ) ) { ?>
												<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser ), $profile_url ); ?>"><?php echo get_avatar($auser->ID, $avatar_size, NULL, $auser->display_name); ?></a>
											<?php } else { ?>
												<?php echo get_avatar($auser->ID, $avatar_size, NULL, $auser->display_name); ?></span>
											<?php } ?>
											<?php if ( ! empty( $link ) && ! empty( $profile_url ) ) { ?>
												<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser ), $profile_url ); ?>"><?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?></a>
											<?php } else { ?>
												<?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?></a>
											<?php } ?>
										</h3>

									<?php } elseif ( $element_name === 'email' ) { ?>

										<p class="pmpro_member_directory_email">
											<strong><?php echo esc_html( $elements_array['email']['label'] ); ?></strong>
											<?php echo pmpromd_format_profile_field( $auser->user_email, 'user_email' ); ?>
										</p>

									<?php } elseif ( $element_name === 'fields' && ! empty( $user_fields_array ) ) { ?>

										<div class="pmpro_member_directory_additional">
											<?php
											foreach($user_fields_array as $field)
											{
												if ( WP_DEBUG ) {
													error_log("Content of field data: " . print_r( $field, true));
												}
				
												// Fix for a trailing space in the 'fields' shortcode attribute.
												if ( $field[0] === '' ) {
													break;
												}
				
												$meta_field = $auser->{$field[1]};
												if(!empty($meta_field))
												{
													?>
													<p class="pmpro_member_directory_<?php echo $field[1]; ?>">
														<?php
														if(is_array($meta_field) && !empty($meta_field['filename']) )
														{
															//this is a file field
															?>
															<strong><?php echo $field[0]; ?></strong>
															<?php echo pmpromd_display_file_field($meta_field); ?>
															<?php
														}
														elseif(is_array($meta_field))
														{
															//this is a general array, check for Register Helper options first
															if(!empty($rh_fields[$field[1]])) {
																foreach($meta_field as $key => $value)
																	$meta_field[$key] = $rh_fields[$field[1]][$value];
															}
															?>
															<strong><?php echo $field[0]; ?></strong>
															<?php echo implode(", ",$meta_field); ?>
															<?php
														}elseif( !empty($rh_fields[$field[1]]) && is_array($rh_fields[$field[1]]) ) {
													?>
														<strong><?php echo $field[0]; ?></strong>
														<?php echo $rh_fields[$field[1]][$meta_field]; ?>
														<?php
													}
														elseif($field[1] == 'user_url')
														{											
															echo pmpromd_format_profile_field( $meta_field, $field[1], $field[0] );
														}
														else
														{
															?>
															<strong><?php echo $field[0]; ?></strong>
															<?php echo pmpromd_format_profile_field( $auser->{$field[1]}, $field[1] ); ?>
															<?php
														}
														?>
													</p>
													<?php
												}
											}
											?>
										</div>

									<?php } elseif ( $element_name === 'level' ) { ?>

										<p class="pmpro_member_directory_level">
											<strong><?php echo esc_html( $elements_array['level']['label'] ); ?></strong>
											<?php
												$alluserlevels = pmpro_getMembershipLevelsForUser( $auser->ID );
												$membership_levels = array();
												if ( ! isset( $levels ) ) {
													// Show all the user's levels.
													foreach ( $alluserlevels as $curlevel ) {
														$membership_levels[] = $curlevel->name;
													}
												} else {
													$levels_array = explode(',', $levels);
													// Show only the levels included in the directory.
													foreach ( $alluserlevels as $curlevel ) {
														if ( in_array( $curlevel->id, $levels_array) ) {
															$membership_levels[] = $curlevel->name;
														}
													}
												}
												$auser->membership_levels = implode( ', ', $membership_levels );
												echo ! empty( $auser->membership_levels ) ? $auser->membership_levels : '';
											?>
										</p>

									<?php } elseif ( $element_name === 'startdate' ) { ?>

										<p class="pmpro_member_directory_date">
											<strong><?php echo esc_html( $elements_array['startdate']['label'] ); ?></strong>
											<?php echo date_i18n(get_option("date_format"), $auser->membership_level->startdate); ?>
										</p>

									<?php } elseif ( $element_name === 'link' ) { ?>

										<p class="pmpro_member_directory_link">
											<a class="more-link" href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ); ?>"><?php _e('View Profile','pmpro-member-directory'); ?></a>
										</p>

									<?php } ?>

								<?php } ?>

							</div>
						</div> <!-- end pmpro_member_directory-item -->
					<?php
					endforeach;
				?>
			</div> <!-- end pmpro_member_directory -->
			<?php

			do_action( 'pmpro_member_directory_after', $sqlQuery, $shortcode_atts );
			
			}
		}
		else
		{
			?>
			<p class="pmpro_member_directory_message pmpro_message pmpro_error">
				<?php _e('No matching profiles found','pmpro-member-directory'); ?>
				<?php
				if($s)
				{
					/* translators: placeholder is for search string entered */
					printf(__('within <em>%s</em>.','pmpro-member-directory'), stripslashes( ucwords(esc_html($s))) );
					if(!empty($directory_url))
					{
						?>
						<a class="more-link" href="<?php echo $directory_url; ?>"><?php _e('View All Members','pmpro-member-directory'); ?></a>
						<?php
					}
				}
				else
				{
					echo ".";
				}
				?>
			</p>
			<?php
		}

		//prev/next
		?>
		<div class="pmpro_pagination">
			<?php
			//prev
			if ( $pn > 1 ) {
				$query_args = array(
					'ps' => $s,
					'pn' => $pn-1,
					'limit' => $limit,
				);
				$query_args = apply_filters( 'pmpromd_pagination_url', $query_args, 'prev' );
				?>
				<span class="pmpro_prev"><a href="<?php echo esc_url(add_query_arg( $query_args, get_permalink($post->ID)));?>">&laquo; <?php _e('Previous','pmpro-member-directory'); ?></a></span>
				<?php
			}

			$number_of_pages = $totalrows / $limit;
			//Page Numbers
			?>
				<span class='pmpro_page_numbers'>
			<?php
			$counter = 0;
			if ( empty( $pn ) || $pn != 1 ) {
				echo '<a href="' . esc_url( add_query_arg( $query_args, get_permalink( $post->ID ) ) ) . '" title="' . esc_attr__( 'Previous', 'pmpromd' ) . '">...</a>';
			}

			if( round( $number_of_pages, 0 ) !== 1 && $pn !== 1 ) {
				//If there's only one page, no need to show the page numbers
				for( $i = $pn; $i <= $number_of_pages; $i++ ){
					if( $counter <= 6 ){
						$query_args = array(
							'ps' => $s,
							'pn' => $i,
							'limit' => $limit,
						);

						if( $i == $pn ){ $active_class = 'class="pmpro_page_active"'; } else { $active_class = ''; }
						
						echo '<a href="' . esc_url( add_query_arg( $query_args, get_permalink( $post->ID ) ) ) . '" ' . $active_class . ' title="' . esc_attr( sprintf( __('Page %s', 'pmpromd' ), $i ) ) . '">' . $i . '</a>';
					}
					$counter++;
				}	
			}		
			?>
			</span>
			<?php
			//next
			if ( $totalrows > $end ) {
				$query_args = array(
					'ps' => $s,
					'pn' => $pn+1,
					'limit' => $limit,
				);
				$query_args = apply_filters( 'pmpromd_pagination_url', $query_args, 'next' );
				?>
				<span class="pmpro_next"><a href="<?php echo esc_url( add_query_arg( $query_args, get_permalink( $post->ID ) ) );?>"><?php _e( 'Next', 'pmpro-member-directory' ); ?> &raquo;</a></span>
				<?php
			}
			?>
		</div> <!-- end pmpro_pagination -->
	</div> <!-- end pmpro -->
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode("pmpromd_directory", "pmpromd_shortcode_elements");
