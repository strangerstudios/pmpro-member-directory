<?php
/*
	This shortcode will display the members list and additional content based on the defined attributes.
*/
function pmpromd_shortcode($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_member_directory avatar="false" email="false" levels="1,2"]
	
	extract(shortcode_atts(array(
		'avatar' => NULL,
		'email' => NULL,
		'levels' => NULL,
		'show_level' => NULL,
		'show_search' => NULL,
		'start_date' => NULL,
		'limit' => NULL,
	), $atts));
	
	global $wpdb, $post;
	
	//turn 0's into falses
	if($avatar === "0" || $avatar === "false" || $avatar === "no")
		$avatar = false;
	else
		$avatar = true;
	
	if($email === "0" || $email === "false" || $email === "no")
		$email = false;
	else
		$email = true;

	if($show_level === "0" || $show_level === "false" || $show_level === "no")
		$show_level = false;
	else
		$show_level = true;

	if($show_search === "0" || $show_search === "false" || $show_search === "no")
		$show_search = false;
	else
		$show_search = true;

	if($start_date === "0" || $start_date === "false" || $start_date === "no")
		$start_date = false;
	else
		$start_date = true;

	ob_start();
	if(isset($_REQUEST['ps']))
		$s = $_REQUEST['ps'];
	else
		$s = "";
	
	if(isset($_REQUEST['pk']))
		$key = $_REQUEST['pk'];
	else
		$key = "";
		
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
		
	if($s)
	{
		$sqlQuery = "SELECT SQL_CALC_FOUND_ROWS u.ID, u.user_login, u.user_email, u.user_nicename, u.display_name, UNIX_TIMESTAMP(u.user_registered) as joindate, mu.membership_id, mu.initial_payment, mu.billing_amount, mu.cycle_period, mu.cycle_number, mu.billing_limit, mu.trial_amount, mu.trial_limit, UNIX_TIMESTAMP(mu.startdate) as startdate, UNIX_TIMESTAMP(mu.enddate) as enddate, m.name as membership FROM $wpdb->users u LEFT JOIN $wpdb->usermeta um ON u.ID = um.user_id LEFT JOIN $wpdb->pmpro_memberships_users mu ON u.ID = mu.user_id LEFT JOIN $wpdb->pmpro_membership_levels m ON mu.membership_id = m.id WHERE mu.status = 'active' AND mu.membership_id > 0 AND ";
		
		if(empty($key))
			$sqlQuery .= "(u.user_login LIKE '%" . esc_sql($s) . "%' OR u.user_email LIKE '%" . esc_sql($s) . "%' OR u.display_name LIKE '%" . esc_sql($s) . "%' OR um.meta_value LIKE '%" . esc_sql($s) . "s%') ";
		else
			$sqlQuery .= "(um.meta_key = '" . esc_sql($key) . "' AND um.meta_value LIKE '%" . esc_sql($s) . "%') ";
	
		if($levels)
			$sqlQuery .= " AND mu.membership_id IN(" . $levels . ") ";					
			
		$sqlQuery .= "GROUP BY u.ID ORDER BY user_registered DESC";
	}
	else
	{
		$sqlQuery = "SELECT SQL_CALC_FOUND_ROWS u.ID, u.user_login, u.user_email, u.user_nicename, u.display_name, UNIX_TIMESTAMP(u.user_registered) as joindate, mu.membership_id, mu.initial_payment, mu.billing_amount, mu.cycle_period, mu.cycle_number, mu.billing_limit, mu.trial_amount, mu.trial_limit, UNIX_TIMESTAMP(mu.startdate) as startdate, UNIX_TIMESTAMP(mu.enddate) as enddate, m.name as membership FROM $wpdb->users u LEFT JOIN $wpdb->pmpro_memberships_users mu ON u.ID = mu.user_id LEFT JOIN $wpdb->pmpro_membership_levels m ON mu.membership_id = m.id";
		$sqlQuery .= " WHERE mu.membership_id > 0  AND mu.status = 'active' ";
		if($levels)
			$sqlQuery .= " AND mu.membership_id IN(" . $levels . ") ";
		$sqlQuery .= "ORDER BY user_registered DESC";
	}

	$sqlQuery .= " LIMIT $start, $limit";
			
	$theusers = $wpdb->get_results($sqlQuery);
	$totalrows = $wpdb->get_var("SELECT FOUND_ROWS() as found_rows");
	
	ob_start();
	
	?>
	<?php if(!empty($s)) { ?>
		<h3 id="pmpro_member_directory_subheading">
			Profiles within <em><?php echo ucwords(esc_html($s)); ?></em>
		</h3>
	<?php } ?>
	
	<?php if(!empty($show_search)) { ?>	
	<form class="pmpro_member_directory_search">
		<input type="text" name="ps" size="25" value="<?php if(!empty($_REQUEST['ps'])) echo esc_attr($_REQUEST['ps']);?>" />
		<input type="hidden" name="limit" value="<?php echo esc_attr($limit);?>" />
		<input type="submit" value="Search Members" />
	</form>
	<?php } ?>
	
	<?php
		if(!empty($theusers))
		{
			?>
			<div class="pmpro_member_directory">
				<div class="pmpro_member_directory_row pmpro_member_directory_heading">
					<?php if(!empty($avatar)) { ?>										
						<div class="pmpro_member_directory_avatar">
							<?php _e('Avatar', 'pmpro'); ?>
						</div>
					<?php } ?>
					<div class="pmpro_member_directory_display-name">
						<?php _e('Member', 'pmpro'); ?>
					</div>
					<?php if(!empty($show_level)) { ?>										
						<div class="pmpro_member_directory_level">
							<?php _e('Level', 'pmpro'); ?>
						</div>
					<?php } ?>
					<?php if(!empty($start_date)) { ?>										
						<div class="pmpro_member_directory_date">
							<?php _e('Start Date', 'pmpro'); ?>
						</div>
					<?php } ?>
				</div>
				<?php
					$count = 0;			
					foreach($theusers as $auser)
					{
						$auser = get_userdata($auser->ID);
						$auser->membership_level = pmpro_getMembershipLevelForUser($auser->ID);
						$count++;
						?>
						<div id="pmpro_member_directory_row-<?php echo $auser->ID; ?>" class="pmpro_member_directory_row">
							<?php if(!empty($avatar)) { ?>										
								<div class="pmpro_member_directory_avatar">
									<?php echo get_avatar($auser->ID, 32); ?>
								</div>
							<?php } ?>
							<div class="pmpro_member_directory_display-name">
								<?php echo $auser->display_name; ?>
								<?php if(!empty($email)) { ?>										
									<br /><small><?php echo $auser->user_email; ?></small>
								<?php } ?>
							</div>
							<?php if(!empty($show_level)) { ?>										
								<div class="pmpro_member_directory_level">
									<?php echo $auser->membership_level->name; ?>
								</div>
							<?php } ?>
							<?php if(!empty($start_date)) { ?>										
								<div class="pmpro_member_directory_date">
									<?php echo date(get_option("date_format"), $auser->membership_level->startdate); ?>
								</div>
							<?php } ?>
							<div class="pmpro_clear"></div>
						</div>		
						<?php																			
					}
				?>
			</div>
			<?php
		}	
		else
		{	
			?>
			<div class="pmpro_member_directory_message pmpro_message pmpro_error">No matching profiles found<?php if($s) { ?> within <em><?php echo ucwords(esc_html($s)); ?></em>. <a href="<?php echo get_permalink(); ?>">View All Members</a><?php } else { ?>.<?php } ?></div>
			<?php					
		}

		//prev/next
		?>
		<div class="pmpro_pagination">
			<?php
			//prev
			if($pn > 1)
			{			
			?>
				<span class="pmpro_prev"><a href="<?php echo esc_url(add_query_arg(array("ps"=>$s, "pn"=>$pn-1, "limit"=>$limit), get_permalink($post->ID)));?>">&laquo; Previous</a></span>
			<?php
			}				
			//next
			if($totalrows > $end)
			{				
			?>
				<span class="pmpro_next"><a href="<?php echo esc_url(add_query_arg(array("ps"=>$s, "pn"=>$pn+1, "limit"=>$limit), get_permalink($post->ID)));?>">Next &raquo;</a></span>
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
