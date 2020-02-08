<?php

/**
 * Plugin Name: WP Events
 * Plugin URI: 
 * Description: 
 * Version: 1.0
 * Author: Soha
 * Author URI: 
 * Text Domain: wp-events
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!defined('WPE_PLUGIN_FILE')) {
    define('WPE_PLUGIN_FILE', plugin_dir_path(__FILE__));
}

if (!defined('WPE_PLUGIN_URL')) {
    define('WPE_PLUGIN_URL', plugin_dir_url(__FILE__));
}

include_once WPE_PLUGIN_FILE . '/inc/class-wp-event.php';
include_once WPE_PLUGIN_FILE . '/inc/class-wp-event-gutenberg.php';
include_once WPE_PLUGIN_FILE . '/inc/events-shortcode.php';
include_once WPE_PLUGIN_FILE . '/inc/events-widget.php';
