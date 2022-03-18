<?php
/*
Plugin Name: Paid Memberships Pro - Member Directory Add On
Plugin URI: https://www.paidmembershipspro.com/add-ons/member-directory/
Description: Adds a customizable Member Directory and Member Profiles to your membership site.
Version: 1.1
Author: Paid Memberships Pro
Author URI: https://www.paidmembershipspro.com/
*/

define( 'PMPRO_MEMBER_DIRECTORY_VERSION', '1.0' );

global $pmpromd_options;

$path = dirname(__FILE__);
$custom_dir = get_stylesheet_directory()."/paid-memberships-pro/pmpro-member-directory/";
$custom_directory_file = $custom_dir."directory.php";
$custom_profile_file = $custom_dir."profile.php";

//load custom or default templates
if(file_exists($custom_directory_file))
	require_once($custom_directory_file);
else
	require_once($path . "/templates/directory.php");
if(file_exists($custom_profile_file))
	require_once($custom_profile_file);
else
	require_once($path . "/templates/profile.php");

require_once($path . "/includes/localization.php"); //localization functions
require_once($path . "/blocks/blocks.php"); //localization functions

function pmpromd_register_styles() {
	//load stylesheet (check child theme, then parent theme, then plugin folder)
	if(file_exists(get_stylesheet_directory()."/paid-memberships-pro/member-directory/css/pmpro-member-directory.css"))
		wp_register_style( 'pmpro-member-directory-styles', get_stylesheet_directory_uri()."/paid-memberships-pro/member-directory/css/pmpro-member-directory.css");
	elseif(file_exists(get_template_directory()."/paid-memberships-pro/member-directory/css/pmpro-member-directory.css"))
		wp_register_style( 'pmpro-member-directory-styles', get_template_directory_uri()."/paid-memberships-pro/member-directory/css/pmpro-member-directory.css");
	elseif(function_exists("pmpro_https_filter"))
		wp_register_style( 'pmpro-member-directory-styles', pmpro_https_filter(plugins_url( 'css/pmpro-member-directory.css', __FILE__ ) ), NULL, "");
	else
		wp_register_style( 'pmpro-member-directory-styles', plugins_url( 'css/pmpro-member-directory.css', __FILE__ ) );
	wp_enqueue_style( 'pmpro-member-directory-styles' );
}
add_action( 'wp_enqueue_scripts', 'pmpromd_register_styles' );

function pmpromd_extra_page_settings($pages) {
   $pages['directory'] = array('title'=>'Directory', 'content'=>'[pmpro_member_directory]', 'hint'=>'Include the shortcode [pmpro_member_directory].');
   $pages['profile'] = array('title'=>'Profile', 'content'=>'[pmpro_member_profile]', 'hint'=>'Include the shortcode [pmpro_member_profile].');
   return $pages;
}
add_action('pmpro_extra_page_settings', 'pmpromd_extra_page_settings');

//show the option to hide from directory on edit user profile
function pmpromd_show_extra_profile_fields($user)
{
	global $pmpro_pages;

	if ( empty( $pmpro_pages['member_profile_edit'] ) || ! is_page( $pmpro_pages['member_profile_edit'] ) ) {
?>
	<h3><?php echo get_the_title($pmpro_pages['directory']); ?></h3>
    <table class="form-table">
        <tbody>
        <tr class="user-hide-directory-wrap">
            <th scope="row"></th>
            <td>
                <?php
                $directory_page = !empty( get_the_title($pmpro_pages['directory']) ) ? esc_html( get_the_title($pmpro_pages['directory']) ) : __( 'directory', 'pmpro-member-directory' ); ?>
                <label for="hide_directory">
                    <input name="hide_directory" type="checkbox" id="hide_directory" <?php checked( get_user_meta($user->ID, 'pmpromd_hide_directory', true), 1 ); ?> value="1"><?php printf(__('Hide from %s?','pmpromd'), $directory_page ); ?>
                </label>
            </td>
        </tr>
        </tbody>
    </table>
<?php
	} else { //If we're on the front-end page edit lets use div instead.
?>
	<div class="pmpro_member_profile_edit-field pmpro_member_profile_edit-field-hide_directory">
	<?php $directory_page = !empty( get_the_title($pmpro_pages['directory']) ) ? esc_html( get_the_title($pmpro_pages['directory']) ) : __( 'directory', 'pmpro-member-directory' ); ?>
	<label for="hide_directory">
		<input name="hide_directory" type="checkbox" id="hide_directory" <?php checked( get_user_meta($user->ID, 'pmpromd_hide_directory', true), 1 ); ?> value="1"><?php printf(__('Hide from %s?','pmpromd'), $directory_page ); ?>
	</label>
	</div> <!-- end pmpro_member_profile_edit-field-hide_directory -->
<?php
	}
}
add_action( 'show_user_profile', 'pmpromd_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'pmpromd_show_extra_profile_fields' );
add_action( 'pmpro_show_user_profile', 'pmpromd_show_extra_profile_fields' );

function pmpromd_save_extra_profile_fields( $user_id ) {

	global $pmpro_pages;

	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
		

	if ( is_page( $pmpro_pages['member_profile_edit'] ) ) {
		if ( ! isset( $_REQUEST['submit'] ) ) {
			return false;
		}
	}

	$hide_from_dir = isset( $_REQUEST['hide_directory'] ) ? sanitize_text_field( $_REQUEST['hide_directory'] ) : null;
	update_user_meta( $user_id, 'pmpromd_hide_directory', $hide_from_dir );
}
add_action( 'personal_options_update', 'pmpromd_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'pmpromd_save_extra_profile_fields' );
add_action( 'pmpro_personal_options_update', 'pmpromd_save_extra_profile_fields' );


function pmpromd_display_file_field($meta_field) {
	$meta_field_file_type = wp_check_filetype($meta_field['fullurl']);
	switch ($meta_field_file_type['type']) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			return '<a href="' . $meta_field['fullurl'] . '" title="' . $meta_field['filename'] . '" target="_blank"><img class="subtype-' . $meta_field_file_type['ext'] . '" src="' . $meta_field['fullurl'] . '"><span class="pmpromd_filename">' . $meta_field['filename'] . '</span></a>'; break;
	case 'video/mpeg':
	case 'video/mp4':
		return do_shortcode('[video src="' . $meta_field['fullurl'] . '"]'); break;
	case 'audio/mpeg':
	case 'audio/wav':
		return do_shortcode('[audio src="' . $meta_field['fullurl'] . '"]'); break;
	default:
		return '<a href="' . $meta_field['fullurl'] . '" title="' . $meta_field['filename'] . '" target="_blank"><img class="subtype-' . $meta_field_file_type['ext'] . '" src="' . wp_mime_type_icon($meta_field_file_type['type']) . '"><span class="pmpromd_filename">' . $meta_field['filename'] . '</span></a>'; break;
	}
}

/**
 * Filters the name to display for the member in the directory or profile page.
 *
 * @since 1.0
 *
 * @param object $user The WP_User object for the profile.
 * @param string $display_name The name to display for the user.
 */
function pmpro_member_directory_get_member_display_name( $user ) {
	$display_name = apply_filters( 'pmpro_member_directory_display_name', $user->display_name, $user );
	return $display_name;
}

/*
Function to add links to the plugin row meta
*/
function pmpromd_plugin_row_meta($links, $file) {
	if(strpos($file, 'pmpro-member-directory.php') !== false)
	{
		$new_links = array(
			'<a href="' . esc_url('https://www.paidmembershipspro.com/add-ons/pmpro-member-directory/')  . '" title="' . esc_attr( __( 'View Documentation', 'pmpro' ) ) . '">' . __( 'Docs', 'pmpro' ) . '</a>',
			'<a href="' . esc_url('https://www.paidmembershipspro.com/support/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro' ) ) . '">' . __( 'Support', 'pmpro' ) . '</a>',
		);
		$links = array_merge($links, $new_links);
	}
	return $links;
}
add_filter('plugin_row_meta', 'pmpromd_plugin_row_meta', 10, 2);

