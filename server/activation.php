<?php
include("funcs.php");

$email = $_GET['e'];
$code = $_GET['c'];



$con = connectToDb();

$ps = $con->prepare("select validation,active from " . userTable() ." where email=?;");
$ps->bind_param("s",$email);
$result = $ps->execute();

    $ps->bind_result($codeIn,$isActive);


    $ps->fetch();

  

    /* close statement */
    $ps->close();



if($codeIn == $code && $isActive == 0)
{

	$ps = $con->prepare("update user set active = 1, validation='' where email=?");
	$ps->bind_param("s",$email);
	$result = $ps->execute();
	if($result)
	{
	echo '
	<link rel="stylesheet" href="../css/resetstyle.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<a href="../index.html">
	<img class="logoImg" src="../images/logo.png" alt="Twinkllinlogo" />
	</a>
	<div id="newPswMessage" style="margin: auto; width: 50%; text-align: center">
	
						<p class="formLabel" style="color: #c0c0c0;  ">Your account was activated.</p>
										
						
	</div>';	
	}
	

$ps->close();
}
else if($isActive == 1)
{
	echo '
	<link rel="stylesheet" href="../css/resetstyle.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<a href="../index.html">
	<img class="logoImg" src="../images/logo.png" alt="Twinkllinlogo" />
	</a>
	<div id="newPswMessage" style="margin: auto; width: 50%; text-align: center">
	
						<p class="formLabel" style="color: #c0c0c0;  ">The account is already active.</p>
										
						
	</div>';
}







?>