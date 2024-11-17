<?php
/**
 * Deprecated hooks, filters and functions
 *
 * @since TBD
 */

/**
 * Check for deprecated filters.
 */
function pmpromd_init_check_for_deprecated_filters() {
	global $wp_filter;

	// Deprecated filter name => new filter name (or null if there is no alternative).
	$pmpromd_map_deprecated_filters = array(
		'pmpro_member_profile_fields' => 'pmpro_member_profile_elements',
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
