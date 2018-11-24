<?php


	$name = $_POST['firstname'];
	$surname = $_POST['lastname'];
	$user = $_POST['username'];
	$psw = $_POST['psw'];
	
	$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');

$query = "insert into users values ('$user','$psw','$name','$surname',0)";
$result = mysql_query($query);

if($result)
{
	echo 1;

}
else
	echo 0;




mysql_close();
	
	
	

?>