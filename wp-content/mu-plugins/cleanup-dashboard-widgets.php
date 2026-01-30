<?php
/**
 * Plugin Name: Cleanup Dashboard Widgets (MU)
 * Description: Hide News Widget from Dashboard
 * Author: adeel.cs@gmail.com
 * Version: 1.0
 */

add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
});
