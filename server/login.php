
<?php
session_start();

$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$user = $_POST['userid'];
$psw = $_POST['psw'];

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');

$query = "SELECT * FROM users";
$result = mysql_query($query);
$found = 0;

while($row=mysql_fetch_array($result))
{
	if($row['username'] == $user && $row['password'] == $psw)
		{
		echo 1;
		$found = 1;
		
		$_SESSION['user'] = $user;
		$_SESSION['firstname'] = $row['firstname'];
		break;
		}
}

if($found == 0)
	echo 0;

mysql_free_result ($result);
mysql_close();



?>
