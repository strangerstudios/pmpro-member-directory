<?php
function pmpromd_load_textdomain()
{
    //get the locale
	$locale = apply_filters("plugin_locale", get_locale(), "pmpromd");
	$mofile = "pmpro-" . $locale . ".mo";

	//paths to local (plugin) and global (WP) language files
	$mofile_local  = dirname(__FILE__)."/../languages/" . $mofile;
	$mofile_global = WP_LANG_DIR . '/pmpro/' . $mofile;

	//load global first
    load_textdomain("pmpro", $mofile_global);

	//load local second
	load_textdomain("pmpro", $mofile_local);
}
add_action("init", "pmpromd_load_textdomain", 1);