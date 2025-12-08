<?php
/**
 * Plugin Name: Handles SCF conflict with AT (MU)
 * Description: Advanced Themer forces ACF to be used from within its own plugin directory. This overrides AT's default path to use SCF's path instead.
 * Author: adeel.cs@gmail.com
 * Version: 1.0
 */

/**
 * Advanced Themer forces ACF to be used from within its own plugin directory.
 * This causes SCF to not work unless we also set this constant here.
 * Define MY_ACF_PATH only when Secure Custom Fields plugin is active.
 * If SCF is inactive, the AT breaks completely, as it required an active ACF plugin
 * Which comes bundled with AT.
 */
add_action('muplugins_loaded', function () {
    if (! function_exists('is_plugin_active')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if (is_plugin_active('secure-custom-fields/secure-custom-fields.php')) {
        define('MY_ACF_PATH', WP_PLUGIN_DIR . '/secure-custom-fields/');
    }
});
