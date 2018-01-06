<?php
include './Includes/Top.php';
include './Includes/mode.php';

if ( $ID ) 
{
	$Mode = "Edit";
	$Sql = "select * from runuser where runuserid = ".$ID;
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in User Query" .mysql_error());
	$EditRow = mysql_fetch_array($ResultSet) ;

	$username = $EditRow[ "username" ];
	$firstname = $EditRow[ "firstname" ];
	$surname = $EditRow[ "surname" ];	
	$password = $EditRow[ "password" ];
	$password2 = $EditRow[ "password" ];

	$RowId = $ID;
}
Else
	$Mode = "Add";

?>
<html>
<head>
<title>OAT Properties Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>


</head>

<?php
include './Includes/BodyHead.php';


?>

<h1><?php print $Mode?> Users</h1>

<p>On this page you can <?php print $Mode?> users who can access the OAT Database</p>

<table width=90% align=center cellpadding=0 cellpadding=0 border=0>
<form method="POST" Name="login" action="UserPosting.php">

<tr><td>Log in name</td><td><input type=text name=username value=<?php print $username?>></td>
<td>
<?php
If ( ereg( "u", $PostFailed ) )
	print( "The User Name must have at least 3 characters" ) ;
Else
{
	If ( ereg( "U", $PostFailed ) )
		print( "The User Name cannot be greater than 10 characters" ) ;
	Else
	{
		If ( ereg( "D", $PostFailed ) )
			print(  "The User Name already exists in the Database - choose another" ) ;

	}
}
?>
</td>

</tr>
<tr><td>Firstname</td><td><input type=text name=firstname value=<?php print $firstname?>></td>
<td>
<?php
If ( ereg( "f", $PostFailed ) )
		print( "You must enter a First Name" ) ;
?>
</td>

</tr>
<tr><td>Surname</td><td><input type=text name=surname value=<?php print $surname?>></td>
<td>
<?php
If ( ereg( "s", $PostFailed ) )
		print( "You must enter a Second Name" ) ;
?>
</td>

</tr>
<tr><td>Password</td><td><input type=text name=password value=<?php print $password?>></td><td>
<?php
If ( ereg( "p", $PostFailed ) )
		print ( "You must enter a Password - maximum 10 characters" ) ;
Else
{
If ( ereg( "P", $PostFailed) )
	print( "The Password cannot be greater than 10 characters");
}
?>
</td>
</tr>
<tr><td>Repeat Password</td><td><input type=text name=password2 value=<?php print $password2?>></td>
<td>
<?php
If ( ereg( "X", $PostFailed ) )
	print( "The Passwords do not match" );
?>
</td>

</tr>

<tr><td></td><td>
<input type=submit value=Save name=submit>
</td>


</tr>


<input type=hidden value='<?php print $RowId;?>' name='ID'>
</form>
</table>


<?php
include './Includes/BodyFoot.php';
?>





















































































