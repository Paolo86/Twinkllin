
<?php

session_start();
$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$theId = $_GET['id'];
$table = $_GET['t'];

 $tableName = "'$table'";
$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');


$query = "SELECT * FROM " . $table . " WHERE id='".trim($theId) . "';";

$result = mysql_query($query);
$row=mysql_fetch_array($result);

if($table == 'jewels')
{
//Details page for jewelery

	echo '<div class="details-box">';
	$id = $_GET['id'];
	$theid = "'$id'";
	echo '<image class="sampleImageDetails" src="' . $row['link'] . '"></image>' ;
	echo '<p>'.  $row['title'] . '</p>';
	echo '<p>'.  $row['price'] . '</p>';
	$stock =  $row['stock']; 

	$theuser = 0;

	if(isset($_SESSION['user']))
	{
	$user = $_SESSION['user'];
	$theuser = "'$user'";
	}

	if($stock > 0)
		{
		echo '<button class="buybuttonDetails" type="button"  onclick="buyNow('.$theid .','.$tableName .','.$theuser.')" >Buy Now!</button>';
		}
	
	echo '</div>';

}
else
{
//Details page for paintings
	$id = $_GET['id'];
	$theid = "'$id'";

	echo '<div class="details-box">';
	
	echo '<image class="sampleImageDetails" src="' . $row['link'] . '"></image>' ;
	echo '<p>'.  $row['title'] . '</p>';
	echo '<p>'.  $row['year'] . '</p>';
	echo '<p>'.  $row['price'] . '</p>';
		$stock =  $row['stock']; 

	$theuser = 0;

	if(isset($_SESSION['user']))
	{
	$user = $_SESSION['user'];
	$theuser = "'$user'";
	}

	if($stock > 0)
		{
		echo '<button class="buybuttonDetails" type="button"  onclick="buyNow('.$theid .','.$tableName .','.$theuser.')" >Buy Now!</button>';
		}

	


	echo '</div>';


}






mysql_free_result ($result);
mysql_close();
?>
