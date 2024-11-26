<?php
/*
Plugin Name: Paid Memberships Pro - Member Directory Add On
Plugin URI: https://www.paidmembershipspro.com/add-ons/member-directory/
Description: Adds a customizable Member Directory and Member Profiles to your membership site.
Version: 1.2.6
Author: Paid Memberships Pro
Author URI: https://www.paidmembershipspro.com/
Text Domain: pmpro-member-directory
Domain Path: /languages
*/

define( 'PMPRO_MEMBER_DIRECTORY_VERSION', '1.2.6' );

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

require_once($path . "/blocks/blocks.php"); //localization functions

function pmpromd_load_textdomain() {
	load_plugin_textdomain( 'pmpro-member-directory', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'pmpromd_load_textdomain' );

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

	$custom_css = '#wpadminbar #wp-admin-bar-pmpromd-edit-profile .ab-item:before { content: "\f110"; top: 3px; }';

	wp_add_inline_style( 'pmpro-member-directory-styles', $custom_css );

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
	<h2><?php echo get_the_title($pmpro_pages['directory']); ?></h2>
    <table class="form-table">
        <tbody>
        <tr class="user-hide-directory-wrap">
            <th scope="row"></th>
            <td>
                <?php
                $directory_page = !empty( get_the_title($pmpro_pages['directory']) ) ? esc_html( get_the_title($pmpro_pages['directory']) ) : __( 'directory', 'pmpro-member-directory' ); ?>
                <label for="hide_directory">
				<?php /* translators: placeholder is for directory page name */ ?>
                    <input name="hide_directory" type="checkbox" id="hide_directory" <?php checked( get_user_meta($user->ID, 'pmpromd_hide_directory', true), 1 ); ?> value="1"><?php printf(__('Hide from %s?','pmpro-member-directory'), $directory_page ); ?>
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
		<input name="hide_directory" type="checkbox" id="hide_directory" <?php checked( get_user_meta($user->ID, 'pmpromd_hide_directory', true), 1 ); ?> value="1"><?php printf(__('Hide from %s?','pmpro-member-directory'), $directory_page ); ?>
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
	// Make sure we have a user.
	if ( ! $user instanceof WP_User ) {
		return '';
	}

	// Get their display name.
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
			'<a href="' . esc_url('https://www.paidmembershipspro.com/add-ons/pmpro-member-directory/')  . '" title="' . esc_attr( __( 'View Documentation', 'pmpro-member-directory' ) ) . '">' . __( 'Docs', 'pmpro-member-directory' ) . '</a>',
			'<a href="' . esc_url('https://www.paidmembershipspro.com/support/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro-member-directory' ) ) . '">' . __( 'Support', 'pmpro-member-directory' ) . '</a>',
		);
		$links = array_merge($links, $new_links);
	}
	return $links;
}
add_filter('plugin_row_meta', 'pmpromd_plugin_row_meta', 10, 2);

/**
 * Formatting profile fields based on the field type
 *
 * @since 1.2
 *
 * @param string      $value   The value of the field
 * @param string      $field_name   The field ID or name that would be stored in the DB
 * @param string      $field_label   The field's front-facing label
 *
 * @return string The output that may have been clickable or embedded.
 */
function pmpromd_format_profile_field( $value, $field_name, $field_label = false ){

	if( empty( $field_name ) ) {
		$field_name = $value;
	}

	$original_value = $value;

	$is_email = false;
	if( is_email( $value ) ) {
		$is_email = true;
		$value = make_clickable( $value );	
	}

	/**
	 * Should we wp_oembed the URL that is provided
	 * 
	 * @param bool Should this url be sent through oembed to render
	 * @param string $field The type of field your changes should apply to
	 */
	$try_oembed = apply_filters( 'pmpromd_try_oembed_url', true, $field_name );

	//Should we try and run oembed on this link?
	if( $try_oembed && !$is_email ) {
		
		// Only try to embed if the URL is valid.
		if ( wp_http_validate_url( $value ) ) {
			$url_embed = wp_oembed_get( $value );		
		}

		if( !empty( $url_embed ) ){
			//Oembed returned a vlue
			$value = $url_embed;
		} else { 
			//Oembed did not return anything. Lets check if we have a label?
			if( $field_label ) {
				$value = sprintf( "<a href='%1s' title='%2s' target='_BLANK'>%3s</a>", $value, $field_label, $field_label );	
			} else {
				//We don't have a label (for cases like an email address)
				$value = make_clickable( $value );
			}
		}
	}	

	if ( function_exists( 'pmpro_get_label_for_user_field_value' ) && ! empty( $field_name ) ) { 
		$value = pmpro_get_label_for_user_field_value( $field_name, $value );
	}

	// Let's support checkboxes here instead.
	if ( $value === '1' ) {
		$value = esc_html__( 'Yes', 'pmpro-member-directory' );
	} elseif ( $value === '0' ) {
		$value = esc_html__( 'No', 'pmpro-member-directory' );
	}
	
	/**
	 * Format the profile field
	 *
	 * @param string $value The value or string that you want to format
	 * @param string $original_value The original value before formatting
	 * @param string $field The type of field your changes should apply to
	 */
	$value = apply_filters( 'pmpromd_format_profile_field', $value, $original_value, $field_name );

	return $value;

}
/**
 * Filters the user identifier used in permalinks
 *
 * @since 1.2.0
 *
 * @param string $display_name The name to display for the user.
 */
