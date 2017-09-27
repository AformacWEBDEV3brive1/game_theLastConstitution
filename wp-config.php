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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mega6*3zd');

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
define('AUTH_KEY',         'mz<>|q8&P@#,V|Nh9DQ>uTaxQ|F8<elGGo0yqE*7[xr%g.@Z}NVZXA0{gx>P44z!');
define('SECURE_AUTH_KEY',  '%XG[A+t+@N8su7[j E3Ia&qy1IhAQ!ZI|#mbWvl1K0T56Pi1?3I2.eQ8K!0Q,<~h');
define('LOGGED_IN_KEY',    'MIh:&!|234n=r[},ejNN6ymD>0+jGkh (_2b/22.X!X(tUTUer%l,I-acw#6E8V|');
define('NONCE_KEY',        '_`*.X)> b^C:}eA avvMI6n(#?NI=e,;2(g^EprpYq?)+K,!i<)P|KNUUvRH3.Gz');
define('AUTH_SALT',        'O{)mp>(qB6AMr$yl^<A-VA?*HC@6aV1 >L_{ZJP1]lu}mwcs-9H:dU2uM5ZEOM.6');
define('SECURE_AUTH_SALT', 'xAz@C}lWu|# F{[(MY@>;M(3b|0l3nIcz,POOs/Q@HV]|p$*cX_;tx@Svdw+SIK%');
define('LOGGED_IN_SALT',   'AH av,XWPI4FY#m!i^rphW%gyWmk2!9y|_w@%:kc(O]u).^@Bq}%pCScj6wF)<S*');
define('NONCE_SALT',       '4PV`6N@)QY|MFUG,;ry8g,` :R 6!A3J_xF%&p?H80A2D:]IPnGy{xxz*}MmRH9a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';


define ('WPLANG', 'fr_FR');


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


