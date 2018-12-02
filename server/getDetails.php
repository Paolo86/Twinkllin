<?php
include("funcs.php");
include("response.php");

$itemid = $_POST['id'];
$con = connectToDb();

$result = sendQuery($con,"select * from ". jewelsTable() ." where id = '$itemid';");

$resp = new Response();

if(!$result)
{
	$resp->success = false;
	$resp->info = "An internal error occurred. Please try again.";	
}
else
{
	
	$row = getRow($result);
	
	$imageDir = "../".imagesLink() . $itemid . "/";
	$a = scandir($imageDir);
	
	$ret = new stdClass();
	$ret->id = $itemid;
	$ret->name = $row['Name'];
	$ret->description = $row['Description'];
	$ret->price = $row['Price'];
	$ret->category = $row['Category'];
	
	$imagesNames = array();
	
	$i = 2;
	for(;$i < count($a); $i++)
	{
		$imagesNames[] = $a[$i];
	}
	$imagesJ = json_encode($imagesNames);
	$ret->imagesNames = $imagesJ;
	
	$jsonItem = json_encode($ret); //Create JSON to return	
	$resp->success = true;
	$resp->info = $jsonItem;

}




$respJ = json_encode($resp);
echo $respJ;
mysqli_close($con);

?>