<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<html>
<head>
<title>TRC Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>


</head>

<?php
include './Includes/BodyHead.php';
?>

<h1>Users</h1>

<p>On this page you can view a list of users who can access the TRC Database</p>
<p>You can add, edit or delete these records</p?

<?php
$Sql = "select * from runuser";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the Users section ".$Sql.mysql_error());

$i = 0 
?> 
<a href="UserAdd.php">Add new user</a>

<table width=90% align=center cellpadding=0 cellpadding=0 border=0>
<?php

while ($row = mysql_fetch_array($ResultSet) ) {

	print "<tr><td>";
	print $row[ "firstname" ]." ".$row[ "surname" ];
	print "<td><a href='UserAdd.php?ID=".$row[ "runuserid" ]."'>Edit</a>";

	print "</td>";
	print "<td>";
	print "<td><a href='UserDelete.php?ID=".$row[ "runuserid" ]."'>Delete</a>";
	print "</td></tr>";


}
?>
</table>
<?php
include './Includes/BodyFoot.php';
?>





















































































