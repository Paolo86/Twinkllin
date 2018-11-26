<?php

include("funcs.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$psw = $_POST['psw'];
$email = $_POST['email'];

$con = connectToDb();
$info = array();



//Check for username
$res = sendQuery("select username from user where username='$username';");
$row = getRow($res);

if($row)
{
	$info['status'] = 'fail';
	$info['response'] = 'Username is already taken';
}
	
else
{
	$result = sendQuery("Insert into user (username, firstname, lastname, email, password, validation, active ) values 
					('$username','$firstname','$lastname','$email','$psw','',0);");
					
	$info['info'] = 'ok';
	$info['response'] = 'Registration successful';
}

$infoJ = json_encode($info);
echo $infoJ;




//$con = connectToDb();


					



?>