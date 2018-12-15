<?php
include("funcs.php");
include('response.php');
session_start();

$response = new Response();


	
	
	
	$originalusername = $_POST['originaluser'];
	$newusername = $_POST['newusername'];
	$newfirstname = $_POST['newfirstname'];
	$newlastname = $_POST['newlastname'];
	$newemail = $_POST['newemail'];

	$con = connectToDb();
	$stmt = $con->prepare("update ". userTable() ." set firstname=?, username=?, lastname=?, email=? where username = ? OR email = ?; ");

	$stmt->bind_param("ssssss", $newfirstname,$newusername,$newlastname,$newemail,$originalusername,$originalusername);
	$result =  $stmt->execute();					
	
	
	if($result)
	{
		$_SESSION['username'] = $newusername;
		$response->success = true;
		
	}
else
{
	$response->success = false;
}
	
	
	



$stmt->close();
$respJ = json_encode($response);
echo $respJ;
mysqli_close($con);

	
?>