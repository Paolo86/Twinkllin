<?php
include("funcs.php");
$con = connectToDb();

$result = sendQuery("select * from ". jewelsTable() .";");
echo '<div class="row">';
while($row = getRow($result))
{
	
	$id = $row['ID'];
	$title = $row['Name'];
	$price = $row['Price'];
	$idstring = "'$id'";
	$stock = $row['Stock'];
	if($stock <=0) continue;
  
  	echo '<div class="col-md-4" >
        <a class="thumbnail" onclick="displayDetails('. $idstring.')">
             <img src="' . $row['Link'] . '" class="img-rounded img-responsive imgThumb">
			 <div class="imgOverlay">
			 <p class="overlayTitle">'.$title.'</p>
			 <p>$'.$price.'</p>
			 </div>
        </a>
    </div>';	
}

echo '</div>';
?>