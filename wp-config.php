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
define('DB_NAME', 'game_theLastConstitution_wp');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'limogescsp');

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
define('AUTH_KEY',         '6cKuQ,>YM48s`94`iDldRBcm=V~[Vfe6&cdm zEv]p![- ,`#[9THmuw)c%}.4RT');
define('SECURE_AUTH_KEY',  'vcl;nVPmkfckpR%1mW.D!].Wqy@:7_*uuM|;4T)( g>=qmZ,^Gx8{#Ky)k _v)_c');
define('LOGGED_IN_KEY',    'Fhr^4]+AQHf$=kiWZJN5)7,m2a:S=Ys=o, yo62V,.o27pM5OC([1gPjQx_tRm,G');
define('NONCE_KEY',        '_MVUb2Tn.X:M;#gXl?T>S<bN=YoQC7NlJf>|h+II&IS])=ruQaD{}6kDF:Vk gqm');
define('AUTH_SALT',        'F!fg+Ht$[a|tj_tJgxEu?2F^,#{DGZ/rPs@6g);v{@ 0l5lB0W(07_e_.INko@?e');
define('SECURE_AUTH_SALT', 'Nn5APzb,Dp3#.O9ggA)8|^q&lv~j~^W>b=$yoL5o5o9q=|YU(3cYvxZ=8~#AH+1E');
define('LOGGED_IN_SALT',   'ri^&8eX^{jY10/.wS=#Mk/ZWVW?0?NKvO#@v*tf,nTn|1Q3T5_Fpa:v|@vJ%L=?h');
define('NONCE_SALT',       'T=;Nza}hon8(<.G=8#5^PN8B*%!-]!tt8a;  e/(>:v#p/|>i6.g3tZjj*=y%EK]');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
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
