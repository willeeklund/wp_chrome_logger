<?php
/*
Plugin Name: Chrome Logger
Plugin URI: http://www.github.com/willeeklund/wp_chrome_logger
Description: A simple plugin to send data to Google Chrome Console. Based on the ChromePhp class (https://github.com/ccampbell/chromephp) by Craig Campbell(http://www.craigiam.com/). You have to install ChromePHP extension(https://chrome.google.com/webstore/detail/noaneddfkdjfnfdakjjmocngnfkfehhd) on Chrome to have this plugin to work.
Version: 0.1
Author: Wilhelm Eklund
Author URI: http://www.github.com/willeeklund
License: GPL2
Last change: 2013-08-11
*/

include (dirname(__FILE__) . '/inc/ChromePhp.php');

add_action ('init', 'wp_chrome_logger_init');

function wp_chrome_logger_init() {
	if (current_user_can('manage_options')) {
  	define ("ALLOW_DEBUG", 1);
		add_action('get_header', 'wpcl_start');
		add_action('get_footer', 'wpcl_end');
		$GLOBALS['timers'] = array();
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	} else {
		define ("ALLOW_DEBUG", 0);
	}
	ChromePhp::getInstance()->addSetting("ALLOW_DEBUG", ALLOW_DEBUG);
}

function wpcl_start() {
	ob_start();
}

function wpcl_end() {
	ob_end_flush();
}

?>
