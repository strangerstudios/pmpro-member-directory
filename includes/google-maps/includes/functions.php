<?php
/**
 * All map related functions to be used in this file.
 */

/**
 * A wrapper function to build and display a Google Map. This replaces the previous membership_map shortcode.
 *
 * @since TBD
 * 
 * @param array $attributes An array of attributes for the Google Map, often passed by a shortcode or block.
 * @param array $members An array of members to be displayed on the map. This is optional and can be used to filter the markers shown. (///TODO)
 * @return string $map_output The HTML output for the Google Map.
 */
function pmpromd_show_google_map( $attributes, $members ) {

	// Only show the map if the 'show_map' attribute is set to true.
	// if ( $attributes['show_map'] === false ) {
	// 	return;
	// }

	// Make sure we have the Maps API key, if it's not set we shouldn't try to do anything.
	$maps_api_key = get_option( 'pmpro_pmpromm_api_key' );
	if ( empty( $maps_api_key ) ) {
		return;
	}

	// //Extract the array $attributes so we can use them directly without doing $attributes['key'] all the time.
	extract( $attributes );

	/**
	 * @deprecated TBD - use `pmpromd_map_id` instead.
	 */
	$map_id = sanitize_text_field( apply_filters_deprecated( 'pmpromm_map_id', array( '1' ), 'pmpromd_map_id', 'TBD' ) );

	/**
	 * A unique identifier for the map, should we want styling and some recipes rely on it.
	 * 
	 * @since TBD
	 * 
	 * @param string $map_id The ID of the map.
	 * @param array $attributes The attributes passed to the map.
	 */
	$map_id = apply_filters( 'pmpromd_map_id', $map_id, $attributes );

	/**
	 * Adjust the notice that is displayed when the map fails to load.
	 * @deprecated TBD
	 */
	$notice = apply_filters_deprecated(
		'pmpromm_default_map_notice',
		array( __( 'This map could not be loaded. Please ensure that you have entered your Google Maps API Key and that there are no JavaScript errors on the page.', 'pmpro-member-directory' ) ),
		'pmpromd_map_failed_to_load_notice',
		'TBD'
	);
	
	/**
	 * Adjust the notice that is displayed when the map fails to load.
	 * 
	 * @since TBD
	 * 
	 * @param string $notice The notice to display when the map fails to load.
	 * @param string $map_id The ID of the map that failed to load.
	 */
	$notice = apply_filters( 'pmpromd_map_failed_to_load_notice', $notice, $map_id );

	//Get the marker data
	$marker_data = pmpromd_generate_marker_data( $members, $attributes );

	// Enqueue jQuery.
	// wp_enqueue_script( 'jquery' );

	/**
	 * Filter the map styles.
	 *
	 * @deprecated TBD - use `pmpromd_map_styles` instead.
	 *
  	 * @param string $styles JSON string of map styles
	 * @param string $map ID of the current map
	 */
	$map_styles = apply_filters_deprecated( 'pmpromm_map_styles', array( '', $map_id ), 'pmpromd_map_styles', 'TBD'  );

	/**
	 * Filter the style of the map.
	 * 
	 * @since TBD
	 * 
	 * @param string $map_styles JSON string of map styles.
	 * @param string $map_id The ID of the map.
	 */
	$map_styles = apply_filters( 'pmpromd_map_styles', $map_styles, $map_id );
	
	//Remove spaces and new lines from the styles
	$map_styles = trim( $map_styles );
	$map_styles = str_replace( " ", "", $map_styles );
	$map_styles = preg_replace( "/\n+/", "", $map_styles );
	$map_styles = preg_replace( "/\s+/", "", $map_styles );

	/**
	 * Add any additional query parameters to the Google Maps API request. Such as libraries etc.
	 * 
	 * @since TBD
	 * 
	 * @param array $query_params An array of query parameters to be added to the Google Maps API request.
	 */
	$query_params = apply_filters( 'pmpromd_maps_query_params', array( 
		'key' => $maps_api_key,
		'callback' => 'pmpromm_init_map', 
		'loading' => 'async', 
		'v' => '3', 
		'style' => $map_styles 
	) );

	// Let's work through the query parameters and clean/sanitize them.
	$query_params = array_map( 'sanitize_text_field', $query_params );

	wp_enqueue_script( 'pmpromd-google-maps', add_query_arg( $query_params, 'https://maps.googleapis.com/maps/api/js' ), array(), PMPRO_MEMBER_DIRECTORY_VERSION, array( 'strategy'  => 'async' ) );
	wp_register_script( 'pmpromd-google-maps-javascript', plugin_dir_url( dirname( __FILE__ ) ) . 'js/map.js', array( 'jquery' ), PMPRO_MEMBER_DIRECTORY_VERSION ); // This changes to `map.js`
	/**
	 * Setup defaults for the map. We're passing through the map_id attribute
	 * to allow developers to differentiate maps. 
	 */
	wp_localize_script( 'pmpromd-google-maps-javascript', 'pmpromm_vars', array(
		'default_start' => apply_filters( 'pmpromm_default_map_start', array( 'lat' => -34.397, 'lng' => 150.644 ), $map_id ),
		'override_first_marker_location' => apply_filters( 'pmpromm_override_first_marker', '__return_false', $map_id ),
		'infowindow_width' => $map_infowindow_width,
		'marker_data' => $marker_data,
		'zoom_level' => $map_zoom,
		'max_zoom' => $map_max_zoom,
		'infowindow_classes' => pmpro_get_element_class( 'pmpromm_infowindow' ),
		'map_styles' => $map_styles		
	) );

	wp_enqueue_script( 'pmpromd-google-maps-javascript' );

	return "<div id='pmpromm_map' class='pmpromm_map pmpro_map_id_" . esc_attr( $map_id ) . "' style='height: " . esc_attr( $map_height ) . "px; width: " . esc_attr( $map_width ) . "%;'>" . esc_html( $notice ) . "</div>";
}


