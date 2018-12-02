<?php

include("funcs.php");
include ("email.php");
include ("response.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$psw = $_POST['psw'];
$email = $_POST['email'];

$con = connectToDb();
$info = new Response();



//Check for username
$res = sendQuery($con,"select username from ". userTable() ." where username='$username';");

if($res)
{
	$row = getRow($res);
	

	if($row)
	{
		$info->success = false;
		$info->info= 'Username is already taken.';
		$infoJ = json_encode($info);
		echo $infoJ;
		return;	
	}
}
else
{
	$info->success = false;
	$info->info= 'Internal error occurred. Please try again.';
	$infoJ = json_encode($info);
	echo $infoJ;
	return;	
}

//Check for email
$res = sendQuery($con,"select email from user where username='$username';");

if($res)
{
	$row = getRow($res);

	if($row)
	{
		$info->success = false;
		$info->info = 'Email is already taken.';
		
	}
}	
else
{
	$info->success = false;
	$info->info= 'Internal error occurred. Please try again.';
	$infoJ = json_encode($info);
	echo $infoJ;
	return;	
}

//If it got here it means it's all good
	$pswEnc = enc($psw);
	$code = enc('$username' . microtime());
	$ac = 0;
	
	$stmt = $con->prepare("Insert into ".userTable()." (username, firstname, lastname, email, password, validation, active ) values (?,?,?,?,?,?,?);");
	$stmt->bind_param("ssssssi", $username,$firstname,$lastname,$email,$pswEnc,$code,$ac);
	$stmt->execute();					
		
	$stmt->close();
	
	//$emailResult = sendEmail("p.ferri1986@gmail.com","Activation code","Click the link below: http://localhost/Twinkllin/server/activation.php?e=" . $email ."&c=". $code."");
	$emailResult = sendEmail($email,"Activation code","<p>Click the link below:</p>
															<a href='http://localhost/Twinkllin/server/activation.php?e=" . $email . "&c=".$code."'>Activate account</a>
															");
	
	
	if($emailResult)
	{
	$info->success = true;
	$info->info = 'We sent an email to your specified address. Please click on the link provided to activate your account.';	
	}
	else
	{
	$info->success = false;
	$info->info = 'We could not send an email to the specified address. Please try again later.';
	}
	
		
	
	
	


$infoJ = json_encode($info);
echo $infoJ;






					



?>