<?php



	
$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');

$table = $_POST['table'];


if($table == 'jewels')
{
	

$title = $_POST['title'];
$category = $_POST['category'];
$price = $_POST['price'];
$link = $_POST['link'];
$stock = $_POST['stock'];
$details = $_POST['details'];
	
//Get total 
$q = "select * from jewels";
$result = mysql_query($q);
$rowcount=mysql_num_rows($result);
$jewelid = "J" . ($rowcount +1);

$insertquery = "insert into jewels values('$jewelid','$title','$details','$category','$price','$link','$stock')";
$insertresult = mysql_query($insertquery);

if($insertresult)
	echo 1;
else
	echo 0;


}
else if($table == 'paintings')
{
	

$title = $_POST['title'];
$category = $_POST['category'];
$price = $_POST['price'];
$link = $_POST['link'];
$stock = $_POST['stock'];
$size = $_POST['size'];
$year = $_POST['year'];	

//Get total 
$q = "select * from paintings";
$result = mysql_query($q);
$rowcount=mysql_num_rows($result);
$paintingid = "P" . ($rowcount +1);

$insertquery = "insert into paintings values('$paintingid','$title','$category','$year','$size','$price','$link','$stock')";
$insertresult = mysql_query($insertquery);

if($insertresult)
	echo 1;
else
	echo 0;


}
else if($table == 'users')
{
	

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$psw = $_POST['psw'];



$insertquery = "insert into users values('$username','$psw','$firstname','$lastname',1)";
$insertresult = mysql_query($insertquery);

if($insertresult)
	echo 1;
else
	echo 0;


}




mysql_close();
	
	
	

?>