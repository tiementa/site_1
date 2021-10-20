<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'site_1' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@rN:Q^?S5w5rgc8s1@<pVUYC/f<i2?OE!fX!<*Xb4a><>>a9to(NigjhZo#?32r7' );
define( 'SECURE_AUTH_KEY',  'aWy6}dl,aSI>;xGE+B`Pz/_A$A&n~T-V|~k%?k9>ixB<^7TSalS87~@Lx6&m9+_o' );
define( 'LOGGED_IN_KEY',    'f7H2@W$vX.}#WTmxQ==S;(/&Fx-KX36BK25/p^@b,?~mDT3wcc>>Zx?fWVo2Y(IA' );
define( 'NONCE_KEY',        'T-2C7KqOWy[UXcE<irLmBR<-GPh0s/r+yOr?kV0+DfDH^y1Y8dYM7sbySPEwLirQ' );
define( 'AUTH_SALT',        'mP|0z47Sn< *_#!GyvQVyDPny;V,u;n3:~!KU:dS$Jph&.P_1k/wNtb+f+6_A<C|' );
define( 'SECURE_AUTH_SALT', '{iwQ$@:<=aBgjuX/?-S<@m%!BlxZ1`J%|-Kwh{yq!njam$SmB2pZ!tHbGai6UONP' );
define( 'LOGGED_IN_SALT',   'rxItY*!VFL%j&3dI?Pk~+6s_5H6Q)G(~rSuC$mHw5lYt4Raj1Epk>,OAFS2)p97`' );
define( 'NONCE_SALT',       'a/sIG7}!~3o;oq4t#H}AzV2ENn*t~:ZtNnT!txNy`T@jC_LSu+!Ubb; YCNM4_LC' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