/**
 * Generate the marker data for the Google Maps.
 *
 * @param Object $members An array of members (WP_User or stdClass) to be displayed on the map.
 * @param array $marker_attributes An array of marker attributes.
 * @return array $marker_array An array of marker data to be used in the Google Maps and output.
 */
function pmpromd_generate_marker_data( $members, $marker_attributes ) {

	global $wpdb, $post, $pmpro_pages, $pmprorh_registration_fields;

	$show_avatar = filter_var( $marker_attributes['show_avatar'], FILTER_VALIDATE_BOOLEAN );
	$link = filter_var( $marker_attributes['link'], FILTER_VALIDATE_BOOLEAN );
	$show_email = filter_var( $marker_attributes['show_email'], FILTER_VALIDATE_BOOLEAN );
	$show_level = filter_var( $marker_attributes['show_level'], FILTER_VALIDATE_BOOLEAN );
	$show_startdate = filter_var( $marker_attributes['show_startdate'], FILTER_VALIDATE_BOOLEAN );

	//// Fix to "Elements" but fallback to Fields. See how the core does it.
	if( !empty( $marker_attributes['fields'] ) ) {
		// Check to see if the Block Editor is used or the shortcode.
		if ( strpos( $marker_attributes['fields'], "\n" ) !== FALSE ) {
			$fields = rtrim( $marker_attributes['fields'], "\n" ); // clear up a stray \n
			$fields_array = explode("\n", $marker_attributes['fields']); // For new block editor.
		} else {
			$fields = rtrim( $marker_attributes['fields'], ';' ); // clear up a stray ;
			$fields_array = explode(";",$marker_attributes['fields']);
		}
		if( !empty( $fields_array ) ){
			for($i = 0; $i < count($fields_array); $i++ ){
				$fields_array[$i] = explode(",", trim($fields_array[$i]));
			}
		}
	} else {
		$fields_array = false;
	}

	//// OLD REMOVE IT, convert to user fields. We can avoid support RH.
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

	// Let's put all the marker data together to display on the map.
	$marker_array = array();
	if ( ! empty( $members ) ) {
		foreach( $members as $member ){
			// If the $member isn't an object, we should skip it.
			if ( ! is_object( $member ) ) {
				continue;
			}

			$member_array = array();

			// Assume $member is now a WP_User or stdClass object
			$member_address = isset( $member->maplocation ) ? maybe_unserialize( $member->maplocation ) : array();

			// If it's an empty array, but the member has old lat/lng, we should use that.
			if ( empty( $member_address ) ) {
				if ( ! empty( $member->old_lat ) ) {
					$member_address['old_lat'] = $member->old_lat;
					$member_address['old_lng'] = $member->old_lng;
				} else {
					$member_address['old_lat'] = get_user_meta( $member->ID, 'pmpro_lat', true );
					$member_address['old_lng'] = get_user_meta( $member->ID, 'pmpro_lng', true );
				}

				// If we still don't have lat/lng, we should skip this member.
				if ( empty( $member_address['old_lat'] ) || empty( $member_address['old_lng'] ) ) {
					continue;
				}
			}

			// Backwards compatibility for older members that are upgrading.
			if ( ! isset( $member_address['optin'] ) && ! empty( $member_address['old_lat' ] ) ) {
				$member_address['optin'] = true;
			}

			//If the user has not opted in, we should not display their location on the map.
			if ( empty( $member_address['optin'] ) ) {
				continue;
			}

			if ( empty( $member_address['latitude'] ) && isset($member_address['old_lat']) && $member_address['old_lat'] !== NULL && isset($member_address['old_lng']) && $member_address['old_lng'] !== NULL ) {
				//If we don't have a new address, check for a valid old address
				$member_array['marker_meta']['lat'] = $member_address['old_lat'];
				$member_array['marker_meta']['lng'] = $member_address['old_lng'];
			} else {
				$member_array['marker_meta']['lat'] = $member_address['latitude'];
				$member_array['marker_meta']['lng'] = $member_address['longitude'];
			}

			$member_array['ID'] = $member->ID;
			$member->meta = get_user_meta( $member->ID );
			$profile_url = get_permalink( $pmpro_pages['profile'] );
			
			$name_content = "";
			$name_content .= '<h2 class="' . esc_attr( pmpro_get_element_class( 'pmpromm_display-name' ) ) . '">';
				if( !empty( $link ) && !empty( $profile_url ) ) {	
					$user_profile = pmpromd_build_profile_url( $member, $profile_url );			
					$name_content .= '<a href="' . esc_url( $user_profile ) . '">' . esc_html( $member->display_name ) . '</a>';
				} else {
					$name_content .= esc_html( $member->display_name );
				}
			$name_content .= '</h2>';

			//This will allow us to hook into the content and add custom fields from RH
			$avatar_content = "";
			if( $show_avatar ){
				$avatar_align = ( !empty( $marker_attributes['avatar_align'] ) ) ? $marker_attributes['avatar_align'] : "";
				$avatar_content .= '<div class="' . esc_attr( pmpro_get_element_class( 'pmpromm_avatar' ) ) . '">';
					if ( ! empty( $marker_attributes['link'] ) && ! empty( $profile_url ) ) {
						$user_profile = pmpromd_build_profile_url( $member, $profile_url );		
						$avatar_content .= '<a class="' . esc_attr( pmpro_get_element_class( $avatar_align ) ) . '" href="' . esc_url( $user_profile ) . '">' . get_avatar( $member->ID, $marker_attributes['avatar_size'], NULL, $member->display_name ) . '</a>';
					} else {
						$avatar_content .= '<span class="' . esc_attr( pmpro_get_element_class( $avatar_align ) ) . '">' . get_avatar( $member->ID, $marker_attributes['avatar_size'], NULL, $member->display_name ) . '</span>';
					}
				$avatar_content .= '</div>';
			}

			$email_content = "";
			if ( $show_email ) {
				$email_content .= '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromm_email' ) ) . '">';
					$email_content .= '<strong>' . esc_html__( 'Email Address', 'pmpro-membership-maps' ) . '</strong>&nbsp;';
					$email_content .= esc_html( $member->user_email );
				$email_content .= '</p>';
			}

			// We may need to get all of the user's levels for MMPU compatibility. Declaring a variable here to hold that data.
			$user_levels = null;

			$level_content = "";
			if ( $show_level ) {
				$user_levels = pmpro_getMembershipLevelsForUser( $member->ID );
				$level_content .= '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromm_level' ) ) . '">';
				if ( count ( $user_levels ) > 1 ) {
					$level_content .= '<strong>' . esc_html__( 'Levels', 'pmpro-membership-maps' ) . '</strong>&nbsp;';
					$level_content .= implode( ', ', wp_list_pluck( $user_levels, 'name' ) );
				} else {
					$level_content .= '<strong>' . esc_html__( 'Level', 'pmpro-membership-maps' ) . '</strong>&nbsp;';
					$level_content .= esc_html( $user_levels[0]->name );
				}
				$level_content .= '</p>';
			}

			$startdate_content = "";
			if ( $show_startdate ) {
				// Make sure that we have the user's levels.
				if ( empty( $user_levels ) ) {
					$user_levels = pmpro_getMembershipLevelsForUser( $member->ID );
				}

				// Calculate their oldest startdate.
				$min_startdate = null;
				foreach( $user_levels as $level ) {
					if ( empty( $min_startdate ) || $level->startdate < $min_startdate ) {
						$min_startdate = $level->startdate;
					}
				}

				// Display the start date.
				$startdate_content .= '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromm_date' ) ) . '">';
				$startdate_content .= '<strong>' . esc_html__( 'Start Date', 'pmpro-membership-maps' ) . '</strong>&nbsp;';
				$startdate_content .= date_i18n( get_option( 'date_format' ), $min_startdate );
				$startdate_content .= '</p>';
			}

			// We should get rid of the user levels now so that it doesn't affect future loop iterations.
			unset( $user_levels );

			$profile_content = "";
			if ( ! empty( $link ) && ! empty( $profile_url ) ) {
				$user_profile = pmpromd_build_profile_url( $member, $profile_url );
				$profile_content .= '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromm_profile' ) ) . '"><a href="' . esc_url( $user_profile ) . '">' . esc_html( apply_filters( 'pmpromm_view_profile_text', __( 'View Profile', 'pmpro-membership-maps' ) ) ) . '</a></p>';				
			}

			$rhfield_content = "";

			if( !empty( $fields_array ) ){
				foreach( $fields_array as $field ){
					
					if ( WP_DEBUG ) {
						error_log("Content of field data: " . print_r( $field, true));
					}

					// Fix for a trailing space in the 'fields' shortcode attribute.
					if ( $field[0] === '' || empty( $field[1] ) ) {
						break;
					}

					if( !empty( $member->meta[$field[1]] ) || !empty( $member->{$field[1]} ) ){

						$current_field_key = $field[0];
						if( isset( $member->meta[$field[1]] ) ) {
							$current_field_val = reset( $member->meta[$field[1]] );
						} else {
							$current_field_val = $member->{$field[1]};
						}

						$rhfield_content .= '<p class="' . esc_attr( pmpro_get_element_class( 'pmpromm_'.$current_field_key ) ) . '">';
						if( is_array( $field ) && !empty( $field['filename'] ) ){
							//this is a file field
							$rhfield_content .= '<strong>' . esc_html( $current_field_key ) . '</strong>';
							$rhfield_content .= pmpromm_display_file_field($member->meta[$field[1]]);
						} elseif ( is_array( $field ) ){
							$cf_field = array();
							//this is a general array, check for Register Helper options first
							if(!empty($rh_fields[$field[1]])) {								
								foreach($field as $key => $value){
									$cf_field[$current_field_key] = $rh_fields[$field[1]][$current_field_val];
								}
							} else {
								$current_field_val = maybe_unserialize( $current_field_val );
								if( is_array( $current_field_val ) ) {
									//Adds support for serialized fields (typically multiselect)
									$cf_field[] = implode( ", ", $current_field_val );
								} else {
									// Check if the field is a valid URL and then try to make it clickable.
									if ( wp_http_validate_url( $current_field_val ) ) {
										$current_field_val = make_clickable( $current_field_val );
									}
									$cf_field[] = $current_field_val;	
								}
							}
							$rhfield_content .= '<strong>' . esc_html( $current_field_key ) . '</strong> ';
							$rhfield_content .= wp_kses_post( implode( ', ', $cf_field ) );
						} elseif ( !empty( $rh_fields[$field[1]] ) && is_array( $rh_fields[$field[1]] ) ) {
							$rhfield_content .= '<strong>' . esc_html( $current_field_val ) . '</strong>';
							$rhfield_content .= wp_kses_post( $rh_fields[$field[1]][$current_field] );
						} else {
							$rhfield_content .= '<strong>' . esc_html( $field[0] ) . ':</strong>';
							$rhfield_content .= make_clickable( $member->{$field[1]} );
						}

						$rhfield_content .= '</p>';

					}
				}
			}

			$marker_content_order = apply_filters( 'pmpromm_marker_content_order', array(
				'name' 		=> $name_content,
				'avatar' 	=> $avatar_content,
				'email' 	=> $email_content,
				'level'		=> $level_content,
				'startdate' => $startdate_content,
				'rh_fields'	=> $rhfield_content,
				'profile'	=> $profile_content,
			) );

			$member_array['marker_content'] = implode( " ", $marker_content_order );

			$member_array['marker_content'] = apply_filters( 'pmpromm_single_marker_content', $member_array['marker_content'], $member );

			$marker_array[] = $member_array;
		}
	}

	return $marker_array;

}
