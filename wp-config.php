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
define( 'DB_NAME', 'radhikabapat_Apr' );

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
define( 'AUTH_KEY',         '*._6%+u*/rq7 OaM>U0*/~zQ2jh)$#+Dq0`5lG7Kp}lK2RPg}+)PDEZ1Fl5s8Xw.' );
define( 'SECURE_AUTH_KEY',  ';sxIkE8awvgy0e3-#Mr+Q:H`@@g+^dK2w@3$iOjEchuh8UMB4r7FZQG(Xc)eq$(t' );
define( 'LOGGED_IN_KEY',    'cxiIZ0{LjksW`Fh?B61VtWJR?V*AB)@)&nAH[DUNLT3dE,4`2uu`}.=/408cOuc4' );
define( 'NONCE_KEY',        '[Pc,UrLib?Tj_W5odde=ZHQ`--.|HCaY$Bn5|.0d%{Tjj_[$[I49aXsFmod$v4D,' );
define( 'AUTH_SALT',        'Td4/G,y(bxETLfdQv#54glh(ByrIZ(nNc6S!J+/z~(c|3AH=KUkWo%<*WOpX>^A/' );
define( 'SECURE_AUTH_SALT', 'q78[+=bC8+T`?IB_$`D*HP3v`{n3!!)q6^>rvx%d~iWr`MOv<HJk~;oP6f%YvaWo' );
define( 'LOGGED_IN_SALT',   'X|2Pr<fvr9Y1W:es[|XO;pFxZ_N-bbdK+1iH$;^Fz@PRsuCwjvA=`yhz9o&aTr]3' );
define( 'NONCE_SALT',       '+a 1Wz]ST+37B*|w3;fY$5yd;uRb%l,VgPxdcf!_QZZ?#q``9auJ|;_*dLiQyU+8' );

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
