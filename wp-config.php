<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'simzy' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',q3`S8P0{ZP+J3zldk b?qM=EC!&3{c:F<g#E3gY8)tPTwO!e)k E{A6+yF<f.=(' );
define( 'SECURE_AUTH_KEY',  'eBRUc.<u7mj,c4_OgjTlBj1D%cRpp2$I,vh!^#8`xQFgWJ(Ggky/P((;P<DArvMA' );
define( 'LOGGED_IN_KEY',    'Vb<zZFLby)/2;.mX[i-<6aoYi*4-;gk/N.A[<<,/0Ut+f^F@=ve!V4e-SM|8mKD.' );
define( 'NONCE_KEY',        'C9=TXQ<J4oiV)d22sok7WMeXHJe2}CcT?(+z6ppn(a)@VF-o#!cqcz%u)R|ZM~1z' );
define( 'AUTH_SALT',        'J^nW>eap!hi4CvO~0TRo-RWAjn:i>NR,EqA/0(yrCB+Xrm|L,|vd{i;|ccV>Dq=(' );
define( 'SECURE_AUTH_SALT', 'o`|Csh&Q)mNkK`S]KZ6:1~hqFEmF.AwDYzOL1 Yq[eDuBwG0o)Jdi0g#Wouj h-5' );
define( 'LOGGED_IN_SALT',   'vAy>`/hFI4Zdwl2kd5C1j@@e`4>NdR9Dn^6#.PME-8Zau.A7q>+_5A42$3XK7F4,' );
define( 'NONCE_SALT',       'eMPUz&V&{+DJ{8]=`d,pXY+1*Rl(}`bZdD>Mml2p81f0NE$u0DWKgV1at9V6JDYQ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
