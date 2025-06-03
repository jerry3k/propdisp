<?php

define('FS_METHOD', 'direct');

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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db740303479' );

/** MySQL database username */
define( 'DB_USER', 'dbo740303479' );

/** MySQL database password */
define( 'DB_PASSWORD', 'eaGsPUuWiQexlyWUkaYC' );

/** MySQL hostname */
define( 'DB_HOST', 'db740303479.db.1and1.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DmyA1:7FPsER!tc+]m}XD*Ra*LbOq)RMA#g_m`L.*@j}?.p~|5%aHRi8@[My^|$+');
define('SECURE_AUTH_KEY',  'Av*!:j.2j/bKTz3uPR2p>Pci 544G#-/(eGI`+Z2dGIBJ!qi<Fzx~jQH7rZ=3iWx');
define('LOGGED_IN_KEY',    'VtW7?wHq.&Y0TzyRj9Lmax%)XtK>-@aZz(A;S&/DAM#Py}=~W/^#Y(_L@~$T`?R!');
define('NONCE_KEY',        '$nqD~xT>C{xNACs@Tc4>{?>_xk42M-UjJI;*eVvv@-x3Ej|yJLaDE]:f6CFZK?AC');
define('AUTH_SALT',        'oZgA[EP]b9.tEmkilj#$O`Nchc,g02,b;Lz-f6|KB-&HTNJW~|aI!P#40uodhF+8');
define('SECURE_AUTH_SALT', '!yGx$86NQF8.m<`^d7>jy/~2)vl;hn,,Vj~8/L:O#Q:Cl>>LQWFx|]oqb?PA-- +');
define('LOGGED_IN_SALT',   '!$5zVg6,X!s271hDn`T*MCFpxKw%7vDzuBjIL|9(hV&t-=|TVzN+|e_#Jg*t24`s');
define('NONCE_SALT',       'VB^,~^%_^<{B{6;Z0+9N+%g-S*_*9}2]/G6Wjz{xZ@?+hsS%RZ)87&*|(%f+XjRp');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'WOViPwUh';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
