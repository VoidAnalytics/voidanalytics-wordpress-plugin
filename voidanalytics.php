<?php
/*
Plugin Name: Void Analytics integration to WP
Description: A simple plugin to add Void Analytics tracking script to each page.
Version: 1.4.0
Author: Void Analytics
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue the Void Analytics script in the head
function add_void_analytics_script() {
    echo '<script src="https://cdn.voidanalytics.com/latest.min.js"></script>';
}
add_action('wp_head', 'add_void_analytics_script');

// Add noscript tag at the end of the body
function add_void_analytics_noscript() {
    echo '<noscript><img src="https://cdn.voidanalytics.com/drop.gif" alt=""/></noscript>';
}
add_action('wp_footer', 'add_void_analytics_noscript');
