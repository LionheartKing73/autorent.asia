<?php
include './Includes/Top.php';

if (! $_REQUEST["deltype"] )
	exit;
else
	$type = $_REQUEST["deltype"];
if ( ! is_numeric ( $_REQUEST["ID"] ))
	exit;
else
	$ID = $_REQUEST["ID"];
	
$tables["ct"] = "closing_times";
$types["ct"] = "Closing Times";
$ids["ct"] = "closing_times_id";
$reds["ct"] = "CloseTimeList.php";	

$tables["ss"] = "stop_sell";
$types["ss"] = "Stop Sales";
$ids["ss"] = "stop_sell_id";
$reds["ss"] = "StopSaleList.php";

$tables["ve"] = "vehicles";
$types["ve"] = "Vehicles";
$ids["ve"] = "vehicleid";
$reds["ve"] = "VehicleList.php";

$tables["loc"] = "locations";
$types["loc"] = "Locations";
$ids["loc"] = "locationid";
$reds["loc"] = "LocationList.php";		
	
if ( $_REQUEST["conf"] == "yes" )
{
	$Sql = "delete from ".$tables[$type]." WHERE ".$ids[$type]." = $ID ";


$ResultSet = mysql_query( $Sql )
or die ( "There has been an unforeseen error  ".$Sql.mysql_error());
	
	
	header("Location: ".$reds[$type]."?err=".$err);
	
}
	


?>
<html>
<head>
<title>Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';

?>

</head>

<?php
include './Includes/BodyHead.php';


print "<h1>Confirm Delete</h1>";

print "<p>Do you want to delete ".$types[$type]." record ".$ID."?";

print "<p><a href='".$SERVER["PHP_SELF"]."?".$_SERVER['QUERY_STRING']."&conf=yes'>Yes</a>";

print "<p><a href='".$reds[$type]."'>No</a>";




include './Includes/BodyFoot.php';
?>
