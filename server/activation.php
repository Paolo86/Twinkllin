<?php
include("funcs.php");

$email = $_GET['e'];
$code = $_GET['c'];



$con = connectToDb();

$ps = $con->prepare("select validation from " . userTable() ." where email=?;");
$ps->bind_param("s",$email);
$result = $ps->execute();

    $ps->bind_result($codeIn);


    $ps->fetch();

  

    /* close statement */
    $ps->close();



if($codeIn == $code)
{

	$ps = $con->prepare("update user set active = 1, validation='' where email=?");
	$ps->bind_param("s",$email);
	$result = $ps->execute();
	if($result)
	echo 'Accout activated';

$ps->close();
}






?>