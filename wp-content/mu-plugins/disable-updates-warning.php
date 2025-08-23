<?php
/**
 * Plugin Name: Disable Updates Warning (MU)
 * Description: Disables the background updates check in Site Health because updates are managed manually.
 * Author: adeel.cs@gmail.com
 * Version: 1.0
 */

add_filter( 'site_status_tests', function( $tests ) {
	unset( $tests['async']['background_updates'] );
	return $tests;
});
