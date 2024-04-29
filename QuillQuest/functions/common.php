<?php
/**
 * Common functions
 *
 * @author Wilowi - Sandra Campos
 * @since 05/11/2022
 *
 */

/**
 * Get the IP
 * @return string
 */
function getRealIP() {
	
	$server = filter_input_array(INPUT_SERVER);
	
	if (!empty($server['HTTP_CLIENT_IP'])){
		return $server['HTTP_CLIENT_IP'];
	}

	if (!empty($server['HTTP_X_FORWARDED_FOR'])){
		return $server['HTTP_X_FORWARDED_FOR'];
	}

	return $server['REMOTE_ADDR'];
}

/**
 * Normalice string
 * @param string $str
 * @return sting
 */
function normalize ($str){
    
    $originals = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modifs = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $str = utf8_decode($str);
    $str = strtr($str, utf8_decode($originals), $modifs);
    $str = strtolower($str);
    
    return utf8_encode($str);
    
}

/**
 * 
 * @param boolean $random -> 1,0 for a generate a random pattern or not
 * @param string $password -> for not random password.
 * @param int $longitud
 * @param boolean $encript -> encript the password or not.
 * @return string
 */
function generatePassword($random,$password='',$longitud=0,$encript=false){
    
    $newPassword = '';
    
    if($random==1 && !empty($longitud)){
	
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#@$*!';
	$max = strlen($pattern) - 1;
	
	for ($i = 0; $i < $longitud; $i++){
		$key .= $pattern{mt_rand(0, $max)};
	}
	
	if($encript){
	    
	    $costt = array('cost' => PASSWORD_BCRYPT_DEFAULT_COST);
	    $newPassword = password_hash($key, PASSWORD_BCRYPT, $costt);
	    return $newPassword;
	}
	
	return $key;
	
	
    }else if(empty($random) && $encript){
	
	$costt = array('cost' => PASSWORD_BCRYPT_DEFAULT_COST);
	$newPassword = password_hash($password, PASSWORD_BCRYPT, $costt);
	
    }

    return $newPassword;
    
}

/**
 * Check the password security
 * @param type $string
 * @return boolean
 */
function checkSecurityPassowrd($string){
    
    $size = strlen($string);
    
    if($size<6 || $size>15){
	
	return false;
	
    }else{	
	
	/*
	 * at least one lowercase char
	  at least one uppercase char
	  at least one digit
	  at least one special sign of @#-_$%&+=!?
	 */
	if (preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%&+=!\?]{6,15}$/', $string)) {
	    return true;
	} else {
	    return false;
	}
    }
}

/**
 * Function to send email with the account no-reply@institutodickens.com
 * @param array $addresses
 * @param string $subject
 * @param string $body
 * @param array $attach
 * @return boolean
 */
function sendMail($addresses, $subject, $body, $attach = array()) {

    if (_ENVIRONMENT == 'production' || _ENVIRONMENT == 'develop') {

	$sendmail = new wiMailer();
	$sendmail->setAddress($addresses);

	if (!empty($attach)) {

	    $sendmail->setAttachment($attach);
	}

	//$sendmail->setOpen();
	if ($sendmail->sendStandarMail($subject, $body)) {
	    return true;
	} else {

	    $log = new logsModel();
	    $log->setFolder('mails/');
	    $log->setFile_name('sendMail.txt');
	    $log->setType_msg('ERROR');
	    $log->setMsg('Error with sending emails by no-reply:  EMAILS: ' . json_encode($addresses) . ' Subject: ' . $subject . ' Message: ' . $body);
	    $log->writeLog();
	    return false;
	}

	//$sendmail->setClose();
    } else {
	return true;
    }
}


?>