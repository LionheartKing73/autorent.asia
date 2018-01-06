<?php
include 'DmDB/Includes/SqlConn.php';
include 'DmDB/Includes/GetCountry.php'; 
if (@ini_get('register_globals'))
   foreach ($_REQUEST as $key => $value)
       unset($GLOBALS[$key]);

//** Assume that all of the calls will be from php files in the root directory *//
//** Then the path to the Image Files directory can be set as follows          *//

$dbimagedir = "DmDB/Images/";

//* Handle the input parameters - default to Houses for Sale *//

$class = $_GET['class'];

if ( strlen ( $type ) == 0  ) 
	$type = "H";

// Retrieve the Form variables

// Get the default times in Thailand for the initial page display

$ThaiTime = time() + ( 14 * 60 * 60 );


//$tomorrow = mktime(0, 0,date("H", $ThaiTime), date("m", $ThaiTime), date("d", $ThaiTime), date("y", $ThaiTime));
$tomorrow = $ThaiTime + ( 25 * 60 * 60 );
$tomyear = date( 'Y', $tomorrow );
$tommonth = date( 'm', $tomorrow);
$tomday =  date( 'd', $tomorrow);  
$tomhr = date( 'H', $tomorrow); ;
$tommin = 0;
$dayafter = $tomorrow  + ( 24 * 60 * 60 ); 
$tom2year = date( 'Y', $dayafter);   
$tom2year = date( 'Y', $dayafter);
$tom2month = date( 'm', $dayafter);
$tom2day =  date( 'd', $dayafter);  
$tom2hr = date( 'H', $dayafter); 
$tom2min = 0;
$day2after = $dayafter  + ( 24 * 60 * 60 ); 
$tom3year = date( 'Y', $day2after);   
$tom3year = date( 'Y', $day2after);
$tom3month = date( 'm', $day2after);
$tom3day =  date( 'd', $day2after);  
$tom3hr = date( 'H', $day2after); 
$tom3min = 0;


if ( $_REQUEST[ "vehclass" ] )
    $vehclass = $_REQUEST[ "vehclass" ];
else
    $vehclass = '';

if ( $_REQUEST[ "vehtype" ] )
    $vehtype = $_REQUEST[ "vehtype" ];
else
    $vehtype = 'suvarnabhumi';

if ( $_REQUEST[ "retloc" ] )
    $retloc = $_REQUEST[ "retloc" ];
else
    $retloc = 'suvarnabhumi';
    


if ( is_numeric( $_REQUEST[ "CurrencyId" ] ) )
{
    $CurrencyId = $_REQUEST[ "CurrencyId" ];
}

$vehdotype = $_REQUEST[ "vehdotype" ];
$insurance = $_REQUEST[ "insurance" ]; 

if ( $_REQUEST[ "fintimemins" ] ) 
    $fintimemins = $_REQUEST[ "fintimemins" ] ;
else
    $fintimemins = 0;
if ( $_REQUEST[ "fintimehrs" ] )
    $fintimehrs = $_REQUEST[ "fintimehrs" ] ;
else
    $fintimehrs = $tom3hr;
if ( $_REQUEST[ "finyear" ])
    $finyear = $_REQUEST[ "finyear" ];
else
    $finyear = $tom3year;
if ( $_REQUEST[ "finmonth" ] )
$finmonth = $_REQUEST[ "finmonth" ];
else
$finmonth = $tom3month;
if ( $_REQUEST[ "finday" ] )
$finday = $_REQUEST[ "finday" ] ;
else
$finday = $tom3day;

if ( $_REQUEST[ "starttimemins" ] ) 
$starttimemins = $_REQUEST[ "starttimemins" ];
else
    $starttimemins = 0;
if ( $_REQUEST[ "starttimehrs" ] )  
    $starttimehrs = $_REQUEST[ "starttimehrs" ];
else
    $starttimehrs = $tom2hr;
if ( $_REQUEST[ "startyearveh" ] )  
    $startyearveh = $_REQUEST[ "startyearveh" ];
else
    $startyearveh = $tom2year;
if ( $_REQUEST[ "startmonthveh" ] )  
    $startmonthveh = $_REQUEST[ "startmonthveh" ];
else
      $startmonthveh = $tom2month;
if ( $_REQUEST[ "startdayveh" ])
    $startdayveh = $_REQUEST[ "startdayveh" ];
else
     $startdayveh = $tom2day;

