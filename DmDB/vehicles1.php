<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
//* PHP CODE to access the Vehicle DB *//
include 'dbheader1.php';

include './DmDB/Includes/booking_costs.php';
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Thai Rent A Car Hua Hin : Hua Hin Car Rental : Hua Hin Car Hire</title>
<meta name="description" content="Hua Hin car rental agents offering the largest rental fleet and professional service.">
<meta name="keywords" content="hua hin car rental hire">
<meta name="audience" content="all">
<meta name="expires" content="never">
<meta name="robots" content="index, follow">
<meta name="rating" content="general, information">
<meta name="aesop" content="information">
<link href="trc.css" rel="stylesheet" type="text/css">
<link href="css/vehicles.css" rel="stylesheet" type="text/css">

</head>
<script type="text/javascript">
<!--
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
<table width="800" border="0" align="center" cellPadding="0" cellSpacing="0" bgcolor="#FFFFFF">
<tr><td colspan="2"><img src="img/head.jpg" border="0" usemap="#Map" /></td>
</tr>
<tr>
    
  <td width="800" valign="top">

          <br>
 <!--  
<form method="post" action="<?php echo $_SERVER[ "PHP_SELF" ]?>">


<center>
<?php

$class = $_REQUEST['class'];
if ( $_REQUEST[ "sortby" ] == "C" )
{
	$c_checked="checked";
	$SortBy = "v.cc DESC";
}
elseif ( $_REQUEST[ "sortby" ] == "P" )
{
	$p_checked="checked";
	$SortBy = "v.passenger DESC";
}
elseif ( $_REQUEST[ "sortby" ] == "R" )
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
?>


<p><b>ORDER BY </b>Price <input type="radio" name="sortby" value="R" <?php echo $r_checked?>>&nbsp;Manufacturer <input type="radio" name="sortby" value="M" <?php echo $m_checked?>>&nbsp;&nbsp;
CC <input type="radio" name="sortby" value="C" <?php echo $c_checked?>>&nbsp;&nbsp;
Passengers <input type="radio" name="sortby" value="P" <?php echo $p_checked?>>&nbsp;&nbsp;
<input type='submit' name='Sorter' value='Re-order'>
</center>
          <br>
                <!-- STARTING THE PHP SECTION TO RETRIEVE THE Vehicle DATA FROM THE DATABASE -->
                <?php

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

?>

-->
<?php


if ( $class )
{
$Sql = "select * from vehicles v where class = '".$class."' ORDER BY ".$SortBy;

}
else
{
	if ( $_REQUEST[ "vehtype" ] <> "Please Select" )
	{
		$Sql = "select v.* from vehicles v, location_vehicles lv, locations l";
		$Sql .= " where lv.vehicleid = v.vehicleid and lv.locationid = l.locationid ";
		$Sql .= "and l.location_code = '".$_REQUEST[ "vehtype" ]."' ORDER BY ".$SortBy;
	}
	else
		$Sql = "select v.* from vehicles v ORDER BY ".$SortBy;
}

$ResultSet = mysql_query( $Sql ) ;

$i = 0;
$VehicleCostArray=array( "elephant"=>0 );

