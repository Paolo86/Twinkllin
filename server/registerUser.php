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
$res = sendQuery($con,"select username from ". userTable() ." where username='$username' OR email='$email';");

if($res)
{
	$row = getRow($res);
	

	if($row)
	{
		$info->success = false;
		$info->info= 'Username or email is already taken.';
	
	}
	else
	{
		
			//If it got here it means it's all good
		$pswEnc = enc($psw);
		$code = enc('$username' . microtime());
		$ac = 0;
		
		
		$stmt = $con->prepare("Insert into ".userTable()." (username, firstname, lastname, email, password, validation, active) values (?,?,?,?,?,?,?);");
		$stmt->bind_param("ssssssi", $username,$firstname,$lastname,$email,$pswEnc,$code,$ac);
		$worked = $stmt->execute();					
		$result = $stmt->get_result();
		$stmt->close();
		
		if(!$worked)
		{
			$info->success = false;
			$info->info= 'Internal error occurred. Pleasdasdasdasdse try again.';
			$infoJ = json_encode($info);

		}
		else{
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
		}
	}
}
else
{
	$info->success = false;
	$info->info= 'Internal error occurred. Please try again.';

}

$infoJ = json_encode($info);
echo $infoJ;					



?>