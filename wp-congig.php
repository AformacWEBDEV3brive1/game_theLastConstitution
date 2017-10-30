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
define('AUTH_KEY',         '?2tr4*6j6 ;2 %z}?ua^-h5ACt{JV`IdhZ1Uxu?^Q,uR&<opUVj|$u4dR:Ji^%,a');
define('SECURE_AUTH_KEY',  'U580iCGhX8&poE5h j#;K/t#dA($x}*kUiU8IENDzB&.Yxuk0 `~]c/1R.$85gfP');
define('LOGGED_IN_KEY',    '8u}[48o9g`xLUnW(R&4rJZT>m1DKb3!%tK!~&~t31)=l]EnGaGrLhh6eD5(lX}:!');
define('NONCE_KEY',        '!<wK6.?lL9E:Irh6Y CR2!(+/cPXi{|IO&]-:Eh#b}N~gw=D>652#2^0i_}@$y&q');
define('AUTH_SALT',        'N&iH,[XbLgniam$}C6h:|mRfz$yq?D@QCr)$gXS(?K}O=$GV uiKzi+ovxM!U0]I');
define('SECURE_AUTH_SALT', 'V(?:$z>;Ti^j s9_O)#9pM+0VqVh^._G!@9a/Aoos)j:r#wy_)J#<.g7xw.=+2CO');
define('LOGGED_IN_SALT',   'g6u3K5bs~*bmmif.X6la]HE@+[SXo!5k*zdipXgmJZld8%*Y]{+aP=+@.w!I=t+O');
define('NONCE_SALT',       'zz.@tG~X9Pxh^&|nx4?ih#w$H=OoUzA!w&2+B7dWlOD8Ub1@|I9S,c|$::#&2B|K');
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
