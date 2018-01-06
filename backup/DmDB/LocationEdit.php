<?php
include './Includes/Top.php';
include './Includes/mode.php';


$ID = $_REQUEST['Location'];

if ( is_numeric( $ID ) )
{



	// If we are in a postback, we check for the existence of the posted records in the DB
	if ( $_POST[ "update" ])
	{
		$Sql = "delete from location_vehicles WHERE locationid = ".$ID;
		mysql_query( $Sql ) ;
		if ( mysql_errno() )
		{
			$ErrorMessage = "Failed: ".mysql_errno().": ".mysql_error();
		}
		else
		{
			for ($i=0; $_POST['cb'][$i]!= null; $i++)
			{
				$value = $_POST['cb'][$i];
				$Sql = "insert into location_vehicles ( locationid, vehicleid ) VALUES ";
				$Sql .= " ( ".$ID.", ".$value." ) ";
				mysql_query( $Sql ) ;
				if ( mysql_errno() )
					$ErrorMessage = "Failed: ".mysql_errno().": ".mysql_error();
			}
		}
        
        // Now update the Location information
           $Sql = "UPDATE locations SET location_code = '".mysql_real_escape_string( $_POST["location_code"])."', " .
               " location_name = '".mysql_real_escape_string( $_POST["location_name"])."', " .
               " fk_location_country_region_id = '".mysql_real_escape_string( $_POST["country_region_id"])."', " .  
               " fk_location_district_id = '".mysql_real_escape_string( $_POST["district_id"])."', " .  
                " location_order = '".mysql_real_escape_string( $_POST["location_order"])."' WHERE locationid = ". $ID;


            $ResultSet = mysql_query( $Sql ) 
                or die ( "There has been an unforeseen error in the locations edit section ".$Sql.mysql_error());
                
            header( "location: LocationList.php") ;
                

	}
    
        // Get the Location name
    $Sql = "select * from locations  WHERE ";
    $Sql .= "locationid = ".$ID;
    $ResultSet = mysql_query( $Sql ) 
    or die ( "Failed in Vehicles Query" .mysql_error());
    $LocationRow = mysql_fetch_array($ResultSet) ;
    $Location_Name = $LocationRow[ 'location_name']; 
    
    
	// Now select the vehicle list from the DB
	$Sql = "select v.*, lv.lvid, s.supplier_name from vehicles v JOIN supplier s on s.supplierid = v.supplierid LEFT OUTER JOIN location_vehicles lv ";
	$Sql .= "ON lv.vehicleid = v.vehicleid and locationid = ".$ID." WHERE v.active = 1 AND v.fk_vehicle_country_id = ".$Country->Rec["country_id"]." ORDER BY class";
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in Vehicles Query" .mysql_error());

}
else
{

 	$ErrorMessage="No Location Selected.";
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


?>

<h1>Vehicles per Locations</h1>
<?php
if ( $ErrorMessage )
print "<h2 style='color: red'>".$ErrorMessage."</h2>";
?>
<form method="POST" Name="login" action="LocationEdit.php"  enctype="multipart/form-data">
<p>Code <input type='text' name='location_code' value='<?php echo $LocationRow["location_code"]?>' >&nbsp;&nbsp;&nbsp;
Location <input type='text' name='location_name' value='<?php echo $LocationRow["location_name"]?>'>&nbsp;&nbsp;&nbsp;
Region 
<?php
    RegionSelect( "country_region_id", $LocationRow["fk_location_country_region_id"] );
?>
&nbsp;&nbsp;&nbsp;
District
<?php
    DistrictSelect( "district_id", $LocationRow["fk_location_district_id"] );
?>
&nbsp;&nbsp;&nbsp;
Display Order <input type='text' name='location_order' value='<?php echo $LocationRow["location_order"]?>'></p>   

<h3>Check the vehicles which are available at <?php echo $Location_Name?></h3>

<table width=100% align=center cellpadding=0 cellpadding=0 border=0>

<?php
$ThisClass="";
while ($row = mysql_fetch_array($ResultSet) ) {
	if ( $ThisClass != $row[ 'class'] )
	{
		$ThisClass = $row[ 'class'];
		print "<tr><td colspan=7 align=center><br/></td></tr>";
		print "<tr><td colspan=7 align=center>".GetClass( $ThisClass)."</td></tr>";
		print "<tr><td colspan=7 align=center><br/></td></tr>";
	}
	$vehicleid = $row[ "vehicleid" ];
	$regno = $row[ "regno" ];
	$price = number_format( $row[ "priceperday" ]);
	$manufacturer = $row[ "manufacturer" ];
	$model = $row[ "model" ];
	$passenger = $row[ "passenger" ];
	$cc = $row[ "cc" ];
	$luggage = $row[ "luggage" ];
	if ($row[ "transmission" ] == "A" )
		$transmission = "Automatic";
	else
		$transmission = "Manual";	
	if (   fmod( $i, 2 )  == 0 ) 
		$tdbgcolor = "#EBF0FE";
	else
		$tdbgcolor = "#FFEAEB";
	

// If this field is null, the value is from the OUTER part of a LEFT outer join and 
// does not represent a selected vehicle
	$lvid = $row[ "lvid" ];
	if ( $lvid )
	{
		$checked = "checked";
		$rowbg="#FFFFBB";
	}
	else
	{
		$checked = "";	
		$rowbg="#DDDDDD";
	}

//* What images are available to show? *//

	$mainthumb = $row[ "mainthumb" ];


$mainimage = $dbimagedir.$row[ "mainimage" ];



?>

            <tr class="SmallText">
              <td colspan=5 style='background-color: grey'></td>
                </tr>
            <tr class="SmallText" style='background-color: <?php echo $rowbg?>'>
              <td ><?php echo $manufacturer." ".$model;?></td>
              <td ><?php echo $row["supplier_name"]?></td>
                   <td ><?php echo $cc?>CC</td>
                  <td ><?php echo $passenger?> passengers</td>
                  <td ><?php echo $transmission?></td>
                  <td  ><?php echo $luggage?></td>
                </tr>

            <tr class="SmallText" style='background-color: <?php echo $rowbg?>'>
			<td align='center'>
			<input type='checkbox' value='<?php echo $vehicleid?>' name='cb[]' <?php echo $checked?> >
			</td>
                  <td colspan="5" ><font color="#0E2F80"><?php echo $row[ "extras1"]." ".$row[ "extras2"]." ".$row[ "extras3"]." ".$row[ "extras4"]?>
                </td>
            </tr>


              
<?php
//* The end of the vehicle loop *//

}

print "</table>";
?>
<center>

<input type=submit value=Save name=submit>
</center>


<input type=hidden value='<?php echo $ID?>' name='Location'>
<input type=hidden value='1' name='update'>
</form>



<?php
include './Includes/BodyFoot.php';
?>
