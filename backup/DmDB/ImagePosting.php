<?php
error_reporting(2047);
include './Includes/LoginCheck.php';
include './Includes/mode.php';



//* Now check the input values *//

	$PostFailed = False;


//* Getting the images *//

$uploaddir = getcwd();

$ID = $_REQUEST['ID'];



	$ImagesDir = $uploaddir . "/Images";

//* The files are added into 1 of 5 directories n the server *//


//* if (!file_exists($SysHouseDir) ) *//
//* mkdir ( $SysHouseDir ); *//



	$sqladd="";


	$UploadFailed=false;
	$PostFailed=false;
	if ( isset ( $_FILES['mainimage']) ) 
	{

		if ( $_FILES['mainimage']['name']  )
		{
			if (  $_FILES['mainimage']['error'] ){

				$UploadFailed = $_FILES['mainimage']['error'];
			}
			else
			{

				$filename = GetFileName( "main", "mainimage", $ID ) ;
				$PostFailed = HandleUploadFile("main", $ID, $filename, $_FILES['mainimage']['tmp_name'], $ImagesDir );

				if ( strlen ( $sqladd ) > 0 ) 
					$sqladd.=",";
				$sqladd.="mainimage = '".$filename."' ";
			}
		}
	}


if ( $PostFailed || $UploadFailed ) 
		{
		header("Location: VehicleImages.php?UF=".$UploadFailed."&PF=".$PostFailed."&ID=".$ID);
	}
	else
	{
		if ( strlen( $sqladd ) > 0 ) 
		{

			$Sql= "update vehicles set ";
			$Sql.=$sqladd;
			$Sql.= " where vehicleid = ".$ID;

			$InsertStatus = @mysql_query($Sql, $Connect );



			If ( ! $InsertStatus ) 
				Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;
			Else
			{
				header("Location: VehicleImages.php?ID=".$ID);

			}
		}
		else
		{

header("Location:VehicleImages.php?Gone=through&ID=".$ID);
		}

	}




// Declare cleaning function 

function GetFileName ( $dirname, $imagename, $ID ) {

$filename = $dirname . "/p" . $ID . "-" . str_replace("'", "", stripslashes( basename($_FILES[$imagename]['name']) ));

return $filename;

}
function HandleUploadFile ($dir, $ID, $filename, $imagename, $uploaddir ) { 


		$uploadfile = $uploaddir . "/" . $filename;

		$UPret = false;

		$TempResult = move_uploaded_file($imagename, $uploadfile);
		if ( ! $TempResult ) 
			$UPret=1;


		
		chmod( $uploadfile, 0744 );


  return $UPret; 
}  




	

?>
