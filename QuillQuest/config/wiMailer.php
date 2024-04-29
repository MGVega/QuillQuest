<?php

/* 
 * Developed by wilowi
 */

require _URL_MAIL . 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
include_once _URL_MAIL . 'util.php';
include_once _URL_MAIL . 'config.php';
include_once _URL_MAIL . 'autoload.php';

class wiMailer{
	
	private $mail =  null;
	private $from = 'info@wilowi.com';
	private $host = 'smtp.ionos.es';
	private $username = 'info@wilowi.com';
	private $password = 'kCF9Xv3vpMVEssNCiiCS';
	private $port = 587;
	
	private $result = false;			
	
	/**
	 * Constructor de la clase
	 */
	public function __construct(){
	
		$this->mail = new PHPMailer;		
		$this->mail->Host = $this->host;
		$this->mail->isSMTP();
		$this->mail->Timeout = 300;		
		$this->mail->SMTPAuth = true;
		$this->mail->Username = $this->username;
		$this->mail->Password = $this->password;
		$this->mail->SMTPSecure = 'tls';
		$this->mail->Port = $this->port;
		$this->mail->setFrom($this->from,'Wilowi');
		$this->mail->isHTML(true);		
		$this->mail->AltBody    = "Para ver el mensaje, por favor use un gestor de correos compatible con HTML - From www.wilowi.com";
		$this->mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
	}
	

	/**
	 * Destructor de la clase
	 *
	 */
	public function __destruct()
	{
		
	}
	
	public function setAdmin($from = '') {

	    if(empty($from)) {

		$this->mail->setFrom('', 'Wilowi');
		
	    } else {
		
		$this->mail->setFrom($from, 'Wilowi');

	    }
	    
	    $this->mail->Username = '';
	    $this->mail->Password = '';
	}


	
	public function setOpen(){
		$this->mail->SMTPKeepAlive = true;
	}
	
	public function setClose(){
		$this->mail->smtpClose();
	}
	
	public function sendStandarMail(string $subject, string $body){
	
		$this->mail->Subject = $subject;
		//$this->mail->SMTPDebug = 2;
		$this->mail->MsgHTML($body);
		
		if(!$this->mail->send()) {
			//echo $this->mail->ErrorInfo;
			$log = new logsModel();
			$log->setFolder('mails/');
			$log->setFile_name('sendMail.txt');
			$log->setType_msg('ERROR');
			$log->setMsg('class wiMailer.php: ' . $this->mail->ErrorInfo);
			$log->writeLog();
			$this->result = false;
		} else {
			$this->result = true;
			$this->mail->clearAttachments();
		}
		
		return $this->result;
	}
	
	
	public function sendMasiveMail(string $subject, string $body){
	
		$this->mail->Subject = $subject;
		//$this->mail->SMTPDebug = 2;
		$this->mail->MsgHTML($body);
		
		if(!$this->mail->send()) {
			//echo $this->mail->ErrorInfo;
			$log = new logsModel();
			$log->setFolder('mails/');
			$log->setFile_name('sendMailMasive.txt');
			$log->setType_msg('ERROR');
			$log->setMsg('class wiMailer.php: ' . $this->mail->ErrorInfo);
			$log->writeLog();
			$this->result = false;
		} else {
			$this->result = true;
			$this->mail->clearAttachments();
		}
		
		return $this->result;
	}
	
	
	public function setAddress(array $addresses){
		
		
		foreach ($addresses as $address) {
			
			$this->mail->addAddress($address);
			
		}
		
	}
	
	public function setBCC(array $addresses){
		
		foreach ($addresses as $address) {
			
			$this->mail->addBCC($address);
			
		}
		
	}
	
	public function setAttachment(array $attachments){
		
		
		foreach ($attachments as $attach) {
			
			$this->mail->addAttachment($attach);
			
		}
		
		
		
	}
	
	
	
	
}


?>