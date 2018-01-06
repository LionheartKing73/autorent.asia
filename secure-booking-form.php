<?php

// Validate the posting from the booking form - we may need to represent the for
define( 'CHECKOUT_PAGE', '99') ;   // To dtermine which Extras are to be displayed
include 'DmDB/Includes/booking_costsv4.php';

include 'Includes/DCRheader.php';

// Session for posting the quoted prices, etc

session_start();
    $ID = $_REQUEST[ "chosenid" ];
    
    
// The booking needs to be done from the www site as it is an SSL transaction and we only had one certificate
if ( is_numeric( $_REQUEST["www_country_id"]) )
{
 $Sql = "select * from country WHERE country_id = ".$_REQUEST["www_country_id"];   

    $ResultSet = mysql_query( $Sql ); 
    $CountryRec = mysql_fetch_array($ResultSet) ;


}   
else
{
    $CountryRec = $Country->Rec ;   
}

if ( $CountryRec["country_subdomain"] )                             // wwww page receives a country indicatoru
    $countrySD =   $CountryRec["country_subdomain"];    
elseif ( $Country->Rec["country_subdomain"] )                       // Country Pages
    $countrySD =   $Country->Rec["country_subdomain"];
else
$countrySD =   "thailand";   
$rc = $countrySD;
$req_districtFr = $_REQUEST["distFr".$rc] ;
$req_districtTo = $_REQUEST["distTo".$rc] ;
$req_locationFr = $_REQUEST["locFr".$req_districtFr] ;
$req_locationTo = $_REQUEST["locTo".$req_districtTo] ;




if ( ! is_numeric ( $ID ) )
{
    var_dump( $_REQUEST );
    print "INVALID ID".$ID;
	exit;
}

$Sql = "select * from vehicles LEFT JOIN locations l on l.location_code = '$vehtype' where vehicleid = ".$ID;   



	$ResultSet = mysql_query( $Sql ); 

	$Row = mysql_fetch_array($ResultSet) ;
    

if ( ($_REQUEST[ "posting"] == "FINAL" )  )
{


//if ( $Country->Rec["country_id"] > -100  )
include ( 'Includes/post_booking_aus3.php');
//else
//include ( 'Includes/post_booking.php');  
$to = "douglas.brown@gmail.com";
$fromaddr  = "info@autorental.asia";
$subject = "Thank you for your booking";

$message_html = "<img src='http://autorental.asia/images/mailheader.png' />" .
"<p>" .
"<p>Good day" .
"<p>Thank you kindly for your car rental booking." .
"<p>You will receive your voucher detailing your booking and containing the car rental counter details shortly." .
"<p>Please check your inbox and your spam or junk box; your voucher may take up to 12 hours to reach you." .
"<p>In the meantime, if there is anything else we can do for you; please do not hesitate to contact us." .
"<p>We look forward to serving yourself, your family and your friends in the future." .
"<p>Our best regards, Diamond Car Rental." .

"<p>" .

"<p><b><i>Now you can rent cars at more than 2500 locations throughout Europe, the Asia Pacific, Australasia, Japan, Fiji
& Sri Lanka with Diamond Car Rental.</i></b>" .

"<p>Diamond Car Rental. " .
"<br/>Kemp House. " .
"<br/>152-160 City Road. " .
"<br/>London EC1V 2NX. " .
"<br/>United Kingdom. " .

"<p>" .
"<p>info@diamondcarrental.co.uk" .
"<p>www.diamondcarrental.co.uk" .
"<p>London: +44 203 5145548" .
"<p>Sydney: +61 87 100 1231" .
"<p>Bangkok: +66 87 090 4711";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= "From: Autorent Asia <".$fromaddr.">\r\n";



$xy = mail( $PostEmail, $subject,  $message_html, $headers );


}



    
    


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Autorent Asia</title>

<meta name="description" content="Thailand car rental agents offering the largest rental fleet and professional service."/>

<meta name="keywords" content="Thailand car rental hire"/>

<meta name="audience" content="all"/>

<meta name="expires" content="never"/>

<meta name="robots" content="index, follow"/>

<meta name="rating" content="general, information"/>

<meta name="aesop" content="information"/>

<link href="trc.css" rel="stylesheet" type="text/css"/>

<link href="Style2016.css" rel="stylesheet" type="text/css" />
<?php
  include 'Includes/metatags.php';
  include 'includes/head1967.php';  
