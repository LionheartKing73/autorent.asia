<?php
session_start();

If ( isset( $_GET['Logoff'] ) )
{
	$_SESSION['runuserid'] = 0;
}


If ( $_SESSION['runuserid'] > 0 ) 
{
include 'SqlConn.php';

	$NotLoggedIn = False;	
	$ActiveUser=$_SESSION['runuserid'];
	$sql="Select * from runuser where runuserid = ".$ActiveUser;
	$ResultSet = mysql_query( $sql ) 
	or die ( "Failed in User Query" .mysql_error());
	$UserRow = mysql_fetch_array($ResultSet) ;
}
Else
{

		$NotLoggedIn= True;
		header("Location: ./index.php");
		Exit();

}
?>