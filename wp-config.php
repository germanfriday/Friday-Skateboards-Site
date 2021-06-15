<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db1364_friday_skateboards');

/** MySQL database username */
define('DB_USER', 'thegermanfrida');

/** MySQL database password */
define('DB_PASSWORD', 'pissedoff1');

/** MySQL hostname */
define('DB_HOST', 'internal-db.s1364.gridserver.com');

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
define('AUTH_KEY',         'r|%)u!L~HmeIOz]>os%yxHU#meNXf|sQl7omJC] QV d<99#~Hq^}L`eS+MI:ieN');
define('SECURE_AUTH_KEY',  'eaij8`0`mI6fH/P?W=ZU]Gq>1Vt-HJ/Nf+OoO`q&|E>t7+l^n-/:|:<s#HB_*wCe');
define('LOGGED_IN_KEY',    'FWu-k1>e%h.rY$hLySObK7|Li5sBt+k{*b@%yyW&+An7GrElhwjQm6)}$1P~to)U');
define('NONCE_KEY',        '(6Kaf:=g$M?;jD yd %M7/0-uTJb&qqi},D(2hO+O2P~:J%)9K3Z@|eV!rXs%/!,');
define('AUTH_SALT',        'D:rH+ruAr@Ld%&B45~0I]m(-8h#[+Y-/$=w]3rtr-(y?1u4Ftj@SM,`FJPz8IC2Y');
define('SECURE_AUTH_SALT', 'V8pT($cr@On%VR s*]pp+@c/P%_8$Qb-SkMVS-~.tG$+XX5(nbhB/jW!yHP__?{&');
define('LOGGED_IN_SALT',   'k,EAhA0tFeJ55GgN_j~[r2p[a=$31EA9C:nBa#yO=t`N~oDSG]k(Wk@bWg#Bl1jz');
define('NONCE_SALT',       'dTEh)G=dji8unHn/F|Pl%u~LoP#qv;LTu9BZ1).Oi<lJ]#q=FHZ*-fbP|L&x~R<.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
