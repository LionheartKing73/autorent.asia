<?php
// For each vehicle, get the pricing scheme from the vehicle record
// then work out the how many nights in different date ranges there are.
// Then get the prices for the appropriate number of nights by checking for 
// the number of nights less than the data number of nights
// Then multiply up and that gives the total

class BookingCosts{

var $CalcString="";
var $BookingBalance=0;
var $CurrencyId=0;
var $CurrencyCode="THB";
var $CurrencyRate=1;


function __construct( $CurrencyId )
{
     $this->CurrencyId = $CurrencyId;
     if ( is_numeric ( $CurrencyId ))
     {
           $Sql = "select from_baht_rate, currency_code from currencies WHERE currencies_id = ".$this->CurrencyId." AND active=1 ";

           $ResultSet = mysql_query( $Sql ) 
            or die ( "There has been an unforeseen error in the currencies section ".$Sql.mysql_error()); 
            
           $row = mysql_fetch_array($ResultSet);
           if ( $this->CurrencyRate != 0 )   
           {        
                $this->CurrencyCode = $row["currency_code"] ;
                $this->CurrencyRate = $row["from_baht_rate"] ; 
               
           }

         
     }
     
}


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
	$sql = "select price,full_rate,insurance_rate,booking_balance from pricing p JOIN vehicles v on v.pricing_scheme_id = p.pricing_scheme_id ";
	$sql .= " WHERE vehicleid = ".$VehicleId." and daterange_code = '".$key."' ";
	$sql .= " and days <= ".$value." order by days desc ";

	$ResultSet = mysql_query( $sql ) ;
	$prow = mysql_fetch_array($ResultSet);
    
    // Apply Currency Rates
    $pprice = $prow["price"] / $this->CurrencyRate;
    $frate = $prow["full_rate"] / $this->CurrencyRate;
    $irate = $prow["insurance_rate"] / $this->CurrencyRate;
    $bbal = $prow["booking_balance"] / $this->CurrencyRate;

    $OnlinePrice = $OnlinePrice + ( $value * $pprice ) ;
	$BookingPrice = $BookingPrice + ( $value * $pprice ) ;          // Removed + ( $value * $prow["insurance_rate"] )
    $WalkinPrice = $WalkinPrice + ( $value * $frate );
    $Insurance = $Insurance + ( $value * $irate );
    
    
    $this->BookingBalance = $this->BookingBalance + ( $value * $bbal );  
	$this->CalcString .= "<tr><td align='right'>".$value." days at ".number_format($pprice  ,2)."</td><td>=</td><td align='right'>".number_format($value * ( $pprice  ),2).".</td></tr>";
    //$this->CalcString .= "<tr><td align='right'>".$value." days at ".number_format($prow["price"] + $prow["insurance_rate"],2)."</td><td>=</td><td align='right'>".number_format($value * ( $prow["price"] + $prow["insurance_rate"] ),2).".</td></tr>";

    }

if ( $this->CalcString )
$this->CalcString="<table>".$this->CalcString."</table>";


}
$this->OnlinePrice = $OnlinePrice;
$this->Insurance = $Insurance ;
$this->WalkinPrice = $WalkinPrice ;


return $BookingPrice;

}
}

?>