<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require 'W:\composer\vendor\autoload.php';

function sendEmail($to, $subject,$message)
{
	
/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {

$mail->IsSMTP();                           // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 587;                    // set the SMTP port
$mail->Username   = "p.ferri1986@gmail.com"; // SMTP account username
$mail->SMTPSecure = 'tsl';
$mail->Password   = "evh5150jigendaisuke";        // SMTP account password
$mail->From = "p.ferri1986@gmail.com";
$mail->addAddress("p.ferri1986@gmail.com", "Pueblo");
$mail->Subject = $subject;
$mail->Body = $message;
$mail->send();
}
catch (Exception $e)
{

}
catch (Exception $e)
{

}


}

?>