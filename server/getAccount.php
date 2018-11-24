
<?php
session_start();

$servername = "localhost";
$username = "X33256656";
$password = "X33256656";

$user = $_SESSION['user'];
$userstring = "'$user'";

$dbc = mysql_pconnect($servername ,$username , $password);

mysql_select_db('X33256656');

$query = "SELECT * FROM users WHERE username= " . $userstring . ";";
$result = mysql_query($query);

$userTable = "'users'";
$jewelsTable = "'jewels'";
$paintingsTable = "'paintings'";

$userTablePK = "'username'";
$jewelsTablePK = "'id'";
$paintingsTablePK = "'id'";
$row=mysql_fetch_array($result);
//Check if admin user, display items
$isadmin = $row['isadmin'];

echo '<div class="account-update">';

echo '<h3 class="statement">Account details</h3>';
echo '<p >Username:<span id="username"> '. $row[0] .'</span></p>';
echo '<p>Password: <input id="'.$row[0].'-password" type="text" value="'. $row[1] .'" onchange="changeAttribute(id,'.$userstring.','.$userTable.','.$userTablePK.')"></input></p>';
echo '<p>Firstname: <input id="'.$row[0].'-firstname" type="text" value="'. $row[2] .'" onchange="changeAttribute(id,'.$userstring.','.$userTable.','.$userTablePK.')"></input></p>';
echo '<p>Lastname:  <input id="'.$row[0].'-lastname" type="text" value="'. $row[3] .'" onchange="changeAttribute(id,'.$userstring.','.$userTable.','.$userTablePK.')"></input></p>';

if($isadmin == 0)
{
echo '<p><button id="users" type="button" value="Save changes" onclick="updateUserAttributes()">Save changes</button></p>';
echo '<p><button type="button" onclick="removeFromDB('.$userstring.','.$userTable.','.$userTablePK.')">Delete account</button>';
}



if($isadmin == 1)
{

//Jewellery table
$query = "SELECT * FROM jewels";

$r = mysql_query($query);

echo '<div class="add-tbls">';
echo '<br /><h3>Jewellery</h3><br />';
echo '<div style="overflow-x:auto;">';
echo '<table>';

while($row=mysql_fetch_array($r))
{
$idstring = "'$row[0]'";

echo '<tr>';

echo '<td>';
echo '<p >'. $row[0] .'</p>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-title" type="text" value="'. $row[1] .'" onchange="changeAttribute(id,'.$idstring.','.$jewelsTable.','.$jewelsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-details" type="text" value="'. $row[2] .'" onchange="changeAttribute(id,'.$idstring.','.$jewelsTable.','.$jewelsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-category" type="text" value="'. $row[3] .'" onchange="changeAttribute(id,'.$idstring.','.$jewelsTable.','.$jewelsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-price"  type="text" value="'. $row[4] .'" onchange="changeAttribute(id,'.$idstring.','.$jewelsTable.','.$jewelsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-link" type="text" value="'. $row[5] .'" onchange="changeAttribute(id,'.$idstring.','.$jewelsTable.','.$jewelsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-stock" type="number" value="'. $row[6] .'" onchange="changeAttribute(id,'.$idstring.','.$jewelsTable.','.$jewelsTablePK.')"></input>';
echo '</td>';
echo '<td>';

echo '<button type="button" onclick="removeFromDB('.$idstring.','.$jewelsTable.','.$jewelsTablePK.')">Remove</button>';
echo '</td>';
echo '</tr>';
}
echo '</table>';
echo '</div>';


//Paintings table
$query = "SELECT * FROM paintings";

$r = mysql_query($query);

echo '<br /><h3>Paintings</h3><br />';
echo '<div style="overflow-x:auto;">';
echo '<table>';

while($row=mysql_fetch_array($r))
{
$idstring = "'$row[0]'";

echo '<tr>';

echo '<td>';
echo '<p >'. $row[0] .'</p>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-title" type="text" value="'. $row[1] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-category" type="text" value="'. $row[2] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-year" type="text" value="'. $row[3] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-size" type="text" value="'. $row[4] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-price" size="35" type="text" value="'. $row[5] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo '<input id="'.$row[0].'-link" type="text" value="'. $row[6] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';
echo ' <input id="'.$row[0].'-stock" type="number" value="'. $row[7] .'" onchange="changeAttribute(id,'.$idstring.','.$paintingsTable.','.$paintingsTablePK.')"></input>';
echo '</td>';
echo '<td>';

echo '<button type="button" onclick="removeFromDB('.$idstring.','.$paintingsTable.','.$paintingsTablePK.')">Remove</button>';
echo '</td>';
echo '</tr>';
}
echo '</table>';
echo '</div>';
//Users table

//User table
$query = "SELECT * FROM users";

$r = mysql_query($query);


echo '<br /><h3>Users</h3><br />';
echo '<div style="overflow-x:auto;">';
echo '<table style="width: 90%">';

echo '<tr>';
echo '<td>';
echo '<p >Username</p>';
echo '</td>';

echo '<td>';
echo '<p >Password</p>';
echo '</td>';

echo '<td>';
echo '<p >Firstname</p>';
echo '</td>';

echo '<td>';
echo '<p >Lastname</p>';
echo '</td>';

echo '<td>';
echo '<p >Admin</p>';
echo '</td>';
echo '</tr>';
while($row=mysql_fetch_array($r))
{
$idstring = "'$row[0]'";

echo '<tr>';

echo '<td>';
echo '<p >'. $row[0] .'</p>';
echo '</td>';

echo '<td>';
echo '<p >'. $row[1] .'</p>';
echo '</td>';

echo '<td>';
echo '<p >'. $row[2] .'</p>';
echo '</td>';

echo '<td>';
echo '<p >'. $row[3] .'</p>';
echo '</td>';

echo '<td>';
$admin = "Yes";
if($row[4] == 0)
	$admin = "No";
echo '<p >'. $admin .'</p>';
echo '</td>';

echo '</tr>';
}
echo '</table>';
echo '</div>';

$addJewel= "'Add-Jewel'";
$addPainting= "'Add-Painting'";
$addStaff= "'Add-Staff'";
echo '<div class="staffAcc-btns">';
echo '<button  type="button" value="Save changes" onclick="updateUserAttributes()">Save changes</button>';
echo '<button  type="button" value="Save changes" onclick="toPage('.$addJewel.')">Add new jewel</button>';
echo '<button  type="button" value="Save changes" onclick="toPage('.$addPainting.')">Add new painting</button>';
echo '<button  type="button" value="Save changes" onclick="toPage('.$addStaff.')">Add new staff member</button>';
echo '<button type="button" onclick="removeFromDB('.$userstring.','.$userTable.','.$userTablePK.')">Delete account</button>';
echo '</div>';

}

echo '</div>';
mysql_free_result ($result);
mysql_close();



?>
