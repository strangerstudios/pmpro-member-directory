<?php
/**
 * Extends the Member Edit Panel class to add a new panel for the member address.
 * @since TBD
 */

// Checking this to ensure it does not fatal error if Membership Maps Add On is still active.
if ( ! class_exists( 'PMPro_Member_Edit_Panel_Map_Address' ) ) {
	class PMPro_Member_Edit_Panel_Map_Address extends PMPro_Member_Edit_Panel {

		/**
		 * Set up the panel.
		 */
		public function __construct() {
			$user        = self::get_user();
			$this->slug  = 'map_address';
			$this->title = __( 'Membership Map Address', 'pmpro-member-directory' );
		}

		/**
		 * Display the panel contents.
		 */
		protected function display_panel_contents() {
			$user = self::get_user();
			?>
			<div id="pmpromm-map-address">
				<?php pmpromd_show_map_address_fields( $user->ID, 'table' ); ?>
				<div>
					<button type="submit" name="pmpro-member-edit-memberships-panel-member_address" class="button button-primary" value="">
						<?php esc_html_e( 'Save Map Address', 'pmpro-member-directory' ); ?>
					</button>
				</div>
			</div><!-- end #member-history-orders -->
			<?php
		}

		/**
		 * Save panel data.
		 */
		public function save() {

			// If the current user can't edit users, bail.
			if ( ! current_user_can( 'edit_users' ) ) {
				return;
			}

			// Get the user we are editing.
			$user = self::get_user();

			if ( ! empty( $_REQUEST['pmpro_member_edit_panel'] ) && $_REQUEST['pmpro_member_edit_panel'] === 'map_address' ) {
				pmpromd_save_marker_location_for_user( $user->ID );
			}
		}
	} // End of class PMPro_Member_Edit_Panel_Map_Address.
} // End if class_exists check.

/**
 * Adds a panel to the Edit Member Dashboard.
 *
 * @since 0.8
 *
 * @param array $panels Array of panels.
 *
 * @return array
 */
function pmpromd_edit_panel_map_address( $panels ) {
	$panels[] = new PMPro_Member_Edit_Panel_Map_Address();

	return $panels;
}
add_filter( 'pmpro_member_edit_panels', 'pmpromd_edit_panel_map_address' );