?>
<script type="text/javascript" src="ibox/ibox.js"></script>

<?php if ($complete=="true"){ ?>

<script type="text/javascript">

	window.location="DCR-booking-complete.php?www_country_id=<?php echo $CountryRec["country_id"]?>&xy=<?php echo $xy?>";

</script>

<?php } 



?>
<script type="text/javascript">   
$(document).ready(function(){
	$('.cc-spans').hide();
	$('#cardtype').change(function(){
		$('.cc-spans').hide();
		if($('#cardtype').val() == 'Amex'){
			$('#span2').show();
		}
		if($('#cardtype').val() == 'Diners'){
			$('#span1').show();
		}
		if($('#cardtype').val() == 'Mastercard'){
			$('#span1').show();
		}
		if($('#cardtype').val() == 'Visa'){
			$('#span1').show();
		}
	});  
});
</script> 

</head>





<body>











<?php



// Calculate the number of days for which the booking is valid



$Days=0;

$Months=0;









?>





<!--Main Table-->

<?php

if ( is_numeric( $_REQUEST[ "CurrencyId" ] ) )
    {
        $CurrencyId = $_REQUEST[ "CurrencyId" ];
    }
    else
        $CurrencyId = 0;

$bcl = new BookingCosts($CountryRec["country_code"], $CountryRec["fk_country_currency_id"]  );

if ($req_districtFr != $req_districtTo )
{

	$bcl->LoadOWC($req_districtFr, $req_districtTo);
	
} 

$pricelocal = $bcl->CalcRegionalPrice($Row["locationid"],$req_districtFr,$req_districtTo,$startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID, $Row["supplierid"] );


require( 'Includes/DCRBodyHeadv1.php') ;   
require( 'Includes/DCRInnerBodyHeadv1.php') ; 

   


$bc = new BookingCosts( $CountryRec["country_code"], $CountryRec["fk_country_currency_id"] );

if ( $vehtype != $retloc )
    $bc->OneWayBooking = true;

$_SESSION["currencies_id"] = $bc->CurrencyId;
$_SESSION["currency_rate"] = $bc->CurrencyRate;
$_SESSION["currency_code"] = $bc->CurrencyCode;


if ($req_districtFr != $req_districtTo )
{
	$bc->LoadOWC($req_districtFr, $req_districtTo);
	
}


$price = $bc->CalcRegionalPrice($Row["locationid"],$req_districtFr,$req_districtTo,$startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID, $Row["supplierid"] );


$_SESSION["CalcPrice"] = $price;
$_SESSION["CalcBalance"] = $bc->BookingBalance;


// Get the calc in the Booking currency
//$bclocal = new BookingCosts( $BookingCurrencyId );
//$pricelocal = $bcl->CalcRegionalPrice($Row["locationid"],$startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID );


?>
            <p class="normaltxtb">



        <?php

            print "<h1 class='Banner'>".$Row[ "manufacturer" ]." ".$Row["model"]."</h1>";

        ?>

             </p>

                <!-- STARTING THE PHP SECTION TO RETRIEVE THE Vehicle DATA FROM THE DATABASE -->

<?php

if ( $Message )

{

print "<div  style='color: red; text-align: center'>".$Message."</div>";



}

