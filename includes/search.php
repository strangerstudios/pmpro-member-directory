<?php
/**
 * Function to display the search form for the member directory.
 *
 * @since TBD
 * @return string $content The search form for the member directory.
 */
function pmpromd_search_form() {
	global $pmpro_pages;

	// Get the directory page URL.
	$directory_url = ! empty( $pmpro_pages['directory'] ) ? get_permalink( $pmpro_pages['directory'] ) : '';

	// Get the limit for the search results.
	$limit = ! empty( $_REQUEST['limit'] ) ? intval( $_REQUEST['limit'] ) : 10;
	?>
	<form action="<?php echo esc_url( $directory_url ); ?>" method="post" role="search" class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro_form pmpro_member_directory_search', 'pmpro_member_directory_search' ) ); ?>">
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
	<?php
}
