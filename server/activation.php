<?php
include("funcs.php");

$username = $_GET['username'];
$code = $_GET['c'];



$con = connectToDb();

$result = sendQuery("select * from " . userTable() ." where username='$username';");

$row = getRow($result);

$codeIn = $row['validation'];

if($codeIn == $code)
{
	$result = sendQuery("update user set active = 1, validation='' where username='$username'");
	if($result)
	echo 'Accout activated';
}






?>