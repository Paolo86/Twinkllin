
<?php


$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$table = $_GET['t'];
 $tableName = "'$table'";
$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');


$query = "SELECT * FROM " . $table;
$result = mysql_query($query);

//Create thumb div for jewelery
if($table == 'jewels')
{
while($row=mysql_fetch_array($result))
{
  $id = $row['id'];



echo '<div  class="pcollection-box" id=" ' . $row["id"] . '"  onclick="displayDetails(id,'.$tableName .')" >';


echo '<image class="sampleImage" src="' . $row['link'] . '"></image>' ;
echo '<p id="title">'.  $row['title'] . '</p>';
echo '<p id ="details-item">Price: '.  $row['price'] . '</p>';
echo '<p id ="details-item">Available: '.  $row['stock'] . '</p>';
$stock =  $row['stock'];
if($stock > 0)
{
echo '<button class="buybutton" type="button" >Buy Now!</button>';
}


echo '</div>';
}
}
//Create thumb div for jewelery
else
{
while($row=mysql_fetch_array($result))
{
  

echo '<div  class="pcollection-box" id=" ' . $row["id"] . '"  onclick="displayDetails(id,'.$tableName .')" >';

echo '<image class="sampleImage" src="' . $row['link'] . '""></image>' ;
echo '<p id="title">'.  $row['title'] . '</p>';
echo '<p id="details-item">'.  $row['year'] . '</p>';

echo '<p id="details-item">Price:'.  $row['price'] . '</p>';
echo '<p id ="details-item">Available:'.  $row['stock'] . '</p>';

$stock =  $row['stock'];
if($stock > 0)
{
echo '<button class="buybutton" type="button" >Buy Now!</button>';
}

echo '</div>';
}

}




mysql_free_result ($result);
mysql_close();
?>
