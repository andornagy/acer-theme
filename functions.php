<?php

//
// This file includes the files that are used in the Twenty Six Wordpress theme.
// 

include( get_template_directory() . '/lib/functions.php' ); // Including tthe framework.
include( get_template_directory() . '/lib/options/theme-options.php' ); // Including the Theme Options page.
include( get_template_directory() . '/lib/widgets/widgets.php' ); // Including the custom widgets.

require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater( 'http://wp-updates.com/api/1/theme', 209, basename(get_template_directory()) );

?>