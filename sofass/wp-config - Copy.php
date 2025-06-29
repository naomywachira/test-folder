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
define( 'DB_NAME', 'sofass' );

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
define( 'AUTH_KEY',         'f6D.47mJEPs$)NDK4`RDyF*{UVX9cy,t&_W?iIns5}chZBb642hn|ho}6LGCs6:T' );
define( 'SECURE_AUTH_KEY',  'jCo]!UOdeA7YKdJ x?Ao-t<,:{U2;X!N;#u9oql@vmEL[T5MofP`KO$BnWJF#zXf' );
define( 'LOGGED_IN_KEY',    'Rzt_qvP?/51R+!O5HH_Z5Ih*tR-E,8Ahs(pO3E.i^gE&q8|E$sBf*-pg/~w6^:g3' );
define( 'NONCE_KEY',        'm<DE$JU.Ify9POvloj^J(foMA*cOJzX:*@P kgFg(^PdLe^>YyX5)Qsr@@0,UpbF' );
define( 'AUTH_SALT',        'po4ZiGwh*_,[^4&`/)`g /HD08mn,m)g:yZ8z&[Am]CX(Rep32:62p7/9num)()y' );
define( 'SECURE_AUTH_SALT', 'Sc5`6]*(nkeMsq;$L4q_pYM1p2+r}.=/dOXaL[xn#F{xmI!=c:B; ] ]+]ynN2SM' );
define( 'LOGGED_IN_SALT',   'wmYvZ`3q@DFp_H!}o8m-SVA?R}^}x9)T$Q8rtG&(VeyvgBbk2O%33q2W`:6E )-T' );
define( 'NONCE_SALT',       'epG?2`jz z&]3^ebh1{|2qU]g~jUVoluTZA{iC{,Y e0]d{[%(/t/]HJPBEMtqfL' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
