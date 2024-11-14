<?php
/**
 * Show the content for the [pmpromd_search] shortcode.
 *
 * @since TBD
 * @return string $content Content for the shortcode.
 */
function pmpromd_search_shortcode( ) {
	// Get the directory and profile page URLs.
	$directory_url = ! empty( $pmpro_pages['directory'] ) ? get_permalink( $pmpro_pages['directory'] ) : '';
	$profile_url = ! empty( $pmpro_pages['profile'] ) ? get_permalink( $pmpro_pages['profile'] ) : '';

	// Get the search limit.
	$limit = isset( $_REQUEST['limit'] ) ? intval( $_REQUEST['limit'] ) : 15;

	ob_start();
	?>
	<form action="<?php echo esc_url( $directory_url ); ?>" method="post" role="search" class="<?php echo pmpro_get_element_class( 'pmpro_form pmpro_member_directory_search', 'pmpro_member_directory_search' ); ?>">
		<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_fields' ) ); ?>">
			<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_field pmpro_form_field-text pmpro_form_field-ps', 'pmpro_form_field-ps' ) ); ?>">
				<label for="ps" class="screen-reader-text"><?php _e('Search for:','pmpro-member-directory'); ?></label>
				<input type="search" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_input pmpro_form_input-text' ) ); ?>" placeholder="<?php esc_attr_e( 'Search Members','pmpro-member-directory' ); ?>" name="ps" id="ps" value="<?php if(!empty($_REQUEST['ps'])) echo esc_attr($_REQUEST['ps']);?>" title="<?php esc_attr_e('Search Members','pmpro-member-directory'); ?>" />
				<input type="hidden" name="limit" value="<?php echo esc_attr( $limit );?>" />
			</div> <!-- end pmpro_form_field-ps -->
		</div> <!-- end pmpro_form_fields -->
		<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form_submit' ) ); ?>">
			<input type="submit" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_btn' ) ); ?>" value="<?php esc_attr_e( 'Submit','pmpro-member-directory'); ?>">
		</div>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'pmpromd_search', 'pmpromd_search_shortcode' );