?>

		<!--Third Table-->

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

            <tr>

            <td valign="top">





			<!--Fourth Table-->

  			 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

                   <tr>

                   <td width=320px valign=top>



			<?

				output_image( $Row, $dbimagedir, "mainimage" , $ID, 300, 225, $qs );

			?>

                  </td>

			 <td valign=top>



			<div align="center" class="smltxt">

				

				<!--Fifth Table-->

				<table width="100%" border="0" cellpadding="3">

				<tr>

				<td align="right" width="50%" valign="top">Transmission</td>

				<td width="50%">

				<?php

					if (  $Row[ "transmission" ] == "A" )

						print "Automatic";

					else

						print "Manual";

				?>

				</td>

				</tr>



				<tr>

				<td align="right" width="50%" valign="top">Capacity</td>

				<td width="50%">

				<?php

				print $Row[ "cc" ]."cc";

				?>

				</td>

				</tr>



				<tr>

				<td align="right" width="50%" valign="top">Number of Passengers</td>

				<td width="50%">

				<?php

				print $Row[ "passenger" ];

				?>

				</td>

				</tr>



				<tr>

				<td align="right" width="50%" valign="top">Air Conditioning?</td>

				<td width="50%">

				<?php

				if ( $Row[ "air" ] )

					print "Yes";

				else

					print "No";

				?>

				</td>

				</tr>



				<tr>

				<td align="right" width="50%" valign="top">Luggage</td>

				<td width="50%">

				<?php

				print $Row[ "luggage" ];

				?>

				</td>

				</tr>



				<tr>

				<td align="right" width="50%" valign="top">Have similar?</td>

				<td width="50%">

				<?php

				if ( $Row[ "havesimilar" ] )

					print "Yes";

				else

					print "No";

				?>

				</td>

				</tr>



				<tr>

				<td align="right" width="50%" valign="top">Extras</td>

				<td width="50%">

				<?php

				print $Row[ "extras1" ];

				?>

				</td>

				</tr>

				<tr>

				<td align="right" width="50%" valign="top"></td>

				<td width="50%">

				<?php

				print $Row[ "extras2" ];

				?>

				</td>

				</tr>

				<tr>

				<td align="right" width="50%" valign="top"></td>

				<td width="50%">

				<?php

				print $Row[ "extras3" ];

				?>

				</td>

				</tr>

				<tr>

				<td align="right" width="50%" valign="top"></td>



				<td width="50%">

				<?php

				print $Row[ "extras4" ];

				?>

				</td>

				</tr>

				</table>

				<!--End Fifth Table-->

                   </div>

			</td>

                  </tr>

                  </table>

			<BR />

			<!--End Fourth Table-->



<!---Booking Form -->





<form method="post" action="<?php echo $_SERVER[ "PHP_SELF"];?>">

                                       <!--<form method="post" action="/webformmailer.php">-->


                                        <input type="hidden" name="recipient" value="info@indochinaholidaysandtours.com" />

                                       

<input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo $ID?>">
<input type="hidden" name="CurrencyId" id="CurrencyId" value="<?php echo $CurrencyId?>">

<input type="hidden" name="posting" id="posting" value="FINAL">

<TABLE  width="95%" align=center cellPadding=4 cellspacing="1">

          <TBODY>
<?php

print "\n";
$d1 = mktime ( $starttimehrs,$starttimemins,0, $startmonthveh, $startdayveh, $startyearveh );

print "\n<input type='hidden' name='retloc' value='".$retloc."'>";  
print "\n<input type='hidden' name='vehtype' value='".$vehtype."'>"; 
print "\n<input type='hidden' name='hFlightNo' value='".$_REQUEST["hFlightNo"]."'>";
print "\n<input type='hidden' name='hPromotionCode' value='".$_REQUEST["hPromotionCode"]."'>";

if ( $CountryRec["country_subdomain"] )                             // wwww page receives a country indicatoru
    $countrySD =   $CountryRec["country_subdomain"];    
elseif ( $Country->Rec["country_subdomain"] )                       // Country Pages
    $countrySD =   $Country->Rec["country_subdomain"];
else
    $countrySD =   "thailand";   
$rc = $countrySD;
$req_districtFr = $_REQUEST["distFr".$rc] ;
$req_districtTo = $_REQUEST["distTo".$rc] ;
$req_locationFr = $_REQUEST["locFr".$req_districtFr] ;
$req_locationTo = $_REQUEST["locTo".$req_districtTo] ;
$htmltext .= '<input type="hidden" name="distFr'.$rc.'" value="'.$req_districtFr.'">';
$htmltext .= '<input type="hidden" name="distTo'.$rc.'" value="'.$req_districtTo.'">';

$htmltext .= '<input type="hidden" name="locFr'.$req_districtFr.'" value="'.$req_locationFr.'">';
$htmltext .= '<input type="hidden" name="locTo'.$req_districtTo.'" value="'.$req_locationTo.'">';

print "\n<input type='hidden' name='startdayveh' value='$startdayveh'>";
print "\n<input type='hidden' name='startmonthveh' value='$startmonthveh'>";
print "\n<input type='hidden' name='startyearveh' value='$startyearveh'>";
print "\n<input type='hidden' name='starttimehrs' value='$starttimehrs'>";
print "\n<input type='hidden' name='starttimemins' value='$starttimemins'>";
/*
DaySelect( "startdayveh", $startdayveh );

MonthSelect( "startmonthveh", $startmonthveh );

YearSelect( "startyearveh", $startdayveh );
*/



