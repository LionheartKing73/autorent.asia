<?php
  // This is posted from the booking page AND
// the currency_rate session variable is set (ie the session has not expired) AND
// the user has not simply requested a change of currency to view the prices (whilst retaining any form data without posting)

// Set $dopost to false if we need to reinput data



$SessCurrencyId = $_SESSION["currencies_id"];
$SessCurrencyRate = $_SESSION["currency_rate"];
$SessCurrencyCode = $_SESSION["currency_code"];


$dopost = true;



    // Name

    if ( ! $_REQUEST[ "hName" ] ) 

    {

        $dopost = false;

        $hNameError = "You must enter a Name";

    }






    // Address

     if ( ! $_REQUEST[ "hAddress" ] ) 

    {

        $dopost = false;

        $hAddressError = "You must enter an address";

    }
 
    // Email

    if ( ! $_REQUEST[ "hEmail" ] ) 

    {

        $dopost = false;

        $hEmailError = "You must enter a valid email address";

    }



    // Phone

    if ( ! $_REQUEST[ "hPhone" ] ) 

    {

        $dopost = false;

        $hPhoneError = "You must enter a phone number";

    }
     if ( ! $_REQUEST[ "hMobile" ] ) 

    {

        $dopost = false;

        $hMobileError = "You must enter a mobile phone number";

    }
    if ( ! is_numeric( $_REQUEST[ "hDriverAge" ] ) ) 
    {

        $dopost = false;

        $hDriverAgeError = "You must enter a valid age";

    }
    elseif ( $_REQUEST[ "hDriverAge" ] < 0 || $_REQUEST[ "hDriverAge" ] > 120 ) 
    {
              $dopost = false;

        $hDriverAgeError = "You must enter a valid age";  
    }
    
    // Optional Radios
    if ( $_REQUEST[ "hOptWaiver" ] )
    {
        $PostOptWaiver = 1;
        $OptWaiverSelected = "checked";
        $EmailOptWaiverText = "YES";
        $OptWaiverUnselected = "";  
    }
    else
    {
        $PostOptWaiver = 0;
        $OptWaiverSelected = "";
        $EmailOptWaiverText = "NO";  
        $OptWaiverUnselected = "checked";  
    }
    if ( $_REQUEST[ "hOptAccident" ] )
    {
        $PostOptAccident = 1;
        $OptAccidentSelected = "checked";
        $EmailOptAccidentText = "YES";
        $OptAccidentUnselected = "";  
    }
    else
    {
        $PostOptAccident = 0;
        $OptAccidentSelected = "";
        $EmailOptAccidentText = "NO";  
        $OptAccidentUnselected = "checked";  
    }    
    if ( $_REQUEST[ "hOptGpsTh" ] )
    {
        $PostOptGpsTh = 1;
        $OptGpsThSelected = "checked";
        $EmailOptGpsThText = "YES";
        $OptGpsThUnselected = "";  
    }
    else
    {
        $PostOptGpsTh = 0;
        $OptGpsThSelected = "";
        $EmailOptGpsThText = "NO";  
        $OptGpsThUnselected = "checked";  
    }
    if ( $_REQUEST[ "hOptGpsEn" ] )
    {
        $PostOptGpsEn = 1;
        $OptGpsEnSelected = "checked";
        $EmailOptGpsEnText = "YES";
        $OptGpsEnUnselected = "";  
    }
    else
    {
        $PostOptGpsEn = 0;
        $OptGpsEnSelected = "";
        $EmailOptGpsEnText = "NO";  
        $OptGpsEnUnselected = "checked";  
    }    



    if ( $dopost )
    {

    // Now we do the email and posting set up, then redirect



    $PickupDate = $startyearveh."-".$startmonthveh."-".$startdayveh;

    $DropoffDate = $finyear."-".$finmonth."-".$finday;

    $PickupTime= $_REQUEST["starttimehrs"].":".$_REQUEST["starttimemins"];

    $DropoffTime= $_REQUEST["fintimehrs"].":".$_REQUEST["fintimemins"];





    $PostName = substr( $_REQUEST["hName"], 0, 50 );


    $PostAddress = substr( $_REQUEST["hAddress"], 0, 50 );
    $PostAddress2 = substr( $_REQUEST["hAddress2"], 0, 50 ); 
    $PostDeliveryAddress = substr( $_REQUEST["hDeliveryAddress"], 0, 50 );
    $PostDeliveryAddress2 = substr( $_REQUEST["hDeliveryAddress2"], 0, 50 ); 
 
    $PostDriverAge = $_REQUEST["hDriverAge"]; 
    
    $PostAdditionalDrivers = 0;
    if ( is_numeric ( $_REQUEST["hAdditionalDrivers"]) )
    {
         if ($_REQUEST["hAdditionalDrivers"] >= 0 && $_REQUEST["hAdditionalDrivers"] <= 4 )
            $PostAdditionalDrivers = $_REQUEST["hAdditionalDrivers"]; 
    }
    
    $PostOptChildSeat = 0;
    if ( is_numeric ( $_REQUEST["hOptChildSeat"]) )
    {
         if ($_REQUEST["hOptChildSeat"] >= 0 && $_REQUEST["hOptChildSeat"] <= 2 )
            $PostOptChildSeat = $_REQUEST["hOptChildSeat"]; 
    }
     
    
    $PostCity = substr( $_REQUEST["hCity"], 0, 25 );

    $PostZip = substr( $_REQUEST["hZip"], 0, 15 );

    $PostCountry = substr( $_REQUEST["hCountry"], 0, 30 );

    $PostEmail = substr( $_REQUEST["hEmail"], 0, 40 );

    $PostAltEmail = substr( $_REQUEST["hAltEmail"], 0, 40 ); 

    $PostPhone = substr( $_REQUEST["hPhone"], 0, 20 );
    $PostMobile = substr( $_REQUEST["hMobile"], 0, 20 );  
    $PostLocalPhone = substr( $_REQUEST["hLocalPhone"], 0, 20 );  
    
    $PostFlightNo = substr( $_REQUEST["hFlightNo"], 0, 10 );

    $PostPromotionCode = substr( $_REQUEST["hPromotionCode"], 0, 15 );

    $PostPaymentType = $_REQUEST["PaymentType"];      

    $PostCardType = substr( $_REQUEST["CCtype"], 0, 20 );

    $PostCardNumber = substr( $_REQUEST["CCnumber"], 0, 20 );

    $PostCardExpiry = substr( $_REQUEST["CCexpiry"], 0, 20 );



    $PostRemark = substr( $_REQUEST["hRemark"], 0, 1000 );

    //$SessCalcPrice = $_SESSION["CalcPrice"];
    //$SessBookingBalance = $_SESSION["CalcBalance"];

    

    $sql = "select partner_visit_id, visit_datetime from partner_visit ";

    $sql .= " WHERE ip_address = '".$_SERVER['REMOTE_ADDR']."' ";

    $sql .= " AND DATE_ADD( now() , INTERVAL  -6 HOUR ) < visit_datetime ORDER BY visit_datetime DESC ";

    $ResultSet = mysql_query( $sql );

    $Record =  mysql_fetch_assoc( $ResultSet );  

    if ( $Record["partner_visit_id"]  )

            $PartnerVisitId = $Record["partner_visit_id"]  ;

    else

        $PartnerVisitId = 0;
        
            // No calc no of days
    $bc = new BookingCosts( $Country->Rec["country_code"], 1 );
    $StDateArr = explode( "-", $PickupDate );
    $StTimeArr = explode( ":", $PickupTime );
    $EnDateArr = explode( "-", $DropoffDate );
    $EnTimeArr = explode( ":", $DropoffTime);   
    
$bc->OptWaiver = $_REQUEST[ "hOptWaiver" ];
$bc->OptAccident = $_REQUEST[ "hOptAccident" ];
$bc->OptGpsTh = $_REQUEST[ "hOptGpsTh" ];
$bc->OptGpsEn = $_REQUEST[ "hOptGpsEn" ];
$bc->OptChildSeat = $_REQUEST[ "hOptChildSeat" ];
$bc->OptChildSeat2 = $_REQUEST[ "hOptChildSeat2" ];

if ( $vehtype != $retloc )
    $bc->OneWayBooking = true;
    
    $sql = "select locationid FROM locations WHERE location_code = '".$vehtype."' ";
    $ResultSet = mysql_query( $sql ) ;

    $vrow = mysql_fetch_array($ResultSet);
    $price = $bc->CalcRegionalPrice( $vrow["locationid"], $StDateArr[2],$StDateArr[1],$StDateArr[0],$StTimeArr[0],$StTimeArr[1],$EnDateArr[2],$EnDateArr[1],$EnDateArr[0],$EnTimeArr[0],$EnTimeArr[1], $ID );


    $sql = "insert into bookings ";

    $sql .= "( fk_booking_country_id, fk_booking_currencies_id, name, address, address2,";

    $sql .= " delivery_address, delivery_address2,  ";

    $sql .= " email, alt_email, phone, mobile, local_phone,";

    $sql .= " payment_type_id, cardtype, cardnumber, cardexpiry, ";

    $sql .= " flight, promocode, mailings, ";

    $sql .= " vehicleid, driver_age,additional_drivers,opt_child_seat, ";
    
    $sql .= " opt_insurance_waiver, opt_insurance_accident, opt_gps_thai, opt_gps_english, ";

    $sql .= " pickup, pickupdate, pickuptime, ";

    $sql .= " dropoff, dropoffdate, dropofftime, calcprice, balance_payment, comments, partner_visit_id ) ";

    $sql .= " VALUES ";

    $sql .= "( ".$Country->Rec["country_id"].",".$Country->Rec["fk_country_currency_id"].", '".$PostName."', '".$PostAddress."', '".$PostAddress2."', ";

    $sql .= " '".$PostDeliveryAddress."', '".$PostDeliveryAddress2."',  ";

    $sql .= " '".$PostEmail."', '".$PostAltEmail."','".$PostPhone."','".$PostMobile."','".$PostLocalPhone."', ";

    $sql .= " '".$PostPaymentType."', '".$PostCardType."', '".$PostCardNumber."','".$PostCardExpiry."', ";

    $sql .= " '".$PostFlightNo."', '".$PostPromotionCode."', '".$_REQUEST["hNewsletter"]."', ";

    $sql .= $ID.", ".$PostDriverAge.", ".$PostAdditionalDrivers.", ".$bc->ChildSeats.", ";
    
    $sql .= $PostOptWaiver.", ".$PostOptAccident.", ".$PostOptGpsTh.", ".$PostOptGpsEn.", ";

    $sql .= "'".$vehtype."', '".$PickupDate."', '".$PickupTime."', ";

    $sql .= "'".$retloc."', '".$DropoffDate."', '".$DropoffTime."',";

    $sql .= "'".$price."', '".$bc->BookingBalance."','".$PostRemark."', ".$PartnerVisitId." ) ";


     print "<!--";

     print $sql;

     print "-->";
     
     mysql_query( "BEGIN WORK;" ) ;     

    if ( mysql_query( $sql ) )

    {

        $BookingId = mysql_insert_id();
        
        foreach( $_REQUEST As $key=>$value )
        {
    
            if ( substr( $key, 0, 4 ) == "xOpt" && $value )
            {
                 
                $xarr = explode( "-", $key );
                $ExtrasId = $xarr[1];
                
                $sql = "INSERT INTO booking_extras ( fk_extras_booking_id, fk_booking_pricing_extras_id, price, rate ) " .
                        " SELECT ".$BookingId.", ".$ExtrasId.", IF ( extras_limit > 0 AND ".$bc->NumDays." * extras_rate > extras_limit, extras_limit,".$bc->NumDays." * extras_rate ) , extras_rate FROM pricing_extras WHERE pricing_extras_id = $ExtrasId";
                mysql_query( $sql );
                
                
                
                if ( mysql_error() )
                {
                    $stop = true;

                    break;
                }
            }
        }
        
        IF ( ! $stop )
        {
             $sql = "SELECT price, extras_text FROM booking_extras be " .
             " JOIN pricing_extras pe ON be.fk_booking_pricing_extras_id = pe.pricing_extras_id " .
             " JOIN pricing_extra_type pet ON pe.fk_extras_pricing_extra_type_id = pet.pricing_extra_type_id " .  
             "WHERE fk_extras_booking_id = ".$BookingId;
             
            $ExtrasCost = 0;
            $ResultSet = mysql_query( $sql ) ;

            while ( $vrow = mysql_fetch_array($ResultSet) )     
            {
                $ExtrasForEmail .= "\n".$vrow["extras_text"].": (".number_format( $vrow[ "price"], 2 )." )";
                $ExtrasCost =  $ExtrasCost + $vrow[ "price"];     
            }

            
        }
        
        IF( $stop )
            mysql_query( "ROLLBACK WORK;" ) ; 
        else
            mysql_query( "COMMIT WORK;" ) ; 
            
            
            $sql = "SELECT location_name, location_code from locations";
            $ResultSet = mysql_query( $sql ) ; 

            while ( $locrow = mysql_fetch_array($ResultSet) )     
            {
                $locarray[$locrow["location_code"]] =   $locrow["location_name"];
            }      

        $sql = "select * from vehicles v LEFT JOIN supplier s ";

        $sql .= "  ON v.supplierid = s.supplierid " ;

        $sql .= "  where v.vehicleid = ".$ID;                       

        $ResultSet = mysql_query( $sql ) ;



        $vrow = mysql_fetch_array($ResultSet);


        $body = "Currency: ".$SessCurrencyCode;
        $body .= "\nRate: ".$SessCurrencyRate;
        $body .= "\nName: ".$PostName;

        $body .= "\nAddress: ".$PostAddress.",".$PostAddress2;

        $body .= "\nPickup: ".$locarray[$vehtype]." on ".$PickupDate." at ".$PickupTime;

        $body .= "\nDrop Off: ".$locarray[$retloc]." on ".$DropoffDate." at ".$DropoffTime;
        $body .= "\nDays: ".$bc->NumDays;
        $body .= "\nFlight: ".$PostFlightNo;

        $body .= "\nPromo: ".$PostPromotionCode;

        if ( $vrow )
        {

            $body .= "\nType: ".$vrow[ "manufacturer" ]." ".$vrow[ "model" ];

        }

        $body .= "\nSupplier: ".$vrow["supplier_name"];  

        $body .= "\nEmail: ".$PostEmail;

        $body .= "\nAlt Email: ".$PostAltEmail;     

        $body .= "\nPhone: ".$PostPhone;
        $body .= "\nMobile: ".$PostMobile;      
        $body .= "\nLocal Phone: ".$PostLocalPhone;   
        $body .= "\nDelivery Address: ".$PostDeliveryAddress.",".$PostDeliveryAddress2;   
        $body .= "\nDriver Age: ".$PostDriverAge; 
        $body .= "\nAdditional Drivers: ".$PostAdditionalDrivers;  
    
        
        $body .= "\nTotal Extras: ".number_format( $ExtrasCost,2); 
        if ( $PostPaymentType = "1" )

            $body .= "\nPayment By: Credit Card";   

        else

            $body .= "\nPayment By: PayPal"; 

        $body .= "\nCredit Card: ".$PostCardType." ".$PostCardNumber;

        $body .= "\nExpires: ".$PostCardExpiry;

        $body .= "\nRemark: ".$PostRemark;

        $body .= "\nPrice Quoted: ".number_format($price,2);

        $upfront =   $price - $bc->BookingBalance;

        $body .= "\nDeposit: ".number_format($upfront,2);  

        $body .= "\nBalance To Pay: ".number_format($bc->BookingBalance,2)." + ".number_format( $ExtrasCost,2)." = ".number_format($SessBookingBalance + $ExtrasCost,2);
        $body .= "\nExtras ";
        $body .= "\n------ ";  
        $body .= $ExtrasForEmail;

$to = "info@diamondcarrental.co.uk";


$fromaddr = $PostEmail;

$fromname =$PostFirstName." ".$PostLastName;

$subject = "New Booking";

$message_text = $body;

$message_html = "";

     mail($to, $fromaddr, $message_text);

     mail("douglas.brown@gmail.com", $fromaddr, $message_text);     
               

$complete = "true" ;

    }
    else

        mysql_query( "ROLLBACK WORK;" ) ;
        $Message="A problem has occurred, the booking has not been recorded, please contact us directly";



    }
?>
