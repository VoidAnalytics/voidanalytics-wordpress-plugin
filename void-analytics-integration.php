<?php
/*
Plugin Name: Void Analytics Integration
Description: A simple plugin to add Void Analytics tracking script to each page with configurable tracking options.
Version: 1.5.0
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

// Add admin menu
function void_analytics_add_admin_menu() {
    add_options_page(
        'Void Analytics Settings',
        'Void Analytics',
        'manage_options',
        'void-analytics',
        'void_analytics_settings_page'
    );
}
add_action('admin_menu', 'void_analytics_add_admin_menu');

// Register settings
function void_analytics_register_settings() {
    register_setting('void_analytics_options', 'void_analytics_track_internal');
    register_setting('void_analytics_options', 'void_analytics_track_outbound');
    register_setting('void_analytics_options', 'void_analytics_track_customers');
}
add_action('admin_init', 'void_analytics_register_settings');

// Settings page HTML
function void_analytics_settings_page() {
    ?>
    <div class="wrap">
        <h1>Void Analytics Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('void_analytics_options'); ?>
            <?php do_settings_sections('void_analytics_options'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">Track Internal Clicks</th>
                    <td>
                        <label>
                            <input type="checkbox" name="void_analytics_track_internal" value="1" <?php checked(1, get_option('void_analytics_track_internal'), true); ?> />
                            Registers every click and pushes custom event.
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Track Outbound Clicks</th>
                    <td>
                        <label>
                            <input type="checkbox" name="void_analytics_track_outbound" value="1" <?php checked(1, get_option('void_analytics_track_outbound'), true); ?> />
                            Registers every outbound click with location data.
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Track Customers</th>
                    <td>
                        <label>
                            <input type="checkbox" name="void_analytics_track_customers" value="1" <?php checked(1, get_option('void_analytics_track_customers'), true); ?> />
                            Generates UUID and stores it in localStorage. Custom events are pushed.
                        </label>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Add the Void Analytics script with custom attributes
function add_void_analytics_script() {
    $script_url = 'https://cdn.voidanalytics.com/latest.min.js';
    
    // Build attributes based on settings
    $attributes = '';
    if (get_option('void_analytics_track_internal')) {
        $attributes .= ' track-internal="true"';
    }
    if (get_option('void_analytics_track_outbound')) {
        $attributes .= ' track-outbound="true"';
    }
    if (get_option('void_analytics_track_customers')) {
        $attributes .= ' track-customers="true"';
    }
    
    // Output the script tag directly with custom attributes
    echo '<script src="' . esc_url($script_url) . '"' . $attributes . '></script>' . "\n";
}
add_action('wp_head', 'add_void_analytics_script');
