<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpbricks' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'Admin@1122' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ',}LsE|9RP;)<1brkBE=dJ5}=6(Zn0hMv`C*y!^Mp).?-4F!YE.U|(gchd:NDmS4O' );
define( 'SECURE_AUTH_KEY',   'EHwBRuKVYP|!ndJ6l5@S[qVXjY[5#Cgg/0>4=}X]cPq|0hY V+JS<._T>JWWa+OD' );
define( 'LOGGED_IN_KEY',     'r- ^h@E)Y[DhTZB0a)nLV6!Mkph``j1VxXg~{HEbJk-QYO}AeObM]ja#&Rb~6p_S' );
define( 'NONCE_KEY',         'FgAR[z9L3<L,<.wN]s<a_fSCR[>EBhSti83/Ms!KdflYr&21sD`o-xlaSWYXE($j' );
define( 'AUTH_SALT',         'o{X>941~h>k+.I;FQ9n[>A]hi44:lk]QF0K-k6=zJ.Td{hdt;:/pJ5=zesahoKM*' );
define( 'SECURE_AUTH_SALT',  'y/`Xu|5-6IKZ!KG3S0Up~mZTGIp.pK?@_Qgw>^7^*D4T$Ow+f)?;-[9X@T3UN T)' );
define( 'LOGGED_IN_SALT',    'qnB/5 tH:(TQ _#I~m+fJA~4,7T;bp`S>[I9=g^xSt+}@f+;8/I*~i>tB|En$RPy' );
define( 'NONCE_SALT',        '.37y1hS--3wf3(UaV[2Je1C>!63,JYEaThMrMq@D?j&sb.tU`L7NPX])![+w2#8X' );
define( 'WP_CACHE_KEY_SALT', 'yPKP(ryMtE1+<uj*7D<L#_M;NyaU2N@:  :+ s&du{HJ^}T(wb)!O3Hf$XBg7QA)' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */


/**
 * Sets the WordPress environment type to 'development' for development purposes.
 * Default: Not set (WordPress assumes 'production')
 * Benefit: Enables development-specific behaviors and disables production optimizations,
 * making debugging easier during development.
 * WP_DEBUG & WP_DEBUG_DISPLAY is automatically set to true in development mode.
 */
const WP_ENVIRONMENT_TYPE = 'development';

/**
 * For development set to true, Disables the WordPress fatal error handler, allowing PHP to handle fatal errors.
 * For production set to false, WordPress handles fatal errors with its own simplified screen
 */
const WP_DISABLE_FATAL_ERROR_HANDLER = WP_ENVIRONMENT_TYPE === 'development';

/**
 * Sets 'bricks-child' as the default WordPress theme to be used on the site.
 * Default: 'twenty-twenty' or the latest default theme
 * Benefit: Ensures the custom 'bricks-child' theme is always used, even after updates
 * that might otherwise revert to WordPress default themes.
 */
const WP_DEFAULT_THEME = 'bricks-child';

/**
 * Skips the installation of new bundled themes/plugins during core updates.
 * Default: false (new bundled themes/plugins are installed)
 * Benefit: Prevents cluttering the site with unnecessary default themes and plugins,
 * keeping the installation cleaner and more focused on custom components.
 */
const CORE_UPGRADE_SKIP_NEW_BUNDLED = true;

/**
 * Disables all automatic WordPress updates (core, plugins, themes).
 * Default: false (automatic updates enabled)
 * Benefit: Prevents unexpected changes to the site and allows for controlled,
 * manual updates after proper testing.
 */
const AUTOMATIC_UPDATER_DISABLED = true;

/**
 * Prevents the installation, update, and deletion of plugins and themes from the WordPress admin.
 * Default: false (file modifications allowed)
 * Benefit: Enforces version control for all code changes rather than allowing
 * ad-hoc modifications through the admin interface, ensuring better code quality control.
 * Good for security and stability in production environments.
 */
const DISALLOW_FILE_MODS = true;

/**
 * Disables post-revisions completely to save database space.
 * Default: true or a number like 3 (limited revisions stored)
 * Benefit: Significantly reduces database size and improves performance by eliminating
 * the storage of multiple versions for the same content.
 */
const WP_POST_REVISIONS = false;

/**
 * Enables overwriting of the original image when editing instead of creating a new copy.
 * Default: false (creates new copies for each edit)
 * Benefit: Prevents media library bloat by not creating multiple versions of edited images,
 * saving disk space, and making media management cleaner.
 */
const IMAGE_EDIT_OVERWRITE = true;

/**
 * Disables the WordPress cron system, requiring an external cron job to be set up.
 * Default: false (WordPress handles cron internally)
 * Benefit: Improves site performance by preventing WordPress from checking for scheduled
 * tasks on every page load, instead of relying on a more efficient system cron job
 * i.e., using wp-cli to handle scheduled tasks.
 */
const DISABLE_WP_CRON = true;

/**
 * Sets the memory limit for WordPress to 256MB, up to the maximum allowed set in the server's php.ini.
 * Default: 40MB for single-site, 64MB for multisite
 * Benefit: Provides more memory for resource-intensive operations, such as large imports,
 * complex queries, or high-traffic sites, improving performance and reducing memory-related errors.
 */
const WP_MEMORY_LIMIT = '256M';

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
