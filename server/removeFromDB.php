<?php



	
$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');



$pkname = trim($_POST['pkname']);
$id = trim($_POST['id']);
$table = trim($_POST['table']);
$idstring = "'".$id."'";


$query = "delete from ".$table." where $pkname = '$id' ;";

$result = mysql_query($query);

if($result)
	echo 1;
else
	echo 0;



mysql_close();
	
	
	

?>