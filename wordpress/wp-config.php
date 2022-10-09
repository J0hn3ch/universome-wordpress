<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni database
 * * Chiavi Segrete
 * * Prefisso Tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/srv/wordpress/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'wordpress_db' );

/** Nome utente del database */
define( 'DB_USER', 'dbadmin_wordpress' );

/** Password del database */
define( 'DB_PASSWORD', 'WP2022' );

/** Hostname del database */
define( 'DB_HOST', '172.21.0.2' );

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di Collazione del Database. Da non modificare se non si ha idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'p<*U6 ]h@,vYmT3Y~IE%-Ed).?y#a,pp6`@ke?q:/BJ+Fu9vhTiUa&@KwVi!OBIy' );
define( 'SECURE_AUTH_KEY',  'JxHfLB:`43`fC&}hk[KQ+FU;?iwwG23:pf7X&?N1}MOcg/SFVw|J r%V3WyP{y_j' );
define( 'LOGGED_IN_KEY',    '|G;,b)@DBR%(&%mOhp0Mi0pOhhE2pOI6$zplf3)Ho)DL3(wZyD_{S3$aWdecskB*' );
define( 'NONCE_KEY',        'qmE~sPd1Z RlV`;yND>9N*TbQ_XmU`=/e]#.,oIaX)Bq%sp%.q]+))KfilCdkQs|' );
define( 'AUTH_SALT',        'W>(sdny9r8mP97e%^rl+H&^f`]c?Fl?R.z{tnwK4E?/GyZ PGT5&[Q(P6G&F3|!y' );
define( 'SECURE_AUTH_SALT', 'a@t3.d7g7.Wiv98Vw/|nRS*QrVGWy&(cX1nF/hgki2|7d(47$x|v5->Lq+F?rK60' );
define( 'LOGGED_IN_SALT',   '[>!2SLyyS`YB#~3FdaElS;bOGSD-XXnUj52H`2vGH}Jm;j=zo23lAia1dZavN=5@' );
define( 'NONCE_SALT',       '?eF d)cQAraA.Jr5^DV6T8$Ra3o9RnCG?uL0H]oM0yH4.,2H<*EQpJCy4sT{3:m:' );

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta le variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');

/** Upload Plugins Directly */
define('FS_METHOD', 'direct');