$fqs = "&starttimemins=".$_REQUEST[ "starttimemins" ];
$fqs .= "&starttimehrs=".$_REQUEST[ "starttimehrs" ];
$fqs .= "&startyearveh=".$_REQUEST[ "startyearveh" ];
$fqs .= "&startmonthveh=".$_REQUEST[ "startmonthveh" ];
$fqs .= "&startdayveh=".$_REQUEST[ "startdayveh" ];
$fqs .= "&fintimemins=".$_REQUEST[ "fintimemins" ] ;
$fqs .= "&fintimehrs=".$_REQUEST[ "fintimehrs" ] ;
$fqs .= "&finyear=".$_REQUEST[ "finyear" ];
$fqs .= "&finmonth=".$_REQUEST[ "finmonth" ];
$fqs .= "&finday=".$_REQUEST[ "finday" ] ;
$fqs .= "&CurrencyId=".$CurrencyId;
$nPickupDate = mktime( $starttimehrs, 0, 0,$startmonthveh,$startdayveh, $startyearveh );



//* Handle the input parameters - convert to text *//
switch ($class) {
case "S":
   $vehicleclass = "Small";
   break;
case "L":
   $vehicleclass = "Large";
   break;
case "M":
   $vehicleclass = "Medium";
   break;
case "X":
   $vehicleclass = "SUV";
   break;
case "V":
   $vehicleclass = "MPV";
   break;
   //* NEW *//
//* End NEW *//
default:
   $vehicleclass = "";
   break;
}




$qs="&class=".$class;

Function output_image( $Record, $imagedir, $imagename, $ID, $width, $height, $qs ){

	if ( strlen( $height ) < 1 )
		$heightstring = "";
	else
		$heightstring = "height=".$height;

	print "<a href='viewimage.php?ID=".$ID.$qs."&image=".$imagename."'>";
	print "<img src='".$imagedir.$Record[ $imagename ]."' border=0 width=".$width." ".$heightstring.">";
	print "</a>";

}

Function property_header( $property,$forsale, $forrent, $saleprice, $rentalprice,  $houseref, $location )
{
	if ( $forrent == "Y" )
	{
		if ( $forsale == "Y" )
		{
			$saleorrent = "Sale or Rent";
			$pricetext = " Sale price ".$saleprice." or for rent at ".$rentalprice." per month";
                }
                else{
			$saleorrent = "Rent";
			$pricetext = $rentalprice." per month";
		}
	}
	else		
		{
			$saleorrent = "Sale";
			$pricetext = $saleprice;
		}

?>

<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><span class="normaltxt"><strong>
<?php
print "".$property." for ".$saleorrent." in ".$location." ref no ".$houseref;
?>
</strong></span>


</td>
              </tr>
            </table> 

<!-- PRICE -->           
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<span class="normaltxtb"><strong><?print $pricetext;?></strong></span>
</td>
</tr>
</table>




<?php
}

Function InsuranceSelect( $vehtype )
{
 print "<select name='insurance' size='1' id='insurance' maxlength='100'>";
 print "<OPTION value=''>Please Select</OPTION>";

$List="Silver,Gold,Platinum";

$arr = split( ",", $List );
    foreach ($arr as $key=>$value)
    {
        $lcloc = substr( $value,0,1 );


        if ( $vehtype == $lcloc )
            print "\n<OPTION selected value='".$lcloc."'>".$value."</OPTION>";
        else
            print "\n<OPTION value='".$lcloc."'>".$value."</OPTION>";
    }
    

print "</SELECT>";



}

Function VehClassSelect( $vehclass )
{
    
    $arr["X"] = "SUV";
    $arr["L"] = "Large";
    $arr["M"] = "Medium";
    $arr["S"] = "Small";
    $arr["P"] = "Prestige";
    $arr["U"] = "Pickups";
    $arr["B"] = "Minibuses";
    $arr["V"] = "MPV" ; 

 print "<select name='vehclass' size='1' id='vehclass' maxlength='100'>";
 print "<OPTION value=''>All Types</OPTION>";


foreach ( $arr as $key=>$value )
{
    
        if ( $vehclass == $key  )
        print "\n<OPTION selected value='".$key."'>".$value."</OPTION>";
    else
        print "\n<OPTION value='".$key."'>".$value."</OPTION>";
    
}

  

print "</SELECT>";



}

