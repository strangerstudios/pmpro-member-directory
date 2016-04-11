<?php
/*
Plugin Name: Paid Memberships Pro - Member Directory Add On
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-member-directory/
Description: A very basic shortcode for display a member directory list on your site.
Version: .5
Author: Stranger Studios
Author URI: http://www.strangerstudios.com
*/

global $pmpromd_options;

$path                  = dirname( __FILE__ );
$custom_dir            = get_stylesheet_directory() . "/paid-memberships-pro/pmpro-member-directory/";
$custom_directory_file = $custom_dir . "directory.php";
$custom_profile_file   = $custom_dir . "profile.php";

//load custom or default templates
if ( file_exists( $custom_directory_file ) ) {
	require_once( $custom_directory_file );
} else {
	require_once( $path . "/templates/directory.php" );
}
if ( file_exists( $custom_profile_file ) ) {
	require_once( $custom_profile_file );
} else {
	require_once( $path . "/templates/profile.php" );
}

/**
 * Sanitize supplied field value(s) depending on it's data type
 *
 * @param $field - The data to santitize
 *
 * @return array|int|string
 *
 * @since .5
 */
function pmpromd_sanitize( $field ) {

	if ( ! is_numeric( $field ) ) {

		if ( is_array( $field ) ) {

			foreach ( $field as $key => $val ) {
				$field[ $key ] = pmpromd_sanitize( $val );
			}
		}

		if ( is_object( $field ) ) {

			foreach ( $field as $key => $val ) {
				$field->{$key} = pmpromd_sanitize( $val );
			}
		}

		if ( ( ! is_array( $field ) ) && ctype_alpha( $field ) ||
		     ( ( ! is_array( $field ) ) && strtotime( $field ) ) ||
		     ( ( ! is_array( $field ) ) && is_string( $field ) )
		) {

			$field = sanitize_text_field( $field );
		}

	} else {

		if ( is_float( $field + 1 ) ) {

			$field = sanitize_text_field( $field );
		}

		if ( is_int( $field + 1 ) ) {

			$field = intval( $field );
		}
	}

	return $field;
}

function pmpromd_register_styles() {
	//load stylesheet (check child theme, then parent theme, then plugin folder)	
	if ( file_exists( get_stylesheet_directory() . "/paid-memberships-pro/member-directory/css/pmpro-member-directory.css" ) ) {
		wp_register_style( 'pmpro-member-directory-styles', get_stylesheet_directory_uri() . "/paid-memberships-pro/member-directory/css/pmpro-member-directory.css" );
	} elseif ( file_exists( get_template_directory() . "/paid-memberships-pro/member-directory/css/pmpro-member-directory.css" ) ) {
		wp_register_style( 'pmpro-member-directory-styles', get_template_directory_uri() . "/paid-memberships-pro/member-directory/css/pmpro-member-directory.css" );
	} elseif ( function_exists( "pmpro_https_filter" ) ) {
		wp_register_style( 'pmpro-member-directory-styles', pmpro_https_filter( plugins_url( 'css/pmpro-member-directory.css', __FILE__ ) ), null, "" );
	} else {
		wp_register_style( 'pmpro-member-directory-styles', plugins_url( 'css/pmpro-member-directory.css', __FILE__ ) );
	}
	wp_enqueue_style( 'pmpro-member-directory-styles' );
}

add_action( 'wp_enqueue_scripts', 'pmpromd_register_styles' );

function pmpromd_extra_page_settings( $pages ) {
	$pages['directory'] = array( 'title'   => 'Directory',
	                             'content' => '[pmpro_member_directory]',
	                             'hint'    => 'Include the shortcode [pmpro_member_directory].'
	);
	$pages['profile']   = array( 'title'   => 'Profile',
	                             'content' => '[pmpro_member_profile]',
	                             'hint'    => 'Include the shortcode [pmpro_member_profile].'
	);

	return $pages;
}

add_action( 'pmpro_extra_page_settings', 'pmpromd_extra_page_settings' );

//show the option to hide from directory on edit user profile
function pmpromd_show_extra_profile_fields( $user ) {
	global $pmpro_pages;
	?>
	<h3><?php echo get_the_title( $pmpro_pages['directory'] ); ?></h3>
	<table class="form-table">
		<tbody>
		<tr class="user-hide-directory-wrap">
			<th scope="row"></th>
			<td>
				<label for="hide_directory">
					<input name="hide_directory" type="checkbox"
					       id="hide_directory" <?php checked( get_user_meta( $user->ID, 'pmpromd_hide_directory', true ), 1 ); ?>
					       value="1"><?php printf( __( 'Hide from %s?', 'pmpromd' ), get_the_title( $pmpro_pages['directory'] ) ); ?>
				</label>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}

add_action( 'show_user_profile', 'pmpromd_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'pmpromd_show_extra_profile_fields' );

function pmpromd_save_extra_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	update_usermeta( $user_id, 'pmpromd_hide_directory', $_POST['hide_directory'] );
}

add_action( 'personal_options_update', 'pmpromd_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'pmpromd_save_extra_profile_fields' );


function pmpromd_display_file_field( $meta_field ) {
	$meta_field_file_type = wp_check_filetype( $meta_field['fullurl'] );
	switch ( $meta_field_file_type['type'] ) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			return '<a href="' . $meta_field['fullurl'] . '" title="' . $meta_field['filename'] . '" target="_blank"><img class="subtype-' . $meta_field_file_type['ext'] . '" src="' . $meta_field['fullurl'] . '"><br />' . $meta_field['filename'] . '</a>';
			break;
		case 'video/mpeg':
		case 'video/mp4':
			return do_shortcode( '[video src="' . $meta_field['fullurl'] . '"]' );
			break;
		case 'audio/mpeg':
		case 'audio/wav':
			return do_shortcode( '[audio src="' . $meta_field['fullurl'] . '"]' );
			break;
		default:
			return '<a href="' . $meta_field['fullurl'] . '" title="' . $meta_field['filename'] . '" target="_blank"><img class="subtype-' . $meta_field_file_type['ext'] . '" src="' . wp_mime_type_icon( $meta_field_file_type['type'] ) . '"><br />' . $meta_field['filename'] . '</a>';
			break;
	}
}

/*
Function to add links to the plugin row meta
*/
function pmpromd_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'pmpro-member-directory.php' ) !== false ) {
		$new_links = array(
			'<a href="' . esc_url( 'http://www.paidmembershipspro.com/add-ons/plugins-on-github/pmpro-member-directory/' ) . '" title="' . esc_attr( __( 'View Documentation', 'pmpro' ) ) . '">' . __( 'Docs', 'pmpro' ) . '</a>',
			'<a href="' . esc_url( 'http://paidmembershipspro.com/support/' ) . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro' ) ) . '">' . __( 'Support', 'pmpro' ) . '</a>',
		);
		$links     = array_merge( $links, $new_links );
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'pmpromd_plugin_row_meta', 10, 2 );