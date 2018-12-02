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

	//sendEmail("p.ferri1986@gmail.com","Password recovery","Click the link below:http://localhost/Twinkllin/server/recoverPassword.php?e=" . $email . "&c=".$code . ".\n
	//			The link will be active for 10 minutes.");
				
	sendEmail("p.ferri1986@gmail.com","Password recovery","<p>Click the link below:</p>
															<a href='http://localhost/Twinkllin/server/recoverPassword.php?e=" . $email . "&c=".$code."'>Recover password</a>
															<br/><p>The link will be active for 10 minutes.</p>");
	$stmt->close();
	}
	else{
		$info->success = false;
		$info->info = 'The specified email was not found :(';
		
		
	}
	$j = json_encode($info);
   echo $j;


}

//If user clicked on link
else
{

	$email = $_GET['e'];
	$code = $_GET['c'];
	
	$con = connectToDb();
	//Get expiration
	$stmt = $con->prepare("select Activation_expire from ". userTable(). " where email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();	
	$stmt->bind_result($expiration);
	$stmt->fetch();
	$stmt->close();
	//Get code
	$stmt = $con->prepare("select validation from ". userTable(). "  where email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();	
	$stmt->bind_result($codeStored);
	$stmt->fetch();
	$stmt->close();
	
	
	$result = sendQuery($con,"select now()");
	$row = getRow($result);

	//Check if time expired
	if($expiration < $row[0] || $code != $codeStored)
	{
	echo '
	<link rel="stylesheet" href="../css/resetstyle.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<a href="../index.html">
	<img class="logoImg" src="../images/logo.png" alt="Twinkllinlogo" />
	</a>
	<div id="newPswMessage" style="margin: auto; width: 50%; text-align: center">
	
						<p class="formLabel" style="color: #c0c0c0;  ">Sorry, the link expired. Please try again.</p>
										
						
	</div>';
	}
	else
	{
		
		//Generate random password
		$psw = generateRandomString();
		$encPsw = enc($psw);
		
	
		$stmt = $con->prepare("update ". userTable() . " set password ='$encPsw', activation_expire=NOW() where email=? AND validation=?");
		$stmt-> bind_param("ss",$email,$code);
		$stmt->execute();	
		$affected = mysqli_affected_rows($con);
		if($affected == 1)
		{
			echo '
			<link rel="stylesheet" href="../css/resetstyle.css" />
			<link rel="stylesheet" type="text/css" href="../css/main.css" />
			<a href="../index.html">
			<img class="logoImg" src="../images/logo.png" alt="Twinkllinlogo" />
			</a>
			<div id="newPswMessage" style="margin: auto; width: 50%; text-align: center">
			
			<p class="formLabel" style="color: #c0c0c0;  ">Your new password:</p><br/>
			<p id="newPsw">'.$psw.'</p>						
								
			</div>';
		}
		else
		{
			echo '
			<link rel="stylesheet" href="../css/resetstyle.css" />
			<link rel="stylesheet" type="text/css" href="../css/main.css" />
			<a href="../index.html">
			<img class="logoImg" src="../images/logo.png" alt="Twinkllinlogo" />
			</a>
			<div id="newPswMessage" style="margin: auto; width: 50%; text-align: center">
			
			<p class="formLabel" style="color: #c0c0c0;  ">There was a problem while resetting your password. Please try again.</p><br/>
									
								
			</div>';
		}
		
		

	
	
	}	
	

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>