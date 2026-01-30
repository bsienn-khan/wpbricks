<?php
/**
 * Plugin Name: Cleanup Site Health warnings (MU)
 * Description: Disable Redundant Warnings
 * 1) Disable debug mode warning in the development environment.
 * 2) Disables the background updates because updates are managed manually.
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
