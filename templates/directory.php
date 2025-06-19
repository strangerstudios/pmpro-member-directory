<?php
/**
 * Show the content for the [pmpro_member_directory] shortcode.
 */
function pmpromd_shortcode( $atts, $content=null, $code="" ) {
	global $wpdb, $post, $pmpro_pages;

	extract(shortcode_atts(array(
		'avatar_size' => '128',
		'elements' => NULL,
		'fields' => NULL,
		'layout' => 'div',
		'level' => NULL,
		'levels' => NULL,
		'limit' => NULL,
		'link' => true,
		'order_by' => 'u.display_name',
		'order' => 'ASC',
		'show_avatar' => true,
		'show_email' => true,
		'show_level' => true,
		'show_search' => true,
		'show_startdate' => true,
		'avatar_align' => NULL,
		'show_map' => false,
		'map_zoom' => sanitize_text_field( apply_filters( 'pmpromm_default_zoom_level', '8' ) ),
		'map_height' => '400',
		'map_width' => '100',
		'map_max_zoom' => NULL,
		'map_infowindow_width' 	=> '300',
	), $atts, "pmpro_member_directory"));

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

	// Validate boolean variables.
	$link = filter_var( $link, FILTER_VALIDATE_BOOLEAN );
	$show_avatar = filter_var( $show_avatar, FILTER_VALIDATE_BOOLEAN );
	$show_email = filter_var( $show_email, FILTER_VALIDATE_BOOLEAN );
	$show_level = filter_var( $show_level, FILTER_VALIDATE_BOOLEAN );
	$show_search = filter_var( $show_search, FILTER_VALIDATE_BOOLEAN );
	$show_startdate = filter_var( $show_startdate, FILTER_VALIDATE_BOOLEAN );

	// Validate the avatar size.
	$avatar_size = intval( $avatar_size );

	// Did they use level instead of levels?
	if ( empty( $levels ) && ! empty( $level ) ) {
		$levels = $level;
	}

	// Convert the levels attribute to an array.
	if ( is_array( $levels ) ) {
		$levels = implode( ',', $levels );
	}

	// Set the default order value to be either ASC or DESC.
	if ( $order !== 'DESC' ) {
		$order = 'ASC';
	}

	// Set some values from the request or defaults.
	$s = isset( $_REQUEST['ps'] ) ? sanitize_text_field( $_REQUEST['ps'] ) : ''; // Search string.
	$pn = isset( $_REQUEST['pn'] ) ? intval( $_REQUEST['pn'] ) : 1; // Page number.
	$limit = isset($_REQUEST['limit']) ? intval($_REQUEST['limit']) : (empty($limit) ? 15 : $limit);

	$end = $pn * $limit;
	$start = $end - $limit;

	// Build SQL into parts to make it easier to add in specific sections to the SQL.
	$sql_parts = array();

	$sql_parts['SELECT'] = "
	SELECT SQL_CALC_FOUND_ROWS 
		u.ID,
		u.user_nicename,
		umf.meta_value AS first_name, 
		uml.meta_value AS last_name,
		umlng.meta_key as old_lng,
		umlat.meta_key as old_lat,
		ummap.meta_value AS maplocation 
	FROM $wpdb->users u 
";

$sql_parts['JOIN'] = "
	LEFT JOIN $wpdb->usermeta umh 
		ON umh.meta_key = 'pmpromd_hide_directory' AND u.ID = umh.user_id 
	LEFT JOIN $wpdb->pmpro_memberships_users mu 
		ON u.ID = mu.user_id 
	LEFT JOIN $wpdb->usermeta umf 
		ON umf.meta_key = 'first_name' AND u.ID = umf.user_id 
	LEFT JOIN $wpdb->usermeta uml 
		ON uml.meta_key = 'last_name' AND u.ID = uml.user_id 
	LEFT JOIN $wpdb->usermeta umlat 
		ON umlat.meta_key = 'pmpro_lat' AND u.ID = umlat.user_id 
	LEFT JOIN $wpdb->usermeta umlng 
		ON umlng.meta_key = 'pmpro_lng' AND u.ID = umlng.user_id 
	LEFT JOIN $wpdb->usermeta ummap 
		ON ummap.meta_key = 'pmpromm_pin_location' AND u.ID = ummap.user_id 
";

$sql_parts['WHERE'] = "
	WHERE mu.status = 'active' 
	AND (umh.meta_value IS NULL OR umh.meta_value <> '1') 
	AND mu.membership_id > 0 
";

$sql_parts['GROUP'] = "GROUP BY u.ID ";

// Clean up order_by to only include text, underscores and periods.
$order_by = preg_replace('/[^a-z._]/', '', $order_by);
$sql_parts['ORDER'] = "ORDER BY " . esc_sql($order_by) . " " . esc_sql($order) . " ";

$sql_parts['LIMIT'] = "LIMIT $start, $limit";

// If search is provided
if ( $s ) {
	$escaped_s = esc_sql( $s );
	$sql_search_where = "
		AND (
			u.user_login LIKE '%$escaped_s%'
			OR u.user_email LIKE '%$escaped_s%'
			OR u.display_name LIKE '%$escaped_s%'
			OR um.meta_value LIKE '%$escaped_s%'
		)
	";

	$sql_search_where = apply_filters( 'pmpro_member_directory_sql_search_where', $sql_search_where, $s );

	// Include generic usermeta join for search
	$sql_parts['JOIN'] .= "
		LEFT JOIN $wpdb->usermeta um ON u.ID = um.user_id 
	";
	$sql_parts['WHERE'] .= $sql_search_where;
}

// Filter by membership levels if provided
if ( $levels ) {
	$levels = preg_replace( '/[^0-9,]/', '', $levels ); // Sanitize: allow only numbers and commas
	$sql_parts['WHERE'] .= "AND mu.membership_id IN (" . esc_sql( $levels ) . ") ";
}

// Allow filters for SQL parts
$sql_parts = apply_filters( 'pmpro_member_directory_sql_parts', $sql_parts, $levels, $s, $pn, $limit, $start, $end, $order_by, $order );

// Assemble full SQL query
$sqlQuery = $sql_parts['SELECT'] . $sql_parts['JOIN'] . $sql_parts['WHERE'] . $sql_parts['GROUP'] . $sql_parts['ORDER'] . $sql_parts['LIMIT'];

// Final filter on full SQL string
$sqlQuery = apply_filters( 'pmpro_member_directory_sql', $sqlQuery, $levels, $s, $pn, $limit, $start, $end, $order_by, $order );

	$theusers = $wpdb->get_results($sqlQuery);
	$totalrows = $wpdb->get_var("SELECT FOUND_ROWS() as found_rows");

	// Update end to match totalrows if total rows is small.
	if ( $totalrows < $end )
		$end = $totalrows;

	$theusers = apply_filters( 'pmpromd_user_directory_results', $theusers );

	ob_start();
	?>
	<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro' ) ); ?>">
		<?php
			if ( ! empty( $show_search ) ) {
				pmpromd_search_form();
			}
		?>

		<div class="<?php echo esc_attr( 'pmpro_member_directory_before' ); ?>">
			<h2 id="pmpro_member_directory_subheading" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_font-large' ) ); ?>">
				<?php if ( ! empty( $s ) ) { ?>
					<?php /* translators: placeholder is for search string entered */ ?>
					<?php printf( esc_html__('Profiles Within %s.','pmpro-member-directory'), '<em>' . esc_html( stripslashes( ucwords( $s ) ) ) . '</em>'); ?>
				<?php } else { ?>
					<?php esc_html_e('Viewing All Profiles','pmpro-member-directory'); ?>
				<?php } ?>
			</h2>
			<?php if ( $totalrows > 0 ) { ?>
				<p>
					<?php
						if ( $totalrows == 1 ) {
							esc_html_e( 'Showing 1 Result', 'pmpro-member-directory' );
						} else {
							/* translators: placeholders are for result numbers */
							echo esc_html( sprintf( __( 'Showing %1$s-%2$s of %3$s Results', 'pmpro-member-directory' ), $start + 1, $end, $totalrows ) );
						}
					?>
				</p>
			<?php } ?>
			<?php
			if ( empty( $theusers ) ) {
				// If there are no users, display a message and bail early.
				?>
				<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_message pmpro_error' ) ); ?>">
					<?php
						if ( $s ) {
							/* translators: placeholder is for search string entered */
							echo wp_kses_post( sprintf( __( 'No matching profiles found within <em>%s</em>.', 'pmpro-member-directory' ), stripslashes( ucwords( esc_html( $s ) ) ) ) );

							// If there is a directory URL, display a link to view all members.
							if ( ! empty( $directory_url ) ) {
								?>
								<a class="more-link" href="<?php echo esc_url( $directory_url ); ?>"><?php esc_html_e( 'View All Members','pmpro-member-directory' ); ?></a>
								<?php
							}
						} else {
							esc_html_e( 'No matching profiles found.', 'pmpro-member-directory' );
						}
					?>
				</div>
				</div> <!-- end pmpro_member_directory_before -->
				</div> <!-- end pmpro -->
				<?php
				$temp_content = ob_get_contents();
				ob_end_clean();
				return $temp_content;
			}
			?>

			<?php
				// Build our elements array. If we have an elements attribute on the shortcode, use that and ignore any other legacy attributes.
				if ( ! empty( $elements ) ) {
					$elements_array = pmpromd_prepare_elements_array( $elements );
				} else {
					// We need to support the legacy attributes for backwards compatibility.
					$elements = '';
					if ( $layout == 'table' ) {
						if ( ! empty( $show_avatar ) ) {
							$elements .= __( 'Avatar', 'pmpro-member-directory' ) . ',avatar|' . $avatar_size . ';';
						}
						$elements .= __( 'Member', 'pmpro-member-directory' ) . ',display_name;';
					} else {
						if ( ! empty( $show_avatar ) ) {
							$elements .= 'avatar|' . $avatar_size . ';';
						}
						$elements .= 'display_name;';
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
					if ( ! empty( $fields ) ) {
						$elements .= $fields;
					}
					$elements_array = pmpromd_prepare_elements_array( $elements );
				}

				/**
				* Filter the elements array for the member directory.
				*
				* @since 2.0
				* @param array $elements_array The array of elements to display on the member directory.
				* @param object $pu The user object.
				* @return array $elements_array The array of elements to display on the member directory.
				*/
				$elements_array = apply_filters( 'pmpro_member_directory_elements', $elements_array );

				// Set up an array of items that will be linked to the user's profile.
				$linked_elements = array( 'display_name' );
				foreach ( $elements_array as $element ) {
					if ( strpos( $element[1], 'avatar|' ) !== false ) {
						$linked_elements[] = $element[1];
					}
				}

				/**
				 * Filter to override the attributes passed into the shortcode.
				 *
				 * @param array Contains all of the shortcode attributes used in the directory shortcode
				 */
				$shortcode_atts = apply_filters( 'pmpro_member_directory_before_atts', array(
					'avatar_size' => $avatar_size,
					'elements' => $elements,
					'fields' => $fields,
					'layout' => $layout,
					'level' => $level,
					'levels' => $levels,
					'limit' => $limit,
					'link' => $link,
					'order_by' => $order_by,
					'order' => $order,
					'show_avatar' => $show_avatar,
					'show_email' => $show_email,
					'show_level' => $show_level,
					'show_search' => $show_search,
					'show_startdate' => $show_startdate,
					'avatar_align' => $avatar_align,
					'elements_array' => $elements_array,
					'fields_array' => $elements_array, // Backwards compatibility. We can remove this in a future version.
					'show_map' => false,
					'map_zoom' => sanitize_text_field( apply_filters( 'pmpromm_default_zoom_level', '8' ) ),
					'map_height' => '400',
					'map_width' => '100',
					'map_max_zoom' => NULL,
					'map_infowindow_width' 	=> '300',
				) );

				// Set the displayed_levels variable to use for displaying values.
				$displayed_levels = empty( $levels ) ? 'all' : $levels;

				/**
				 * Action to add content before the member directory.
				 *
				 * @since 0.8
				 * @param string $sqlQuery The SQL query used to get the members.
				 * @param array $shortcode_atts The attributes passed into the shortcode.
				 */
				do_action( 'pmpro_member_directory_before', $sqlQuery, $shortcode_atts );

				/// PUT THE MAP IN HERE.
				echo pmpromd_show_google_map( $shortcode_atts, $theusers );
			?>
		</div> <!-- end pmpro_member_directory_before -->

		<div class="pmpro_member_directory<?php echo ( ! empty( $layout ) ? ' pmpro_member_directory-' . esc_attr( $layout ) : '' ); ?>">
			<?php
			if ( $layout == 'table' ) {
				// Show the table layout.
				?>
				<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card' ) ); ?>">
					<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_content' ) ); ?>">
						<table class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_table' ) ); ?>">
							<thead>
							<?php
								foreach ( $elements_array as $element ) {
									?>
									<th class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_directory_' . $element[1] ) ); ?>">
										<?php echo esc_html( $element[0] ); ?>
									</th>
								<?php } ?>
							</thead>
							<tbody>
								<?php
									// Loop through the users and output the content.
									foreach ( $theusers as $auser ) {
										$auser = get_userdata( $auser->ID );
										?>
										<tr id="pmpro_member_directory_row-<?php echo esc_attr( $auser->ID ); ?>" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_directory_row' ) ); ?>">
											<?php
												foreach ( $elements_array as $element ) {
													$value = pmpromd_get_display_value( $element[1], $auser, $displayed_levels );
													// Wrap the value in a link if the element is in the linked elements array.
													if ( ! empty( $link ) && ! empty( $profile_url ) && in_array( $element[1], $linked_elements ) ) {
														$value = '<a href="' . esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ) . '">' . $value . '</a>';
													}
													?>
													<td class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_directory_field-' . strtok( $element[1], '|' ) ) ); ?>"<?php echo ! empty( $element[0] ) ? ' data-title="' . esc_attr( $element[0] ) . '"' : ''; ?>>
														<?php echo wp_kses( $value, pmpromd_allowed_html() ); ?>
													</td>
													<?php
												}

												// Show the link to the user's profile.
												if ( ! empty( $link ) && ! empty( $profile_url ) ) {
													?>
													<td class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_directory_link' ) ); ?>">
														<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ); ?>"><?php esc_html_e( 'View Profile','pmpro-member-directory' ); ?></a>
													</td>
													<?php
												}
											?>
										</tr>
										<?php
									}
								?>
							</tbody>
						</table>
					</div> <!-- end pmpro_card_content -->
				</div> <!-- end pmpro_card -->
				<?php
			} else {
				foreach ( $theusers as $auser ) {
					$auser = get_userdata( $auser->ID );
					?>
					<div id="pmpro_member-<?php echo esc_attr( $auser->ID ); ?>" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_member_directory-item pmpro_card', 'pmpro_member-' . esc_attr( $auser->ID ) ) ); ?>">
						<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_content' ) ); ?>">
							<?php
								// Loop through the elements and output the content.
								foreach ( $elements_array as $element ) {
									$value = pmpromd_get_display_value( $element[1], $auser, $displayed_levels );
									if ( ! empty( $value ) || $value === '0' ) {
										// Wrap the value in a link if the element is in the linked elements array.
										if ( ! empty( $link ) && ! empty( $profile_url ) &&in_array( $element[1], $linked_elements ) ) {
											$value = '<a href="' . esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ) . '">' . $value . '</a>';
										}
										if ( 'display_name' === $element[1] ) {
											$value = '<h2 class="' . pmpro_get_element_class( 'pmpro_font-large' ) . '">' . $value . '</h2>';
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
						</div> <!-- end pmpro_card_content -->
						<?php
							// Show the link to the user's profile.
							if ( ! empty( $link ) && ! empty( $profile_url ) ) {
								?>
								<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_card_actions' ) ); ?>">
									<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ); ?>"><?php esc_html_e('View Profile','pmpro-member-directory'); ?></a>
								</div>
								<?php
							}
						?>
					</div> <!-- end pmpro_card -->
					<?php
				}
			}
			?>
		</div> <!-- end pmpro_member_directory -->

		<div class="<?php echo esc_attr( 'pmpro_member_directory_after' ); ?>">
			<?php
				/**
				 * Action to add content after the member directory.
				 *
				 * @since 0.8
				 * @param string $sqlQuery The SQL query used to get the members.
				 * @param array $shortcode_atts The attributes passed into the shortcode.
				 */
				do_action( 'pmpro_member_directory_after', $sqlQuery, $shortcode_atts );
			?>

			<?php
				/**
				 * Filter the query arguments for the pagination URL.
				 *
				 * @since 0.7
				 * @deprecated 2.0.2 The `$type` parameter is no longer used.
				 *
				 * @param array $query_args The query arguments for the pagination URL.
				 * @param string $type (deprecated) The type of pagination URL to get. This parameter is no longer used.
				 */
				$target_page_query_args = apply_filters( 'pmpromd_pagination_url', array( 'ps' => $s, 'limit' => $limit ), 'prev' );

				// Show the pagination.
				$pagination = pmpro_getPaginationString(
					$pn,
					$totalrows,
					$limit,
					1,
					esc_url( add_query_arg( $target_page_query_args, get_permalink( $post->ID ) ) ),
					'&pn=',
					__( 'Member Directory Pagination', 'pmpro-member-directory' )
				);
				echo wp_kses_post( $pagination );
			?>

		</div> <!-- end pmpro_member_directory_after -->
	</div> <!-- end pmpro -->
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode( 'pmpro_member_directory', 'pmpromd_shortcode' );