$d2 = mktime ( $fintimehrs, $fintimemins,0, $finmonth, $finday, $finyear );

print "\n<input type='hidden' name='finday' value='$finday'>";
print "\n<input type='hidden' name='finmonth' value='$finmonth'>";
print "\n<input type='hidden' name='finyear' value='$finyear'>";
print "\n<input type='hidden' name='fintimehrs' value='$fintimehrs'>";
print "\n<input type='hidden' name='fintimemins' value='$fintimemins'>";

print "\n<input type='hidden' name='hOptWaiver' value='".$_REQUEST["hOptWaiver"]."'>";
print "\n<input type='hidden' name='hOptAccident' value='".$_REQUEST["hOptAccident"]."'>";
print "\n<input type='hidden' name='hOptGpsTh' value='".$_REQUEST["hOptGpsTh"]."'>";
print "\n<input type='hidden' name='hOptGpsEn' value='".$_REQUEST["hOptGpsEn"]."'>";
print "\n<input type='hidden' name='hOptChildSeat' value='".$_REQUEST["hOptChildSeat"]."'>";
print "\n<input type='hidden' name='hOptChildSeat2' value='".$_REQUEST["hOptChildSeat2"]."'>";

print "\n<input type='hidden' name='www_country_id' value='".$CountryRec["country_id"]."'>";       


foreach( $_REQUEST As $key=>$value )
{
    
    if ( substr( $key, 0, 4 ) == "xOpt" )
    {
         print "\n<input type='hidden' name='".$key."' value='".$value."'>";  
    }
}

//include 'booking_costs_table.php';   





//print "<h4>Price THB ".number_format( $price, 0 )."&nbsp;&nbsp;&nbsp;</a></h4>";



//print $bc->CalcString;







?>
<input type="hidden" name="www_country_id" id="www_country_id" value="<?php echo $CountryRec["country_id"]?>">   
<TABLE id="Booking" width="95%" align=center cellPadding=4 cellspacing="1">  

            <TR>

              <TD colspan="4" bgcolor="#D2A3D3"><span class="normaltxtb"><STRONG>Drivers details</STRONG></span></TD>

            </TR>
 <TR>

              <TD colspan="4" bgcolor="#D2A3D3">
          
            <p style='text-align: left; width: 80%; margin: 6px; padding: 6px;background-color: white; color:black; border: solid 1px black;'>
            
                        This is a 256 bit secure page, all of the information that you provide for us on this form will be encrypted and transmitted securely.
</p>
      </TD>
              </TR>   
            <TR>

              <TD width='100px' bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Name:</font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hName" type="text" class="input_simple-no" size="50" value="<?php print $_POST[ "hName" ];?>"><span style="color: red"><?php echo $hNameError;?></span>

                * </TD>

            </TR>




 <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Your usual home phone number:</font></TD>



              <TD colspan="3" bgcolor="#E8D1E9"><input name="hPhone" type="text" class="input_simple-no" size="30" value="<?php echo $_POST["hPhone"];?>"><span style="color: red"><?php echo $hPhoneError;?></span>

                * </TD>

            </TR>
            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Your usual mobile phone number:</font></TD>



              <TD colspan="3" bgcolor="#E8D1E9"><input name="hMobile" type="text" class="input_simple-no" size="30" value="<?php echo $_POST["hMobile"];?>"><span style="color: red"><?php echo $hMobileError;?></span>

                * </TD>

            </TR>
            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">A local number if you have one:</font></TD>



              <TD colspan="3" bgcolor="#E8D1E9"><input name="hLocalPhone" type="text" class="input_simple-no" size="30" value="<?php echo $_POST["hLocalPhone"];?>">

               </TD>

            </TR>        


            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">E-mail: </font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hEmail" type="text" class="input_simple-no" value="<?php echo $_POST["hEmail"];?>" size="40" maxlength="100">

              <span style="color: red"><?php echo $hEmailError;?></span>

                * </TD>

            </TR>

            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Alternative E-mail: </font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hAltEmail" type="text" class="input_simple-no" value="<?php echo $_POST["hAltEmail"];?>" size="40" maxlength="100">

              

                </TD>

            </TR>
                        <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Full delivery address: </font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hDeliveryAddress" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["hDeliveryAddress"];?>"></TD>

            </TR>

            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Delivery address line 2: </font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hDeliveryAddress2" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["hDeliveryAddress2"];?>"></TD>

            </TR>  
            
            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Age of the main driver:</font></TD>



              <TD colspan="3" bgcolor="#E8D1E9"><input name="hDriverAge" type="text" class="input_simple-no" size="6" value="<?php echo $_POST["hDriverAge"];?>">
              <span style="color: red"><?php echo $hDriverAgeError;?></span> *
               </TD>

            </TR>              	

            
            <TR>


              <TD  bgcolor="#E8D1E9" class="smltxtblue">Flight No.</TD>

                <TD colspan="3"  bgcolor="#E8D1E9"><input name="hFlightNo" type="text" class="input_simple-no"" value=""></TD>



              </TR>


            <TR>
         
            <TR>

              <TD colspan="4" bgcolor="#D2A3D3"><span class="normaltxtb"><STRONG>Cardholder details <table height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
             

              <th scope="col"><img src="images/Visa.gif" width="40" height="25" /></th>
              <th scope="col"><img src="images/MasterCard.gif" width="40" height="25" /></th>
              <th scope="col"><img src="images/17_american-express.gif" width="29" height="25" /></th>
            </tr>