Function VehTypeSelect( $name, $vehtype )
{
 print "<select name='".$name."' size='1' id='".$name."' maxlength='100'>";
 print "<OPTION>Please Select</OPTION>";

		$Sql = "select location_code, location_name from  locations WHERE fk_location_country_id =  ".$Country->Rec["country_id"]." order by location_order";
$ResultSet = mysql_query( $Sql ) ;

while ($row = mysql_fetch_array($ResultSet) ) {

	if ( $vehtype == $row["location_code"] )
		print "\n<OPTION selected value='".$row["location_code"]."'>".$row["location_name"]."</OPTION>";
	else
		print "\n<OPTION value='".$row["location_code"]."'>".$row["location_name"]."</OPTION>";
}
	

print "</SELECT>";



}
Function CurTypeSelect( $name, $vehtype )
{
     global $Country;  
 print "<select name='".$name."' size='1' id='".$name."' maxlength='100'>";
 print "<OPTION value='0'>THB</OPTION>";

        $Sql = "select currencies_id, currency_code from currencies WHERE active = 1 order by currency_code";
$ResultSet = mysql_query( $Sql );


while ($row = mysql_fetch_array($ResultSet) ) {

    if ( $vehtype == $row["currencies_id"] )
        print "\n<OPTION selected value='".$row["currencies_id"]."'>".$row["currency_code"]."</OPTION>";
    else
        print "\n<OPTION value='".$row["currencies_id"]."'>".$row["currency_code"]."</OPTION>";
}
    

print "</SELECT>";



}
Function VehTypeGet( $name, $vehtype )
{

    global $Country;  
$Sql = "select location_name from  locations where location_code = '".$vehtype."' AND fk_location_country_id =  ".$Country->Rec["country_id"];
$ResultSet = mysql_query( $Sql ) ;

$row = mysql_fetch_array($ResultSet);

return $row["location_name"];

}
Function DaySelect( $name, $currday )
{
print "<SELECT NAME='".$name."' id='".$name."'>";
print "<OPTION VALUE='0'>DAY</OPTION>";

for ( $counter = 1; $counter <= 31; $counter += 1) {
if ( $currday == $counter )
	print "<OPTION selected VALUE='".$counter."'>".$counter."</OPTION>";
else
	print "<OPTION VALUE='".$counter."'>".$counter."</OPTION>";
}


print "</select>";
}


Function MonthSelect( $name, $currmonth )
{

$MonthList="MONTH,January,February,March,April,May,June,Jul,August,September,October,November,December";
$marr = split( ",", $MonthList );
print "<SELECT NAME='".$name."' id='".$name."'>";
    foreach ($marr as $key=>$value)
    {
	if ( trim($currmonth) == $key  )
		print "\n<OPTION selected value='".$key ."'>".$value."</OPTION>";
	else
		print "\n<OPTION value='".$key ."'>".$value."</OPTION>";
	}

print "</select>";
}
Function YearSelect( $name, $curryear )
{
$year = date("Y");
print "<SELECT NAME='".$name."' id='".$name."'>";
print "<option VALUE='0'>YEAR</option>";


for ( $counter = $year; $counter <= $year + 3; $counter += 1) {
	if ( $curryear == $counter  )
		print "\n<OPTION selected value='".$counter ."'>".$counter."</OPTION>";
	else
		print "\n<OPTION value='".$counter ."'>".$counter."</OPTION>";
}

print "</select>";

}
Function TimeSelect( $hourname, $minutename, $hour, $minute )
{

print "<SELECT NAME='".$hourname."' id='".$hourname."'>";
print "<OPTION  VALUE='0'>HRS</OPTION>";

for ( $counter = 1; $counter <= 24; $counter += 1) {
if ( $hour == $counter )
	print "<OPTION selected VALUE='".$counter."'>".$counter."</OPTION>";
else
	print "<OPTION VALUE='".$counter."'>".$counter."</OPTION>";


}

print "</select>";
print "<SELECT NAME='".$minutename."' id='".$minutename."'>";
print "<OPTION  VALUE='0'>MINS</OPTION>";


if ( $minute == 0 )
{
	print "<OPTION selected VALUE='00'>00</OPTION>";
	print "<OPTION VALUE='30'>30</OPTION>";
}
else
{
	print "<OPTION VALUE='00'>00</OPTION>";
	print "<OPTION selected VALUE='30'>30</OPTION>";

}


print "</select>";


}
?>