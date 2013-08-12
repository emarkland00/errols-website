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
	
	function checkFormParams() {
	    global $subject, $message, $email, $cc;
	    global $emailSubject, $emailMessage, $emailAddress, $emailCC;
	    
	    if ((!isset($_POST[$subject]) || 
             !isset($_POST[$message]) || 
             !isset($_POST[$email]))) {
	         return false;
	    }

	    // get and validate email
	    $emailAddress = $_POST[$email];
	    if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL) === false) {
	        if ($emailAddress !== "me@localhost") {
	            return false;	        
	        }
	    }
	    
	    // get and validate optional cc
	    $emailSubject = $_POST[$subject];
	    $emailMessage = $_POST[$message];
	    $emailCC = $_POST[$cc];
	    
		return true;		
	}
	
	function emailIsValid($email) {
	    return filter_var($email, FILTER_VALIDATE_EMAIL);
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
	
	function error($code, $message) {
	    header("HTTP 1.1 $code $message");
	}
	
	if (!checkFormParams()) {
	    error(400, "Invalid details");
		return;
	}
	
	return processForm();
?>