function pmpromd_user_identifier() {
	
	/**
	 * Filter to change how user identifiers are presented. Choose between slug and ID
	 * Note: Value is case sensitive
	 * 
	 * @since 1.2.0
	 */
	return apply_filters( 'pmpromd_user_identifier', 'slug' );
}

/**
 * Gets user based on their identifier
 *
 * @since 1.2.0
 *
 * @param object The user object
 */
function pmpromd_get_user_by_identifier( $value ) {

	$user_identifier = pmpromd_user_identifier();

	return get_user_by( $user_identifier, sanitize_text_field( $value ) );
	
}

/**
 * Gets a user from the pu URL value
 *
 * @since 1.2.0
 *
 */
function pmpromd_get_user( $user_id = false ){

	global $wp_query, $current_user;

	if ( $user_id ) {
		//We're specifying which user we want to display
		$pu = get_user_by( 'id', intval( $user_id ) );
	} elseif ( ! empty( $wp_query->get( 'pu' ) ) ) {
		//Using the new permalinks /profile/user
		$pu = pmpromd_get_user_by_identifier( $wp_query->get( 'pu' ) );
	} elseif ( ! empty( $_REQUEST['pu'] ) ) {
		//Using old url structure /profile/?pu=user
		$pu = pmpromd_get_user_by_identifier( $_REQUEST['pu'] );
	} elseif ( ! empty( $current_user->ID ) ) {
		$pu = $current_user;
	} else {
		$pu = false;
	}

	return $pu;

}

/**
 * Adds an edit profile link when on the Profile page
 */
function pmpromd_add_edit_profile($admin_bar){

	global $pmpro_pages, $post, $current_user;

	if( current_user_can( 'manage_options' ) && !empty( $post ) && $pmpro_pages['profile'] == $post->ID ){

		$pu = pmpromd_get_user();

		if( $pu ){

			$edit_link = get_edit_user_link( $pu->ID );
		    $admin_bar->add_menu( array(
		        'id'    => 'pmpromd-edit-profile',
		        'title' => esc_html__( 'Edit Profile', 'pmpro-member-directory' ),
		        'href'  => $edit_link,
		        'meta'  => array(
		            'title' => __( 'Edit Profile', 'pmpro-member-directory' ),
		        ),
		    ));		    

		}
	}

}
add_action( 'admin_bar_menu', 'pmpromd_add_edit_profile', 100 );

/**
 * Filter the fields we are expecting to show and make sure the user has the required level.
 *
 * @since 1.2
 * 
 * @param array  $profile_fields The list of fields we want to display on the page.
 * @param object $pu             The current user object.
 *
 * @return array The list of fields we want to display on the page.
 */
