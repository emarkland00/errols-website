<?php
	session_start(); 
	
	function checkCaptcha() {
		include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
		$securimage = new Securimage();
		return $securimage->check($_POST['captcha-code']);
	}
	
	function checkFormParams() {
		return (!isset($_POST['subject']) || !isset($_POST['details']) || !isset($_POST['email']));		
	}
	
	function processForm() {
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['details'];
		mail("contact@errolmarkland.com", $email, $subject, $message);
	}
	
	if (!checkCaptcha()) {
		header("HTTP 1.1 400 Bad captcha solution.");
		return;
	}
	
	if (!checkFormParams()) {
		header('HTTP 1.1 400 Missing details');
		return;
	}
	
	return processForm();
?>

