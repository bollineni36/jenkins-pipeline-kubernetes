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
define('WP_SITEURL', 'http://localhost/konsear/blog');
 define('WP_HOME', 'http://localhost/konsear/blog');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'konsear');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '}*2`W8)xCRy3,<Dmn@wXw_l[C&v][t~ tw8,EkI4D B0D2lz/zr,6)voZMHvL_rA');
define('SECURE_AUTH_KEY',  'jb}gXDxh%}b96oPv0M^3!g<)AuD{?|NJ72|[8U1:JqV?=T}Pr]?dPCi|]zFs1Wu8');
define('LOGGED_IN_KEY',    'gXAPT<Zwitv,4k]x-+ j>~Kqh|nPfK-m-b6B%`)ri/da!o.5yB(|AL|I8~9*Ev(u');
define('NONCE_KEY',        '2>rcj;b.Wz]U]gE~=e)xSn]g,5sa0=CzI-/!yP{ }g==7hk*[`]4?] 9rv/g[3R?');
define('AUTH_SALT',        '|`8zzE|c.Wj$:Cq2(w$*+4v`IXss[Uwzqofq)V/I?3R:0!SSJi)%r}Ml~+}HxmDy');
define('SECURE_AUTH_SALT', 'lfzA-qN%O$?Z3f5kuXoLJW6GV>Y&r- aL_a[$$W~%3xVHqw{8J//{uv.kYgt=V|y');
define('LOGGED_IN_SALT',   'S.IDo^?Db#~(w`-X__`kVc1aq}.HUFGAcL2ojZ9cP.^nyW-D7xEswmd1zPM&QW+|');
define('NONCE_SALT',       '$r.H5OL];$3HACDYfb/HW-<>!CTE:I`|r#YqRqE use j`+X%P `ABg>.ul e=T+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'kons_';

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

define('FS_METHOD', 'direct');
define( 'WP_AUTO_UPDATE_CORE', false );
