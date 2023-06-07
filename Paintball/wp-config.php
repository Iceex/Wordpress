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
define( 'DB_NAME', 'test' );

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
define( 'AUTH_KEY',         'vohBS$uGG,~3-4~I{=5IJ%!-_SXG|y1fs#DLlS3Q[8=-rsN:7eA&k*K?:cYVlnH+' );
define( 'SECURE_AUTH_KEY',  'kM:^u>):WT$^t:KP& 0*PrOY,F(,F0--PfV#T}~PVF0./er(xU#:1su1/+deVWiX' );
define( 'LOGGED_IN_KEY',    '}WX4:DAR*A/xy 5<q-5tM[p;wtW)e|5}hH`:o)LZ@=1]BGvJZk-3W]$vHBLsY_Hc' );
define( 'NONCE_KEY',        ']})o&<</]V.]V;:s.a]Z8ShZ#s*!uTdTH:Kx!%?{|};g4mZ4Y6/M9.[{G4j{=hr?' );
define( 'AUTH_SALT',        '4mZ/nBp=DK>.gHSx-E0UWDk+MxHJdNdn486D<0`OE[?/R*5NT7-LHw&Ob(_>MASA' );
define( 'SECURE_AUTH_SALT', 'pv!1jp+7@e{dHohCe3!bE8CzZoZ>:pf5~SFPm|Nxf0O0wr8U3W,Bq]FCX.i-u4Qy' );
define( 'LOGGED_IN_SALT',   ';gX^:/$J E1#7zovURNXy(2b#^$@eAAR{]@&k|(16s>%o-<nZ_@O7|b,wj?a!Soc' );
define( 'NONCE_SALT',       'JRl?B<ahz _kOzP_:v:jI|-gI918n).9os4Akoxm~FNTp% )EjFz(r6i+d+Um2J?' );

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
