<?php

/* 
 * Developed by wilowi
 */

$server_document = filter_input(INPUT_SERVER,'DOCUMENT_ROOT',FILTER_SANITIZE_STRING);

// ---- Entorno
define("_ENVIRONMENT", 'localhost');
define("_URL_ENVIRONMENT",'http://localhost/quillquest/quillquest/');
define("_URL_LOGS",'/mario/dataLogs/');
define("_URL_MAIL",$server_document.'/quillquest/quillquest/');
define("_KEY_CAPTCHA",'6Leh0k4UAAAAAJaZt96GG2S3d2IUwQ4Mfzxpejog');

/*define("_ENVIRONMENT", 'develop');
define("_URL_ENVIRONMENT",'https://quillquest.wilowi.com/');
define("_URL_LOGS",'/var/www/develop/quillquest/quillquest/');
define("_URL_MAIL",'/var/www/develop/quillquest/quillquest/');
define("_KEY_CAPTCHA",'');*/

/*define("_ENVIRONMENT", 'production');
define("_URL_ENVIRONMENT",'https://www.quillquest.com/');
define("_URL_LOGS",'/var/www/quillquest/dataLogs/');
define("_URL_MAIL",'/var/www/quillquest/quillquest/');
define("_KEY_CAPTCHA",'');*/

date_default_timezone_set('Europe/Madrid');

?>