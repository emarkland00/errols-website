<?php 
	if (!isset($_POST['subject']) || !isset($_POST['details']) || !isset($_POST['email'])) {
		location('HTTP 1.1 400 Missing details');
		return;
	}
	
	require_once '/ext/securimage/securimage.php';
	$image = new Securimage();
	if (!$image->check($_POST['code'])) {
		location('HTTP 1.1 400 Failed captcha test');
		return;
	}
	
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['details'];
	mail("contact@errolmarkland.com", $email, $subject, $message);
?>