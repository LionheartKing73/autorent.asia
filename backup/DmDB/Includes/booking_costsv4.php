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
var $CurrencyCode="";
var $CurrencyRate=1;
var $NumDays=0;

var $OptWaiver=false;
var $OptAccident=false;
var $OptGpsTh=false;
var $OptGpsEn=false;
var $OptChildSeat=false;
var $OptChildSeat2=false;
var $ChildSeats=0; ///No. of Child Seats

var $Insurance = 0;
var $OptAccidentCost=0;
var $OptGpsThCost=0;
var $OptGpsEnCost=0;
var $OptChildSeatCost=0;

var $OWCprice=0;
var $time1=0;
var $time2=0;
var $BookingDays=0;


function BookingCosts( $CurrencyCode, $CurrencyRate,$d1,$m1,$y1, $h1,$n1,$d2,$m2,$y2, $h2,$n2 )
{
     
      
        $this->CurrencyCode = $CurrencyCode ;
        $this->CurrencyRate = $CurrencyRate ; 
        
        $SD = $y1."-".$m1."-".$d1." ".$h1.":".$n1;
		$ED = $y2."-".$m2."-".$d2." ".$h2.":".$n2;
		date_default_timezone_set('Asia/Bangkok');

		$this->time1 = mktime( $h1, $n1, 0, $m1, $d1, $y1 );
		$this->time2 = mktime( $h2, $n2, 0, $m2, $d2, $y2 );

		
		$this->BookingDays = floor( ( $this->time2 - $this->time1 ) / ( 60 * 60 * 24 ) ) ;

  
}
function CalcPrice( $d1,$m1,$y1, $h1,$n1,$d2,$m2,$y2, $h2,$n2, $VehicleId )
{
    $price = $this->CalcRegionalPrice( 0,0, $pickup, $dropoff, $d1,$m1,$y1, $h1,$n1,$d2,$m2,$y2, $h2,$n2, $VehicleId );
    
    return $price;
}

