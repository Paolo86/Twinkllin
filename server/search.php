
<?php


$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$search = $_GET['search'];
$foundSomething = 0;

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');

//Look in jewels table
$query = "SELECT * FROM jewels";
$result = mysql_query($query);
$tableName = "'jewels'";

while($row=mysql_fetch_array($result))
{

  if(strpos(strtolower($row['title']), strtolower($search)) !== false || strpos(strtolower($row['category']), strtolower($search)) !== false )
	{
	$foundSomething = 1;
	  $id = $row['id'];

	echo '<div  class="pcollection-box" id=" ' . $row["id"] . '"  onclick="displayDetails(id,'. $tableName .')" >';
	echo '<image class="sampleImage" src="' . $row['link'] . '"></image>' ;
	echo '<p>' . $row["title"] . '</p>';
	echo '</div>';

	}
	
	
}

//Look in paintings table
$query = "SELECT * FROM paintings";
$result = mysql_query($query);
$tableName = "'paintings'";

while($row=mysql_fetch_array($result))
{
$foundSomething = 1;
	
  if(strpos(strtolower($row['title']), strtolower($search)) !== false || strpos(strtolower($row['category']), strtolower($search)) !== false || strtolower($row['year']) == strtolower($search) )
	{
	  $id = $row['id'];

	echo '<div  class="pcollection-box" id=" ' . $row["id"] . '"  onclick="displayDetails(id,'. $tableName .')" >';
	echo '<image class="sampleImage" src="' . $row['link'] . '"></image>' ;
	echo '<p>' . $row["title"] . '</p>';
	echo '</div>';

	}
	
	
}


if($foundSomething ==0)
{
echo '<div  class="pcollection-box"  >';

	echo '<h1>No results.</h1>';
	echo '</div>';
}



mysql_free_result ($result);
mysql_close();
?>