/**
 * We determine that the URL base is for the profile and then set up the rewrite rule
 */
function pmpromd_custom_rewrite_rules() {

	global $pmpro_pages;

	$parent_id = get_post_field( 'post_parent', $pmpro_pages['profile'] );
	$slug = get_post_field( 'post_name',  $pmpro_pages['profile'] );

	if( !empty( $parent_id ) ){
		$parent_slug = get_post_field( 'post_name',  $parent_id );
		$profile_base = $parent_slug.'/'.$slug;
	} else {
		$profile_base = $slug;
	}

	add_rewrite_rule(
		$profile_base.'/([^/]+)/?$',
		'index.php?pagename='.$profile_base.'&pu=$matches[1]',
		'top'
	);

}
add_action('init', 'pmpromd_custom_rewrite_rules', 10 );

/**
 * Adding in the ?pu parameter so that we can retrieve the value from the pretty permalink
 */
function pmpromd_custom_query_vars( $query_vars ) {

    $query_vars[] = 'pu';
    
    return $query_vars;
}

add_filter( 'query_vars', 'pmpromd_custom_query_vars', 10, 1 );

/**
 * On Page Settings Save, Flush Rewrite Rules
 */
function pmpromd_pagesettings_flush(){

	if( 
		!empty( $_REQUEST['page'] ) && 
		$_REQUEST['page'] == 'pmpro-pagesettings' && //Are we on the PMPro Page Settings
		!empty( $_REQUEST['savesettings']) && //Are we hitting the save button
		( !empty( $_REQUEST['profile_page_id'] ) ) //Is there a profile page present
	){

		flush_rewrite_rules( true );
	}

}
add_action( 'admin_init', 'pmpromd_pagesettings_flush' );

/**
 * We're saving a page, is it a Profile page
 */
function pmpromd_page_save_flush( $post_id ){

	global $pmpro_pages;

	if( !empty( $pmpro_pages['profile'] ) && (int)$pmpro_pages['profile'] == $post_id && did_action( 'init' ) ) {
		flush_rewrite_rules( true );
	}

}
add_action( 'save_post', 'pmpromd_page_save_flush', 10, 1 );

/**
 * Redirect from the OLD profile URL to the new URL's
 */
function pmpromd_redirect_profile_links(){

	if( !empty( $_REQUEST['pu'] ) ){

		wp_redirect( pmpromd_build_profile_url( $_REQUEST['pu'], false, true ), 302, 'WordPress' );

		exit();
	}

}
add_action( 'init', 'pmpromd_redirect_profile_links' );

/**
 * Build profile URL
 */
function pmpromd_build_profile_url( $pu, $profile_url = false, $separator = false ) { 

	global $pmpro_pages;

	if( !empty( $pmpro_pages['profile'] ) && !$profile_url ) {
		$profile_url = apply_filters( 'pmpromd_profile_url', get_permalink( $pmpro_pages['profile'] ) );
	}

	if( $separator ) { 
		return $profile_url . sanitize_title( $pu );
	} else {
		return $profile_url . '/'. sanitize_title( $pu );
	}
}