while ($row = mysql_fetch_array($ResultSet) ) {

	$ID = $row[ "vehicleid" ];
	$regno = $row[ "regno" ];
	$price = number_format( $row[ "priceperday" ]);
	$manufacturer = $row[ "manufacturer" ];
	$model = $row[ "model" ];
	$passenger = $row[ "passenger" ];
	$Bags = $row[ "Bags" ];
	$Included = $row[ "Included" ];
	if ($row[ "transmission" ] == "A" )
		$transmission = "Automatic";
	else
		$transmission = "Manual";	
	if (   fmod( $i, 2 )  == 0 ) 
		$tdbgcolor = "#EBF0FE";
	else
		$tdbgcolor = "#FFEAEB";
	
	$detaillink="?ID=".$ID."&class=".$class;

//* What images are available to show? *//

	$mainthumb = $row[ "mainthumb" ];


$mainimage = $dbimagedir.$row[ "mainimage" ];
$htmltext = "<div id='Vehicle".$ID."'>";
$htmltext .= "\n<form method='post' action='booking1.php'>";

$htmltext .= "\n<table width='780px' align='center' border='0' cellpadding='2' cellspacing='0' class='border_Gray2'>"
;


$htmltext .= "\n<tr>";
$htmltext .= "\n<td valign='top' width='146px' rowspan='7' align='center' bgcolor='#FFFFFF'>";
$htmltext .= "\n<img class='input' src='".$mainimage."' alt='".$manufacturer." ".$model."' width='120' height='90' border='0' />";


$htmltext .= "</td>";
$htmltext .= "\n<td width='634px' bgcolor='#F2F2F2' valign='top'>";
$htmltext .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$htmltext .= "\n<tr>";

$htmltext .= "\n<td width='312px' bgcolor='#F2F2F2'><strong>".$manufacturer." ".$model." (or similar)</strong>";

$bc = new BookingCosts();
$price = $bc->CalcPrice($startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID );

$htmltext .= "\n</td><td width='120px' style='color: rgb( 143,3,29 );' align=='left' ><strong>";
$htmltext .= 'Price THB '.number_format( $price, 0 );
$htmltext .=  "</strong></td>"; 
$htmltext .= "<td width='212px' align='right' >";  
$ix = $row[ "vehicleid" ];
$VehicleCostArray[ $ix] = $price;

$htmltext .= '<input type="hidden" name="Submit" value="'.$ID.'" >';
//$htmltext .= '<input type="input" name="Submit" value="'.$ID.'" src="img/b_booking.gif" width="118" height="21" border="0">';
$htmltext .= '<input type="submit" name="Submit" value="Book Now" >';
"</td>";


$htmltext .= "\n</tr>";
$htmltext .=  "</table>";


$htmltext .=  "<table>";
$htmltext .= "\n<tr class='rowcar'>";

$htmltext .= "\n<td width='100px' bgcolor='#F2F2F2'><strong>Passenger:</strong></td>";
$htmltext .= "\n<td width='60px' align='center' class='vehfield'>".$passenger."</td>";

$htmltext .= "\n<td width='60px' align='right' bgcolor='#F2F2F2'><strong>Bags:</strong></td>";

   



$htmltext .= "\n<td width='60px' align='center' class='vehfield'>".$Bags."</td>";
$htmltext .= "\n<td width='70px' ></td>";  

$htmltext .= "\n<td width='97px' align='right' ><strong>Transmission:</strong></td>";
$htmltext .= "\n<td width='137px' class='vehfield' >".$transmission."</td>";




$htmltext .= "\n</tr>";
$htmltext .= "\n<tr class='rowcar'>";
$htmltext .= "\n<td bgcolor='#F2F2F2'><strong>Included:</strong></td>";
$htmltext .= "\n<td class='vehfield' colspan='4'>".$Included."</td>";
$htmltext .= "\n<td  align='right' bgcolor='#F2F2F2'><strong>Air:</strong></td>";
$htmltext .= "\n<td class='vehfield' colspan='1'>Yes</td>";

$htmltext .= "\n</tr>";
 $htmltext .= "\n</table>";  

$htmltext .= '<div id="ShowLink'.$ID.'" >';
$htmltext .= '<a href="#" onclick="ShowDiv( '.$ID.' );return false;">See more details</a>';
$htmltext .= "</div>";
$htmltext .= "<div id='InDiv".$ID."' style='display: none'>";

$htmltext .=  "<table>";    
$htmltext .= "<tr>";
$htmltext .= '<td height="30" colspan="4" bgcolor="#F2F2F2"><font color="#0E2F80">';
$htmltext .='<ul><li>'.$row[ "extras1"].'<li>'.$row[ "extras2"].'<li>'.$row[ "extras3"].'<li>'.$row[ "extras4"].'</ul>';
$htmltext .='</td>';
$htmltext .= "</tr>";
$htmltext .= "<tr>";
$htmltext .= '<td colspan="4" align="center" valign="top" bgcolor="#F2F2F2">';




$htmltext .= '<input type="hidden" name="chosenid" value="'.$ID.'" >';
$htmltext .= '<input type="hidden" name="posting" value="YES" >';
$htmltext .= '<input type="hidden" name="vehtype" value="'.$_REQUEST[ "vehtype" ].'">';


$htmltext .= '<input type="hidden" name="startdayveh" value="'.$_REQUEST[ "startdayveh" ].'">';
$htmltext .= '<input type="hidden" name="startmonthveh" value="'.$_REQUEST[ "startmonthveh" ].'">';
$htmltext .= '<input type="hidden" name="startyearveh" value="'.$_REQUEST[ "startyearveh" ].'">';
$htmltext .= '<input type="hidden" name="starttimehrs" value="'.$_REQUEST[ "starttimehrs" ].'">';
$htmltext .= '<input type="hidden" name="starttimemins" value="'.$_REQUEST[ "starttimemins" ].'">';

$htmltext .= '<input type="hidden" name="finday" value="'.$_REQUEST[ "finday" ].'">';
$htmltext .= '<input type="hidden" name="finmonth" value="'.$_REQUEST[ "finmonth" ].'">';
$htmltext .= '<input type="hidden" name="finyear" value="'.$_REQUEST[ "finyear" ].'">';
$htmltext .= '<input type="hidden" name="fintimehrs" value="'.$_REQUEST[ "fintimehrs" ].'">';
$htmltext .= '<input type="hidden" name="fintimemins" value="'.$_REQUEST[ "fintimemins" ].'">';


$htmltext .= "</td>";
                $htmltext .= "</tr>";
              $htmltext .= "</table>";
              
              $htmltext .= '<a href="#" onclick="HideDiv( '.$ID.' );return false;">See less details</a>';
              $htmltext .= "</div>";
              
              
           $htmltext .= "  </td>";
           $htmltext .= " </tr>";

          $htmltext .= "</table>";
          $htmltext .= "<br>";
          $htmltext .= "<br>";
$htmltext .= "</form>";

$htmltext .= "</div>";

  $VehicleHTMLArray[$row[ "vehicleid" ]] = $htmltext;           

//* The end of the vehicle loop *//
$i = $i + 1;
}



		asort( $VehicleCostArray );


