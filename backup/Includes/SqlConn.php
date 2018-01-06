<?php
include('connection.php');

	$Connect = mysql_connect($serverhost, $serveruser, $serverpwd)
			or exit( "Failed to make Connection" );

	If ( $Connect ) 
	{
		$ConnectedDB = mysql_select_db ( $dbname, $Connect ) ;

	}
		else
	{
			die ("No connect" );
	}

?>