</table></STRONG></span></TD>

            </TR>

            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue" colspan="5"><div align="justify">

                <div>Pay by credit card on-line securely.
                
           
             
                
<!--
                
                <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nowadays there are so many people and companies accepting payment for goods and services on-line that you never know where your personal credit card information has gone to. Indo China Holidays and Tours Limited have chosen to use the PayPal secure on-line payment service to process customers credit cards. PayPal is the most secure and convenient way to pay for goods and services on-line, at no time does Indo China Holidays and Tours receive or view your credit card details, these remain within the secure PayPal system and PayPal automatically checks your credit card with the issuer to check that you have not reported the card stolen or lost and that the address that you supply is the one registered for your card. You do not have to hold a PayPal account to pay; you can pay just this one invoice using the PayPal credit card acceptance system. <span id="ecxGD__CURSOR">&nbsp;</span><br />

                </div>

                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When we receive your booking we will send you by e-mail our invoice showing the full payment details as shown on this page and shortly after that you will receive a request for a payment from PayPal to cover only the booking deposit. You may pay this deposit using a range of credit or debit cards or you can pay using your PayPal account. The balance of the invoice must be paid to the car rental provider at the time of collection using a credit card.
                
                
                </div>
-->            
                
              <?php
              
              // Get Extra Cost
                    foreach( $_REQUEST As $key=>$value )
                    {
                
                        if ( substr( $key, 0, 4 ) == "xOpt" )
                        {
                             
                             $ExtraCost = $ExtraCost + $value;
                             print "\n<!--".$key."---".$value."-->";

                        }
                    }
              
              $sql = "select * from credit_card where fk_cc_country_id = ".$CountryRec["country_id"] . 
                    " and fk_cc_supplier_id = ".$Row["supplierid"] .
                    " ORDER by charge_rate DESC, credit_card_description DESC ";
    
              $ResultSet = mysql_query( $sql ); 

              $currRT = "";
               $payment = $pricelocal + $ExtraCost ;
               
              while ( $Row2 = mysql_fetch_array($ResultSet) )     
              {
                  
                  $cc_options.='<option value-"'.$Row2["credit_card_id"].'">'.$Row2["credit_card_description"].'</option>';
                  if ( $currRT != $Row2["charge_rate"])
                  {
                      $detail = $Row2["credit_card_description"]."</td><td align='right'>".$bcl->CurrencyCode." ";
                      $detail .= number_format( ( $Row2["charge_rate"] * $payment ) / 100, 2 );
                      $detail .= "</td></tr>";
                      if ( ! $currRT )
                          $output = $detail;
                      else
                          $output = $detail."<tr><td align='left'>".$output; 
                      $currRT = $Row2["charge_rate"] ;   
                  }
                  else
                      $output =  $Row2["credit_card_description"].", ".$output;
              }
              
              

              
              ?>
             <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Credit Card</font></TD>
              <TD colspan="3" bgcolor="#E8D1E9">
              <select name="cardtype"  class="input_simple-no" id="cardtype">
                  <option value=''>Select Card</option>
                  <option value='Amex'>AMEX</option>
                  <option value='Diners'>Diners</option>
                  <option value='Mastercard'>Mastercard</option>
                  <option value='Visa'>Visa</option>
              </select>
              </TD>
            </TR>             
              
               <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Card no: </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cardnumber" type="text" class="input_simple-no" size="20" value="<?php echo $_POST["cardnumber"];?>">
              
                            <span style="color: red"><?php echo $ccCardNumberError;?></span> *
              </TD>
            </TR>  
        
               <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Expiry: </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cardexpiry" type="text" class="input_simple-no" size="10" value="<?php echo $_POST["cardexpiry"];?>">
              
                            <span style="color: red"><?php echo $ccCardExpiryError;?></span> *
              </TD>
            </TR>          
             <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">CVV/CSC: </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="card_cvv" type="text" class="input_simple-no" size="5" value="<?php echo $_POST["card_cvv"];?>">
		<span style="color: red"><?php echo $ccCardCVVError;?></span> *&nbsp;
		<span class="cc-spans" id="span1" style="font-size: 12px">A 3 digit number at the end of the signature strip on the back of your card.</span> 
		<span class="cc-spans" id="span2" style="font-size: 12px">A 4 (four) digit number on the front of your card.</span> 
              </TD>
            </TR>    
    
             <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">First name </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_fname" type="text" class="input_simple-no" size="40" value="<?php echo $_POST["cc_fname"];?>">
              
                            <span style="color: red"><?php echo $ccFnameError;?></span> *
              </TD>
            </TR>  
            
             <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Last name </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_lname" type="text" class="input_simple-no" size="40" value="<?php echo $_POST["cc_lname"];?>">
              <span style="color: red"><?php echo $ccLnameError;?></span> *
              </TD>
            </TR> 
              
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Address </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9">
              
