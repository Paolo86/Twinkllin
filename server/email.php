<?php


	
	$email = $_POST['email'];
	$msg = $_POST['message'];
	$extra = "From: " . $email;
	
	mail('p.ferri1986@gmail.com','Twinkllin',$msg,$extra);

	echo 'Email from ' . $email;
	
	
	

?>