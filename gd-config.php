<?php

define( 'GD_VIP', '166.62.107.55' );
define( 'GD_RESELLER', 1 );
define( 'GD_ASAP_KEY', '120204b6e563e4c1855502d9d6d0d615' );
define( 'GD_STAGING_SITE', false );
define( 'GD_EASY_MODE', true );
define( 'GD_SITE_CREATED', 1535993290 );
define( 'GD_ACCOUNT_UID', '98d36f62-afd1-11e8-8145-3417ebe73f0e' );
define( 'GD_SITE_TOKEN', '064612fd-6212-45d4-9d12-88de3913b53f' );
define( 'GD_TEMP_DOMAIN', 'j5f.49f.myftpupload.com' );
define( 'GD_CDN_ENABLED', FALSE );

// Newrelic tracking
if ( function_exists( 'newrelic_set_appname' ) ) {
	newrelic_set_appname( '98d36f62-afd1-11e8-8145-3417ebe73f0e;' . ini_get( 'newrelic.appname' ) );
}

/**
 * Is this is a mobile client?  Can be used by batcache.
 * @return array
 */
function is_mobile_user_agent() {
	return array(
	       "mobile_browser"             => !in_array( $_SERVER['HTTP_X_UA_DEVICE'], array( 'bot', 'pc' ) ),
	       "mobile_browser_tablet"      => false !== strpos( $_SERVER['HTTP_X_UA_DEVICE'], 'tablet-' ),
	       "mobile_browser_smartphones" => in_array( $_SERVER['HTTP_X_UA_DEVICE'], array( 'mobile-iphone', 'mobile-smartphone', 'mobile-firefoxos', 'mobile-generic' ) ),
	       "mobile_browser_android"     => false !== strpos( $_SERVER['HTTP_X_UA_DEVICE'], 'android' )
	);
}