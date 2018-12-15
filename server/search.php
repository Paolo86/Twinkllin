<?php
include("funcs.php");
include('response.php');

$searchInput = $_POST['searchInput'];


$con = connectToDb();


$response = new Response();

$result = sendQuery($con ,"select * from ". jewelsTable() ." where Name like '%$searchInput%' OR Category like '%$searchInput%'");


if($result)
	{
	    $response->success = true;
		$response->info =  '<div class="row">';
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
			
		  
			$response->info  .= '<div class="col-md-4" >
				<a class="thumbnail" onclick="displayDetails('. $idstring.')">
					 <img src="' . $linkToImage . '" class="img-rounded img-responsive imgThumb">
					 <div class="imgOverlay">
					 <p class="overlayTitle">'.$title.'</p>
					 <p>$'.$price.'</p>
					 </div>
				</a>
			</div>';	
		}

		$response->info .= '</div>';
	}
else
	{
		$response->success = false;
		$response->info= 'An internal error occurred. Please try again.';
		//$response->info= 'Err ' .  mysqli_error($con);
		
	}





$respJ = json_encode($response);
echo $respJ;
mysqli_close($con);

?>