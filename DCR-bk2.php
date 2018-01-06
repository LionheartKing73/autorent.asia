<?php

// Validate the posting from the booking form - we may need to represent the for

include 'DmDB/Includes/booking_costsv3.php';

include 'Includes/DCRheader.php';

// Session for posting the quoted prices, etc

session_start();
    $ID = $_REQUEST[ "chosenid" ];

if ( ($_REQUEST[ "posting"] == "FINAL" )  )
{


//if ( $Country->Rec["country_id"] > -100  )
include ( 'Includes/post_booking_aus.php');
//else
//include ( 'Includes/post_booking.php');  



}


if ( ! is_numeric ( $ID ) )
{
    var_dump( $_REQUEST );
    print "INVALID ID".$ID;
	exit;
}

$Sql = "select * from vehicles LEFT JOIN locations l on l.location_code = '$vehtype' where vehicleid = ".$ID;   



	$ResultSet = mysql_query( $Sql ); 

	$Row = mysql_fetch_array($ResultSet) ;
    
    
// The booking needs to be done from the www site as it is an SSL transaction and we only had one certificate
if ( is_numeric( $_REQUEST["www_country_id"]) )
{
 $Sql = "select * from country WHERE country_id = ".$_REQUEST["www_country_id"];   

    $ResultSet = mysql_query( $Sql ); 
    $CountryRec1 = mysql_fetch_array($ResultSet) ;
     print "<!--";
     var_dump( $CountryRec1 );
     print "-->";
      
    
    $CountryRec = $Country->Rec ;  
}   
else
{
    $CountryRec = $Country->Rec ;   
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Diamond Car Rental, Thailand</title>

<meta name="description" content="Thailand car rental agents offering the largest rental fleet and professional service."/>

<meta name="keywords" content="Thailand car rental hire"/>

<meta name="audience" content="all"/>

<meta name="expires" content="never"/>

<meta name="robots" content="index, follow"/>

<meta name="rating" content="general, information"/>

<meta name="aesop" content="information"/>

<link href="trc.css" rel="stylesheet" type="text/css"/>

<link href="Style2013.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ibox/ibox.js"></script>

<?php if ($complete=="true"){ ?>

<script type="text/javascript">

	window.location="complete_thankyou.php";

</script>

<?php } 



?>

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
$pricelocal = $bcl->CalcRegionalPrice($Row["locationid"],$startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID );


require( 'Includes/DCRBodyHeadv1.php') ;   
require( 'Includes/DCRInnerBodyHeadv1.php') ; 

    


$bc = new BookingCosts( $CountryRec["country_code"], $CountryRec["fk_country_currency_id"] );

if ( $vehtype != $retloc )
    $bc->OneWayBooking = true;

$_SESSION["currencies_id"] = $bc->CurrencyId;
$_SESSION["currency_rate"] = $bc->CurrencyRate;
$_SESSION["currency_code"] = $bc->CurrencyCode;


$price = $bc->CalcRegionalPrice($Row["locationid"],$startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins,$ID );


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

<TABLE id="Booking" width="95%" align=center cellPadding=4 cellspacing="1">  

            <TR>

              <TD colspan="4" bgcolor="#D2A3D3"><span class="normaltxtb"><STRONG>2. Enter personal information and contact details</STRONG></span></TD>

            </TR>


            <TR>

              <TD width='100px' bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Name:</font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hName" type="text" class="input_simple-no" size="50" value="<?php print $_POST[ "hName" ];?>"><span style="color: red"><?php echo $hNameError;?></span>

                * </TD>

            </TR>



            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Your usual home address: </font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hAddress" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["hAddress"];?>"><span style="color: red"><?php echo $hAddressError;?></span> *</TD>

            </TR>

            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Home address line 2: </font></TD>

              <TD colspan="3" bgcolor="#E8D1E9"><input name="hAddress2" type="text" class="input_simple-no" size="50" value="<?php echo $_POST["hAddress2"];?>"></TD>

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

              <TD bgcolor="#E8D1E9" class="smltxtblue"><font color="#03227C">Additional drivers:</font></TD>



              <TD colspan="3" bgcolor="#E8D1E9">
              <SELECT  name="hAdditionalDrivers"  class="input_simple-no" >
<?php
 for ( $i=0; $i<=4; $i++ )   
 {
    if ( $i == $PostAdditionalDrivers )
    {
       print "<option selected value='$i'>".$i."</option>"; 
    }  
    else
    {
       print "<option value='$i'>".$i."</option>"; 
    }  
 }
    
?>
              
              </SELECT> (there is usually a charge for any additional drivers)
               </TD>

            </TR> 
            
            <TR>


              <TD  bgcolor="#E8D1E9" class="smltxtblue">Flight No.</TD>

                <TD colspan="3"  bgcolor="#E8D1E9"><input name="hFlightNo" type="text" class="input_simple-no"" value=""></TD>



              </TR>


            <TR><TD colspan="4" bgcolor="#E8D1E9">All drivers must be over 21 years of age and hold a full driving licence.</TD></TR> 
		<TR><TD colspan="4" bgcolor="#E8D1E9">The driving licence must contain a photograph of the holder.</TD></TR> 
		<TR><TD colspan="4" bgcolor="#E8D1E9">A valid credit card is required when collecting the car.</TD></TR> 
		<TR><TD colspan="4" bgcolor="#E8D1E9">All drivers must show a valid passport and a valid driving licence when you collect the car.</TD></TR> 
		<TR><TD colspan="4" bgcolor="#E8D1E9">Photocopies are not acceptable.</TD></TR> 
            <TR>
         
            <TR>

              <TD colspan="4" bgcolor="#D2A3D3"><span class="normaltxtb"><STRONG>3. Payment details <table height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
             
              <th scope="col"><img src="images/paypal_logo.gif" width="63" height="25" /></th>
              <th scope="col"><img src="images/Visa.gif" width="40" height="25" /></th>
              <th scope="col"><img src="images/MasterCard.gif" width="40" height="25" /></th>
              <th scope="col"><img src="images/17_american-express.gif" width="29" height="25" /></th>
            </tr>
</table></STRONG></span></TD>

            </TR>

            <TR>

              <TD bgcolor="#E8D1E9" class="smltxtblue" colspan="5"><div align="justify">

                <div>Pay by credit card on-line securely.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nowadays there are so many people and companies accepting payment for goods and services on-line that you never know where your personal credit card information has gone to. Indo China Holidays and Tours Limited have chosen to use the PayPal secure on-line payment service to process customers credit cards. PayPal is the most secure and convenient way to pay for goods and services on-line, at no time does Indo China Holidays and Tours receive or view your credit card details, these remain within the secure PayPal system and PayPal automatically checks your credit card with the issuer to check that you have not reported the card stolen or lost and that the address that you supply is the one registered for your card. You do not have to hold a PayPal account to pay; you can pay just this one invoice using the PayPal credit card acceptance system. <span id="ecxGD__CURSOR">&nbsp;</span><br />

                </div>

                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When we receive your booking we will send you by e-mail our invoice showing the full payment details as shown on this page and shortly after that you will receive a request for a payment from PayPal to cover only the booking deposit. You may pay this deposit using a range of credit or debit cards or you can pay using your PayPal account. The balance of the invoice must be paid to the car rental provider at the time of collection using a credit card.</div>
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

              <TD colspan="4" bgcolor="#D2A3D3"><STRONG class="normaltxtb">5. Would you like to receive our special email?</STRONG></TD>

            </TR>			

            <TR>

              <TD colspan="4" bgcolor="#E8D1E9">

			  		<input name="hNewsletter" type="radio" value="1" checked> <span class="normaltxt">Yes, sign me up</span>                  &nbsp;&nbsp;

                  <input name="hNewsletter" type="radio" value="2"> <span class="normaltxt">No, not at this time</span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 </TD>
              </TR>

			             <TR>

              <TD colspan="4" bgcolor="#E8D1E9">&nbsp;</TD>

              </TR>

            <TR>

              <TD bgcolor="#E8D1E9">&nbsp;</TD>

              <TD colspan="3" bgcolor="#E8D1E9">


                <input type="submit" name="hSubmit" value="Send Request" class="button_Black">

<input type="hidden" name="chosenid" id="chosenid" value="<?php echo $ID;?>">

                  </form> 
                  
                  <!--</form>-->
                  
                               </TD>



            </TR>

          </TBODY>

        </TABLE>





<!-- END Booking Form -->

     	    </td>

            </tr>

            </table>

		<!--End Third Table-->                               





    

    

    </td>

            </tr>



          </table>










<?php

require( 'Includes/DCRInnerBodyFootv3.php') ;  
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

