<?php
include("funcs.php");

$username = $_GET['username'];
$code = $_GET['c'];



$con = connectToDb();

$ps = $con->prepare("select validation from " . userTable() ." where username=?;");
$ps->bind_param("s",$username);
$result = $ps->execute();
 /* bind result variables */
    $ps->bind_result($codeIn);

    /* fetch value */
    $ps->fetch();

  

    /* close statement */
    $ps->close();



if($codeIn == $code)
{

	$ps = $con->prepare("update user set active = 1, validation='' where username=?");
	$ps->bind_param("s",$username);
	$result = $ps->execute();
	if($result)
	echo 'Accout activated';

$ps->close();
}






?>