<?php
include './Includes/LoginCheck.php';
include './Includes/mode.php';

$ID = $_GET['ID'];
if  ( $ID > 0 )
{


	$imagefile=$_GET['image'];


	$Sql= "select mainimage from vehicles where vehicleid = ".$ID;
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in Vehicle Query" .mysql_error());
	$UpdateRow = mysql_fetch_array($ResultSet) ;

	$filename = getcwd();
	$filename.="/Images/".$UpdateRow[ 0 ];

	//* update the record *//
	$Sql= "update vehicles set  mainimage = '' where vehicleid = ".$ID;
	$DeleteStatus = @mysql_query($Sql, $Connect );

		If ( ! $DeleteStatus ) 
			Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;
		
		Else
		{

//* remove the file *//

	unlink( $filename );




			header("Location: VehicleImages.php?ID=".$ID);
		}


	}
Else
{
	header("Location: VehicleList.php?Del=No" );


}





?>
