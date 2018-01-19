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
define('DB_NAME', 'nazia');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '76]4=U+/B_vBq&=bNcfK%^hCpGmHQ(A4qyzF)+~;!SkYfIqk@aje4Z7NQ6Xo@aF*');
define('SECURE_AUTH_KEY',  'qG_ ]Rar;uR(u-&eGQ0f>wB;uL|po:kQdn7.|}w8FOpQAPDckAU9>~Q`{@Li6Jp?');
define('LOGGED_IN_KEY',    '@+Z$s:SNt1m$@WVAer%_1AL,T1CB,XwGp1-@P[}zT$];J-!G+w%1U5K!C^dA8BSW');
define('NONCE_KEY',        '|#ban{-30B{=sC,qQXrG)^]&EE6b|iqxf&`2;=`x{]y6@90^=h+XaZC@E|5CVTH;');
define('AUTH_SALT',        'ecfwa[H+>wT3`lyXt~&%zrWZUM_^w2e=}Z!JXxyzr8c`_wTLG6IK|K~qnq,#v))t');
define('SECURE_AUTH_SALT', 'm$cwV<K6O6u7g}w^_vln8G}g_p.8J;k;Qu*LH*lt;Kes+}(#vO6pFFC@/#C~{i}Z');
define('LOGGED_IN_SALT',   'h$VTRfmLTj.> lMQiK.KUF}uJrGqH7Y|>SuThNdD!>}T^FGCIuDS(B*{zMX+^:zy');
define('NONCE_SALT',       '[S/A9[CIjJ9K65}x4cz)]f+KYE^LL,K74Zu?N1o.44u6B_l.0ZP@3vQwG<rOWSyw');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