function pmpromd_filter_profile_fields_for_levels( $profile_fields, $pu ) {

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
add_filter( 'pmpro_member_profile_fields', 'pmpromd_filter_profile_fields_for_levels', 10, 2 );

/**
 * Determine what the URL base is for the profile and then set up the rewrite rule.
 */
function pmpromd_custom_rewrite_rules() {
	global $pmpro_pages;

	if ( empty( $pmpro_pages ) || empty( $pmpro_pages['profile'] ) ) {
		return;
	}

	// Get the profile permalink.
	$profile_permalink = get_permalink( $pmpro_pages['profile'] );

	// Parse the path from the permalink, taking subfolder installations into account.
	$profile_base = trim( parse_url( $profile_permalink, PHP_URL_PATH ), '/' );

	// Add the rewrite rule.
	add_rewrite_rule(
		'^' . preg_quote( $profile_base, '#' ) . '/([^/]+)/?$',
		'index.php?pagename=' . $profile_base . '&pu=$matches[1]',
		'top'
	);
}
add_action( 'init', 'pmpromd_custom_rewrite_rules', 10 );

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
add_action( 'admin_init', 'pmpromd_pagesettings_flush', 4 );

/**
 * We're saving a page, is it a Profile page
 */
function pmpromd_page_save_flush( $post_id ){

	global $pmpro_pages;

	if( !empty( $pmpro_pages['profile'] ) && 
		(int)$pmpro_pages['profile'] == $post_id && 
		did_action( 'init' ) 
	) {
		flush_rewrite_rules( true );
	}

}
add_action( 'save_post', 'pmpromd_page_save_flush', 10, 1 );

/**
 * Redirect from the OLD profile URL to the new URL's
 */
function pmpromd_redirect_profile_links(){

	if( !empty( $_REQUEST['pu'] ) ){

		$structure = get_option( 'permalink_structure' );	

		if( !empty( $structure ) ) {

			wp_redirect( pmpromd_build_profile_url( $_REQUEST['pu'], false, true ), 302, 'WordPress' );
			exit();

		}		
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

	$structure = get_option( 'permalink_structure' );	

	if( is_object( $pu ) ) {
		//We can't use 'slug' directly when getting the user nicename
		$user_identifier = strtolower( pmpromd_user_identifier() );

		if( $user_identifier == 'id' ) {
			$pu = $pu->ID;
		} else {
			$pu = $pu->user_nicename;
		}
	}

	if( empty( $pu ) ) {
		return '';
	}

	if( empty( $structure ) ) {
		//We're using plain permalinks here. Query parameters to the rescue!
		return add_query_arg( array( 'pu' => $pu ), $profile_url );
	}

	if( strpos( $structure, 'post_id' ) !== FALSE ) {
		//Numeric permalinks don't have a trailing slash for some readon
		$separator = true;
	}

	if( $separator ) { 
		return $profile_url . '/' . sanitize_title( $pu );
	} else {
		return $profile_url . sanitize_title( $pu );
	}
}

/**
 * Run an upgrade check to compare versions and flush rewrite rules
 *
 * @since 1.2
 * 
 * @return void
 */
function pmpromd_check_for_upgrade() {

	if ( ! function_exists( 'pmpro_init' ) ) {
		return;
	}

	$pmpromd_db_version = get_option("pmpro_md_db_version");

	if( empty( $pmpromd_db_version ) || version_compare( $pmpromd_db_version, '1.2', '<' ) ) {

		flush_rewrite_rules( true );

		pmpro_setOption("md_db_version", "1.2");

	}

}
add_action( 'admin_init', 'pmpromd_check_for_upgrade' );

/**
 * Strip the [pmpro_member_directory] or [pmpro_member_profile] shortcode and blocks from content if the current user can't edit users.
 *
 * @since TBD
 *
 * @return mixed The content with the shortcode removed. Will be the same type as the input.
 */
function pmpromd_maybe_strip_shortcodes( $content ) {
	// If the user can edit users, we don't need to strip the shortcode.
	if ( current_user_can( 'edit_users' ) ) {
		return $content;
	}

	// If an array is passed in, filter all elements recursively.
	if ( is_array( $content ) ) {
		foreach ( $content as $key => $value ) {
			$content[ $key ] = pmpromd_maybe_strip_shortcodes( $value );
		}
		return $content;
	}

	// If we're not looking at a string, just return it.
	if ( ! is_string( $content ) ) {
		return $content;
	}
	
	// Okay, we have a string, figure out the regex.
	$shortcodeRegex = get_shortcode_regex( array( 'pmpro_member_directory', 'pmpro_member_profile' ) );	

	// Remove various blocks.
	$blockWrapperPatterns = array(
		"<!-- wp:pmpro-member-directory/directory /-->",
		"<!-- wp:pmpro-member-directory/profile /-->",
		"/<!--\s*wp:pmpro-member-directory\/directory\s*{[^}]*}\s*\/-->/",
		"/<!--\s*wp:pmpro-member-directory\/profile\s*{[^}]*}\s*\/-->/",
		"/<!-- wp:shortcode -->\s*$shortcodeRegex\s*<!-- \/wp:shortcode -->/s",
		"/$shortcodeRegex/"
	);

	$content = preg_replace( $blockWrapperPatterns, '', $content );

	return $content;
}
add_filter( 'content_save_pre', 'pmpromd_maybe_strip_shortcodes' );
add_filter( 'excerpt_save_pre', 'pmpromd_maybe_strip_shortcodes' );
add_filter( 'widget_update_callback', 'pmpromd_maybe_strip_shortcodes' );

/**
 * Only allow those with the edit_users capability
 * to use the Directory or Profile shortcodes in post_meta.
 *
 * @since TBD
 * @param int    $meta_id     ID of the meta data entry.
 * @param int    $object_id   ID of the object the meta is attached to.
 * @param string $meta_key    Meta key.
 * @param mixed  $_meta_value Meta value.
 * @return void
 */
function pmpromd_maybe_strip_shortcodes_from_post_meta( $meta_id, $object_id, $meta_key, $_meta_value ) {
	// Bail if the value is not a string or array.
	if ( ! is_string( $_meta_value ) && ! is_array( $_meta_value ) ) {
		return;
	}

	// Strip the shortcode from the meta value.
	$stripped_value = pmpromd_maybe_strip_shortcodes( $_meta_value );

	// If there was a change, save our stripped version.
	if ( $stripped_value !== $_meta_value ) {
		update_post_meta( $object_id, $meta_key, $stripped_value );
	}
}
add_action( 'updated_post_meta', 'pmpromd_maybe_strip_shortcodes_from_post_meta', 10, 4 );