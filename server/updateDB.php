<?php


	$table = $_POST['table'];
	$newvalue = $_POST['newvalue'];
	$column = $_POST['column'];
	$id = trim($_POST['id']);
	$pkname = $_POST['pkname'];
	
	$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');


$query = "update $table set $column = '$newvalue' where $pkname = '$id';";	
	
$result = mysql_query($query);

if($result)
	echo 1;
else
	echo 0;




mysql_close();

?>