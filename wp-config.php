<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'last_constitution_wp');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '123456');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ':=5`ZUv|W}d7(k1_5<yUOfa~p3S(DRIzygMB0P4[9J_2|: Svl<XiW2&.nDQ9QK_');
define('SECURE_AUTH_KEY',  'pY8iSiE)GE}M3z>.1*IWpaq<?8G3 f/)yKi:1?Dqof!@T8mR%.C~*P/%N~:m(ze]');
define('LOGGED_IN_KEY',    'a+DpgrCz`?c b-K)!9$n_z#,FgrtE9c_#v:5s.sfi^%Ds asL~DB{3`zI?/#7x?s');
define('NONCE_KEY',        'ix0HP]yyPw,G#^/MSMhI:]+Ki%Bni,D(:B_]lE-sYF*ncxg,S^ TV$yo2R0%kp65');
define('AUTH_SALT',        'CWu4}]M[=M|z=((oG3(1}iL3&vlKXA0Y_~Ptz`?]@C<D.bhv]bJ?R;r:1T2-KBxc');
define('SECURE_AUTH_SALT', '00:#_%31]aE9aEYS8V@a=u!4f$;[==l]:Er`kezXi6AXwWQW<kupm]Y;~#LJr?mk');
define('LOGGED_IN_SALT',   '26uRl6ygNv8(WH]J(HzJu<)>85<Fx-yW%R/* C=[Wb/Dd_IFJv&|0>|;Fd}Jbac*');
define('NONCE_SALT',       'r(1+$+*S*P].c[1_w{>sQw!!|=!4r=[F<]SL5x]gQUsBfsNnMT)?bn~)qTlY{kzk');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
