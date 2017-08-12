<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rfgd_20527767_kd');

/** MySQL database username */
define('DB_USER', 'rfgd_20527767');

/** MySQL database password */
define('DB_PASSWORD', 'e4nb80gG');

/** MySQL hostname */
define('DB_HOST', 'sql211.rf.gd');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Rp%Q&v:^}zwA^Pv]<Q[^bY2=f.Zd?Fr|-(/f-g|5{AS8F]R#si,IC:[8qiner:U6');
define('SECURE_AUTH_KEY',  'a=m4} Vw::Dz_>.]]#SQ0:E@|BwXq(z}WIPopcB0zz_IAwzGx+maX++w4C+Po.+0');
define('LOGGED_IN_KEY',    '+ZiLfEW~PFvKZ@1)Jm|;TuIhd?GxV $`ur/rV?25agXGUa}k[SEK7d7G|Zoo|1A4');
define('NONCE_KEY',        '!<{W@iuhb4QJ|pc1@AYff InxZK5ve%^9LgFdEO-A`Np`la~ae><1Byi)p|8!1)<');
define('AUTH_SALT',        'xWKE&:d%h%;~~)?V.XW-Ky{J{<|@P|^Q;Y*24WE/SfE`>nF7Hj@*no-KY7CW%$]9');
define('SECURE_AUTH_SALT', '!k@m?G1zvhE9-Ug&XWTG`Qg}seQ(??3>;[-d5<9_8;fB}N}5<F/t|TteF$3]=1Xy');
define('LOGGED_IN_SALT',   'nO(!wA0W/N;@?}a]U0oig^r,owSas-OClx8Ihh=`m?R>8/bau` 2|EsWJnyqNOw7');
define('NONCE_SALT',       '$1BMP>:Xl|)SKJN02=U|6JlCD-Ua$ooPSNz|;oS8}>5fRoKI>[V(Wp.K|vCGsAIs');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
