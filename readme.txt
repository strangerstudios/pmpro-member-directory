=== Paid Memberships Pro - Member Directory Add On ===
Contributors: strangerstudios
Tags: pmpro, paid memberships pro, members, directory
Requires at least: 5.2
Tested up to: 6.8
Stable tag: 2.0.4

Add a robust Member Directory and Profiles to Your Membership Site - with attributes to customize the display.

== Description ==
The Member Directory Add On enhances your membership site with a public or private, searchable directory and member profiles.

[Read the full documentation for the Member Directory and Profiles Add On](https://www.paidmembershipspro.com/add-ons/member-directory/)

= Official Paid Memberships Pro Add On =

This is an official Add On for [Paid Memberships Pro](https://www.paidmembershipspro.com), the most complete member management and membership subscriptions plugin for WordPress.

= Shortcodes and Attributes =
This plugin creates shortcodes for Member Directory and Member Profile pages, which can be defined in Memberships > Page Settings of the WordPress admin.

Shortcode attributes for `[pmpro_member_directory]` include:

1. elements: Set the elements that will be shown for each directory entry. default: none (accepts a list of label names and element IDs, i.e. elements="Company,company;Website,user_url").
1. layout: The format of the directory. default: div (accepts 'table', 'div', '2col', '3col', and '4col').
1. levels: The level ID or a comma-separated list of level IDs to include in the directory. default: all levels (accepts a single level ID or a comma-separated list of IDs).
1. limit: the number of members to display per page
1. link: Optionally link the member directory item to the single member profile page. default: true (accepts 'true' or 'false').
1. order: Sort the results based on the order_by attribute in ascending or descending order. default: ASC (accepts 'DESC' or 'ASC').
1. order_by: The sort order for the results. default: 'u.display_name' (accepts 'u.user_email', 'u.user_email', 'u.display_name', 'u.user_login', 'u.user_registered', 'mu.membership_id', 'mu.startdate', 'joindate')
1. show_search: Display a search form (searches on member display name or email address); default: true (accepts 'true' or 'false').

Shortcode attributes for `[pmpro_member_profile]` include:

1. elements: Set the elements that will be shown on the user profile. default: none (accepts a list of label names and element IDs, i.e. elements="Company,company;Website,user_url").
1. show_search: Display a search form (searches on member display name or email address); default: true (accepts 'true' or 'false').
1. user_id: Show a specific member's profile; default: none (accepts any numeric uesr id, i.e. user_id="125").

== Installation ==

1. Upload the `pmpro-member-directory` directory to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the `Plugins` menu in WordPress.
1. Create a page for your directory and set the appropriate shortcode attributes and `Require Membership` settings per your needs.
1. Create a page for your profile and set the appropriate shortcode attributes and `Require Membership` settings per your needs.
1. Navigate to Memberships > Page Settings to assign your pages to the Directory and Profile page settings.

== Examples ==
Show only level IDs 1 and 4, show avatars and email address.:
[pmpro_member_directory levels="1,4" elements="Avatar,avatar|128;Email Address,user_email;"]

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

== Frequently Asked Questions ==

= I found a bug in the plugin. =

Please post it in the issues section of GitHub and we'll fix it as soon as we can. Thanks for helping. https://github.com/strangerstudios/pmpro-member-directory/issues

= I need help installing, configuring, or customizing the plugin. =

Please visit our premium support site at http://www.paidmembershipspro.com for more documentation and our support forums.

== Changelog ==
= 2.1 - 2025-08-05 =
* ENHANCEMENT: Added Google Maps functionality to the directory and profile pages. See our documentation for new actions and filters - most are borrowed from the Membership Maps Add On with `pmpromd_` prefix instead of `pmpromm_` (@andrewlimaza)
* ENHANCEMENT: Adjusted the default generated shortcodes for both the directory and profile pages to include the `elements` attribute with a default set of elements. (@kimcoleman)
* ENHANCEMENT: Added a new filter `pmpro_member_profile_before_atts` to allow customization of the attributes for the profile shortcode. This follows the existing directory filter logic that is available. (@ipokkel)
* ENHANCEMENT: Allow displaying "ID" as an element in the directory and profile pages shortcode. (@dparker1005)
* BUG FIX: Fixed an issue where the profile generated URL would not work correctly on a subfolder WordPress install or when not using pretty permalinks. (@andrewlimaza)
* BUG FIX: Fixed an issue for the profile generated URL when permalinks were set without a trailing slash. (@andrewlimaza)

= 2.0.4 - 2025-04-24 =
* BUG FIX/ENHANCEMENT: Added improved compatibility for The Events Calendar plugin, and possibly other plugins that may use `?pu=` in their URLs. #191 (@JarrydLong)
* BUG FIX: Fixed an issue with the Member Profile block not honoring the "Show Bio" setting. #192 (@dwanjuki)
* BUG FIX: Fixed audio playback (embedded) videos on the profile and directory pages. #193 (@dwanjuki)

= 2.0.3 - 2025-03-18 =
* BUG FIX: Fixed an issue that could cause content after the directory shortcode to be formatted incorrectly if no members were found. #185 (@kimcoleman)
* ENHANCEMENT: Now leveraging the `pmpro_getPaginationString()` function for pagination on the directory page. #186 (@kimcoleman)
* DEPRECATED: The second parameter passed to the `pmpromd_pagination_url` shortcode is now deprecated and should no longer be used. #186 (@kimcoleman)

= 2.0.2 - 2025-03-13 =
* BUG FIX: Fixed a PHP fatal error that could occur when 3rd party code called functions that were removed in the v2.0 release. #184 (@dparker1005)

= 2.0.1 - 2025-03-05 =
* ENHANCEMENT: Now allowing more HTML tags in the directory and profile pages. #179 (@kimcoleman)
* ENHANCEMENT: Added a new filter `pmpromd_allowed_html` to customize the allowed HTML tags in the directory and profile pages. #179 (@kimcoleman)
* BUG FIX: Fixed a PHP fatal error that could occur when 3rd party code called functions that were removed in the previous release. #183 (@dparker1005)
* BUG FIX: Fixed an issue where sorting the directory by first or last name would cause no results to be shown. #182 (@dparker1005)
* BUG FIX: Fixed an issue where elements with a value of '0' would not be displayed. #181 (@dparker1005)
* BUG FIX: Fixed a PHP warning that would occur if there was not a value found for a directory or profile element. #181 (@kimcoleman)
* BUG FIX: Fixed the styling of avatars in directories. #180 (@kimcoleman)

= 2.0 - 2025-02-26 =
* FEATURE: Added support for an “elements” attribute on the directory and profile shortcodes to allow total customization of the displayed content and order it is displayed. This attribute will replace several true/false attributes as well as the “fields” attribute in a future update. #169 (@kimcoleman)
* FEATURE: Added a new `[pmpro_member_directory_search]` shortcode to allow placing the search form outside of the directory or profile. #169 (@kimcoleman)
* ENHANCEMENT: Updated styling for PMPro v3.1. #169 (@kimcoleman)
* ENHANCEMENT: Added a User Field Group for "Directory and Profile Preferences". #169 (@kimcoleman)
* ENHANCEMENT: Improved how user fields are displayed in directories and profiles. #169 (@kimcoleman)
* ENHANCEMENT: Added a new filter `pmpromd_get_display_value` to allow customizing the display value of user fields. #172 (@kimcoleman)
* BUG FIX/ENHANCEMENT: Improved logic to determine which level to show information for on profiles when users have multiple levels. #169 (@kimcoleman)
* BUG FIX: Fixed a fatal error that may show when viewing a directory or profile without the core PMPro plugin enabled. #176 (@dparker1005)
* BUG FIX: Fixed an issue where pretty permalinks would not work on subfolder WordPress installs. #168 (@kimcoleman)
* REFACTOR: Cleaned up plugin files and WPCS fixes. #169 (@kimcoleman)
* DEPRECATED: Deprecated the `pmpro_member_directory_fields` filter. Use `pmpro_member_directory_elements` instead. #169 (@kimcoleman)
* DEPRECATED: Marked billing addresses as deprecated. Directory addresses should be stored separately from billing addresses as they may not be the same. #173 (@dparker1005)

= 1.2.6 - 2024-02-19 =
* SECURITY: Improved security around shortcode attributes to prevent SQL injection.

= 1.2.5 - 2024-02-14 =
* SECURITY: Improved security around using the Directory and Profile shortcode or block to only be used by users that have are able to edit the relevant content and edit_users capability. (@andrewlimaza)
* REFACTOR: Moved from pmpro_getOption to get_option for better compatibility. (@JarrydLong)
* REFACTOR: Improved accessibility for screen readers by adjusting the HTML header sizes. (@kimwhite)
* BUG FIX: Fixed an issue where fields that had default blank values would show up on the profile page (@ipokkel)

= 1.2.4 - 2023-06-28 =
* ENHANCEMENT: Improved pagination style to display page numbers instead of ... (@JarrydLong)
* ENHANCEMENT: Improved output on custom fields label values for value => label type of fields. (@andrewlimaza)
* ENHANCEMENT: Improved compatibility with Multiple Memberships Per User. Shows the oldest start date if a user has multiple levels (@dparker1005)
* BUG FIX: Fixed an issue where using the [membership] shortcode would redirect to the directory page. (@andrewlimaza)
* BUG FIX: Fixed an issue where the auto embedding functionality would incorrectly embed custom fields.(@andrewlimaza)

= 1.2.3 - 2022-08-05 =
* BUG FIX/ENHANCEMENT: Better profile page checks prevent issues with rewrite rules. (@ideadude & @kimcoleman)

= 1.2.2 - 2022-07-07 =
* BUG FIX: Fixed issue when profile page was nested within a nested page (Thanks @JarrydLong)
* BUG FIX: Fixed fatal error when Paid Memberships Pro plugin wasn't active. (Thanks @JarrydLong)
* BUG FIX: Fixed a layout issue conflict on the directory page for the Membership Maps Add On being included in the div container and now displays it correctly. (Thanks @JarrydLong)
* BUG FIX: Fixed warnings of undefined variables when navigating to a profile page of a non-existing user. (Thanks @ipokkel)
* REFACTOR: Adjusted incorrect docblock variable for the format the profile field method. (Thanks @ipokkel)

= 1.2.1 - 2022-04-07 =
* ENHANCEMENT: Added small sanitization check for query parameter values.
* BUG FIX: Fixed issue where passing "user_id" attribute in shortcode was returning empty results.
* BUG FIX: Removed debug code that was causing minor output issues.

= 1.2 - 2022-03-31 =
* ENHANCEMENT: General improvements to localization and translatable strings.
* ENHANCEMENT: Improvement to profile pretty permalinks structure that's more SEO friendly (e.g. membership-account/profile/admin/). Automatically flush permalinks when needed in admin area.
* ENHANCEMENT: Improved handling of clickable links, we try to automatically embed custom fields first or fallback to clickable URL fields.
* ENHANCEMENT: pmpro_get_element_class implemented on directory and profile pages to load HTML classes as needed.
* ENHANCEMENT: Added "Edit Profile" link for administrators when viewing the profile page. Redirects to the edit profile WordPress page.
* ENHANCEMENT: New filter `pmpromd_try_oembed_url` added to allow trying to embed possible fields first. Set this false if you don't want to automatically embed embeddable URL's.
* ENHANCEMENT: New filter `pmpromd_format_profile_field` added to allow how to format any fields that may be clickable and allows custom output for fields.
* ENHANCEMENT: New filter `pmpromd_user_identifier` added to allow how to identify/retrieve the user information. Defaults to "slug" (user_nicename) or can use user ID to retrieve relevant information in the directory or profile page.
* ENHANCEMENT: New filter `pmpro_member_directory_sql_search_where` added to allow filtering of search WHERE SQL conditions to offer more specific search results.
* ENHANCEMENT: Profile page title no longer changes to the user's name.
* ENHANCEMENTX: Improved the displaying of level dependent custom fields.
* BUG FIX: Fixed issue where pagination would cause issues with search. (Thanks @jcotter).

= 1.1 - 2020-11-16 =
* BUG FIX: Fixed issue where saving "hide from directory" wasn't saving on the front-end profile page.
* BUG FIX: Fixed issue where profile page wasn't showing user information (fields) correctly.

= 1.0 - 2020-08-27 =
* BUG FIX/ENHANCEMENT: Moved `pmpro_member_directory_after` outside div container for better styling with Membership Maps.
* ENHANCEMENT: Added new filter to adjust user display name on directory and profile page. `pmpro_member_directory_display_name`.
* ENHANCEMENT: New filter added to allow PHP to adjust the user results further. `pmpromd_user_directory_results`.

= 0.8 - 2020-07-23 =
* ENHANCEMENT: Updated webpack configuration to use wp-scripts package.
* ENHANCEMENT: Added an 'edit' link if user is viewing their own profile. New filter added 'pmpromd_member_profile_action_links'.
* ENHANCEMENT: New hooks added to templates - 'pmpro_member_profile_before', 'pmpro_member_directory_before' and 'pmpro_member_directory_after'.
* ENHANCEMENT: Removed semi-colon from field label where it was automatically being displayed. User's now can manually add this in if needed.

= 0.7 - 2020-04-30 =
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
