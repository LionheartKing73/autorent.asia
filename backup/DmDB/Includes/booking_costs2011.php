<?php
// For each vehicle, get the pricing scheme from the vehicle record
// then work out the how many nights in different date ranges there are.
// Then get the prices for the appropriate number of nights by checking for 
// the number of nights less than the data number of nights
// Then multiply up and that gives the total

class BookingCosts{

var $CalcString="";
var $BookingBalance=0;


function CalcPrice( $d1,$m1,$y1, $h1,$n1,$d2,$m2,$y2, $h2,$n2, $VehicleId )
{
$BookingPrice = 0;

if ( ! is_numeric( $VehicleId ) )
	exit;

$SD = $y1."-".$m1."-".$d1." ".$h1.":".$n1;
$ED = $y2."-".$m2."-".$d2." ".$h2.":".$n2;


$time1 = mktime( $h1, $n1, 0, $m1, $d1, $y1 );
$time2 = mktime( $h2, $n2, 0, $m2, $d2, $y2 );


$BookingDays = floor( ( $time2 - $time1 ) / ( 60 * 60 * 24 ) ) ;


// We have the start date and the end date
// we need to work out how many days are there in which date range

$rundate = $time1;
print "<!--TESTER";
while ( $rundate < $time2 )
{

	$rd =  date( "Y-m-d", $rundate );
	$sql = "select rangecode from dateranges d JOIN supplier s ON d.calendar_id = s.calendar_id ";
    $sql .= " JOIN vehicles v ON v.supplierid = s.supplierid ";
    $sql .= "where v.vehicleid = $VehicleId and d.startdate <= '".$rd."' ";
	$sql .= " and d.enddate >= '".$rd."' ";

	$ResultSet = mysql_query( $sql ) ;

	$prow = mysql_fetch_array($ResultSet);
     var_dump( $prow );
	$arr[ $prow["rangecode" ] ] = $arr[ $prow["rangecode" ] ] + 1;

	$rundate = $rundate + ( 60 * 60 * 24 );
}
print "-->";


 /*
   NOTE: The Date Ranges are linked to the Prices on the code. A unique indez 
 */


// Now loop through the date ranges
if ( is_array( $arr ) )
{
	foreach ($arr as $key => $value)
	{
	$sql = "select price,booking_balance from pricing p JOIN vehicles v on v.pricing_scheme_id = p.pricing_scheme_id ";
	$sql .= " WHERE vehicleid = ".$VehicleId." and daterange_code = '".$key."' ";
	$sql .= " and days <= ".$value." order by days desc ";

	$ResultSet = mysql_query( $sql ) ;
	$prow = mysql_fetch_array($ResultSet);

	$BookingPrice = $BookingPrice + ( $value * $prow["price"] );
    $this->BookingBalance = $this->BookingBalance + ( $value * $prow["booking_balance"] );  
	$this->CalcString .= "<tr><td align='right'>".$value." days at ".number_format($prow["price"],2)."</td><td>=</td><td align='right'>".number_format($value * $prow["price"],2).".</td></tr>";
}

if ( $this->CalcString )
$this->CalcString="<table>".$this->CalcString."</table>";


}

return $BookingPrice;

}
}

?>