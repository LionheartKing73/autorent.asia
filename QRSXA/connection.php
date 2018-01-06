<?php
// $serverhost = "localhost";
// $serveruser = "autorent_root";
// $serverpwd  = "root@123";
// $dbname     = "autorent_DCR";
$serverhost = "localhost";
$serveruser = "root";
$serverpwd  = "";
$dbname     = "autorent_dcr";
	$Connect = mysqli_connect($serverhost, $serveruser, $serverpwd)
			or exit( "Failed to make Connection" );

	If ( $Connect ) 
	{
		$ConnectedDB = mysqli_select_db ( $dbname, $Connect ) ;
		//echo "connected!";

	}
		else
	{
			die ("No connect" );
	}
?>