foreach ( $VehicleCostArray as $kid=>$costs )
{

	print  $VehicleHTMLArray[$kid];

}

/*
if ( $DoCSSsort )
{
	sort( $VehicleCostArray );
print "<style  TYPE='text/css'> ";	
	foreach( $VehicleCostArray as $vid => $vcost )
	{
		print "\ndiv#Vehicle".$vid;
		print "{";
		print "position: relative;";
		print "top: 30px;";
		print "}\n";

	}

}
print "</style>";
*/
if ( $i == 0 )
{
	print "<p class='normaltxt'>Sorry, we have no ".$vehicleclass." vehicles available for ".$saleorrent." at this time.</p>";
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
<tr>
  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="20%" bgcolor="#EFEFEF" class="smltxtbw"><div align="center"><a href="http://www.ownersabroadthailand.com/golf.htm" target="_blank">GOLF CONDOS<br />
        GOLF VILLAS<br />
        FOR RENT &amp; SALE</a></div></td>
      <td width="20%" bgcolor="#CEDDF2" class="smltxtbw"><div align="center"><a href="http://www.ownersabroadthailand.com/hotels.htm" target="_blank">BOOK HOTELS THROUGHOUT<br />

        THAILAND HERE</a></div></td>
      <td width="20%" bgcolor="#FFFFCC" class="smltxtbw"><div align="center"><a href="http://www.ownersabroadthailand.com/villa-rentals.htm" target="_blank">BEACH CONDOS<br />
        POOL VILLAS<br />
        FOR SALE &amp; RENT</a></div></td>
      <td width="20%" bgcolor="#CEDDF2" class="smltxtbw"><div align="center"><a href="http://www.ownersabroadthailand.com/tours.htm" target="_blank">GUIDED TOURS TROUGHOUT<br />

        THAILAND</a></div></td>
      <td width="20%" bgcolor="#EFEFEF" class="smltxtbw"><div align="center"><a href="http://www.ownersabroadthailand.com/golf.htm" target="_blank">GOLF BREAKS<br />
&amp; HOLIDAYS<br />
        THE BEST PRICES</a></div></td>
    </tr>
  </table>
    </td>

</tr>
<tr>
  <td height="25" colspan="2" bgcolor="#000000"><div align="center" class="smltxtw">site operated by : <a href="http://www.ownersabroadthailand.co.uk" target="_blank">Indo China Holidays and Tours</a></div></td>
</tr>
</table>

<map name="Map" id="Map">
  <area shape="rect" coords="175,105,304,123" href="index.php" />
<area shape="rect" coords="310,105,429,123" href="fleet.php" />
<area shape="rect" coords="436,105,598,123" href="promotions.php" />
<area shape="rect" coords="604,105,794,123" href="guides.php" />
</map></body>
</html>
