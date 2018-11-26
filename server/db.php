<?php
include("funcs.php");
$con = connectToDb();

$result = sendQuery("select * from ". jewelsTable() .";");

while($row = getRow($result))
{
	
	$id = $row['ID'];



echo '<div  class="pcollection-box" id=" ' . $row["ID"] . '" >';


echo '<image class="sampleImage" src="' . $row['Link'] . '"></image>' ;
echo '<p id="title">'.  $row['Name'] . '</p>';
echo '<p id ="details-item">Price: '.  $row['Price'] . '</p>';
echo '<p id ="details-item">Available: '.  $row['Stock'] . '</p>';
$stock =  $row['Stock'];
if($stock > 0)
{
echo '<button class="buybutton" type="button" >Buy Now!</button>';
}


echo '</div>';
	
	
}


?>