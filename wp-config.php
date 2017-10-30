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
define('AUTH_KEY',         'EjqMKDz_{*X_@/yD$j]eHb5uW=c9j{s:|VOvW!@t4#kv.G9Da@,mS.yZ5=J%QyO0');
define('SECURE_AUTH_KEY',  '$pjdNpN$Tg:DF;Y~-=Cu,R?}_@&fnv<Mc4%=/zX&0bD$iYia;}N_AJW&iV{<[ 4s');
define('LOGGED_IN_KEY',    'b31A?KI]HzGpZ^H2?cWJ(Q;d>cZ_]`=29GKR72HE%kB~m&Gr3Uyu>xJ:GKmZ[66C');
define('NONCE_KEY',        '*HV+%M.d UBI8]BiJ9&OV~W1I~K$I_a)2^3E;b:5.$N^9DSjk^hG8]c*h41vQz`;');
define('AUTH_SALT',        '!M@:/}6>$^.-ZlkuZADakqg/ T*iz<6|fh2TZD; VQ$q.oC.JK+^s&)M{rS{,j`j');
define('SECURE_AUTH_SALT', 'Lb1G/zoP<_I(*&[n3Ca(SKG$_(&%y<pI3;sobuZOW|Y%S%O^dql2m.;#2ah#4AaM');
define('LOGGED_IN_SALT',   'w1GgJ5t>ciKk;Z[K{iOCRAKdz{==]c0uDK2JPUDUQ.g]:ArLhawK,1PwMmGLP1V!');
define('NONCE_SALT',       'UVH-KTixAdOV(=U3g7Y<M2P(8VJkn#5,{!Ly0hDRfs_t(&)ob>z6ndat+VT$1P5h');
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
