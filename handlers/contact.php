<?php

    // the actual recipient address
	$EMAIL_ADDRESS = 'errol.markland@gmail.com';

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
             error(400, 'Bad request', "Required form variable is missing");
	         return false;
	    }

	    // get and validate email
	    $emailAddress = $_POST[$email];
	    if (!emailIsValid($emailAddress)) {
            error(400, 'Bad request', "Attempt to use invalid email address $emailAddress");
            return false;
        }

	    // get and validate optional cc
	    $emailSubject = filter_var($_POST[$subject], FILTER_SANITIZE_STRING);
	    $emailMessage = filter_var($_POST[$message], FILTER_SANITIZE_STRING);
        syslog(LOG_INFO, "Site mail form subject: $emailSubject");
        syslog(LOG_INFO, "Site mail format message: $emailMessage");
        if (isset($_POST[$cc])) {
            $emailCC = filter_var($_POST[$cc], FILTER_SANITIZE_STRING);
            syslog(LOG_INFO, "Site mail form CC: $emailCC");
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
            syslog(LOG_INFO, "Sent email from $emailAddress");
		    $result['result'] = 'Sent email to site owner';
		} else {
            error_log("Failed to send email from $emailAddress");
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

            if (mail($emailAddress, $ccSubject, $ccMessage, $headers . 'From: errolmarkland.com contact form' . "\r\n")) {
                $result['cc_result'] = "Successfully CC'd $emailAddress";
            } else {
                $result['cc_result'] = "Failed to CC $emailAddress";
            }
		}

		echo json_encode($result);
	}

	function error($code, $message, $log_error) {
	    header("HTTP 1.1 $code $message");
        error_log($log_error, 0);
	}

	if (!checkFormParams()) {
	    error(400, "Invalid details");
		return;
	}

	return processForm();
?>
