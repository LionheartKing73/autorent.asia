<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
//* PHP CODE to access the Vehicle DB *//
include 'includes/DCRheader.php';
include 'DmDB/Includes/booking_costsv3.php';
define ( 'ONE_WAY_RENTALS', 'One way rentals may incur a relocation fee. Same city returns do not usually attract a relocation fee, however in some rare cases this may apply. Most of the cars listed show the usual or average one way relocation fee as a separate item.');
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Diamond Car Rental, Thailand</title>
<meta name="description" content="Thailand car rental agents offering the largest rental fleet and professional service.">
<meta name="keywords" content="Thailand car rental hire">
<meta name="audience" content="all">
<meta name="expires" content="never">
<meta name="robots" content="index, follow">
<meta name="rating" content="general, information">
<meta name="aesop" content="information">
<link href="Style2013.css" rel="stylesheet" type="text/css" />
<link href="css/vehicles.css" rel="stylesheet" type="text/css">
<?php
  include 'Includes/metatags.php';
  include 'includes/head1967.php';  
ini_set( 'display_errors', 'Off' );
?>
<style type="text/css">
a.cartype
{
  background-color: rgb( 100,100,255);
  border-radius: 25px;
  border: solid 1px black;
  margin: 3px; 
  padding-top: 3px; 
  padding-bottom: 3px; 
  padding-left: 10px;
  padding-right: 10px;
  color: white;
  text-decoration: none;  
}
</style>
</head>
<script type="text/javascript">
<!--
 function ShowVehicles( inputDIV )
 {
     var cusid_ele = document.getElementsByClassName('Vehicle'); 
     var cusid_clk = document.getElementsByClassName('cartype');    
     if ( inputDIV == "All")
     {
        for (var i = 0; i < cusid_clk.length; ++i) {
            var item = cusid_clk[i];  
            item.style.backgroundColor="rgb(100,100,255)";
        }  
        for (var i = 0; i < cusid_ele.length; ++i) {
            var item = cusid_ele[i];  
            item.style.display="block";
        }
     }
     else
     {
            for (var i = 0; i < cusid_clk.length; ++i) {
            var item = cusid_clk[i];  
            item.style.backgroundColor="rgb(200,200,200)";
            }
            var item = document.getElementById(inputDIV ); 
            item.style.backgroundColor="rgb(100,100,255)";       
            
            for (var i = 0; i < cusid_ele.length; ++i) {
            var item = cusid_ele[i];  
            item.style.display="none";
            }   
    
        var cusid_ele22 = document.getElementsByClassName('Vehicle'+inputDIV);
        for (var i = 0; i < cusid_ele22.length; ++i) {
        var item = cusid_ele22[i];  
        item.style.display="block";  
        }
    }

 }
function ShowDiv( divId )
{
    div = document.getElementById( "InDiv" + divId );
    div.style.display = "block";
    
    div2 = document.getElementById( "ShowLink" + divId );
    div2.style.display = "none";
}
function HideDiv( divId )
{
    div = document.getElementById( "InDiv" + divId );
    div.style.display = "none";
    
    div2 = document.getElementById( "ShowLink" + divId );
    div2.style.display = "block";
}

-->
</script>

