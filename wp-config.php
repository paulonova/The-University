<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsens installationsrutin, utan kan kopiera
 * denna fil direkt till "wp-config.php" och fylla i alla värden.
 *
 * Denna fil innehåller följande konfigurationer:
 *
 * * Inställningar för MySQL
 * * Säkerhetsnycklar
 * * Tabellprefix för databas
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define( 'DB_NAME', 'db_university' );

/** MySQL-databasens användarnamn */
define( 'DB_USER', 'root' );

/** MySQL-databasens lösenord */
define( 'DB_PASSWORD', '' );

/** MySQL-server */
define( 'DB_HOST', 'localhost' );

/** Teckenkodning för tabellerna i databasen. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'd3_9NIz722B;2),)$!sLLp?kc[3T?SPBw)v.,-!hjW^I%bS&>4oqX-,z7^2ox5um' );
define( 'SECURE_AUTH_KEY',  '>hf?Txc;[VF/+Hq9BhS[@|*m%;*4^d:e-W[9swX+XH0z,gqs:_?Plmgg<kRAxNS7' );
define( 'LOGGED_IN_KEY',    'D?AJc~^Q:eYy@S,Yp|OV=_~cSk&GiJEJj:!Ic|HrZe -1>fD,.zWFM@@<z%W7aOL' );
define( 'NONCE_KEY',        'R#_}+Qc+KjJX3(1|/94dl<hA=Qb-{wWUi|M(T3MXEGp1;Dx</DHtFkSN6JrRIj.@' );
define( 'AUTH_SALT',        'Mx;C)AFUw++ me,qPkr6dWMxUb<::5!Tr[WTL[8_@`I)F/^,=$U{c+Xb{AW75oIS' );
define( 'SECURE_AUTH_SALT', 'G@h/IDqAI~5,[78Vni,.eP$~!GwPKNVP`Y&I*JUNa.4}=/+?q-{Ff|im3m%`;V!p' );
define( 'LOGGED_IN_SALT',   'zH)(%1oY!3;ug#dYF0^Wjn`&?xzDiyIPOZ;10v{gekaLOW3AG#q}=YV%yZ:z5xu)' );
define( 'NONCE_SALT',       'mQD&q,E1/&U<LMB[7=!&38_c17ajvbhG/qoRF+NPWA?**moN~aI?<Ho<D,(cSi&J' );

/**#@-*/

/**
 * Tabellprefix för WordPress-databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Använd endast siffror, bokstäver och understreck!
 */
$table_prefix = 'wp_';

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det rekommenderas att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 *
 * För information om andra konstanter som kan användas för felsökning, 
 * se dokumentationen. 
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera här och börja publicera! */

/** Absolut sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');