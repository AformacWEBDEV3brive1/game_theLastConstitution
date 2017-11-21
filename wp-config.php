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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'game_theLastConstitution_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'limogescsp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '@@`In84d.:cZ2! {5e2c*ykk.+w]#dMaF{~f|3b%/E!Qa[FN@.nKj[lgu[8Y@RuN');
define('SECURE_AUTH_KEY',  '=?laf9/$U>[_(#g}]W0XN2mz$s*em0iofy~b,SF~Uk:S+R#ldCpa+^}^ I70~sa<');
define('LOGGED_IN_KEY',    'pi[=8yHZ&Ad=${%Fd $k*g12%3|>1Ll9[ q^@Z##Y+i:QI7umB8h1vCU1flZqa@8');
define('NONCE_KEY',        'sbI:BPA(1nO9TyeS|z*$B.h,mkMBuTp5N$xQ]4Kj6;8[1ii^3nIw[x /G5L@R.k3');
define('AUTH_SALT',        '<Yr<@)PSis)3Qv lxZ#>sNJ&i39YjdQ91lH5EAf]B&fN)QCV{&]vJfh=!}I;uoxl');
define('SECURE_AUTH_SALT', '-JMQYa;b{c5C2i2{6Cvi;)=gOK|[(nRoH!Iax&@jP%pl?ljRx?%DWt8!Qm.`~m_~');
define('LOGGED_IN_SALT',   'j=,@Ff!LJxUs& tspuyOw<?Ime9D#INef5E-<rjesrn<SSl5Rxl2;JJADdW*t[sf');
define('NONCE_SALT',       'PEdE#WCDv]+0$wk8Egd.&[n%~xsnV8d30RPi1<0,bC25 c5(*b2 LWA+y[&.E}SA');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

