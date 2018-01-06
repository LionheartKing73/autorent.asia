<?php
include './Includes/Top.php'; 
include './Includes/LoginCheck.php';
include './Includes/mode.php';

$priceperday=str_replace(",","",$_POST["priceperday"]);


$passenger=str_replace(",","",$_POST["passenger"]);
$regno = str_replace(",","",$_POST["regno"]);
$cc=str_replace(",","",$_POST["cc"]);

$Class = mysql_real_escape_string($_REQUEST['class' ]);


if ( ! get_magic_quotes_gpc() ) {
$manufacturer = addslashes($_POST['manufacturer']);
$model = addslashes($_POST['model']);
$luggage = addslashes($_POST['luggage']);
$extras1 = addslashes($_POST['extras1']);
$extras2 = addslashes($_POST['extras2']);
$extras3 = addslashes($_POST['extras3']);
$extras4 = addslashes($_POST['extras4']);
}
else
{
$manufacturer = $_POST['manufacturer'];
$model = $_POST['model'];
$luggage = $_POST['luggage'];
$extras1 = $_POST['extras1'];
$extras2 = $_POST['extras2'];
$extras3 = $_POST['extras3'];
$extras4 = $_POST['extras4'];
}

if ( ! $passenger )
	$passenger = 0;


if ( ! $cc  )
	$cc= 0;


$Class = $_REQUEST['class' ];
$Package = $_REQUEST['package' ];


	$PostFailed = False;

  	if (strlen($priceperday)<1 )
	{
		$priceperday = 0;
	}


//Check if this vehicle exists

$ID = $_POST["ID"];

		//* Initialiase all the variables *//


		if ( ! $ID ){
		$Sql= "insert into stop_sell ( fk_ct_supplier_id, fk_ct_locations_id, fk_ct_pricing_scheme_id,stop_from, stop_to ) values ( ";
        $Sql.= intval( $_POST['supplierid']).",";
        $Sql.= intval( $_POST['fk_ct_locations_id']).","; 
        $Sql.= intval( $_POST['fk_ct_pricing_scheme_id']).",'"; 
		$Sql.= trim( $_POST['stop_from'] )."','";
		$Sql.= trim( $_POST['stop_to'] )."' )";

		}
		Else
		{
		$Sql= "update stop_sell set  ";  
		$Sql.="fk_ct_supplier_id = ".trim( $_POST['supplierid'] ).", ";
		$Sql.="fk_ct_locations_id = ".trim( $_POST['fk_ct_locations_id'] ).", ";
		$Sql.="fk_ct_pricing_scheme_id = ".trim( $_POST['fk_ct_pricing_scheme_id'] ).", ";
		$Sql.="stop_from = '".$_POST['stop_from']."', ";
		$Sql.="stop_to = '".$_POST['stop_to']."'" ;
		$Sql.= " where stop_sell_id = ".$_POST['ID'];


		}



		$InsertStatus = @mysql_query($Sql, $Connect );



		If ( ! $InsertStatus ) 
			Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;

		Else
		{
			header("Location: StopSaleList.php?Class=".$Class);
		}

?>
