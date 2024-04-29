<?php

/*
 * Developed by wilowi
 */

header('Cache-Control: no-store, no-cache, must-revalidate');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
ini_set('display_errors', 0);

require_once 'config/includes.php';

$front = new frontController();

try {
	$front->main();
	
} catch (Exception $exception) {
	
}
?>

