=== Paid Memberships Pro - Member Directory Add On ===
Contributors: strangerstudios
Tags: pmpro, paid memberships pro, members, directory
Requires at least: 4
Tested up to: 5.4
Stable tag: 0.7

Add a robust Member Directory and Profiles to Your Membership Site - with attributes to customize the display.

== Description ==
The Member Directory Add On enhances your membership site with a public or private, searchable directory and member profiles.

[Read the full documentation for the Member Directory and Profiles Add On](https://www.paidmembershipspro.com/add-ons/member-directory/)

= Official Paid Memberships Pro Add On =

This is an official Add On for [Paid Memberships Pro](https://www.paidmembershipspro.com), the most complete member management and membership subscriptions plugin for WordPress.

= Shortcodes and Attributes =
This plugin creates 2 shortcodes for a Member Directory and Member Profile pages, which can be defined in Memberships > Page Settings of the WordPress admin.

Shortcode attributes for `[pmpro_member_directory]` include:

1. avatar_size: The square pixel dimensions of the avatar to display. Requires the "show_avatar" attribute to be set to 'true'. default: '128' (accepts any numerical value).
1. fields: Display additional user meta fields. default: none (accepts a list of label names and field IDs, i.e. fields="Company,company;Website,user_url").
1. layout: The format of the directory. default: div (accepts 'table', 'div', '2col', '3col', and '4col').
1. levels: The level ID or a comma-separated list of level IDs to include in the directory. default: all levels (accepts a single level ID or a comma-separated list of IDs).
1. limit: the number of members to display per page
1. link: Optionally link the member directory item to the single member profile page. default: true (accepts 'true' or 'false').
1. order: Sort the results based on the order_by attribute in ascending or descending order. default: ASC (accepts 'DESC' or 'ASC').
1. order_by: The sort order for the results. default: 'u.display_name' (accepts 'u.user_email', 'u.user_email', 'u.display_name', 'u.user_login', 'u.user_registered', 'mu.membership_id', 'mu.startdate', 'joindate')
1. show_avatar: Display the user's avatar generated via Gravatar (https://en.gravatar.com) or user-submitted using a plugin like Simple Local Avatars (https://wordpress.org/plugins/simple-local-avatars/); default: true (accepts 'true' or 'false').
1. show_email: Display the user's email address; default: true (accepts 'true' or 'false').
1. show_level: Display the user's membership level; default: true  (accepts 'true' or 'false').
1. show_search: Display a search form (searches on member display name or email address); default: true (accepts 'true' or 'false').
1. show_startdate: Display the user's membership start date for their current level; default: true (accepts 'true' or 'false').

Shortcode attributes for `[pmpro_member_profile]` include:

1. avatar_size: The square pixel dimensions of the avatar to display. Requires the "show_avatar" attribute to be set to 'true'. default: '128' (accepts any numerical value).
1. fields: Display additional user meta fields. default: none (accepts a list of label names and field IDs, i.e. fields="Company,company;Website,user_url").
1. show_avatar: Display the user's avatar generated via Gravatar (https://en.gravatar.com) or user-submitted using a plugin like Simple Local Avatars (https://wordpress.org/plugins/simple-local-avatars/); default: true (accepts 'true' or 'false').
1. show_bio: Display the user's bio (if available); default: true (accepts 'true' or 'false').
1. show_billing: Display the user's billing address (if available); default: true (accepts 'true' or 'false').
1. show_email: Display the user's email address; default: true (accepts 'true' or 'false').
1. show_level: Display the user's membership level; default: true  (accepts 'true' or 'false').
1. show_phone: Display the user's billing phone (if available); default: true (accepts 'true' or 'false').
1. show_search: Display a search form (searches on member display name or email address); default: true (accepts 'true' or 'false').
1. show_startdate: Display the user's membership start date for their current level; default: true (accepts 'true' or 'false').
1. user_id: Show a specific member's profile; default: none (accepts any numeric uesr id, i.e. user_id="125").

== Installation ==

1. Upload the `pmpro-member-directory` directory to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the `Plugins` menu in WordPress.
1. Create a page for your directory and set the appropriate shortcode attributes and `Require Membership` settings per your needs.
1. Create a page for your profile and set the appropriate shortcode attributes and `Require Membership` settings per your needs.
1. Navigate to Memberships > Page Settings to assign your pages to the Directory and Profile page settings.

== Examples ==
Show only level IDs 1 and 4, hide avatars and email address:
[pmpro_member_directory levels="1,4" show_avatar="false" show_email="false"]

Show all level IDs, hide level name and start date:
[pmpro_member_directory show_level="false" show_startdate="false"]

Show a unique member directory by level. Level 1 Members can only see other Level 1 Members...:
[membership level="1"]
[pmpro_member_directory levels="1"]
[/membership]

[membership level="2"]
[pmpro_member_directory levels="2"]
[/membership]

[membership level="3"]
[pmpro_member_directory levels="3"]
[/membership]

Show unique member profiles based on level - hide user phone number and email address.
[membership level="1"]
[pmpro_member_profile show_email="false" show_phone="false"]
[/membership]

[membership level="2"]
[pmpro_member_profile show_email="true" show_phone="true"]
[/membership]

== Frequently Asked Questions ==

= I found a bug in the plugin. =

Please post it in the issues section of GitHub and we'll fix it as soon as we can. Thanks for helping. https://github.com/strangerstudios/pmpro-member-directory/issues

= I need help installing, configuring, or customizing the plugin. =

Please visit our premium support site at http://www.paidmembershipspro.com for more documentation and our support forums.

== Changelog ==

= 0.7 - 2020-04-29 =
* SECURITY/ENHANCEMENT: Update NPM packages to latest version to resolve vulnerability issues.
* BUG FIX: Stripping slashes when using an apostrophe in search field.
* BUG FIX: Fixed notice and display bug when a trailing space was left in the shortcode's "fields" attribute.
* BUG FIX: Added `method="post"` to search form on directory page to avoid errors where sites not using pretty permalinks would break.
* BUG FIX/ENHANCEMENT: Replicated error_log for field data code in the "table" layout (logging was already in the other layouts).
* BUG FIX/ENHANCEMENT: Added `word-break` css improvement for cases where a long name or email address was forcing overflow content.
* BUG FIX/ENHANCEMENT: Fixed case where a user hidden from directory could still have their individual profile accessed through direct URL.
* ENHANCEMENT: Support for Multiple Memberships Per User to display comma-separated list of levels in directory and profile view.
* ENHANCEMENT: Support for frontend member profile edit in PMPro v2.3+ to allow members to toggle display in directory.
* ENHANCEMENT: Filter added for previous and next page navigation on directory (`pmpromd_pagination_url`).
* ENHANCEMENT: Wrapped the filename output on directory or profile with `<span class="pmpromd_filename">` to allow customization or hide via CSS.

= .6.1 =
* BUG FIX: Levels select in block not returning any results.
* BUG FIX: Custom fields from Register Helper not working when multiple fields are set in the shortcode method.
* BUG FIX: Remove "Levels" attribute from profile block method as profile shortcode does not support this attribute. Set the 'Require Membership' meta box to restrict access to profile pages.

= .6 =
* BUG FIX: Show default "Hide From Directory" if no directory page is set.
* BUG FIX: Strip trailing semi-colon from "fields" attribute.
* BUG FIX: Redirect non-member profiles back to the directory page.
* ENHANCEMENT: Directory and Profile page now makes use of CSS grid.
* ENHANCEMENT: Filter added for 'view profile' link on directory ("pmpromd_profile_url").
* ENHANCEMENT: Improve SQL for directory page. This is now broken into sections making it easier to adjust the query. New filter added for this ("pmpro_member_directory_sql_parts").
* ENHANCEMENT: Support Approvals Add On. Redirect non-approved member profiles back to the directory page.
* FEATURE: Support the new WordPress Block Editor for both the directory and profile page. Please note custom page templates need to be updated for this to work with the block editor.

= .5.3 =
* BUG FIX: Changed how column layouts are determined, fixing issues with column shortcodes not working properly

= .5.2 =
* BUG FIX: Removed extra ob_start() in templates/directory.php, which was causing issues sometimes.

= .5.1 =
* BUG/ENHANCEMENT: Improved meta_field code for PHP7 support.

= .5 =
* BUG: Fixed bug with the fields attribute of the directory shortcode.
* ENHANCEMENT: Added localization support and French translation. (Thanks, Max Kovalenkov)

= .4.4 =
* ENHANCEMENT: Added the pmpro_member_directory_sql filter (passes $sqlQuery, $levels, $s, $pn, $limit, $start, $end) that can be used to filter the SQL used to lookup members for the directory page.

= .4.3 =
* BUG: Fixed bug where the Address 1 text was appearing under Address 2 on profiles.

= .4.2 =
* BUG/ENHANCEMENT: Now passing ?pu={user_nicename} in the profile link. The profile page will accept a numerical ID or alphanumerical nicename/slug to lookup the user.

= .4.1 =
* ENHANCEMENT: Added sorting by first_name and last_name.
* ENHANCEMENT: Now checking for Register Helper labels for arrays of custom fields on the profile and directory templates.
* BUG: Fixed broken profile links on directory page for certain usernames.

= .4 =
* Added pmpro_member_profile_fields filter to set or override fields available on the profile pages.

= .3.1 =
* BUG: Fixed css declaration that was affecting elements outside of the pmpro_member_directory div/table
* ENHANCEMENT: Added ability to load the theme's (child or parent) custom pmpro-member-directory.css in place of default

= .3 =
* FEATURE: Added [pmpro_member_profile] shortcode
* ENHANCEMENT: Added additional attributes to the [pmpro_member_directory]
* ENHANCEMENT: Added ability to define Directory and Profile page under Memberships > Pge Settings
* ENHANCEMENT: Added user option to hide profile from diretory.

= .2 =
* SECURITY: Protecting against SQL injections and XSS on the directory search form/etc.
* ENHANCEMENT: Added pagination to the directory page with a 15 members per page limit. You can override the limit by setting a limit parameter on the shortcode or by passing &limit=... to the URL.

= .1 =
* Initial commit.
