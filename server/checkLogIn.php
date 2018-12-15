<?php
include("funcs.php");
include('response.php');
session_start();

$response = new Response();

if(isset($_SESSION['username']) && isset($_SESSION['psw']))
{
	$response->success = true;
	$ret = new stdClass();
	$un = $_SESSION['username'];
	//Get user details and send back
	$con = connectToDb();
	$result = sendQuery($con ,"select * from ". userTable() ." where username='$un' OR email='$un';");
	
	if($result)
	{
		$row = getRow($result);
		
		$ret->username = $_SESSION['username'];
		$ret->psw = $_SESSION['psw'];
		$ret->email = $row['email'];
		$ret->firstname = $row['firstname'];
		$ret->lastname = $row['lastname'];
		
		$retJ = json_encode($ret);
		
		$response->success = true;
		$response->info = $retJ;
	}
	else
	{
		$response->success = false;
		$response->info = "";	
	}
}
else
{
	$response->success = false;
	$response->info = "";
	
}

$responseJ = json_encode($response);
echo $responseJ;

	
?>