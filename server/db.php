<?php
include("funcs.php");


$con = connectToDb();

$result = sendQuery("select * from ". jewelsTable() .";");
echo '<div class="row">';
while($row = getRow($result))
{
	$stock = $row['Stock'];
	if($stock <=0) continue;
	
	$id = $row['ID'];
	$title = $row['Name'];
	$price = $row['Price'];
	$idstring = "'$id'";
	//Get a link to first image
	$imageDir = "../".imagesLink() . $id . "/";
	$a = scandir($imageDir);
	$linkToImage = imagesLink() . $id . "/" . $a[2]; //Get first image available
	
	
  
  	echo '<div class="col-md-4" >
        <a class="thumbnail" onclick="displayDetails('. $idstring.')">
             <img src="' . $linkToImage . '" class="img-rounded img-responsive imgThumb">
			 <div class="imgOverlay">
			 <p class="overlayTitle">'.$title.'</p>
			 <p>$'.$price.'</p>
			 </div>
        </a>
    </div>';	
}

echo '</div>';
?>