<?php
include './Includes/Top.php'; 
include './Includes/LoginCheck.php';
include './Includes/mode.php';

$priceperday=str_replace(",","",$_POST["priceperday"]);


$passenger=str_replace(",","",$_POST["passenger"]);
$regno = str_replace(",","",$_POST["regno"]);
$cc=str_replace(",","",$_POST["cc"]);


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
		$Sql= "insert into vehicles ( regno, manufacturer, model, fk_vehicle_country_id, active, supplierid, package, class, havesimilar, cc, passenger, transmission, air, luggage, extras1, extras2, extras3, extras4, priceperday, pricing_scheme_id ) values ( '";
		$Sql.= $regno ."','";
		$Sql.= trim( $manufacturer )."','";
		$Sql.= trim( $model )."',";
        $Sql.= intval( $Country->Rec["country_id"]).",";
        $Sql.= intval( $_POST['active'] ).",'";  
		$Sql.= trim( $_POST['supplierid'] )."','";
		$Sql.= trim( $_POST['package'] )."','";
		$Sql.= trim( $_POST['class'] )."','";
		$Sql.= trim( $_POST['havesimilar'] )."','";
		$Sql.= trim( $_POST['cc'] )."',";
		$Sql.= trim( $passenger ).",'";
		$Sql.= trim( $_POST['transmission'] )."',";
		$Sql.= intval( $_POST['air'] ).",'";
		$Sql.= trim( $_POST['luggage'] )."','";
		$Sql.= trim( $_POST['extras1'] )."','";
		$Sql.= trim( $_POST['extras2'] )."','";
		$Sql.= trim( $_POST['extras3'] )."','";
		$Sql.= trim( $_POST['extras4'] )."',";
		$Sql.= intval( $_POST['priceperday'] ).",";
		$Sql.= $_POST['pricing_scheme_id' ].")";
		}
		Else
		{
		$Sql= "update vehicles set regno = '".$regno."', ";
		$Sql.="manufacturer = '".$manufacturer."', ";
		$Sql.="model = '".$model."', ";
        $Sql.="active = ".$_POST['active'].", ";   
		$Sql.="supplierid = ".trim( $_POST['supplierid'] ).", ";
		$Sql.="package = '".$_POST['package']."', ";
		$Sql.="class = '".$_POST['class']."', ";
		$Sql.="havesimilar = ".$_POST['havesimilar'].", ";
		$Sql.="cc = '".$_POST['cc']."', ";
		$Sql.="passenger = ".$passenger.", ";
		$Sql.="transmission = '".$_POST['transmission']."', ";
		$Sql.="air = ".$_POST['air'].", ";
		$Sql.="luggage = '".$_POST['luggage']."', ";
		$Sql.="extras1 = '".$extras1."', ";
		$Sql.="extras2 = '".$extras2."', ";
		$Sql.="extras3 = '".$extras3."', ";
		$Sql.="extras4 = '".$extras4."', ";
		$Sql.="priceperday = ".intval( $_POST['priceperday'] ).", ";
		$Sql.="pricing_scheme_id = ".$_POST['pricing_scheme_id' ];
		$Sql.= " where vehicleid = ".$_POST['ID'];


		}

		$InsertStatus = @mysql_query($Sql, $Connect );


		If ( ! $InsertStatus ) 
			Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;

		Else
		{
			header("Location: VehicleList.php?Class=".$Class);
		}

?>
