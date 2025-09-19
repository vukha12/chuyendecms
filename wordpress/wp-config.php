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
define( 'DB_NAME', 'db_cms' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '14102002Kha' );

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
define( 'AUTH_KEY',         '6npVD/3f8WByhH~::+}JOs2iQIzXG(@eD&d{]t:NM&3_sN=o;tfm}envu{4-BzhY' );
define( 'SECURE_AUTH_KEY',  'Gu^mX!I+(h4#Zm@/WQ!2.u3ky7Z47-}{`Ts1`T-%o/- t5_YwSKZip341Owvu0lq' );
define( 'LOGGED_IN_KEY',    '!s7s}@>?;/zXbwupXGLqKM(/QF}d{jcY!Y);Hr&I15T//QviIR%M-?SWPLvz19F ' );
define( 'NONCE_KEY',        '5`/3rCQM2.caX`&j!)VIC{3w1,0_YAnM#,wMVRlR[vdj}<cdIe{Jjxd;Qn=M^crl' );
define( 'AUTH_SALT',        'L1vlJD(XiPqZwc/i;HOjk8fd#|0d 8=z]&p(_g?~GiluT4V1rIB)oW8O_;v$aJZe' );
define( 'SECURE_AUTH_SALT', '! Lf<,*)Aims.aaxqnUIQN.831r2}_-WEuP9ImK:B0ytkKm0O,%.[[V=M2p/r]yj' );
define( 'LOGGED_IN_SALT',   'xU448 dy!/[;C(++p&6koyD7Z-&NG*7cE@BTI6:/_-YE7,{INpeFaz-i|73![2)S' );
define( 'NONCE_SALT',       'o,,&be=y9,K!m&N%MJ.#%+rbEKfbQF4g rgafyzx,Mo/t].IOIj6 u.ItC:gFjGP' );

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
$table_prefix = 'wp_demo_cms';

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
