<?php
	
	$EMAIL_ADDRESS = 'errol@errolmarkland.com';
    
    // expected vars
	$subject = 'subject';
	$message = 'message';
	$email = 'email';
    
    // optional vars
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
             error(400, 'Missing required parameter');
	         return false;
	    }

	    // get and validate email
	    $emailAddress = $_POST[$email];
	    if (!emailIsValid($emailAddress)) {
            error(400, 'Invalid email address');
            return false;
        }
	    
	    // get and validate optional cc
	    $emailSubject = $_POST[$subject];
	    $emailMessage = $_POST[$message];
        if (isset($_POST[$cc])) {
            $emailCC = $_POST[$cc];
        }
	    
		return true;		
	}
	
	function emailIsValid($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        return $email === 'me@localhost';
        
	}
	
	function processForm() {
	    global $emailSubject, $emailMessage, $emailAddress, $emailCC, $EMAIL_ADDRESS;
	    $result = array();
	    
	    $headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    	    
		if (mail($EMAIL_ADDRESS, $emailSubject, $emailMessage, $headers . 'From: ' . $emailAddress . "\r\n")) {
		    $result['result'] = 'Sent email to site owner';		    
		} else {
		    $result['result'] = 'Failed to send email to site owner';
		}
		
		if ($emailCC === "1") {
		    $ccSubject = "[Copy] '$emailSubject' from errolmarkland.com";
		    
		    //TODO: Add a gray background for the reply text
		    $ccMessage = $emailMessage . PHP_EOL;
		    $ccMessage .= '<br /><br />Thanks for contacting me.' . PHP_EOL;
            $ccMessage .= '<br />I\'ll get back to you as soon as possible!' . PHP_EOL;
            $ccMessage .= "<br /><br />Best Regards,";
            $ccMessage .= "<br />Errol Markland";
		    
            if (mail($emailAddress, $ccSubject, $ccMessage, $headers . 'From: contact@errolmarkland.com' . "\r\n")) {
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

