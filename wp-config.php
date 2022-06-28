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
define( 'DB_NAME', 'market' );

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
define( 'AUTH_KEY',         '7S+uYu?2=tSl5 xu,cbI,s*P.:pNF))a`Cn,v$4bNre5-Y4qLS>&YrbVe&+T{k8s' );
define( 'SECURE_AUTH_KEY',  'M3vkC|9q,eplRs0g[RoKr8P/Mb%N()kzT(]Md ~A:Ai4n;6dO OQLh+pqM/T&18]' );
define( 'LOGGED_IN_KEY',    '.65 }ZOrVNn,]H=|KT8g7:l? mNxZ3rS-l]j@pg&ACt=?}.U]V3Ym;+uLdcRdHfO' );
define( 'NONCE_KEY',        'gt.McOt/Z5S.c(Aws#K7,{.`uBFF@J-~$KQia4~[@p<HypF8@dVgkXgBK<QJ:Rbx' );
define( 'AUTH_SALT',        'oack.se8Y?!nBWBcn>1sNZra(Gpu57vCo0P?mMaX,Oj5#4;Kc(FqAw-VE=YTfJGJ' );
define( 'SECURE_AUTH_SALT', 'HO?bFW[C9)?U1c0:2KKTTyy3BeM .O1=uzFFF`<Pxm9yyN2fiQ~PUnOVq?Sm!ARy' );
define( 'LOGGED_IN_SALT',   'kke_HD-E?$Ckk#J &{;^IZuF#Al`2oo@dE:E.:/&taWO!zi(32#7T5Q0oasz9xe!' );
define( 'NONCE_SALT',       ';1rjaqmZfTr^`H@3PLMo1#Mgz~C5o_a|%2EDp}&:TsP8_1~.&3hPqd+-LPH[pD#d' );

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
