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
define('DB_NAME', 'atrixtest_wp_mh5ik');

/** Database username */
define('DB_USER', 'atrixtest_wp_uixry');

/** Database password */
define('DB_PASSWORD', 'V#L68@yo2A_SLufK');

/** Database hostname */
define('DB_HOST', 'localhost:3306');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', '84EDJyO+)r5WL79p(0f_#PuH)t8@V%ck7;mPv&D*Oy%O6:Y7*Hu2J89R5)l(08P;');
define('SECURE_AUTH_KEY', 'sh+~7Op0B#CI#xbR8c|dZ13)P;*Y05f)G3IU]t;2k3xY190W6F665*j12y80LA5_');
define('LOGGED_IN_KEY', 'Q29JQWo%kD9[R]w6&B2CsD|*136EtQ@N5iq_;V-l706HI4mH6%[*Y3USvZm1IZf3');
define('NONCE_KEY', 'IhDXc-tkL|fQGy|ob7%37aO+#%r3x7GP1W!NKS!zbs5KKbDgrZns0fdyd@|L9)s7');
define('AUTH_SALT', '83N0(A/1V+47d1~rBJ7W&foz3[688sh~1)!21-Fs6U3j8N+6G-x5|mb1-p00sl7)');
define('SECURE_AUTH_SALT', '3#;j6~p(H#-5:JY@]U0t2+t-1tW0v3a35Pds%8:131[@iYM|qe!3+uy3a--9Ttg|');
define('LOGGED_IN_SALT', '8+Hxj6XgmWF8jTQZ@0+pMx5333((~+QA&j8#-~3PL~E[@0+Jh5DY1ac&iC)LFD*1');
define('NONCE_SALT', 'SI14FE-HfMj4605|i-)2*O0%;6:!w:L804LF1MxK3I+vs7s(Oe[|N9[[1CH&#)48');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'c5FM3_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'DISALLOW_FILE_EDIT', true );
define( 'CONCATENATE_SCRIPTS', false );
define( 'WP_CACHE_KEY_SALT', 'd37a1affc1abe0f7ad0e904d1426b215' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
