<?php 
/**
* @package WordPress
* @subpackage Betterwork
*/

require_once (TEMPLATEPATH . '/framework/main.php');

// Create Text Domain For the Themes' Translations
if (function_exists('load_textdomain')) {
	load_theme_textdomain('betterwork', get_template_directory().'/locale');
}

