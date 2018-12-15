<?php

include("funcs.php");
include('response.php');

sleep(1); //Pause for a second, otherwise the modal doesn't close in javascript and you get a dark screen (2 modals showing up).
$username = $_POST['username'];


$con = connectToDb();


$response = new Response();

$stmt = $con->prepare("delete from ". userTable() ." where username = ? OR email = ?; ");

	$stmt->bind_param("ss", $username,$username);
	$stmt->execute();					
	$result = $stmt->get_result();



if($result)
{
	$response->success = true;
	$response->info = "Your account was successfully deleted.";	
		
}
else
{
	$response->success = false;
	$response->info = "An internal error occurred. Please try again later.";
}



$stmt->close();
$respJ = json_encode($response);
echo $respJ;
mysqli_close($con);

?>