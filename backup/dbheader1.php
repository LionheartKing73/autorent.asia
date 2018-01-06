<?php
include 'DmDB/Includes/SqlConn.php';
include 'DmDB/Includes/GetCountry.php'; 
include 'DmDB/VehicleClassDefinitions.php';
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
$day3after = $day2after  + ( 24 * 60 * 60 );  
$tom4year = date( 'Y', $day3after);   
$tom4year = date( 'Y', $day3after);
$tom4month = date( 'm', $day3after);
$tom4day =  date( 'd', $day3after);  
$tom4hr = date( 'H', $day3after); 
$tom4min = 0;


if ( $_REQUEST[ "class" ] )
    $vehclass = $_REQUEST[ "class" ];
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
    

// Initialise the Display Currencies
$CurrencyId = $Country->Rec["fk_country_currency_id"]; 
$CurrencyCode = $Country->Rec["currency_code"]; 
$CurrencyExchangeRate = 1;
if ( is_numeric( $_REQUEST[ "CurrencyId" ] ) )
{
    $CurrencyId = $_REQUEST[ "CurrencyId" ];
    
    if ( $CurrencyId != $Country->Rec["fk_country_currency_id"] )
    {
     // Now we need to calculate the conversion rate from the selected currency to default currency
     $sql = "SELECT b.from_usd_rate / a.from_usd_rate  exch_rate, a.currency_code  " .
            " FROM currencies_from_usd a, currencies_from_usd b " .
            "WHERE a.currencies_id = ".$CurrencyId." AND b.currencies_id = ".$Country->Rec["fk_country_currency_id"];
   
     $ResultSet = mysql_query( $sql ) or die( "Sorry an error has occured, please contact DCR");
     $row = mysql_fetch_array($ResultSet);
     $CurrencyCode = $row["currency_code"]; 
     $CurrencyExchangeRate = number_format( $row["exch_rate"],4,".","" );
     

    
    }
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
    $fintimehrs = $tom4hr;
if ( $_REQUEST[ "finyear" ])
    $finyear = $_REQUEST[ "finyear" ];
else
    $finyear = $tom4year;
if ( $_REQUEST[ "finmonth" ] )
$finmonth = $_REQUEST[ "finmonth" ];
else
$finmonth = $tom4month;
if ( $_REQUEST[ "finday" ] )
$finday = $_REQUEST[ "finday" ] ;
else
$finday = $tom4day;

if ( $_REQUEST[ "starttimemins" ] ) 
$starttimemins = $_REQUEST[ "starttimemins" ];
else
    $starttimemins = 0;
if ( $_REQUEST[ "starttimehrs" ] )  
    $starttimehrs = $_REQUEST[ "starttimehrs" ];
else
    $starttimehrs = $tom3hr;
if ( $_REQUEST[ "startyearveh" ] )  
    $startyearveh = $_REQUEST[ "startyearveh" ];
else
    $startyearveh = $tom3year;
if ( $_REQUEST[ "startmonthveh" ] )  
    $startmonthveh = $_REQUEST[ "startmonthveh" ];
else
      $startmonthveh = $tom3month;
if ( $_REQUEST[ "startdayveh" ])
    $startdayveh = $_REQUEST[ "startdayveh" ];
else
     $startdayveh = $tom3day;

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



Function Insuranceselect( $vehtype )
{
 print "<select name='insurance' size='1' id='insurance' >";
 print "<option value=''>Please select</option>";

$List="Silver,Gold,Platinum";

$arr = split( ",", $List );
    foreach ($arr as $key=>$value)
    {
        $lcloc = substr( $value,0,1 );


        if ( $vehtype == $lcloc )
            print "\n<option selected='selected' value='".$lcloc."'>".$value."</option>";
        else
            print "\n<option value='".$lcloc."'>".$value."</option>";
    }
    

print "</select>";



}

Function VehClassselect( $vehclass )
{



    
    $arr["X"] = "SUV";
    $arr["L"] = "Large";
    $arr["M"] = "Medium";
    $arr["S"] = "Small";
    $arr["P"] = "Prestige";
    $arr["U"] = "Pickups";
    $arr["B"] = "Minibuses";
    $arr["V"] = "MPV" ; 
	$arr["V"] = "MPV" ; 


 print "<select name='vehclass' size='1' id='vehclass' >";
 print "<option value=''>All Types</option>";


foreach ( $arr as $key=>$value )
{
    
        if ( $vehclass == $key  )
        print "\n<option selected='selected' value='".$key."'>".$value."</option>";
    else
        print "\n<option value='".$key."'>".$value."</option>";
    
}

  

print "</select>";



}

Function VehTypeselect( $name, $vehtype )
{
    global $Country;
    if ( ! $Country->Rec["country_id"] )
        $ctry = 1 ;
    else  
        $ctry = $Country->Rec["country_id"];  
 print "<select name='".$name."' size='1' id='".$name."' >";


		$Sql = "select location_code, location_name from  locations WHERE fk_location_country_id =  ".$ctry." order by location_order";
$ResultSet = mysql_query( $Sql ) ;

while ($row = mysql_fetch_array($ResultSet) ) {

	if ( $vehtype == $row["location_code"] )
		print "\n<option selected='selected' value='".$row["location_code"]."'>".$row["location_name"]."</option>";
	else
		print "\n<option value='".$row["location_code"]."'>".$row["location_name"]."</option>";
}
	

print "</select>";



}
Function CurTypeselect( $name, $vehtype )
{
 
 print "<select name='".$name."' size='1' id='".$name."'>";


        $Sql = "select currencies_id, currency_code from currencies_from_usd WHERE active = 1 order by currency_code";
$ResultSet = mysql_query( $Sql );


while ($row = mysql_fetch_array($ResultSet) ) {


    if ( $vehtype == $row["currencies_id"] )
        print "\n<option selected='selected' value='".$row["currencies_id"]."'>".$row["currency_code"]."</option>";
    else
        print "\n<option value='".$row["currencies_id"]."'>".$row["currency_code"]."</option>";
}
    

print "</select>";



}


Function VehTypeGet( $name, $vehtype )
{

    global $Country;  
if ( $Country->Rec["country_id"] )
	$ctry = $Country->Rec["country_id"];
else
	$ctry = 1;

$Sql = "select location_name from  locations where location_code = '".$vehtype."' AND fk_location_country_id =  ".$ctry;

$ResultSet = mysql_query( $Sql ) ;

$row = mysql_fetch_array($ResultSet);

return $row["location_name"];

}
Function Dayselect( $name, $currday )
{
print "<select name='".$name."' id='".$name."'>";
print "<option value='0'>DAY</option>";

for ( $counter = 1; $counter <= 31; $counter += 1) {
if ( $currday == $counter )
	print "<option selected='selected' value='".$counter."'>".$counter."</option>";
else
	print "<option value='".$counter."'>".$counter."</option>";
}


print "</select>";
}


Function Monthselect( $name, $currmonth )
{

$MonthList="MONTH,January,February,March,April,May,June,Jul,August,September,October,November,December";
$marr = split( ",", $MonthList );
print "<select name='".$name."' id='".$name."'>";
    foreach ($marr as $key=>$value)
    {
	if ( trim($currmonth) == $key  )
		print "\n<option selected='selected' value='".$key ."'>".$value."</option>";
	else
		print "\n<option value='".$key ."'>".$value."</option>";
	}

print "</select>";
}
Function Yearselect( $name, $curryear )
{
$year = date("Y");
print "<select name='".$name."' id='".$name."'>";
print "<option value='0'>YEAR</option>";


for ( $counter = $year; $counter <= $year + 3; $counter += 1) {
	if ( $curryear == $counter  )
		print "\n<option selected='selected' value='".$counter ."'>".$counter."</option>";
	else
		print "\n<option value='".$counter ."'>".$counter."</option>";
}

print "</select>";

}
Function Timeselect( $hourname, $minutename, $hour, $minute )
{

print "<select name='".$hourname."' id='".$hourname."'>";
print "<option  value='0'>HRS</option>";

for ( $counter = 1; $counter <= 24; $counter += 1) {
if ( $hour == $counter )
	print "<option selected='selected' value='".$counter."'>".$counter."</option>";
else
	print "<option value='".$counter."'>".$counter."</option>";


}

print "</select>";
print "<select name='".$minutename."' id='".$minutename."'>";
print "<option value='0'>MINS</option>";


if ( $minute == 0 )
{
	print "<option selected='selected' value='00'>00</option>";
	print "<option value='30'>30</option>";
}
else
{
	print "<option value='00'>00</option>";
	print "<option selected='selected' VALUE='30'>30</option>";

}


print "</select>";


}
?>