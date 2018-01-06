<?php
include './Includes/Top.php'; 
include './Includes/LoginCheck.php';
include './Includes/mode.php';

ini_set( 'display_errors', 'On' );

$clf=str_replace(":","",$_POST['closed_from']);
$clt=str_replace(":","",$_POST['closed_to']);

	$ID = $_POST["ID"];
	$PostFailed = False;


	if ( $clt <= $clf )
	{

		$err="STARTTIME";
		//print "DDDDD";
	
	}
//print $clf ."--". $clt ;
//exit;


	
	// Check that the 



if ( ! $err )
{
	

		if ( ! $ID ){
		$Sql= "insert into closing_times ( fk_ct_supplier_id, fk_ct_locations_id, closed_from, closed_to ) values ( ";
        $Sql.= intval( $_POST['supplierid']).",";
        $Sql.= intval( $_POST['fk_ct_locations_id']).",'"; 
		$Sql.= trim( $_POST['closed_from'] )."','";
		$Sql.= trim( $_POST['closed_to'] )."' )";

		}
		Else
		{
		$Sql= "update closing_times set  ";  
		$Sql.="fk_ct_supplier_id = ".trim( $_POST['supplierid'] ).", ";
		$Sql.="fk_ct_locations_id = ".trim( $_POST['fk_ct_locations_id'] ).", ";
		$Sql.="closed_from = '".$_POST['closed_from']."', ";
		$Sql.="closed_to = '".$_POST['closed_to']."'" ;
		$Sql.= " where closing_times_id = ".$_POST['ID'];


		}


		$InsertStatus = @mysql_query($Sql, $Connect );
		If ( ! $InsertStatus ) 
		{
			Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;
			exit;
		}
			
}

			header("Location: CloseTimeList.php?err=".$err);
	

?>