<?php
/*
	This shortcode will display the profile for the user ID specified in the URL and additional content based on the defined attributes.
*/
function pmpromd_profile_preheader()
{
	global $post, $pmpro_pages, $current_user;
	if(!empty($post->ID) && $post->ID == $pmpro_pages['profile'])
	{
		/*
			Preheader operations here.
		*/			
		global $main_post_id;
		$main_post_id = $post->ID;
		
		//Get the profile user
		if(!empty($_REQUEST['pu']) && is_numeric($_REQUEST['pu']))
			$pu = get_user_by('id', $_REQUEST['pu']);
		elseif(!empty($_REQUEST['pu']))
			$pu = get_user_by('slug', $_REQUEST['pu']);
		elseif(!empty($current_user->ID))
			$pu = $current_user;
		else
			$pu = false;
		
		//If no profile user, go to directory or home
		if(empty($pu) || empty($pu->ID))
		{
			if(!empty($pmpro_pages['directory']))
				wp_redirect(get_permalink($pmpro_pages['directory']));
			else
				wp_redirect(home_url());
			exit;
		}
		
		/*
			If a level is required for the profile page, make sure the profile user has it.
		*/
		//check is levels are required
		$levels = pmpro_getMatches("/ levels?=[\"']([^\"^']*)[\"']/", $post->post_content, true);
		if(!empty($levels) && !pmpro_hasMembershipLevel(explode(",", $levels), $pu->ID))
		{
			if(!empty($pmpro_pages['directory']))
				wp_redirect(get_permalink($pmpro_pages['directory']));
			else
				wp_redirect(home_url());
			exit;
		}
				
		/*
			Update the head title and H1
		*/
		function pmpromd_the_title($title, $post_id = NULL)
		{				
			global $main_post_id, $current_user;
			if($post_id == $main_post_id)
			{
				if(!empty($_REQUEST['pu']))
				{
					global $wpdb;				
					$user_nicename = $_REQUEST['pu'];
					$display_name = $wpdb->get_var("SELECT display_name FROM $wpdb->users WHERE user_nicename = '" . esc_sql($user_nicename) . "' LIMIT 1");
				}
				elseif(!empty($current_user))
				{			
					$display_name = $current_user->display_name;					
				}
				if(!empty($display_name))
					$title = $display_name;
			}			
			return $title;
		}
		add_filter("the_title", "pmpromd_the_title", 10, 2);
		
		function pmpromd_wp_title($title, $sep)
		{
			global $wpdb, $main_post_id, $post, $current_user;
			if($post->ID == $main_post_id)
			{	
				if(!empty($_REQUEST['pu']))
				{
					$user_nicename = $_REQUEST['pu'];
					$display_name = $wpdb->get_var("SELECT display_name FROM $wpdb->users WHERE user_nicename = '" . esc_sql($user_nicename) . "' LIMIT 1");					
				}
				elseif(!empty($current_user))
				{			
					$display_name = $current_user->display_name;					
				}
				if(!empty($display_name))
				{
					$title = $display_name . ' ' . $sep . ' ';
				}
				$title .= get_bloginfo( 'name' );
			}
			return $title;
		}
		add_filter("wp_title", "pmpromd_wp_title", 10, 2);
	}
}
add_action("wp", "pmpromd_profile_preheader", 1);	

