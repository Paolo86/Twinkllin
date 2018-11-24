
<?php


$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$theId = $_GET['id'];
$table = $_GET['t'];


$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');


$query = "update " . $table . " set stock = stock-1 WHERE id='".trim($theId) . "';";

$result = mysql_query($query);




mysql_free_result ($result);
mysql_close();
?>