function CalcRegionalPrice( $location,$disf, $dist, $VehicleId, $supplierid )
{

$this->NumDays = 0;
// if this is a One Way rental
// we will retrieve the one way costs per supplier into an array for thes disricts

// We chekc the number of days to see if a One Way Feee applies
// Over a certain number of days no fee applies


if ( $this->OWCarray[ $supplierid ]["max_days"]  >= $this->BookingDays )
	$this->OWCprice = $this->OWCarray[ $supplierid ]["cost"] / $this->CurrencyRate;
else
	$this->OWCprice = 0;
$BookingPrice = $this->OWCprice;
$OnlinePrice = $this->OWCprice;
$WalkinPrice = $this->OWCprice;







// We have the start date and the end date
// we need to work out how many days are there in which date range

$rundate = $this->time1;
print "<!--TESTER";

$FirstRecord=true;
$FirstDayMethodPricingRangeCode="";
//$//Owr_fee = 0;
//$Owr_max_days = 0;

/*
if ( $supplierid)
{
	var_dump( $supplierid );
	exit;
}
*/
while ( $rundate < $this->time2 )
{

	$rd =  date( "Y-m-d", $rundate );
	$sql = "select rangecode,first_day_method,one_way_rental_fee, owr_fee_max_days  ";
    $sql .= " from dateranges d JOIN supplier s ON d.calendar_id = s.calendar_id ";
    $sql .= " JOIN vehicles v ON v.supplierid = s.supplierid ";
    $sql .= " LEFT JOIN locations l ON l.locationid = $location ";   
    $sql .= " LEFT JOIN country_region cr ON cr.country_region_id = l.fk_location_country_region_id ";   
    $sql .= "where v.vehicleid = $VehicleId and d.startdate <= '".$rd."' ";
	$sql .= " and d.enddate >= '".$rd."' AND ( d.fk_daterange_country_region_id = 0 OR d.fk_daterange_country_region_id = cr.country_region_id ) ORDER BY d.startdate  ";

	$ResultSet = mysql_query( $sql ) ;
	

		

	$prow = mysql_fetch_array($ResultSet);

	$arr[ $prow["rangecode" ] ] = $arr[ $prow["rangecode" ] ] + 1;

	$rundate = $rundate + ( 60 * 60 * 24 );
    $this->NumDays = $this->NumDays + 1;
    
    // Some suppliers use the pricing from the first day of the booking
    $FirstDayMethod = $prow["first_day_method" ];
    if ( $FirstDayMethod  && $FirstRecord )
    {
        $FirstDayMethodPricingRangeCode = $prow["rangecode" ] ;
    }
    $FirstRecord=false;
    
    // One way rental fees may be applied depending on supplier & number of days
    //$Owr_fee =  $prow["one_way_rental_fee" ];
    //$Owr_max_days =  $prow["owr_fee_max_days" ];


}
var_dump( $arr );
print "ARRAYARRAY";
print "-->";


 /*
   NOTE: The Date Ranges are linked to the Prices on the code. A unique indez 
 */


// Now loop through the date ranges
if ( ! $FirstDayMethod )
{
    if ( is_array( $arr ) )
    {
	    foreach ($arr as $key => $value)
	    {
        
	        $sql = "select price,full_rate,insurance_rate,booking_balance,pai_rate,child_seat_rate,gps_en_rate,gps_th_rate from pricing p JOIN vehicles v on v.pricing_scheme_id = p.pricing_scheme_id ";
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
        //$Insurance = $Insurance + ( $value * $irate );
          
        $this->OptAccidentCost = $this->OptAccidentCost + (( $this->NumDays * $prow["pai_rate"] ) / $this->CurrencyRate); 
        $this->OptGpsEnCost = $this->OptGpsEnCost + (( $this->NumDays * $prow["gps_en_rate"] ) / $this->CurrencyRate); 
        $this->OptGpsThCost = $this->OptGpsThCost + (( $this->NumDays * $prow["gps_th_rate"] ) / $this->CurrencyRate); 
        $this->OptChildSeatCost = $this->OptChildSeatCost + (( $this->NumDays * $prow["child_seat_rate"] ) / $this->CurrencyRate); 
        
        $this->BookingBalance = $this->BookingBalance + ( $value * $bbal );  
	    $this->CalcString .= "<tr><td align='right'>".$value." days at ".number_format($pprice  ,2)."</td><td>=</td><td align='right'>".number_format($value * ( $pprice  ),2).".</td></tr>";
    //$this->CalcString .= "<tr><td align='right'>".$value." days at ".number_format($prow["price"] + $prow["insurance_rate"],2)."</td><td>=</td><td align='right'>".number_format($value * ( $prow["price"] + $prow["insurance_rate"] ),2).".</td></tr>";
    


        }



    }
}
else
{
    // Use the initial price for the whole booking
              $sql = "select price,full_rate,insurance_rate,booking_balance,pai_rate,child_seat_rate,gps_en_rate,gps_th_rate from pricing p JOIN vehicles v on v.pricing_scheme_id = p.pricing_scheme_id ";
            $sql .= " WHERE vehicleid = ".$VehicleId." and daterange_code = '".$FirstDayMethodPricingRangeCode."' ";
            $sql .= " and days <= ".$this->NumDays." order by days desc ";

            $ResultSet = mysql_query( $sql ) ;
            $prow = mysql_fetch_array($ResultSet);  
                    $pprice = $prow["price"] / $this->CurrencyRate;
        $frate = $prow["full_rate"] / $this->CurrencyRate;
        $irate = $prow["insurance_rate"] / $this->CurrencyRate;
        $bbal = $prow["booking_balance"] / $this->CurrencyRate;

        $OnlinePrice = $OnlinePrice + ( $this->NumDays * $pprice ) ;
        $BookingPrice = $BookingPrice + ($this->NumDays * $pprice ) ;          // Removed + ( $value * $prow["insurance_rate"] )
        $WalkinPrice = $WalkinPrice + ( $this->NumDays * $frate );
        $Insurance = $Insurance + ( $this->NumDays * $irate );
        
        $this->OptAccidentCost = $this->OptAccidentCost + (( $this->NumDays * $prow["pai_rate"] ) / $this->CurrencyRate); 
        $this->OptGpsEnCost = $this->OptGpsEnCost + (( $this->NumDays * $prow["gps_en_rate"] ) / $this->CurrencyRate); 
        $this->OptGpsThCost = $this->OptGpsThCost + (( $this->NumDays * $prow["gps_th_rate"] ) / $this->CurrencyRate); 

        $this->OptChildSeatCost = $this->OptChildSeatCost + (( $this->NumDays * $prow["child_seat_rate"] ) / $this->CurrencyRate); 

    
        $this->BookingBalance = $this->BookingBalance + ( $this->NumDays * $bbal );  
        $this->CalcString .= "<tr><td align='right'>".$this->NumDays." days at ".number_format($pprice  ,2)."</td><td>=</td><td align='right'>".number_format($this->NumDays * ( $pprice  ),2).".</td></tr>";
}

	
	
    if ( $this->CalcString )
        $this->CalcString="<table>".$this->CalcString."</table>";
        
$this->OnlinePrice = $OnlinePrice;
$this->Insurance = $Insurance ;
$this->WalkinPrice = $WalkinPrice ;


        // Possible One Way booking cost
        // Removed 25th November 2012
        /*
        if ( $this->OneWayBooking && $this->NumDays <= $Owr_max_days  )
        {
            $this->WalkinPrice = $this->WalkinPrice + ( $Owr_fee / $this->CurrencyRate ) ;
            $BookingPrice = $BookingPrice + ( $Owr_fee / $this->CurrencyRate )  ;
            $this->OnlinePrice = $this->OnlinePrice + ( $Owr_fee / $this->CurrencyRate )   ;
        }
        */
        // Optionals


        // Multiply Seat costs by number of seats
        if ( $this->OptChildSeat )
            $this->ChildSeats = 1;
        if ( $this->OptChildSeat2 )
            $this->ChildSeats = $this->ChildSeats + 1;

        
        $this->Extras = $this->OptChildSeatCost * $this->ChildSeats;
        if ( $this->OptWaiver )
        {
            // Add the Waiver to the Booking Price
            $this->Extras = $this->Extras + $Insurance;
        }
        if ( $this->OptAccident )
            $this->Extras = $this->Extras + $this->OptAccidentCost;
        if ( $this->OptGpsEn )
            $this->Extras = $this->Extras + $this->OptGpsEnCost;           
        if ( $this->OptGpsTh )
            $this->Extras = $this->Extras + $this->OptGpsThCost;   
            
$BookingPrice = $BookingPrice + $Extras;



return $BookingPrice;

}

	function LoadOWC( $df, $dt )
	{
		/*
		$sql = "select district_id from district WHERE district_text In ( '$df', '$dt' )";
		print $sql;
		$ResultSet = mysql_query( $sql ) ;
		$drec = mysql_fetch_array($ResultSet);
		$dref1 = $drec["district_id"];
		$drec = mysql_fetch_array($ResultSet);
		$dref2 = $drec["district_id"];	
		*/
		$array=explode( "-", $df );
		$dref1 = $array[1];
		$array=explode( "-", $dt );
		$dref2 = $array[1];	
			$sql = "select * FROM one_way_costs " ;
			$sql .= "JOIN supplier on supplierid = fk_owc_supplier_id ";
		    $sql .= "where (( fk_d1_district_id = $dref1 AND fk_d2_district_id = $dref2 ) ";
		    $sql .= "OR ( fk_d1_district_id = $dref2 AND fk_d2_district_id = $dref1 )) ";
		    $sql .= "AND allow_one_way_rentals = 1 ";
		    
		   
		    
		    $ResultSet = mysql_query( $sql ) ;
	
			while($owcrow = mysql_fetch_array($ResultSet))
			{
				
				$owcCost[$owcrow["fk_owc_supplier_id"]]["cost"] = $owcrow["one_way_cost"];
				$owcCost[$owcrow["fk_owc_supplier_id"]]["max_days"] = $owcrow["owr_fee_max_days"];
				
			}
	
		$this->OWCarray = $owcCost;


	}


}

?>