<span style="font-size: 12px">P.O.Box numbers are not acceptable even though your statements maybe sent to your P.O.Box number. You must enter the full street number or house name and the street name where the card is registered to.</span>         
              </TD>
            </TR>    
               
             <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Address 1</font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_add1" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["cc_add1"];?>">
              
                            <span style="color: red"><?php echo $ccAdd1Error;?></span> *
              </TD>
            </TR>          
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Address 2 </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_add2" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["cc_add2"];?>">

              </TD>
            </TR>              
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Town </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_city" type="text" class="input_simple-no" size="25" value="<?php echo $_POST["cc_city"];?>">
              
              <span style="color: red"><?php echo $ccCityError;?></span> *
              </TD>
            </TR> 

              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">City </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_province" type="text" class="input_simple-no" size="25" value="<?php echo $_POST["cc_province"];?>">
                            <span style="color: red"><?php echo $ccProvinceError;?></span> *
              
              </TD>
            </TR> 
            
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Country: </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9">
              <input name="cc_country" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["cc_country"];?>">
              
              
             <span style="color: red"><?php echo $ccCountryError;?></span> *
              </TD>
            </TR>             
             
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Postcode </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_postcode" type="text" class="input_simple-no" size="10" value="<?php echo $_POST["cc_postcode"];?>">
                            <span style="color: red"><?php echo $ccPostCodeError;?></span> *
              
              </TD>
            </TR>   
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Phone </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_phone" type="text" class="input_simple-no" size="20" value="<?php echo $_POST["cc_phone"];?>">

              </TD>
            </TR> 
              <TR>
              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Email </font></TD>
              <TD colspan="3" bgcolor="#E8D1E9"><input name="cc_email" type="text" class="input_simple-no" size="20" value="<?php echo $_POST["cc_email"];?>">
                            <span style="color: red"><?php echo $ccEmailError;?></span> *
              
              </TD>
            </TR>                                                                         
              <?php
              
              if ( $output )
              {
                  print "<p>Credit card service fee: ";
                 print "<table>\n<tr><td align=left'>".$output."</table>";
              }
              
              ?>
              
              
              </div></TD>

             

            

		 <TR>

              <TD colspan="4" bgcolor="#D2A3D3"><span class="normaltxtb"><STRONG>4. Any additonal comments or questions here</STRONG></span></TD>

            </TR>

            <TR>

              <TD colspan="4" bgcolor="#E8D1E9"><textarea name="hRemark" cols="50" rows="4"></textarea></TD>

            </TR>



			             <TR>

              <TD colspan="4" bgcolor="#E8D1E9">&nbsp;</TD>

              </TR>

            <TR>

              <TD bgcolor="#E8D1E9">&nbsp;</TD>

              <TD colspan="3" bgcolor="#E8D1E9">


                <input type="submit" name="hSubmit" value="BOOK NOW" class="button_Black">

