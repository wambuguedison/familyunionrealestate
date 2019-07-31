<?php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function sanitize_text($string) {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["submit"])) {
    if(empty($_POST["name"])) {
        $error .= '<p><label class="text-danger">Please Enter name</label></p>';
    } else {
        $name = sanitize_text($_POST["name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $error .= '<p><label class="text-danger">Please Enter valid characters for name</label></p>'; 
        }
    }
    if(empty($_POST["email"])) {
        $error .= '<p><label class="text-danger">Please Enter email</label></p>';
    } else {
        $email = sanitize_text($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= '<p><label class="text-danger">Email cant contain invalid characters</label></p>';
        }
    }
    if(empty($_POST["subject"])) {
        $error .= '<p><label class="text-danger">Please Enter Subject</label></p>';
    } else {
        $subject = sanitize_text($_POST["subject"]);
    }
    if (empty($_POST["message"])) {
        $error .= '<p><label class="text-danger">Please Enter Message</label></p>';
    } else {
        $message = sanitize_text($_POST["message"]);
    }
    if ($error == '') {
        require 'src/php/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '80';
        $mail->SMTPAuth = true;
        $mail->Username = 'wambuguedison@gmail.com';
        $mail->Password = 'Eddiewaweru';
        $mail->SMTPSecure = '';
        $mail->From = $_POST["email"];
        $mail->FromName = $_POST["name"];
        $mail->AddAddress('wambuguedison@gmail.com', 'Eddie W.');
        $mail->AddCC($_POST["email"], $_POST["name"]);
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = $_POST["subject"];;
        $mail->Body = $_POST["message"];
        if($mail->Send()) {
            $error = '<p><label class="text-success">Sent Successfully</label></p>';
        } else {
            $error = '<p><label class="text-danger">Error</label></p>';
        }
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>