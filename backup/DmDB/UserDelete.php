<?php
include './Includes/LoginCheck.php';
include './Includes/mode.php';

if  ( $ID > 1 )
	{
		$Sql= "delete from runuser where runuserid = ".$ID;
		$DeleteStatus = @mysql_query($Sql, $Connect );

		If ( ! $DeleteStatus ) 
			Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;
		
		Else
		{
			header("Location: Users.php");
		}


	}
Else
{
	header("Location: Users.php?Del=No" );


}





?>
