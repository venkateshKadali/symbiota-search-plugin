<?php


/*
Plugin Name: Symbiota Search plugin
Plugin URI: https://wordpress.org/plugins/page-plugin/
Description: Symbiota search wordpress plugin allows user to add symbiota search into their websites.
Version: 0.1.0
Author: Venkatesh Kadali
Text Domain: Symbiota-plugin
*/

require ( plugin_dir_path(__FILE__). 'symbiota-custom-post-type.php');
require(plugin_dir_path(__FILE__). 'symbiota-custom-metabox.php');


?>