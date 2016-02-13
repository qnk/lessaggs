<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'lessaggs');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'MYo2!N</Qp(h?set cW|^P|Jr3O{PBs6U(*cy,#3:|A2]Lf!%yFmPsq~|W;|]YD?');
define('SECURE_AUTH_KEY', '}}|z/f3#B6p)U4e/C&FYoVy_%S5R`l(ITDOY-a#)+:A#Nsp!)c*@RkJ}c;=2wEJ,');
define('LOGGED_IN_KEY', 'G{}.D)uo3q-| }yLO4?[nm-t/Z0+x<D8YYSSN8br+aDm;@pi+k1.bjn9^-;-hFE*');
define('NONCE_KEY', 'IX622;J:-D$~RW=1Po* l<][Z}VT.0m?BBG>C+270RnG~rFPWdz~&Lac-[Jau$An');
define('AUTH_SALT', '>/lFjf-|]NvH?;3QnbK;H13D/$[I:[Uey-.(%iD+XKE$Z]6rrMGjA_mjd+dUBGIZ');
define('SECURE_AUTH_SALT', '8?3q{t22?,C|+},y=Su wG(X)G@BNkmJ/4;4r@=CS~Yx:%Hs!B>bKjzm`Cf&%Q/^');
define('LOGGED_IN_SALT', 'Z/.sx]BTww4^2^+R5d,u)8*dY6Y2<:]EZmor.,l fT#5AiX<v;(8gO~=LlE+7/UE');
define('NONCE_SALT', 'YkIc; hU(!,$2d1k0BdD!}3vq~<2E[x|g)`M|smDv7Tz>)az=5-%(eT$4tiN:can');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

