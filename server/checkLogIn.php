<?php
include("funcs.php");
include('response.php');
session_start();

$response = new Response();

if(isset($_SESSION['username']) && isset($_SESSION['psw']))
{
	$response->success = true;
	$ret = new stdClass();
	$ret->username = $_SESSION['username'];
	$ret->psw = $_SESSION['psw'];
	
	$retJ = json_encode($ret);
	
	$response->success = true;
	$response->info = $retJ;
}
else
{
	$response->success = false;
	$response->info = "";
	
}

$responseJ = json_encode($response);
echo $responseJ;

	
?>