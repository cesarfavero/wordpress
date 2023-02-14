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

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', 'a895422de9ac7bb31d97290624f19a8e2e06688e04cfb0423f42322d9ccfb82a' );


/** Database hostname */

define( 'DB_HOST', '127.0.0.1:3306' );


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

define( 'AUTH_KEY',         'dY4e!^6Px#F?#Yy]Lfttm[:=2kK:}gUmZ*d4%ivcFd48}V6I@amGbXuwhH:n0!MJ' );

define( 'SECURE_AUTH_KEY',  'pZN1LRga`ALg+E~^=9qSO+&blz4l|*jGlM/Fb:cXr[LO3p2D82oF~5tcRD(2nPEI' );

define( 'LOGGED_IN_KEY',    '31o d}3JVkH#/zIiit^FeiK/HHcHQV/j-;e`C5<Am!8_G^%AQN9EN1n#kR:^FM(.' );

define( 'NONCE_KEY',        '(,|Wt&jp8,Z5-a|?CCC^@7`),Mi_olp2^9zR,L}-)8lxfw0ES{&/NA|yBh+ez[N`' );

define( 'AUTH_SALT',        'FSpMUaJaYu5dg~oo-5T{~xUmPC#waiMnI2O@Hz7+Bv*wWtogPyw}dZgtbZB6F]ZN' );

define( 'SECURE_AUTH_SALT', 'nYWk&liE*|Hq}/<lWq0Ldp^?,ZF;@+.IBBGgh5):c,fo-@iZrD.l.^OlJlGBRXH}' );

define( 'LOGGED_IN_SALT',   '#LH?Klo(:kL~jkle:C(<OED`I*n^eTJG20iwFqey<E?1xqalSe-><rGW8mf%/NqF' );

define( 'NONCE_SALT',       '%Jk7OcIf}.6}Ls3I];bJ;i_76Ebx#C@MLnznJza$_Y61P(og7>.0tARy&Vj1{$hK' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_';


/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the documentation.

 *

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
