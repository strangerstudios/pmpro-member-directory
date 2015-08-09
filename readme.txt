=== Paid Memberships Pro - Member Directory Add On ===
Contributors: strangerstudios
Tags: pmpro, paid memberships pro, members, directory
Requires at least: 3.5
Tested up to: 4.2.4
Stable tag: .2

Add a Simple Member Directory to Your Site - with attributes to customize the display.

== Description ==

This plugin creates a shortcode `[pmpro_member_directory]` with the following attributes:

1. avatar: Display the user's avatar generated via Gravatar (https://en.gravatar.com) or user-submitted using a plugin like Simple Local Avatars (https://wordpress.org/plugins/simple-local-avatars/); default: true (accepts 'true' or 'false').
1. email: Display the user's email address; default: true (accepts 'true' or 'false').
1. levels: The level ID or a comma-separated list of level IDs to include in the directory. default: all levels (accepts a single level ID or a comma-separated list of IDs).
1. show_level: Display the user's membership level; default: true  (accepts 'true' or 'false').
1. show_search: Display a search form (searches on member display name or email address); default: true  (accepts 'true' or 'false').
1. start_date: Display the user's membership start date for their current level; default: true (accepts 'true' or 'false').

== Installation ==

1. Upload the `pmpro-member-directory` directory to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the `Plugins` menu in WordPress.
1. Create a page for your directory and set the appropriate shortcode attributes and `Require Membership` settings per your needs.

== Examples ==
Show only level IDs 1 and 4, hide avatars and email address:
[pmpro_member_directory levels="1,4" avatar="false" email="false"]

Show all level IDs, hide level name and start date:
[pmpro_member_directory show_level="false" start_date="false"]

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
= .2 =
* SECURITY: Protecting against SQL injections and XSS on the directory search form/etc.
* ENHANCEMENT: Added pagination to the directory page with a 15 members per page limit. You can override the limit by setting a limit parameter on the shortcode or by passing &limit=... to the URL.

= .1 =
* Initial committ.