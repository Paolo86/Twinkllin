<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require 'W:\composer\vendor\autoload.php';

function sendEmail($to, $subject,$message)
{
	

$mail = new PHPMailer(TRUE);


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
$mail->AddEmbeddedImage('../images/logo.png', 'Twinkllin','../images/logo.png');
$mail->Body = '<div><img width="50pt" src=\"cid:Twinkllin\" /></div><div>'.$message.'</div>';
$mail-> IsHTML(true);

$mail->send();
return true;


}
catch (Exception $e)
{
return false;
}



}

?>