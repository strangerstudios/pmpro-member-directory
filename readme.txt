=== Paid Memberships Pro - Member Directory Add On ===
Contributors: strangerstudios, eighty20results
Tags: pmpro, paid memberships pro, members, directory
Requires at least: 3.5
Tested up to: 4.4.2
Stable tag: .5

Add a robust Member Directory and Profiles to Your Membership Site - with attributes to customize the display.

== Description ==
The Member Directory Add On enhances your membership site with a public or private, searchable directory and member profiles.

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
= .5 =
* ENHANCEMENT: Supports better/more extensive search based on user metadata in [pmpro_member_directory] shortcode

= .4.4 =
* Added the pmpro_member_directory_sql filter (passes $sqlQuery, $levels, $s, $pn, $limit, $start, $end) that can be used to filter the SQL used to lookup members for the directory page.

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