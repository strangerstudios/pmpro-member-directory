<?php
/**
 * This is the main file for the PMPro Member Directory Maps functionality.
 * The contents of this directory are to self-contain the Google Maps functionality for the Member Directory.
 * 
 * This is to ensure a smooth transition for users and developers who have the Membership Maps Add On installed.
 * 
 * @since TBD
 */

define( 'PMPRO_MEMBER_DIRECTORY_MAPS_DIR', dirname( __FILE__ ) );

include_once( PMPRO_MEMBER_DIRECTORY_MAPS_DIR . '/includes/functions.php' );
include_once( PMPRO_MEMBER_DIRECTORY_MAPS_DIR . '/includes/checkout.php' );
include_once( PMPRO_MEMBER_DIRECTORY_MAPS_DIR . '/includes/admin.php' );
include_once( PMPRO_MEMBER_DIRECTORY_MAPS_DIR . '/includes/pmpro-class-member-edit-panel-map-address.php' );
