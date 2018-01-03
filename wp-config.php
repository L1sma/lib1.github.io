<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'lib');

/** Имя пользователя MySQL */
define('DB_USER', 'lib');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '81f803de-3939-4bb6-961d-d5eb9dc55466');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cb504m4y9c=J{s<M=q4|N/v)tY~L9GB(puwU0U`pn-f/:!e3R[&Giykm-szcr|UG');
define('SECURE_AUTH_KEY',  'DE:[j6T2Qd.<*2k;gb)S&:2M=4<v2CFhG4U97mdm7{ Y!SUy_E=QqhUr;/)ke-*L');
define('LOGGED_IN_KEY',    'mDw@KE/VZ#Pd>PW)tD;6N];22|fFL;Jy8FA)e?As?N7V{ISJ`a=[;qg6/wIfj%}7');
define('NONCE_KEY',        '2R(Bna&f|6xOny4iLn2sw%{Fp2@7ExhrAaL)=joVg~;*i^r1_v&hFu@~>Jtd/vLC');
define('AUTH_SALT',        'oxi$,rm-j@&f#I@G4Ac8Fx[fASMxZGH>9%jo:jO8Bsp|!HxEKH^lUx`~YXi.t4Q)');
define('SECURE_AUTH_SALT', '#x?9+)qdhyP#?Q,f1m8fr{4Ee_?TpGy,HK;`u@_koYFM@#9?~Gy[C/3N>|v)YyE:');
define('LOGGED_IN_SALT',   'ZQ$dWou4OC7R$@tX]0Ov6K{g*dDfU0T+Md}Xk>a=eW&^G`q/t;EaeX`Em*B#bXw+');
define('NONCE_SALT',       'U@$1V/+ 0/S<u8>PAu$_^VArHn^t$y<AxXH6f7r)9m$9>KM1 % VSu.{I1o|<zU0');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
