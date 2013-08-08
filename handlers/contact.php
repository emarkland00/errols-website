<?php
	session_start(); 
	
	$subject = 'subject';
	$message = 'details';
	$email = 'email';
	
	$emailSubject='';
	$emailMessage='';
	$emailAddress='';
	        
	
	function checkCaptcha() {
	    return true;
		include_once $_SERVER['DOCUMENT_ROOT'] . '/ext/securimage/securimage.php';
		$securimage = new Securimage();
		return $securimage->check($_POST['captcha-code']);
	}
	
	function checkFormParams() {
	    global $subject, $message, $email;
	    global $emailSubject, $emailMessage, $emailAddress;
	    
	    if ((!isset($_POST[$subject]) || 
             !isset($_POST[$message]) || 
             !isset($_POST[$email]))) {
	        // echo "Checking form params and failed";
	         return false;
	    }

	    $emailAddress = $_POST[$email];
	    $emailSubject = $_POST[$subject];
	    $emailMessage = $_POST[$message];
	    // echo " Checked form params...They were good.";
		return true;		
	}
	
	function processForm() {
	    global $emailSubject, $emailMessage, $emailAddress;
		mail("me@localhost", $emailSubject, $emailMessage, "From: me@localhost");
        // mail($emailAddress,$emailSubject, $emailMessage);
		echo json_encode(array(
		     "result" => "success"
        ));
	}
	
	if (!checkCaptcha()) {
		header("HTTP 1.1 400 Bad captcha solution.");
		return;
	}
	
	if (!checkFormParams()) {
		header('HTTP 1.1 400 Invalid details');
		return;
	}
	
	return processForm();
?>

