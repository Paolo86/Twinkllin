<?php
include("funcs.php");
include('response.php');

$username = $_POST['username'];
$psw = $_POST['psw'];

$con = connectToDb();


$response = new Response();

$stmt = $con->prepare("select * from ". userTable() ." where username = ?; ");

	$stmt->bind_param("s", $username);
	$stmt->execute();					
	$result = $stmt->get_result();



if($result)
{

		$data = $result->fetch_all();	
		//If username is available
		if(count($data) ==1)
		{
			//Check password
			if(password_verify($psw, $data[0][5]))
			{
				//Check if account is active
				if($data[0][7] == 1) //Log in OK
				{
				$response->success = true;
				$response->info = $data[0][2];	
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['psw'] = $psw;
				}
				else //Account is not active
				{
				$response->success = false;
				$response->info = "Your account is not active yet. Please activate your account before logging in.";	
				}
				
			}
			else
			{
				$response->success = false;
				$response->info = "The password appears to be incorrect.";
			}
		}
		else
		{
		$response->success = false;
		$response->info = "The details provided don't match with our system. Please check you username/password and try again.";	
		}
		
		
	
		
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