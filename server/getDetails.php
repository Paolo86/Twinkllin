<?php
include("funcs.php");
include("response.php");

$itemid = $_POST['id'];
$con = connectToDb();

$result = sendQuery("select * from ". jewelsTable() ." where id = '$itemid';");
$row = getRow($result);
sleep(4);
$resp = new Response();

if($row)
{
	
	
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
else
{
	
	$resp->success = false;
	$resp->info = "Database failure";
}

$respJ = json_encode($resp);
echo $respJ;

?>