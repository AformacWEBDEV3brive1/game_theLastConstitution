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
define('DB_NAME', 'game_last_constitution');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456789$');

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
define('AUTH_KEY',         'r}%I_uRoe@MZ3%wI%1y]J.O)%;<b`6hi}UxyVnSY/)%r0$+iziK>1XW.BIHo47nO');
define('SECURE_AUTH_KEY',  '<_[3lam$lZ 0nuk}TSsXZ-3e_zlFm)$BCP`c&N!`7;3$5,4kGc+5O5d+he)NHKRZ');
define('LOGGED_IN_KEY',    'XeR3pWynxsKE:~B|KC.!xy3{G^t Ps8DO6cUu1w6U -&C*WF)a,ccUyQT9_?Mjvy');
define('NONCE_KEY',        'Hb;}N1lBC)s|(.pW.gKoSW[Bh?Vao#7hm=S;oe_ujMj0cDCXU!N.y-$X{Uo141G`');
define('AUTH_SALT',        'rwk[b4Ug@W^9t~nw/SCnj6^Z-Q/_$Vbkt31bFmCd_4-n1$cX<teck8;7D$.o><*^');
define('SECURE_AUTH_SALT', ';?Iwl}|H]6sd!D>y2S__9q]||@[8N/Xd5zo^h~*PdBmH(a+0Xr7$U>;zto1DT{rZ');
define('LOGGED_IN_SALT',   '%xu3}orHfcgju6R.g>@mRj{w5(hO_m0.Z[e*]hv~q_bRBh&]w@lRu8|5oVo1j 2r');
define('NONCE_SALT',       'Rel2*U9OL;~S@b<-JXSN.Jc,Or[MbZ*H<IaVz4D0py7}obW!PZS ~a&v/0LlE;/r');

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

