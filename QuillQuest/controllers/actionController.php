<?php

/**
 * Control Ajax
 *
 * @author Wilowi - Sandra Campos
 * @since 06/07/2020
 *
 */

// ----- Tipo de salida => JSON
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
header('Content-Type: application/json; charset=utf8');

ini_set('display_errors', 0);

include_once dirname(__FILE__) . '/../config/includes.php';

//if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { // SSL connection 
$json = '';
$result = '';
$files = '';

$server = filter_input(INPUT_SERVER,'REQUEST_METHOD',FILTER_SANITIZE_STRING);

if (($server === 'POST')) {

    $post = filter_input_array(INPUT_POST);    
    
    if (!empty($post) || !empty($_FILES)) {

	$values = (object) $post;
	$files = $_FILES;

    } else {
	$json = file_get_contents('php://input');
	$values = json_decode($json);
	//echo "<pre>";echo print_r(json_decode($json));echo"</pre>";	
    }
    
    $controller = null;
    try {

	switch ($values->controller) {

	    case 'panelController':
		$controller = new panelController();
		echo $controller->doFunction($values, $files);
		break;

	    case 'webController':
		$controller = new webController();
		echo $controller->doFunction($values, $files);
		break;
            
            case 'rutasController':
		$controller = new rutasController();
		echo $controller->doFunction($values, $files);
		break;

	    default:
		break;
	}
    } catch (Exception $e) {

	$result = $post['jsoncallback'] . '({"resultado":"","error_code":"' . $e->getCode() . '","error_msg":"' . $e->getMessage() . '","POST":' . json_encode($post) . '})';
	echo $result;
    }
}

//}
?>
