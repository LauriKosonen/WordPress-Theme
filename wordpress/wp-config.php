<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'omateema' );

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
define( 'AUTH_KEY',         'V4k.tb[[`44w^]|+C]X0S>66ZEa{AztOy+qQ.5I-U[A-fLH9~fM9P`ihcC<3V]Vj' );
define( 'SECURE_AUTH_KEY',  '~,sX^EV:(Mu~iTupHa~HRId6/WqT?j0]IW@%_8iuO|kIszKw?>?V2DY2kWyHT[L+' );
define( 'LOGGED_IN_KEY',    '%hix]_R-JLS&9`4I`I2DLfR>rRfEdiA[zv^Ya9Jm+fEGG/u6%If[ZW)YEynWu[Cg' );
define( 'NONCE_KEY',        'GJoGk$}CEX@I;?TDh5cf{H*fw40O73=pWI,7>s{CRMd8BXuuDGfC1#.O@!`8xe-Y' );
define( 'AUTH_SALT',        'Lx%8Xb2}RG(:Z}rg]/</qC)0QZXvwb/.|WNBUy]LqV;|J!zzi`3u/uNTlh6bx|5h' );
define( 'SECURE_AUTH_SALT', 'A{<zN]dKsPv$}juf%}wMk_ry5zY;P@rqXm)*f?MFZuWsGi6veG{Rvi#f9{G#[?.5' );
define( 'LOGGED_IN_SALT',   ':6/qbZ4XmCF[LYguLfifN6Lg*CGOz[kJje 8~ K,,{QVC&~{|.TY`9y+48qI5 %?' );
define( 'NONCE_SALT',       'Z>chfTA$:[YB2&plYxXi{#{jgBAS!2Iuj5H`10q,p^:h=VTvl7 JW~`By,,*z 9x' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
