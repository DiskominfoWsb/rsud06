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
define('DB_NAME', 'rsud');

/** MySQL database username */
define('DB_USER', 'rsud');

/** MySQL database password */
define('DB_PASSWORD', 'gftuJRuduDA9PAWt');

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
define('AUTH_KEY',         'zoCwoN(Ibb<hT+YyHfsRmiP(jg|]4MRcPhh(ku;ws94zK;,DS9>bI@w}^pqe)h M');
define('SECURE_AUTH_KEY',  '5#}1+) FW/%HMPTQ/BOG2TS3C33&Wmntq(RRaTve8R +bMQ{SGx}@SF*1sbD/en|');
define('LOGGED_IN_KEY',    '-Djy=U4ny5xTyt NZ>2`@GcgHDYeuiO0hVU^L.j}`%>HnEx2x(M$thz$/M=-)^.H');
define('NONCE_KEY',        '!G[b!4] i} l?te6<=xqtJOy(t)1I&(DQ88}!2:%_mJh/(|kKssK>-JiL)h8&-$l');
define('AUTH_SALT',        'HYc%K~pI9(|Aqg`* &eTO;$yY`agk];#y6nuTQI9`3x@mq)tl$U0r -O{D7m+YA=');
define('SECURE_AUTH_SALT', 'wT499U0qD/R}Jqa}M:I|~Gw]F$ewm?`OQ2H`L LNZ6<a&-e4AGHTT[]H(iI::f2{');
define('LOGGED_IN_SALT',   's<!p=D$)R@J$4N>>;*ri,)8Q@l%sxuRo5YAsR6z59bsjB:-p#ISdzx&7*Ty,sd(g');
define('NONCE_SALT',       'fFROD>jbBp+>q /2}>>a6U@a]BD ]:ARt{_;W~(WAm?ODG0 :[6Deb5B#.C;IPn3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_rsud';

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
