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
define('DB_NAME', 'game_last_constitution');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'rastaman66');

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
define('AUTH_KEY',         'pKi0 .U#k-2{0G!hlJy<B9w!fmJ+P#T=eJGcA~2%@w)oOx*n*Z9f1QY]c4f~(hh+');
define('SECURE_AUTH_KEY',  ';`vmoeL<h~JFD-=_D&Ek[+#-^qdL7/Q~}3J>gX9bUhpW6TxTY:nu*=i{4A O0XE,');
define('LOGGED_IN_KEY',    'kP+H4n#Tys>`nGZX J)E1_,g0W9Ikx%1oXI=gl)uYns(`CH1;9#,f.lN8d^beN~U');
define('NONCE_KEY',        '|VV&pK:[pMIS>;a{%FeX<^?H=q{/7R? v(^>jzs~U7 34&ag%0&P;]ew6aZ%HtVg');
define('AUTH_SALT',        'kwdqAGC=DJ!>7,@]{}>+db~r;Pp+UQ#to_/K8Zr-ho6:V87@$RxH%F<%M9RQD3mo');
define('SECURE_AUTH_SALT', 'pA)wJ6q+h5w%`$K5,e.hQ14%j2?~`JGpU)WIKA.>$xDi$gEfKG+PE9^]-aJ4Gmrj');
define('LOGGED_IN_SALT',   'q8{6>@yO:BMR)JVD&MzQQRg75)L5USGNIfPv_=lJkgbJ(fJEtEu|I}BE=+[ek9OZ');
define('NONCE_SALT',       '14~4b;?mGvwnz=(OIoo)M8yG,S8fR&4 -KZgrW)EF1k3-sf J_+(o7M?p75J0P_R');
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
