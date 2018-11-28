<?php

function userTable()
{
	
	return "user";
}

function jewelsTable()
{
	
	return "jewels";
}

function connectToDb()
{
	
	$con = mysqli_connect("localhost","root","","twinkllin");
	return $con;
}

function redirectTo($page)
{
	header("Location: " . $page);
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


function enc($val)
{
	
	return password_hash($val,PASSWORD_BCRYPT );
}





?>