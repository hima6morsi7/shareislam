<?php
/**
 * Podstawowa konfiguracja WordPressa.
 *
 * Ten plik zawiera konfiguracje: ustawień MySQL-a, prefiksu tabel
 * w bazie danych, tajnych kluczy i ABSPATH. Więcej informacji
 * znajduje się na stronie
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Kodeksu. Ustawienia MySQL-a możesz zdobyć
 * od administratora Twojego serwera.
 *
 * Ten plik jest używany przez skrypt automatycznie tworzący plik
 * wp-config.php podczas instalacji. Nie musisz korzystać z tego
 * skryptu, możesz po prostu skopiować ten plik, nazwać go
 * "wp-config.php" i wprowadzić do niego odpowiednie wartości.
 *
 * @package WordPress
 */

// ** Ustawienia MySQL-a - możesz uzyskać je od administratora Twojego serwera ** //
/** Nazwa bazy danych, której używać ma WordPress */
define('DB_NAME', 'kaes4x_shareisl');

/** Nazwa użytkownika bazy danych MySQL */
define('DB_USER', 'aik3io_shareisl');

/** Hasło użytkownika bazy danych MySQL */
define('DB_PASSWORD', 'Vo1oSexei9mu');

/** Nazwa hosta serwera MySQL */
define('DB_HOST', 'shareislam.frivs.one.mysql.dhosting.com');

/** Kodowanie bazy danych używane do stworzenia tabel w bazie danych. */
define('DB_CHARSET', 'utf8');

/** Typ porównań w bazie danych. Nie zmieniaj tego ustawienia, jeśli masz jakieś wątpliwości. */
define('DB_COLLATE', '');

/**#@+
 * Unikatowe klucze uwierzytelniania i sole.
 *
 * Zmień każdy klucz tak, aby był inną, unikatową frazą!
 * Możesz wygenerować klucze przy pomocy {@link https://api.wordpress.org/secret-key/1.1/salt/ serwisu generującego tajne klucze witryny WordPress.org}
 * Klucze te mogą zostać zmienione w dowolnej chwili, aby uczynić nieważnymi wszelkie istniejące ciasteczka. Uczynienie tego zmusi wszystkich użytkowników do ponownego zalogowania się.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ';j*SOJNc-&7*e-<L/#z($JAJ*[b<TrIu<-T~`U|C+3eiF7O=_?`_f9 tY=cxs4;h');
define('SECURE_AUTH_KEY',  '#];grhZ^6GG3KQS8xsUajd,kV s2U-}DD9X*+luh&4tk]EU}C|}J?}P~^HM?FSGt');
define('LOGGED_IN_KEY',    'Bof+767>qMB/Rl[u9>o|dOKzb4HaN.o1(~+_&%KIf7j*O2/ps#A~9; KP54J~V7d');
define('NONCE_KEY',        '.bj!^P1e>+S%B~(q=@=*Vv5H-WX4z%0gau5x. 5~wN|Qs` <68ZM3U4)A`&1e^=B');
define('AUTH_SALT',        '$31WlC]-d1dr2jVzm#&R6x[L(6YAB$Y]z+ojf!bH*.jsxn*3k W%N6rwo-8 46?P');
define('SECURE_AUTH_SALT', ' ?/v7/#{ikLrWCj-plH~]kMMgg(^I:0p@o>_D9tZkV@vvDick:g.f+?w2,*oZZ8U');
define('LOGGED_IN_SALT',   'ylX7bLCJms*;4A@UPP0,$yj;#COl#ae*LK0)*`S=Y-L>9Z(<2z2kht}|GYiQ;|wr');
define('NONCE_SALT',       'ZKjYORt--^|7&Xi-=8Da-@/_0q*s2KY}3+64n,iH${x>k;|[#]6[.V>UGSk-}-w5');


/**#@-*/
/**
 * Prefiks tabel WordPressa w bazie danych.
 *
 * Możesz posiadać kilka instalacji WordPressa w jednej bazie danych,
 * jeżeli nadasz każdej z nich unikalny prefiks.
 * Tylko cyfry, litery i znaki podkreślenia, proszę!
 */
define('WP_CACHE', true);
$table_prefix  = 'wp_';

/**
 * Dla programistów: tryb debugowania WordPressa.
 *
 * Zmień wartość tej stałej na true, aby włączyć wyświetlanie ostrzeżeń
 * podczas modyfikowania kodu WordPressa.
 * Wielce zalecane jest, aby twórcy wtyczek oraz motywów używali
 * WP_DEBUG w miejscach pracy nad nimi.
 */
define('WP_DEBUG', false);

/* To wszystko, zakończ edycję w tym miejscu! Miłego blogowania! */

/** Absolutna ścieżka do katalogu WordPressa. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

/** Ustawia zmienne WordPressa i dołączane pliki. */
require_once(ABSPATH . 'wp-settings.php');
