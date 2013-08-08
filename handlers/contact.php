<?php
	session_start(); 
	
	$EMAIL_ADDRESS = 'errol@errolmarkland.com';
	$subject = 'subject';
	$message = 'details';
	$email = 'email';
	$cc = 'cc';
	
	$emailSubject='';
	$emailMessage='';
	$emailAddress='';
	$emailCC='';
	        
	
	function checkCaptcha() {
	    return true;
		include_once $_SERVER['DOCUMENT_ROOT'] . '/ext/securimage/securimage.php';
		$securimage = new Securimage();
		return $securimage->check($_POST['captcha-code']);
	}
	
	function checkFormParams() {
	    global $subject, $message, $email, $cc;
	    global $emailSubject, $emailMessage, $emailAddress, $emailCC;
	    
	    if ((!isset($_POST[$subject]) || 
             !isset($_POST[$message]) || 
             !isset($_POST[$email]))) {
	         return false;
	    }

	    $emailAddress = $_POST[$email];
	    $emailSubject = $_POST[$subject];
	    $emailMessage = $_POST[$message];
	    $emailCC = $_POST[$cc]; 
		return true;		
	}
	
	function processForm() {
	    global $emailSubject, $emailMessage, $emailAddress, $emailCC, $EMAIL_ADDRESS;
	    $result = array();
	    
		if (mail($EMAIL_ADDRESS, $emailSubject, $emailMessage, "From: $emailAddress")) {
		    $result['result'] = 'Sent email to site owner';		    
		} else {
		    $result['result'] = 'Failed to send email to site owner';
		}
		
		if ($emailCC === "1") {
             if (mail($emailAddress, "CC: $emailSubject", $emailMessage, "From: contact@errolmarkland.com")) {
                 $result['cc_result'] = "Successfully CC'd $emailAddress";
             } else {
                 $result['cc_result'] = "Failed to CC $emailAddress";
             }
		}
		
		echo json_encode($result);
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