<body>
<?php
//ini_set( 'display_errors', 'On' );
require( 'includes/DCRBodyHeadv1.php') ;  
require( 'includes/DCRInnerBodyHeadv1.php') ;

    if (  ( $_REQUEST["vehtype"] != $_REQUEST["retloc"]  ) && $_REQUEST["understood"] != "YES" )
    {
        print "<div style='padding: 10px; padding-bottom: 30px'>";
        print "<p class='normaltxt' style='padding-top: 30px; padding-bottom: 30px' >".ONE_WAY_RENTALS."</p>";
        
        $OnboundQS = $_SERVER['QUERY_STRING'].$fqs;
        print "<p><a href='".$_SERVER["PHP_SELF"]."?understood=YES&".$OnboundQS."'><button name='Continue' value='Continue'>Continue</button></a>";
        
        //print "&nbsp;&nbsp;&nbsp;<a href='country.php?".$OnboundQS."'><button name='Back' value='Back'>Back</button></a>";
        print "&nbsp;&nbsp;&nbsp;<button onclick='window.history.go(-1)' name='Back' value='Back'>Back</button>";    
        
        print "</div>";
    }
    else
    {
        
        // REMAINDER OF THE PAGE
?>


      <div class="boxed">
<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-annotation="inline" data-width="300"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<?php

// Checking the booking days
$bc = new BookingCosts( $CurrencyCode, $CurrencyExchangeRate );
$price = $bc->CalcRegionalPrice($locationid, $startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,0 );

if ( $bc->NumDays > 28 )
{
    print "<p style='color: red'> The prices shown here are for 29 day rentals only. Contact us for really competitive rates for rentals in excess of 1 month. Click <a href='contact-us.php'>here</a> and don't forget to tell us when and where you want the car and your start and finish dates.";
}

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>    
  <td valign="top">

          <br>
 

<?php

$class = $_REQUEST['class'];
if ( $_REQUEST["sortby"] == "C" )
{
	$c_checked="checked";
	$SortBy = "v.cc DESC";
}
elseif ( $_REQUEST["sortby"] == "P" )
{
	$p_checked="checked";
	$SortBy = "v.passenger DESC";
}
elseif ( $_REQUEST["sortby"] == "R" )
{
	$r_checked="checked";
// We do not alter the SQL for the price option
// it is done by CSS after the HTML has been formed
	$SortBy = "v.manufacturer";
	$DoCSSsort=true;
}
else
{
	$m_checked="checked";
	$SortBy = "v.manufacturer";
}


print "\n<input type='hidden' name='vehtype' value ='".$vehtype."'>";
print "\n<input type='hidden' name='class' value ='".$class."'>";

print "\n<input type='hidden' name='fintimemins' value ='".$fintimemins."'>";
print "\n<input type='hidden' name='fintimehrs' value ='".$fintimehrs."'>";
print "\n<input type='hidden' name='finyear' value ='".$finyear."'>";
print "\n<input type='hidden' name='finmonth' value ='".$finmonth."'>";
print "\n<input type='hidden' name='finday' value ='".$finday."'>";

print "\n<input type='hidden' name='starttimemins' value ='".$starttimemins."'>";
print "\n<input type='hidden' name='starttimehrs' value ='".$starttimehrs."'>";
print "\n<input type='hidden' name='startyearveh' value ='".$startyearveh."'>";
print "\n<input type='hidden' name='startmonthveh' value ='".$startmonthveh."'>";
print "\n<input type='hidden' name='startdayveh' value ='".$startdayveh."'>";

print "\n</form>";



    // From the Left Hand Search box
    //if ( $insurance )
        //$extraCLSsql = " AND package = '".$insurance."' ";

    if ( $class )
        $extraCLSsql = " AND class = '".$class."' ";

	if ( $_REQUEST["vehtype"] <> "Please Select" )
	{
		$Sql = "select v.*, s.supplier_image, s.supplier_name, l1.locationid from vehicles v JOIN  supplier s ON v.supplierid = s.supplierid ";
        $Sql .= " JOIN location_vehicles lv1 ON lv1.vehicleid = v.vehicleid ";
        $Sql .= " JOIN locations l1 ON lv1.locationid = l1.locationid AND l1.location_code = '".$_REQUEST["vehtype"]."'";

        if ( $_REQUEST["vehtype"] != $_REQUEST["retloc"])
        {
             $Sql .= " JOIN location_vehicles lv2 ON lv2.vehicleid = v.vehicleid ";
             $Sql .= " JOIN locations l2 ON lv2.locationid = l2.locationid AND l2.location_code = '".$_REQUEST["retloc"]."'";
             // One-way rentals allowed?
             $extraCLSsql .= " AND s.allow_one_way_rentals = 1";
             
             // One way rentals less than 3 days are not allowed
             //if ( $bc->NumDays < 3 )
                //$extraCLSsql .= " AND 1=2 ";
        }
		$Sql .= " where active = 1 AND v.fk_vehicle_country_id = ".$Country->Rec["country_id"];
		$Sql .= " $extraCLSsql ORDER BY ".$SortBy;
	}
	else
		$Sql = "select v.*, s.supplier_image from vehicles v, supplier s WHERE v.supplierid = s.supplierid $extraCLSsql and 1=2 ORDER BY ".$SortBy;
		
		
		
$StartDate = $startyearveh."-".$startmonthveh."-".$startdayveh;	
$FinDate = $finyear."-".$finmonth."-".$finday;	

$StartTime = $starttimehrs.":".$starttimemins;	
$FinTime = $fintimehrs.":".$fintimemins;		
		print "\n<input type='hidden' name='fintimemins' value ='".$fintimemins."'>";
print "\n<input type='hidden' name='fintimehrs' value ='".$fintimehrs."'>";
print "\n<input type='hidden' name='finyear' value ='".$finyear."'>";
print "\n<input type='hidden' name='finmonth' value ='".$finmonth."'>";
print "\n<input type='hidden' name='finday' value ='".$finday."'>";

print "\n<input type='hidden' name='starttimemins' value ='".$starttimemins."'>";
print "\n<input type='hidden' name='starttimehrs' value ='".$starttimehrs."'>";
print "\n<input type='hidden' name='startyearveh' value ='".$startyearveh."'>";
print "\n<input type='hidden' name='startmonthveh' value ='".$startmonthveh."'>";
print "\n<input type='hidden' name='startdayveh' value ='".$startdayveh."'>";

//	debugging
//	if($_REQUEST["doug"]){
//		print $Sql;
//		exit;
//	}

$ResultSet = mysql_query( $Sql ) ;

$i = 0;
$VehicleCostArray=array( "elephant"=>0 );

while($row = mysql_fetch_array($ResultSet)){
	$ID = $row["vehicleid"];
	$regno = $row["regno"];
	$price = number_format( $row["priceperday"]);
	$manufacturer = $row["manufacturer"];
	$model = $row["model"];
	$passenger = $row["passenger"];
	$cc = $row["cc"];
	$supplierid = $row["supplierid"];
	$locationid = $row["locationid"]; 
	$luggage = $row["luggage"];
	$class = $row["class"];
    $air = $row[ "air" ];


    
    // Now Check for Stop Sell records in the location/supplier combo
    // for the dates
    
    
    $Sql = "select * from stop_sell where fk_ct_locations_id = $locationid and " .
           " fk_ct_supplier_id = $supplierid  " . 
           " and class = '$class'  " . 
           " and stop_from < '$FinDate' and stop_to > '$StartDate'";
           
           
           print '<!--';
           print $Sql;
           print "-->";
        
    $ResultSet1 = mysql_query( $Sql ) ;

    $num_rows = mysql_num_rows($ResultSet1);

	if ($num_rows > 0) {
	  continue;
	}
	
	// Now Check for Closing Times records in the location/supplier combo
    // for the dates
    
    $Sql = "select * from closing_times where fk_ct_locations_id = $locationid and " .
           " fk_ct_supplier_id = $supplierid  " . 
           " and (( closed_from <= '$StartTime' and closed_to > '$StartTime' ) OR " .
           "  ( closed_from <= '$FinTime' and closed_to > '$FinTime' ))";
           
           print '<!--';
           print $Sql;
           print "-->";
        
    $ResultSet1 = mysql_query( $Sql ) ;

    $num_rows = mysql_num_rows($ResultSet1);

	if ($num_rows > 0) {
	  continue;
	}    


	if($row["transmission"] == "A"){
		$transmission = "Automatic";
	}else{
		$transmission = "Manual";
	}
	if(fmod( $i, 2 )  == 0){
		$tdbgcolor = "#EBF0FE";
	}else{
		$tdbgcolor = "#FFEAEB";
	}
	$detaillink="?ID=".$ID."&class=".$class;

	//* What images are available to show? *//
	$mainthumb = $row["mainthumb"];
	$mainimage = $dbimagedir.$row["mainimage"];

	$bc = new BookingCosts($CurrencyCode, $CurrencyExchangeRate);
	if($_REQUEST["vehtype"] != $_REQUEST["retloc"]){
	    $bc->OneWayBooking = true;
	}
	$price = $bc->CalcRegionalPrice($locationid,$startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID );

	$ix = $row["vehicleid"];
	$VehicleCostArray[ $ix] = $price;
	$VehicleSupplierArray[ $ix] = $supplierid; 
	$VehicleClassArray[ $ix] = $class; 

	if ($CountryRec["country_subdomain"]){
		// wwww page receives a country indicatoru
		$countrySD = $CountryRec["country_subdomain"];    
	}elseif($Country->Rec["country_subdomain"]){
		// Country Pages
		$countrySD = $Country->Rec["country_subdomain"];
	}else{
		$countrySD = "thailand";   
	}

	$rc = $countrySD;
	$req_districtFr = $_REQUEST["distFr".$rc] ;
	$req_districtTo = $_REQUEST["distTo".$rc] ;
	$req_locationFr = $_REQUEST["locFr".$req_districtFr] ;
	$req_locationTo = $_REQUEST["locTo".$req_districtTo] ;

	//only show vehicle if price is not 0, to avoid promotions from showing outside of their timeframe.
	if($bc->OnlinePrice != 0){  
    
        if ( $class )
            $class_array[$class] = $class;  
        $htmltext = "\n<div id='Vehicle".$ID."' class='Vehicle Vehicle".$class."'>";  
		$htmltext .= "\n<form method='post' action='DCR-book-1.php'>";
		$htmltext .= "\n<table width='' align='center' border='0' cellpadding='2' cellspacing='0' class='border_Gray2'>";
		$htmltext .= "\n<tr>";
		$htmltext .= "\n<td valign='top' width='146px' rowspan='7' align='center' bgcolor='#FFFFFF'>";
		$htmltext .= "\n<img class='input' src='".$mainimage."' alt='".$manufacturer." ".$model."' width='120' height='90' border='0' />";
		if ( $row["supplier_image"] != "" )
            $htmltext .= "\n<br/><br/><img src='/images/Suppliers/".$row["supplier_image"]."'/> ";  
        $htmltext .= "</td>";
		$htmltext .= "\n<td width='' bgcolor='#F2F2F2' valign='top'>";
		$htmltext .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
		$htmltext .= "\n<tr>";
		$htmltext .= "\n<td width='212px' bgcolor='#F2F2F2'><strong>".$manufacturer." ".$model." (or similar)</strong>";
		$htmltext .= "\n</td><td width='150px' style='color: rgb( 143,3,29 );' align=='left' ><strong>";
		$htmltext .= 'Price '.$bc->CurrencyCode." ".number_format( $bc->OnlinePrice, 2 );
		$htmltext .= "</strong></td>";
//		$htmltext .= "\n<td align='right'>";
//		$htmltext .= "\n<img src='img/".$row["supplier_name"].".png' alt='".$row["supplier_name"]."' border='0' />";
//		$htmltext .= "\n</td>";
		$htmltext .= "\n<td width='122px' align='right' >";
		$htmltext .= '<input type="hidden" name="Submit" value="'.$ID.'" >';
		$htmltext .= '<input type="hidden" name="CurrencyId" value="'.$CurrencyId.'" >';
//		$htmltext .= '<input type="input" name="Submit" value="'.$ID.'" src="img/b_booking.gif" width="118" height="21" border="0">';
		$htmltext .= '<input type="submit" name="Submit" value="Book Now" >';
		$htmltext .= "</td>";
		$htmltext .= "\n</tr>";
		$htmltext .= "</table>";
		$htmltext .= "<table>";
		$htmltext .= "\n<tr class='rowcar'>";
		$htmltext .= "\n<td width='100px' bgcolor='#F2F2F2'><strong>Passenger:</strong></td>";
		$htmltext .= "\n<td width='60px' align='center' class='vehfield'>".$passenger."</td>";
		$htmltext .= "\n<td width='60px' align='right' bgcolor='#F2F2F2'><strong>Bags:</strong></td>";
		$htmltext .= "\n<td width='60px' align='center' class='vehfield'>".$cc."</td>";
		$htmltext .= "\n<td width='70px' ></td>";
		$htmltext .= "\n<td width='97px' align='right' ><strong>Air:</strong></td>";
		$htmltext .= "\n<td width='137px' class='vehfield' >";
        if ( $air )
            $htmltext .=  "Yes";
        else
            $htmltext .=   "No";      
        $htmltext .= "\n</td>";
		$htmltext .= "\n</tr>";
		$htmltext .= "\n<tr class='rowcar'>";
		$htmltext .= "\n<td bgcolor='#F2F2F2'></td>";
		$htmltext .= "\n<td class='vehfield' colspan='4'>".$luggage."</td>";
		$htmltext .= "\n<td  valign='top' align='center' valign='middle' colspan='4'>";
		$htmltext .= "<br/><br/>";
		$htmltext .= '<input  type="submit" name="Submit2" value="Fuel Policy" ><br/>';
		$htmltext .= '<input  type="submit" name="Submit3" value="Insurance" ><br/>';
		$htmltext .= '<input  type="submit" name="Submit4" value="Extras" >';
		$htmltext .= '</td>';
		$htmltext .= "\n</tr>";
		$htmltext .= "\n</table>";
//		$htmltext .= '<div id="ShowLink'.$ID.'" >';
//		$htmltext .= '<a href="#" onclick="ShowDiv( '.$ID.' );return false;">See more details</a>';
//		$htmltext .= "</div>";
		$htmltext .= "<div id='InDiv".$ID."' style='display: none'>";
		$htmltext .= "<table>";    
		$htmltext .= "<tr>";
		$htmltext .= '<td height="30" colspan="4" bgcolor="#F2F2F2"><font color="#0E2F80">';
		$htmltext .= '<ul><li>'.$row["extras1"].'<li>'.$row["extras2"].'<li>'.$row["extras3"].'<li>'.$row["extras4"].'</ul>';
		$htmltext .= '</td>';
		$htmltext .= "</tr>";
		$htmltext .= "<tr>";
		$htmltext .= '<td colspan="4" align="center" valign="top" bgcolor="#F2F2F2">';
		$htmltext .= '<input type="hidden" name="chosenid" value="'.$ID.'" >';
		$htmltext .= '<input type="hidden" name="posting" value="YES" >';
		$htmltext .= '<input type="hidden" name="vehtype" value="'.$_REQUEST["vehtype"].'">';
		$htmltext .= '<input type="hidden" name="retloc" value="'.$_REQUEST["retloc"].'">';
		$htmltext .= '<input type="hidden" name="distFr'.$rc.'" value="'.$req_districtFr.'">';
		$htmltext .= '<input type="hidden" name="distTo'.$rc.'" value="'.$req_districtTo.'">';
		$htmltext .= '<input type="hidden" name="locFr'.$req_districtFr.'" value="'.$req_locationFr.'">';
		$htmltext .= '<input type="hidden" name="locTo'.$req_districtTo.'" value="'.$req_locationTo.'">';
		$htmltext .= '<input type="hidden" name="startdayveh" value="'.$_REQUEST["startdayveh"].'">';
		$htmltext .= '<input type="hidden" name="startmonthveh" value="'.$_REQUEST["startmonthveh"].'">';
		$htmltext .= '<input type="hidden" name="startyearveh" value="'.$_REQUEST["startyearveh"].'">';
		$htmltext .= '<input type="hidden" name="starttimehrs" value="'.$_REQUEST["starttimehrs"].'">';
		$htmltext .= '<input type="hidden" name="starttimemins" value="'.$_REQUEST["starttimemins"].'">';
		$htmltext .= '<input type="hidden" name="finday" value="'.$_REQUEST["finday"].'">';
		$htmltext .= '<input type="hidden" name="finmonth" value="'.$_REQUEST["finmonth"].'">';
		$htmltext .= '<input type="hidden" name="finyear" value="'.$_REQUEST["finyear"].'">';
		$htmltext .= '<input type="hidden" name="fintimehrs" value="'.$_REQUEST["fintimehrs"].'">';
		$htmltext .= '<input type="hidden" name="fintimemins" value="'.$_REQUEST["fintimemins"].'">';
		$htmltext .= "</td>";
		$htmltext .= "</tr>";
		$htmltext .= "</table>";
		$htmltext .= '<a href="#" onclick="HideDiv( '.$ID.' );return false;">See less details</a>';
		$htmltext .= "</div>";
		$htmltext .= "</td>";
		$htmltext .= "</tr>";
		$htmltext .= "</table>";
		$htmltext .= "<br>";
		$htmltext .= "<br>";
		$htmltext .= "</form>";
		$htmltext .= "</div>";
		$VehicleHTMLArray[$row["vehicleid"]] = $htmltext;
	}
	//* The end of the vehicle loop *//
	$i = $i + 1;
}
asort( $VehicleCostArray );

if ( sizeof( $class_array) > 0 )
{
?>
<a class="cartype" href="javascript:onclick=ShowVehicles('All');" id="All">All</a>
<?php 
}

// Set the Vehicled type names from DmDB/VehicleClassDefinitions.php
foreach( $class_array as $ck=>$cv )
{
  $class_array[$ck] = $ClassArray[$ck]; 
}
// $class_array["ECON"] = "Economy"
/*
asort( $class_array ); 
  
foreach( $class_array as $ck=>$cv )
*/

foreach( $ClassSrtArray as $cn=>$ck )
{
	// Check that the key is in the vehicle list
	$match=false;
	foreach( $class_array as $vk=>$vv )
	{
  		if ( $vk == $ck )
		{
			$match= true;
		}
	}
	if ( $match )
	{
?>
<a class="cartype" href="javascript:onclick=ShowVehicles('<?php echo $ck;?>')" id="<?php echo $ck;?>">
<?php 
print $ClassArray[$ck]."</a>"; 
	}      
}
print "</br/>";
print "</br/>";  
foreach($VehicleCostArray as $kid=>$costs){
	// We only display one vehicle per supplier  per vehicle type
	/*
	$already_displayed=false;
	if($DisplaySupplierArray){
		foreach($DisplaySupplierArray as $array_class=>$InnerArray){
			if($array_class == $VehicleClassArray[ $kid ]){
				foreach($InnerArray as $supplier){
					if($VehicleSupplierArray[ $kid ] == $supplier){
						$already_displayed = true;
						break;
					}
				}
				break;
			}
		}
	}
	if($already_displayed){
		continue;
	}else{
		$DisplaySupplierArray[ $VehicleClassArray[ $kid ]][] = $VehicleSupplierArray[ $kid ];
	}
	*/
	print  $VehicleHTMLArray[$kid];
}
/*
if($DoCSSsort){
	sort( $VehicleCostArray );
	print "<style  TYPE='text/css'> ";	
	foreach($VehicleCostArray as $vid => $vcost){
		print "\ndiv#Vehicle".$vid;
		print "{";
		print "position: relative;";
		print "top: 30px;";
		print "}\n";
	}

}
print "</style>";
*/
if($i == 0){
	print "<p class='normaltxt'>We are sorry but we appear to have no vehicles to suit your request. This maybe because we have no vehicles of the type that you have chosen at that location. Please try selecting a different vehicle type or location. ";
	print "<p class='normaltxt'>If you are trying to book a one way rental it maybe that the car you have chosen is not available for a one way rental between your two selected locations. Please try selecting a different vehicle."; 
	print "<p class='normaltxt'>If you are still experiencing difficulties please return to the home page and contact us using the contact us button or by telephone.";
	print "<p class='normaltxt'>Please feel free to contact us for further advice.</p>";
}
?>
</td>
</tr>
<!--
<tr>
  <td width="230" bgcolor="#FFFFCC"><div align="center" class="hotline">HOTLINE<br />
  +66(0)85-1910182</div></td>
  <td valign="top">&nbsp;</td>
</tr>
-->
</table>
</div>
<?php
} // One Way Rental END IF<br /
require( 'includes/DCRInnerBodyFootv2.php') ;
require( 'includes/DCRBodyFootv1.php') ;   
?>

</body>
</html>