function pmpromd_profile_shortcode($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_member_profile avatar="false" email="false"]
	
	extract(shortcode_atts(array(
		'avatar_size' => '128',
		'fields' => NULL,
		'show_avatar' => NULL,
		'show_bio' => NULL,
		'show_billing' => NULL,
		'show_email' => NULL,
		'show_level' => NULL,
		'show_name' => NULL,
		'show_phone' => NULL,
		'show_search' => NULL,
		'show_startdate' => NULL,
		'user_id' => NULL
	), $atts));
	
	global $current_user, $display_name, $wpdb, $pmpro_pages, $pmprorh_registration_fields;
	
	//some page vars
	if(!empty($pmpro_pages['directory']))
		$directory_url = get_permalink($pmpro_pages['directory']);
	else
		$directory_url = "";
	if(!empty($pmpro_pages['profile']))
		$profile_url = get_permalink($pmpro_pages['profile']);
	
	//turn 0's into falses
	if($show_avatar === "0" || $show_avatar === "false" || $show_avatar === "no")
		$show_avatar = false;
	else
		$show_avatar = true;
		
	if($show_billing === "0" || $show_billing === "false" || $show_billing === "no")
		$show_billing = false;
	else
		$show_billing = true;
		
	if($show_bio === "0" || $show_bio === "false" || $show_bio === "no")
		$show_bio = false;
	else
		$show_bio = true;
	
	if($show_email === "0" || $show_email === "false" || $show_email === "no")
		$show_email = false;
	else
		$show_email = true;

	if($show_level === "0" || $show_level === "false" || $show_level === "no")
		$show_level = false;
	else
		$show_level = true;
	
	if($show_name === "0" || $show_name === "false" || $show_name === "no")
		$show_name = false;
	else
		$show_name = true;
		
	if($show_phone === "0" || $show_phone === "false" || $show_phone === "no")
		$show_phone = false;
	else
		$show_phone = true;

	if($show_search === "0" || $show_search === "false" || $show_search === "no")
		$show_search = false;
	else
		$show_search = true;

	if($show_startdate === "0" || $show_startdate === "false" || $show_startdate === "no")
		$show_startdate = false;
	else
		$show_startdate = true;
	
	if(isset($_REQUEST['limit']))
		$limit = intval($_REQUEST['limit']);
	elseif(empty($limit))
		$limit = 15;

	if(empty($user_id) && !empty($_REQUEST['pu']))		
	{
		//Get the profile user
		if(is_numeric($_REQUEST['pu']))
			$pu = get_user_by('id', $_REQUEST['pu']);
		else
			$pu = get_user_by('slug', $_REQUEST['pu']);

		$user_id = $pu->ID;
	}

	if(!empty($user_id))
		$pu = get_userdata($user_id);
	elseif(empty($_REQUEST['pu']))
		$pu = get_userdata($current_user->ID);

	if(!empty($pu))
		$pu->membership_level = pmpro_getMembershipLevelForUser($pu->ID);

	ob_start();

	?>
	<?php if(!empty($show_search)) { ?>
	<form action="<?php echo $directory_url; ?>" method="post" role="search" class="pmpro_member_directory_search search-form">
		<label>
			<span class="screen-reader-text"><?php _e('Search for:','label'); ?></span>
			<input type="search" class="search-field" placeholder="<?php _e('Search Members','pmpromd'); ?>" name="ps" value="<?php if(!empty($_REQUEST['ps'])) echo esc_attr($_REQUEST['ps']);?>" title="<?php _e('Search Members','pmpromd'); ?>" />
			<input type="hidden" name="limit" value="<?php echo esc_attr($limit);?>" />
		</label>
		<input type="submit" class="search-submit" value="<?php _e('Search Members','pmpromd'); ?>">
	</form>
	<?php } ?>
	<?php
		if(!empty($pu))
		{
			if(!empty($fields))
			{
				$fields_array = explode(";",$fields);
				if(!empty($fields_array))
				{
					for($i = 0; $i < count($fields_array); $i++ )
						$fields_array[$i] = explode(",", $fields_array[$i]);
				}
			}
			else
				$fields_array = false;

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
			<div id="pmpro_member_profile-<?php echo $pu->ID; ?>" class="pmpro_member_profile">
				<?php if(!empty($show_avatar)) { ?>										
					<p class="pmpro_member_directory_avatar">
						<?php echo get_avatar($pu->ID, $avatar_size, NULL, $pu->display_name, array("class"=>"alignright")); ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_name) && !empty($pu->display_name) ) { ?>										
					<h2 class="pmpro_member_directory_name">
						<?php echo $pu->display_name; ?>
					</h2>
				<?php } ?>
				<?php if(!empty($show_bio) && !empty($pu->description) ) { ?>										
					<p class="pmpro_member_directory_bio">
						<strong><?php _e('Biographical Info', 'wp'); ?></strong>
						<?php echo $pu->description; ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_email)) { ?>										
					<p class="pmpro_member_directory_email">
						<strong><?php _e('Email Address', 'pmpro'); ?></strong>
						<?php echo $pu->user_email; ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_level)) { ?>										
					<p class="pmpro_member_directory_level">
						<strong><?php _e('Level', 'pmpro'); ?></strong>
						<?php echo $pu->membership_level->name; ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_startdate)) { ?>										
					<p class="pmpro_member_directory_date">
						<strong><?php _e('Start Date', 'pmpro'); ?></strong>
						<?php echo date(get_option("date_format"), $pu->membership_level->startdate); ?>
					</p>
				<?php } ?>
				<?php if(!empty($show_billing) && !empty($pu->pmpro_baddress1)) { ?>										
					<p class="pmpro_member_directory_baddress">
						<strong><?php _e('Address', 'pmpro'); ?></strong>
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
						<strong><?php _e('Phone Number','pmpro'); ?></strong>
						<?php echo formatPhone($pu->pmpro_bphone); ?>
					</p>
				<?php } ?>
				<?php 
					//filter the fields
					$fields_array = apply_filters('pmpro_member_profile_fields', $fields_array, $pu);
					
					if(!empty($fields_array))
					{
						foreach($fields_array as $field)
						{
							if(empty($field[0]))
								break;							
							$meta_field = $pu->$field[1];
							if(!empty($meta_field))
							{
								?>
								<p class="pmpro_member_directory_<?php echo esc_attr($field[1]); ?>">
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
									}								
									else
									{
										if($field[1] == 'user_url')
										{
											?>
											<a href="<?php echo esc_url($meta_field); ?>" target="_blank"><?php echo $field[0]; ?></a>
											<?php
										}
										else
										{
											?>
											<strong><?php echo $field[0]; ?></strong>
											<?php
												$meta_field_embed = wp_oembed_get($meta_field);
												if(!empty($meta_field_embed))
													echo $meta_field_embed;
												else
													echo make_clickable($meta_field); 
											?>
											<?php
										}
									}
								?>
								</p>
								<?php
							}
						}
					}
				?>
				<div class="pmpro_clear"></div>
			</div>
			<hr />
			<?php if(!empty($directory_url)) { ?>
				<div align="center"><a class="more-link" href="<?php echo $directory_url;?>"><?php _e('View All Members','pmpromd'); ?></a></div>
			<?php } ?>
			<?php
		}	
	?>
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode("pmpro_member_profile", "pmpromd_profile_shortcode");
