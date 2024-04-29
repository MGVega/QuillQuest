<?php

/**
 * Controller for redirect to web or panel.
 *
 * @author Wilowi - Sandra Campos
 * @since 06/07/2020
 *
 */

ini_set('display_errors', 0);
header('Cache-Control: no-store, no-cache, must-revalidate');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
header('Cache-Control: post-check=0, pre-check=0', FALSE);


final class frontController {

    static function main() {

	$Controller = null;

	$valores = filter_input_array(INPUT_GET);
        $valores_post = filter_input_array(INPUT_POST);
	$type = $valores['type'];

	if (!empty($type)) {

	    switch ($type) {
		case "panel":
		    $Controller = new panelController();
		    break;
                
                case "rutaSeleccionada":
                    $Controller = new rutasController();
                    $Controller->setRuta($valores['control']);
                    break;

		default:
                    $Controller = new webController();
                    break;
            }
            
            $Controller->setPage($valores['type']);
            $Controller->main();
	    
	} else {

	    $Controller = new webController();
	    $Controller->main();
	}
    }

}

?>
