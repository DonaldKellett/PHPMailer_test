<?php
/*
  PHPMailer Defaults
  Created by DonaldKellett (https://github.com/DonaldKellett)
  Does the default setting-up of PHPMailer (such as setting the SMTP and logging in to my GMail account) so all I have to do is include $headers, $to, $subject and $message and send the email via PHPMailer
  Open Source - No Licenses!
*/

// New PHPMailer Instance
$mail = new PHPMailer;

// Set to SMTP
$mail->isSMTP();

// Debug Mode (uncomment if necessary)
# $mail->SMTPDebug = 2;

// HTML-Friendly Debug Output (uncomment if necessary)
# $mail->Debugoutput = 'html';

// Set Host (Gmail) and Port (587); login to my email account via script
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "someone@example.tld"; // Enter your Gmail email address to start using this script
$mail->Password = "password"; // Enter your Gmail password to start using this script
?>
