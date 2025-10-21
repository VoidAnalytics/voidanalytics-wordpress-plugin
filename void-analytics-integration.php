<?php
/*
Plugin Name: Void Analytics Integration
Description: A simple plugin to add Void Analytics tracking script to each page.
Version: 1.4.0
Requires at least: 5.2.0
Tested up to: 6.8.3
Author: Void Analytics
Plugin URI: https://www.voidanalytics.com
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue the Void Analytics script in the head
function add_void_analytics_script() {
    wp_enqueue_script(
        'void-analytics-script', // Handle for the script
        'https://cdn.voidanalytics.com/latest.min.js', // URL of the script
        array(), // Dependencies, if any
        null, // Version number (or set to null)
        false // Load in the header (false) or footer (true)
    );
}
add_action('wp_enqueue_scripts', 'add_void_analytics_script');
