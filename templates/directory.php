<?php
/*
	This shortcode will display the members list and additional content based on the defined attributes.
*/
function pmpromd_shortcode($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_member_directory show_avatar="false" show_email="false" levels="1,2"]

	extract(shortcode_atts(array(
		'avatar_size' => '128',
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
		'avatar_align' => NULL
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

	if($show_avatar === "0" || $show_avatar === "false" || $show_avatar === "no"  || $show_avatar === false)
		$show_avatar = false;
	else
		$show_avatar = true;

	if($show_email === "0" || $show_email === "false" || $show_email === "no" || $show_email === false )
		$show_email = false;
	else
		$show_email = true;

	if($show_level === "0" || $show_level === "false" || $show_level === "no" || $show_level === false)
		$show_level = false;
	else
		$show_level = true;

	if($show_search === "0" || $show_search === "false" || $show_search === "no" || $show_search === false )
		$show_search = false;
	else
		$show_search = true;

	if($show_startdate === "0" || $show_startdate === "false" || $show_startdate === "no" || $show_startdate === false )
		$show_startdate = false;
	else
		$show_startdate = true;

	if(isset($_REQUEST['ps']))
		$s = $_REQUEST['ps'];
	else
		$s = "";

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

$sql_parts['ORDER'] = "ORDER BY ". esc_sql($order_by) . " " . $order . " ";

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
	<?php if(!empty($show_search)) { ?>
	<form role="search" method="post" class="<?php echo pmpro_get_element_class( 'pmpro_member_directory_search search-form', 'directory_search' ); ?>">
		<label>
			<span class="screen-reader-text"><?php _e('Search for:','pmpro-member-directory'); ?></span>
			<input type="search" class="search-field" placeholder="<?php _e('Search Members','pmpro-member-directory'); ?>" name="ps" value="<?php if(!empty($_REQUEST['ps'])) echo stripslashes( esc_attr($_REQUEST['ps']) );?>" title="<?php _e('Search Members','pmpro-member-directory'); ?>" />
      <input type="hidden" name="pn" value="1" />
			<input type="hidden" name="limit" value="<?php echo esc_attr($limit);?>" />
		</label>
		<input type="submit" class="search-submit" value="<?php _e('Search Members','pmpro-member-directory'); ?>">
	</form>
	<?php } ?>

	<h3 id="pmpro_member_directory_subheading">
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
	</h3>
	<?php
	if ( empty( $theusers ) ) {
		// If there are no users, display a message and bail early.
		?>
		<p class="pmpro_member_directory_message pmpro_message pmpro_error">
			<?php
			if ( $s ) {
				/* translators: placeholder is for search string entered */
				echo wp_kses_post( sprintf( __( 'No matching profiles found within <em>%s</em>.', 'pmpro-member-directory' ), stripslashes( ucwords( esc_html( $s ) ) ) ) );

				// If there is a directory URL, display a link to view all members.
				if ( ! empty( $directory_url ) ) {
					?>
					<a class="more-link" href="<?php echo $directory_url; ?>"><?php _e( 'View All Members','pmpro-member-directory' ); ?></a>
					<?php
				}
			} else {
				esc_html_e( 'No matching profiles found.', 'pmpro-member-directory' );
			}
			?>
		</p>
		<?php
		$temp_content = ob_get_contents();
		ob_end_clean();
		return $temp_content;
	}

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
	?>

	<?php 
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
		'show_avatar' => $show_avatar,
		'show_email' => $show_email,
		'show_level' => $show_level,
		'show_search' => $show_search,
		'show_startdate' => $show_startdate,
		'avatar_align' => $avatar_align,				
		'fields_array' => $fields_array
	) );

	do_action( 'pmpro_member_directory_before', $sqlQuery, $shortcode_atts ); ?>
	
	<div class="pmpro_member_directory<?php
		if ( ! empty( $layout ) ) {
			echo ' pmpro_member_directory-' . $layout;
		}
	?>">			
		
		<?php
		if($layout == "table") {
			// Show the header for the table.
			?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<thead>
					<?php if(!empty($show_avatar)) { ?>
						<th class="pmpro_member_directory_avatar">
							<?php _e('Avatar', 'pmpro-member-directory'); ?>
						</th>
					<?php } ?>
					<th class="pmpro_member_directory_display-name">
						<?php _e('Member', 'pmpro-member-directory'); ?>
					</th>
					<?php if(!empty($show_email)) { ?>
						<th class="pmpro_member_directory_email">
							<?php _e('Email Address', 'pmpro-member-directory'); ?>
						</th>
					<?php } ?>
					<?php if(!empty($show_level)) { ?>
						<th class="pmpro_member_directory_level">
							<?php _e('Level', 'pmpro-member-directory'); ?>
						</th>
					<?php } ?>
					<?php if(!empty($show_startdate)) { ?>
						<th class="pmpro_member_directory_date">
							<?php _e('Start Date', 'pmpro-member-directory'); ?>
						</th>
					<?php } ?>
					<?php if(!empty($fields_array)) { ?>
						<th class="pmpro_member_directory_additional">
							<?php _e('More Information', 'pmpro-member-directory'); ?>
						</th>
					<?php } ?>
					<?php if(!empty($link) && !empty($profile_url)) { ?>
						<th class="pmpro_member_directory_link">&nbsp;</th>
					<?php } ?>
				</thead>
				<tbody>
				<?php
		}

		// Loop through the users and ouptut the content.
		$count = 0;
		$data_wrapper = ( $layout == 'table' ) ? 'td' : 'p';
		foreach($theusers as $auser) {
			$auser = get_userdata($auser->ID);
			$auser->membership_level = pmpro_getMembershipLevelForUser($auser->ID);
			$fields_array = pmpromd_filter_profile_fields_for_levels( $fields_array, $auser );
			$count++;

			// Show the header for the user.
			if ( $layout == 'table' ) {
				?>
				<tr id="pmpro_member_directory_row-<?php echo $auser->ID; ?>" class="pmpro_member_directory_row<?php if(!empty($link) && !empty($profile_url)) { echo " pmpro_member_directory_linked"; } ?>">
				<?php
			} else {
				?>
				<div id="pmpro_member-<?php echo esc_attr( $auser->ID ); ?>" class="<?php echo pmpro_get_element_class( 'pmpro_member_directory-item', 'directory_item' ); ?>">
				<?php
			}

			// Show the user's avatar.
			if ( ! empty( $show_avatar ) ) {
				if ( $layout == 'table' ) {
					?>
					<td class="pmpro_member_directory_avatar">
						<?php if(!empty($link) && !empty($profile_url)) { ?>
							<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ); ?>"><?php echo get_avatar( $auser->ID, $avatar_size, NULL, $auser->user_nicename ); ?></a>
						<?php } else { ?>
							<?php echo get_avatar( $auser->ID, $avatar_size, NULL, $auser->user_nicename ); ?>
						<?php } ?>
					</td>
					<?php
				} else {
					?>
					<div class="pmpro_member_directory_avatar">
						<?php if(!empty($link) && !empty($profile_url)) { ?>
							<a class="<?php echo $avatar_align; ?>" href="<?php echo esc_url( pmpromd_build_profile_url( $auser ), $profile_url ); ?>"><?php echo get_avatar($auser->ID, $avatar_size, NULL, $auser->display_name); ?></a>
						<?php } else { ?>
							<span class="<?php echo $avatar_align; ?>"><?php echo get_avatar($auser->ID, $avatar_size, NULL, $auser->display_name); ?></span>
						<?php } ?>
					</div>
					<?php
				}
			}

			// Show the user's display name.
			if ( $layout == 'table' ) {
				// Open the td.
				?><td><?php
			}
			?>
			<h3 class="pmpro_member_directory_display-name">
				<?php if(!empty($link) && !empty($profile_url)) { ?>
					<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ), $profile_url, true ); ?>"><?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?></a>
				<?php } else { ?>
					<?php echo esc_html( pmpro_member_directory_get_member_display_name( $auser ) ); ?>
				<?php } ?>
			</h3>
			<?php
			if ( $layout == 'table' ) {
				// Close the td.
				?></td><?php
			}

			// Show the user's email address.
			if ( ! empty( $show_email ) ) {
				?>
				<<?php echo $data_wrapper; ?> class="pmpro_member_directory_email">
					<?php echo pmpromd_format_profile_field( $auser->user_email, 'user_email' ); ?>
				</<?php echo $data_wrapper; ?>>
				<?php
			}

			// Show the user's membership level.
			if ( ! empty( $show_level ) ) {
				// If the layout is not a table, print "level" as a header.
				if ( $layout !== 'table' ) {
					?>
					<strong><?php _e('Level', 'pmpro-member-directory'); ?></strong>
					<?php
				}
				?>
				<<?php echo $data_wrapper; ?> class="pmpro_member_directory_level">
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
				</<?php echo $data_wrapper; ?>>
				<?php
			}

			// Show the user's start date.
			if ( ! empty( $show_startdate ) ) {
				// If the layout is not a table, print "Start Date" as a header.
				if ( $layout !== 'table' ) {
					?>
					<strong><?php _e('Start Date', 'pmpro-member-directory'); ?></strong>
					<?php
				}
				?>
				<<?php echo $data_wrapper; ?> class="pmpro_member_directory_date">
					<?php echo date_i18n( get_option( 'date_format' ), $auser->membership_level->startdate ); ?>
				</<?php echo $data_wrapper; ?>>
				<?php
			}

			// Show additional fields.
			if ( ! empty( $fields_array ) ) {
				// If the layout is a table, open the td.
				if ( $layout == 'table' ) {
					?><td class="pmpro_member_directory_additional"><?php
				}

				foreach($fields_array as $field) {
					// Fix for a trailing space in the 'fields' shortcode attribute.
					if ( $field[0] === '' ) {
						break;
					}

					$meta_field = $auser->{$field[1]};
					if ( ! empty( $meta_field ) ) {
						?>
						<p class="pmpro_member_directory_<?php echo $field[1]; ?>">
							<?php
							if ( is_array( $meta_field ) && ! empty( $meta_field['filename'] ) ) {
								// This is a file field.
								?>
								<strong><?php echo $field[0]; ?></strong>
								<?php echo pmpromd_display_file_field($meta_field); ?>
								<?php
							} elseif ( is_array( $meta_field ) ) {
								// This is a general array, check for Register Helper options first.
								if ( ! empty( $rh_fields[$field[1]] ) ) {
									foreach($meta_field as $key => $value) {
										$meta_field[$key] = $rh_fields[$field[1]][$value];
									}
								}
								?>
								<strong><?php echo $field[0]; ?></strong>
								<?php echo implode( ", ",$meta_field ); ?>
								<?php
							} elseif ( ! empty( $rh_fields[$field[1]] ) && is_array( $rh_fields[$field[1]] ) ) {
								?>
								<strong><?php echo $field[0]; ?></strong>
								<?php echo $rh_fields[$field[1]][$meta_field]; ?>
								<?php
							} elseif($field[1] == 'user_url') {	
								echo pmpromd_format_profile_field( $meta_field, $field[1], $field[0] );
							} else {
								?>
								<strong><?php echo $field[0]; ?></strong>
								<?php
								echo pmpromd_format_profile_field( $auser->{$field[1]}, $field[1] );
							}
							?>
						</p>
						<?php
					}
				}

				// If the layout is a table, close the td.
				if ( $layout == 'table' ) {
					?></td><?php
				}	
			}

			// Show the link to the user's profile.
			if ( ! empty( $link ) && ! empty( $profile_url ) ) {
				?>
				<<?php echo $data_wrapper; ?> class="pmpro_member_directory_link">
					<a href="<?php echo esc_url( pmpromd_build_profile_url( $auser, $profile_url ) ); ?>"><?php _e('View Profile','pmpro-member-directory'); ?></a>
				</<?php echo $data_wrapper; ?>>
				<?php
			}

			// Show the footer for the user.
			if ( $layout == 'table' ) {
				?>
				</tr>
				<?php
			} else {
				?>
				</div> <!-- end pmpro_member_directory-item -->
				<?php
			}
		} // end foreach

		if($layout == "table") {
			// Show the footer for the table.
			?>
				</tbody>
			</table>
			<?php
		}
		?>
	</div> <!-- end pmpro_member_directory -->
	<?php
	do_action( 'pmpro_member_directory_after', $sqlQuery, $shortcode_atts );
	
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

		if( round( $number_of_pages, 0 ) === 1 ) {
			//If there's only one page, no need to show the page numbers
			for( $i = $pn; $i <= $number_of_pages+1; $i++ ){
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
	</div>
	<?php
	?>
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode("pmpro_member_directory", "pmpromd_shortcode");
