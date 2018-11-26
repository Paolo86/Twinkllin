<?php

function connectToDb()
{
	
	$con = mysqli_connect("localhost","root","","twinkllin");
	return $con;
}


function sendQuery($query)
{
	$con = connectToDb();
	$result = mysqli_query($con,$query);
	return $result;
}

function getRow($result)
{
	
	$row = mysqli_fetch_array($result);
	return $row;
}





?>