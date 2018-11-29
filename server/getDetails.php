<?php
include("funcs.php");

$itemid = $_POST['id'];
$con = connectToDb();

$result = sendQuery("select * from ". jewelsTable() ." where id = '$itemid';");
$row = getRow($result);

if($row)
{
	$ret = array("name"=>$row['Name'],
					"category"=>$row['Category'],
						"description"=>$row['Description'],
							"price"=>$row['Price'],
								"img"=>$row['Link']);

	
	$j = json_encode($ret);
	echo $j;
}
else
{
	
	echo 'ERROR';
}
/*
echo '<div class="row">';
while($row = getRow($result))
{
	
	$id = $row['ID'];
	$title = $row['Name'];
	$price = $row['Price'];
	$idstring = "'$id'";

  
  	echo '<div class="col-xs-4" >
        <a class="thumbnail" onclick="displayDetails('. $idstring.')">
             <img src="' . $row['Link'] . '" class="img-rounded imgThumb">
			 <div class="imgOverlay">
			 <p class="overlayTitle">'.$title.'</p>
			 <p>$'.$price.'</p>
			 </div>
        </a>
    </div>';	
}

echo '</div>';*/
?>