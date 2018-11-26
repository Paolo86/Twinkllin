<?php

include("funcs.php");
include ("email.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$psw = $_POST['psw'];
$email = $_POST['email'];

$con = connectToDb();
$info = array();



//Check for username
$res = sendQuery("select username from ". userTable() ." where username='$username';");
$row = getRow($res);
$valid = 1;

if($row)
{
	$info['status'] = 'fail';
	$info['response'] = 'Username is already taken';
	$valid = 0;
}


//Check for email
$res = sendQuery("select email from user where username='$username';");
$row = getRow($res);

if($row)
{
	$info['status'] = 'fail';
	$info['response'] = 'Email is already taken';
	$valid = 0;
}

	
if($valid == 1)
{
	$pswEnc = md5($psw);
	$code = md5('$username' . microtime() );
	$result = sendQuery("Insert into user (username, firstname, lastname, email, password, validation, active ) values 
					('$username','$firstname','$lastname','$email','$psw','$code',0);");
					
	$info['info'] = 'ok';
	$info['response'] = 'Registration successful';
	
	sendEmail("p.ferri1986@gmail.com","Activation code","CLick the link below:
	
	http://localhost/Twinkllin/server/activation.php?username=" . $username ."&c=". $code."");
}

$infoJ = json_encode($info);
echo $infoJ;






					



?>