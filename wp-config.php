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
define('DB_NAME', 'ieeecornell');

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
define('AUTH_KEY',         'cr%fJxD1NT|SRQU(jBXH#oY|[MP-BkRwe$6 6@SPEUb5W%#9tr?n[b*tvSw}r}R-');
define('SECURE_AUTH_KEY',  '!}_J4IbKL![p$|[Nhka$-PrZxFxjMDU9yEbT|se[!IEh_rW;T:0{,a3>N;SWc/%#');
define('LOGGED_IN_KEY',    '#cTajmf=-}$ l[e7m.|7?9NlvpHYU,C~O*WBWt^91{|o$|IRn@`_~UaX27y{iL#r');
define('NONCE_KEY',        'pByuL| {A9|Rb3X5+HPQ)674s]w gN-G AyD $QN4iieIcO9|UN_B:E$E0z|9wkr');
define('AUTH_SALT',        'VM-&ad},i3*:DctHTT5Cvgv+l95)l*fs&d|_ xFcYanr&W$3cYUPV,$4^s8|lP97');
define('SECURE_AUTH_SALT', 'R}B#ZVo(p;KP}:5o b9gJy^aKHz#]_glxF-cp~2ka+h#8ox^qjn>%45jO4VcxzA-');
define('LOGGED_IN_SALT',   'gQqybQ3BH- @FD>;9-wSi!ZyDHncky28#%=~pgv yNb)LQfvLlc&)g?!W7+ijy,u');
define('NONCE_SALT',       '6^W mYj?9Am0;wHU?RYzf!RQR@+.vS;[v+]lrk4m,q]D+#:3ub2Z-N!jxdq,GzQ|');

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