<input type="hidden" name="chosenid" id="chosenid" value="<?php echo $ID;?>">

<?php
$htmltext = '<input type="hidden" name="distFr'.$rc.'" value="'.$req_districtFr.'">';
$htmltext .= '<input type="hidden" name="distTo'.$rc.'" value="'.$req_districtTo.'">';

$htmltext .= '<input type="hidden" name="locFr'.$req_districtFr.'" value="'.$req_locationFr.'">';
$htmltext .= '<input type="hidden" name="locTo'.$req_districtTo.'" value="'.$req_locationTo.'">';

print $htmltext;
?>

                  </form> 
                  
                  <!--</form>-->
                  
                               </TD>



            </TR>

          </TBODY>

        </TABLE>



                <div class="smltxtblue" style='margin-top: 3px; text-align: left'><span style='font-weight: bold' class="smltxtblue">Exchange Rates: </span> are for illustrative purposes, your credit card will be debited for the amount of the booking deposit & any insurance products and will be debited in Thai Baht. We use the secure on-line services of PayPal to process our credit card & debit card payments.


</div>
       

<!-- END Booking Form -->

     	    </td>

            </tr>

            </table>

		<!--End Third Table-->                               





    

    

    </td>

            </tr>



          </table>










<?php

require( 'Includes/DCRInnerBodyFootv2.php') ;  
require( 'Includes/DCRBodyFootv1.php') ;   

?>









</body>

</html>

<?php

function send_mail($to, $fromaddr, $fromname, $subject, $message_text, $message_html = "")

{

  // to prevent spammers/hackers from utilising your html2server email form

  // this type of hacking is called "header injection" where the spammer will call your

  // script with the subject or message containing more header information before the message

  // allowing them to send as many mails as they like, and blacklisting your mail server as a spammer

  // they mostly change the headers, and add cc, and bcc headers.

  // The best way to stop this is to check for headers and remove them!

  $subject = preg_replace("/\nfrom\:.*?\n/i", "", $subject);

  $subject = preg_replace("/\nbcc\:.*?\n/i", "", $subject);

  $subject = preg_replace("/\ncc\:.*?\n/i", "", $subject);

  $message_text = preg_replace("/\nfrom\:.*?\n/i", "", $message_text);

  $message_text = preg_replace("/\nbcc\:.*?\n/i", "", $message_text);

  $message_text = preg_replace("/\ncc\:.*?\n/i", "", $message_text);

  $message_html = preg_replace("/\nfrom\:.*?\n/i", "", $message_html);

  $message_html = preg_replace("/\nbcc\:.*?\n/i", "", $message_html);

  $message_html = preg_replace("/\ncc\:.*?\n/i", "", $message_html);



  // create additional_parameters - this ensures that the RETURN-PATH will be properly set

  // saving the mail from being rejected by the destination mail server as spam

  // known servers that reject if RETURN-PATH domain does not match the from domain include

  // gmail, hotmail, aol, excite, yahoo, btinternet

  // most spam killers will also regard emails with

  $additional_parameters = "-f $fromaddr";



  // create additional_headers

  $headers = "From: $fromname <$fromaddr>\r\n";



  // specify MIME version 1.0

  $headers .= "MIME-Version: 1.0\r\n";



  // deal with html messages

  if($message_html != "")

  {

   // unique boundary

   $boundary = uniqid("sometext");



   // tell e-mail client this e-mail contains alternate versions

   $headers .= "Content-Type: multipart/alternative; boundary = $boundary\r\n\r\n";



   // plain text version of message

   $body  = "--$boundary\r\n";

   $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

   $body .= "Content-Transfer-Encoding: 7 bit\r\n\r\n";

   $body .= $message_text."\r\n\r\n";



   // HTML version of message

   $body .= "--$boundary\r\n";

   $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   $body .= "Content-Transfer-Encoding: t bit\r\n\r\n";

   $body .= $message_html."\r\n\r\n";

  }



  // deal with plain text only messages

  if($message_html == "")

  {

   // tell e-mail client the content type

     $headers .= "Content-type: text/plain; charset=iso-8859-1\n";



   // the plain text message

   $body = $message_text;

  }



  // send message

  return mail($to, $subject, $body, $headers, $additional_parameters);

} 

?>

