<?php
/**
 * Plugin Name: Cleanup Dashboard Widgets (MU)
 * Description: Hide News Widget from Dashboard (optimization)
 * Author: adeel.cs@gmail.com
 * Version: 1.0
 */

add_filter( 'site_status_tests', function( $tests ) {
    if (WP_ENVIRONMENT_TYPE === 'development') {
        unset( $tests['direct']['debug_enabled'] );
    }

    unset( $tests['async']['background_updates'] );

    return $tests;
});

// Hide News Widget from Dashboard
add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
});
