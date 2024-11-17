<?php
/**
 * Show the content for the [pmpro_member_directory_search] shortcode.
 */
function pmpromd_search_shortcode() {
	ob_start();
	?>
	<div class="<?php echo esc_attr( pmpro_get_element_class( 'pmpro' ) ); ?>">
		<?php pmpromd_search_form(); ?>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
add_shortcode( 'pmpro_member_directory_search', 'pmpromd_search_shortcode' );
