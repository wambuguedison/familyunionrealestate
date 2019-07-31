<?php
$admin_email = "info@familyunion.co.ke";


$header = "index.html";
$error = "src/error.html";
$success = "src/success.html";

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$mail = 
"Name: " . $name . "\r\n" . 
"Email: " . $email . "\r\n" .
"Subject: " .  $subject . "\r\n" .
"Message: " . $message ;

/*
The following function checks for email injection.
Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
*/
function isitInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_REQUEST['email'])) {
    header( "Location: $header" );
} elseif (empty($name) || empty($email) || empty($subject) || empty($message)) {
    header( "Location: $error" );
} elseif ( isitInjected($email) || isitInjected($name)  || isitInjected($message) || isitInjected($subject)) {
    header( "Location: $error" );
} else {

	mail( "$admin_email", "New Mail From Customer", $mail );

	header( "Location: $success" );
}
?>