<?php

/* 
 * Developed by wilowi
 */

$server_document = filter_input(INPUT_SERVER,'DOCUMENT_ROOT',FILTER_SANITIZE_STRING);

// ---- Entorno
define("_ENVIRONMENT", 'localhost');
define("_URL_ENVIRONMENT",'http://localhost/mirandilla/mirandilla/');
define("_URL_LOGS",'/mario/dataLogs/');
define("_URL_MAIL",$server_document.'/mirandilla/mirandilla/');
define("_KEY_CAPTCHA",'6Leh0k4UAAAAAJaZt96GG2S3d2IUwQ4Mfzxpejog');

/*define("_ENVIRONMENT", 'develop');
define("_URL_ENVIRONMENT",'https://mirandilla.wilowi.com/');
define("_URL_LOGS",'/var/www/develop/mirandilla/mirandilla/');
define("_URL_MAIL",'/var/www/develop/mirandilla/mirandilla/');
define("_KEY_CAPTCHA",'');*/

/*define("_ENVIRONMENT", 'production');
define("_URL_ENVIRONMENT",'https://www.mirandilla.com/');
define("_URL_LOGS",'/var/www/mirandilla/dataLogs/');
define("_URL_MAIL",'/var/www/mirandilla/mirandilla/');
define("_KEY_CAPTCHA",'');*/

date_default_timezone_set('Europe/Madrid');

?>