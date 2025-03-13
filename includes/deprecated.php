<?php
/**
 * Deprecated hooks, filters and functions
 *
 * @since 2.0
 */

/**
 * Check for deprecated filters.
 */
function pmpromd_init_check_for_deprecated_filters() {
	global $wp_filter;

	// Deprecated filter name => new filter name (or null if there is no alternative).
	$pmpromd_map_deprecated_filters = array(
		'pmpro_member_profile_fields' => 'pmpro_member_profile_elements',
		'pmpro_member_directory_fields' => 'pmpro_member_directory_elements',
	);
	
	foreach ( $pmpromd_map_deprecated_filters as $old => $new ) {
		if ( has_filter( $old ) ) {
			if ( ! empty( $new ) ) {
				// We have an alternative filter. Let's show an error message and forward to that new filter.
				/* translators: 1: the old hook name, 2: the new or replacement hook name */
				trigger_error( esc_html( sprintf( esc_html__( 'The %1$s hook has been deprecated in the Member Directory Add On for Paid Memberships Pro. Please use the %2$s hook instead.', 'pmpro-member-directory' ), $old, $new ) ) );
				
				// Add filters back using the new tag.
				foreach( $wp_filter[$old]->callbacks as $priority => $callbacks ) {
					foreach( $callbacks as $callback ) {
						add_filter( $new, $callback['function'], $priority, $callback['accepted_args'] ); 
					}
				}
			} else {
				// We don't have an alternative filter. Let's just show an error message.
				/* translators: 1: the old hook name */
				trigger_error( esc_html( sprintf( esc_html__( 'The %1$s hook has been deprecated in  Member Directory Add On for Paid Memberships Pro and may not be available in future versions.', 'pmpro-member-directory' ), $old ) ) );
			}
		}
	}
}
add_action( 'init', 'pmpromd_init_check_for_deprecated_filters', 99 );

/**
 * @deprecated TBD
 */
function pmpromd_show_extra_profile_fields( $user ) {
	_deprecated_function( __FUNCTION__, 'TBD' );
}

/**
 * @deprecated TBD
 */
function pmpromd_save_extra_profile_fields( $user_id ) {
	_deprecated_function( __FUNCTION__, 'TBD' );
}

/**
 * @deprecated TBD
 */
function pmpromd_filter_profile_fields_for_levels( $profile_fields, $pu ) {
	_deprecated_function( __FUNCTION__, 'TBD' );
	global $pmprorh_registration_fields;

	$fields_to_hide = array();

	if(!empty($pmprorh_registration_fields)) {
		
		//Loop through all of the RH fields
		foreach($pmprorh_registration_fields as $where => $fields) {

			//cycle through fields
			foreach($fields as $field){
				//Check if there are any levels associated with this field	
				if( !empty( $field->levels ) ){
					//Check if the member has the required level to view this
					if( !pmpro_hasMembershipLevel( $field->levels, $pu->ID ) ){
						//If not, lets hide this field from them
						$fields_to_hide[] = $field->name;
					}
				}
				
				
			}

		}
	}
	$fields_to_show = array();

	if( !empty( $profile_fields ) ) {

		//Lets loop through all of the profile fields that we 'should' display
		foreach( $profile_fields as $field_array ){
			//Check if the current field is in the fields_to_hide array
			if( ! in_array( $field_array[1], $fields_to_hide ) ) {
				//It isn't in the array so we want to show this field
				$fields_to_show[] = $field_array;
			}
		}

	}

	return $fields_to_show;
}