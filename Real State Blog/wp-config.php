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
define( 'DB_NAME', 'portafolio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'IL Z@u{5Ut4{~*wUe(9[.(8k<+q7o_eXsB<k)<eIQQzm*5K?*h| 8VK.J)P)OZ=5' );
define( 'SECURE_AUTH_KEY',  'PqH%.a%hx+5xQ+!5WR[@3I{^X07J+M2h9nnoW$$9[7 0VTlkJZ%`3mltXMeA%zca' );
define( 'LOGGED_IN_KEY',    'qcT$rl6aB#1pY2isJ~,r]QYN7qO,W~*5Dnj-V$FNxcb{iM+FiR~LQko*:}l9H7pG' );
define( 'NONCE_KEY',        '[4m8zv%1%JF/ZfUKdD|0zW7,sH2gqOa$s`o[c5I3GYVo~4|fUze+>#58ZeWCCK`N' );
define( 'AUTH_SALT',        'rXY^QY!<v<UYoCbR-gIpk)XV0?xDcdmqDV!GUSUHMJTE#fmsz7G1lQo%M^,x0yq>' );
define( 'SECURE_AUTH_SALT', '2bLNml~AyW)5Jz]Wir`)8BlR;c-v2ws[]4nKVi$;.E[t5a-:jNP?5@Wkur45w.5L' );
define( 'LOGGED_IN_SALT',   ',K#]oqn[P&e48bi8*c+|pk~V8`#r(*kstZFW%#rRrl(Vp$Mw*>,c$>`N~Z+[m*:@' );
define( 'NONCE_SALT',       'P)(?rmsnp55~#eLKIp eK%TuRg6zig||8bDc,_+a&ykuey],5{; )ixS#mn/`Tv/' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
