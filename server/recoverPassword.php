<?php
include("funcs.php");
include ("email.php");
include ("response.php");

if($_SERVER['REQUEST_METHOD']=='POST')
{

	$email = $_POST['email'];
	$con = connectToDb();

	
	
	$stmt = $con->prepare("select email from user where email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();	
	$result = $stmt->get_result();
	
	$rowcount = mysqli_num_rows($result);
	$info = new Response();


	if($rowcount==1)
	{
	
	$code = enc(microtime());
	$stmt = $con->prepare("update ". userTable() . " set validation ='$code', Activation_expire =  NOW() + INTERVAL 10 MINUTE where email=?");
	$stmt-> bind_param("s",$email);
	$stmt->execute();

	$info->success = true;
	$info->info = 'We sent an email to your specified address. Please click on the link provided to recover your password.';

	sendEmail("p.ferri1986@gmail.com","Password recovery","Click the link below:http://localhost/Twinkllin/server/recoverPassword.php?e=" . $email . "&c=".$code . ".\n
				The link will be active for 10 minutes.");
	$stmt->close();
	}
	else{
		$info->success = false;
		$info->info = 'Email not found';
		
		
	}
	$j = json_encode($info);
   echo $j;


}
else
{
	$email = $_GET['e'];
	$code = $_GET['c'];
	$con = connectToDb();
	$stmt = $con->prepare("select Activation_expire from user where email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();	
	$stmt->bind_result($expiration);
	$stmt->fetch();
	$stmt->close();
	$result = sendQuery("select now()");
	$row = getRow($result);

	//Check if time expired
	if($expiration < $row[0])
		echo 'Too late';
	else
		echo 'Will send new password';
	
	
}


?>