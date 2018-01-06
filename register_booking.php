<?php
 //  The initial pricing form. This is posted to booking_interim_process.php
 // If any of the optional items are altered this page is redisplayed
 // otherwise the final booking form is shown
 
 define( 'BOOKING_STAGE', '1') ;   // This will be overridden if this form has to be redisplayed (see booking_interim_process.php)
define( 'CHECKOUT_PAGE', '1') ;   // To dtermine which Extras are to be displayed

include 'DmDB/Includes/booking_costsv4.php';

include 'Includes/DCRheader.php';

// Session for posting the quoted prices, etc
  if (!isset ($_COOKIE[ini_get('session.name')])) {
    session_start();
  }

// Initialise the Session variables


    
    // Optional Radios
    if ( $_POST[ "hOptWaiver" ] )
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
    
    if ( $_POST[ "hOptAccident" ] )
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

    if ( $_POST[ "hOptGpsTh" ] )
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
    if ( $_POST[ "hOptGpsEn" ] )
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
    if ( $_POST[ "hOptChildSeat" ] )
    {
        $PostOptChildSeat = 1;
        $OptChildSeatSelected = "checked";
        $EmailOptChildSeatText = "YES";
        $OptChildSeatUnselected = "";  
    }
    else
    {
        $PostOptChildSeat = 0;
        $OptChildSeatSelected = "";
        $EmailOptChildSeatText = "NO";  
        $OptChildSeatUnselected = "checked";  
    }  
    if ( $_POST[ "hOptChildSeat2" ] )
    {
        $PostOptChildSeat2 = 1;
        $OptChildSeat2Selected = "checked";
        $EmailOptChildSeat2Text = "YES";
        $OptChildSeat2Unselected = "";  
    }
    else
    {
        $PostOptChildSeat2 = 0;
        $OptChildSeat2Selected = "";
        $EmailOptChildSeat2Text = "NO";  
        $OptChildSeat2Unselected = "checked";  
    }   
    if ( is_numeric( $_REQUEST[ "CurrencyId" ] ) )
    {
        $CurrencyId = $_REQUEST[ "CurrencyId" ];
    }
    else
        $CurrencyId = 0;
    
    // Set the Session variables - if these change, this page needs to be redisplayed
    $_SESSION["PostOptWaiver"] = $_POST[ "hOptWaiver" ]; 
    $_SESSION["PostOptAccident"] = $_POST[ "hOptAccident" ]; 
    $_SESSION["PostOptGpsTh"] = $_POST[ "hOptGpsTh" ]; 
    $_SESSION["PostOptGpsEn"] = $_POST[ "hOptGpsEn" ]; 
    $_SESSION["CurrencyId"] = $CurrencyId;  
    $_SESSION["PostOptChildSeat"] = $_REQUEST[ "hOptChildSeat" ];
    $_SESSION["PostOptChildSeat2"] = $_REQUEST[ "hOptChildSeat2" ];

    $ID = $_POST[ "chosenid" ];


if ( ! is_numeric ( $ID ) )
	exit;

$Sql = "select * from vehicles LEFT JOIN locations l on l.location_code = '$vehtype' LEFT JOIN supplier s ON s.supplierid = vehicles.supplierid where vehicleid = ".$ID;



	$ResultSet = mysql_query( $Sql ); 

	$Row = mysql_fetch_array($ResultSet) ;


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
$bc = new BookingCosts( $CurrencyCode, $CurrencyExchangeRate, $startdayveh,$startmonthveh,$startyearveh,$starttimehrs,$starttimemins, $finday,$finmonth,$finyear,$fintimehrs,$fintimemins );

$bc->OptWaiver = $_POST[ "hOptWaiver" ];
$bc->OptAccident = $_POST[ "hOptAccident" ];
$bc->OptGpsTh = $_POST[ "hOptGpsTh" ];
$bc->OptGpsEn = $_POST[ "hOptGpsEn" ];
$bc->OptChildSeat = $_POST[ "hOptChildSeat" ];
$bc->OptChildSeat2 = $_POST[ "hOptChildSeat2" ];

$_SESSION["currencies_id"] = $bc->CurrencyId;
$_SESSION["currency_rate"] = $bc->CurrencyRate;
$_SESSION["currency_code"] = $bc->CurrencyCode;

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


if ($req_districtFr != $req_districtTo )
{
	$bc->LoadOWC($req_districtFr, $req_districtTo);
	
}
	



$price = $bc->CalcRegionalPrice( $Row["locationid"],$req_districtFr,$req_districtTo,$ID,$Row["supplierid"] );


$_SESSION["CalcPrice"] = $price;
$_SESSION["CalcBalance"] = $bc->BookingBalance;

?>
<?php
  include 'Includes/metatags.php';
  include 'Includes/head1967.php';  
?>
<script type="text/javascript">
<!--
var origBookingCost = <?php echo number_format($bc->OnlinePrice,2,'.','')?>;



function setBookingCost()
{

totBookingCost =  origBookingCost;
frm = document.getElementById( "bookingform" );
for(i=0; i<frm.elements.length; i++)
{
    fld = frm.elements[i].name;
if ( fld.substring(0,4) == "xOpt" && frm.elements[i].checked && frm.elements[i].value > 0.0001 )
{
    optfee =  Math.round( 100 *  frm.elements[i].value ) / 100;
    totBookingCost = totBookingCost + optfee;
//document.write("The field name is: " + frm.elements[i].name + " and it's value is: " + //frm.elements[i].value + ".<br />");
}
}
bc = document.getElementById( "totalBookingCost" );

rNumber = Math.round( 100 * totBookingCost) / 100 ;
fNumber= rNumber.toFixed(2) ;

bc.innerHTML=addCommas( fNumber );



}
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
//-->
</script>

<?php if ($complete=="true"){ ?>

<script type="text/javascript">

	window.location="thankyou.php";

</script>

<?php } ?>

</head>





<body>


<?php

  require( 'Includes/DCRBodyHeadv1.php') ;   
require( 'Includes/DCRInnerBodyHeadv1.php') ;  



?>




<?php

if ( $Message )

{

print "<div  style='color: red; text-align: center'>".$Message."</div>";



}
print "<h1 class='Banner'>".$Row[ "manufacturer" ]." ".$Row["model"]."</h1>";
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





<!--<form method="post" id="bookingform"  action="<?php echo $posturl?>" >-->
<!--<form method="post" id="bookingform"  action="DCR-bk2.php" > -->
<!--<form method="post" id="bookingform"  action="https://www.diamondcarrental.co.uk/secure-booking-form.php" >  --> 
<form method="post" id="bookingform"  action="register_booking_options.php" > 
                                       <!--<form method="post" action="/webformmailer.php">-->


                                        <input type="hidden" name="recipient" value="info@indochinaholidaysandtours.com" />

                                       
<input type="hidden" name="www_country_id" id="www_country_id" value="<?php echo $Country->Rec["country_id"]?>">
<input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo $ID?>">

<input type="hidden" name="posting" id="posting" value="YES">
<input type="hidden" name="chosenid" id="chosenid" value="<?php echo $ID;?>"> 


<TABLE id="Booking" width="100%" align=center cellPadding=4 cellspacing="1">

          <TBODY>



            

            <start>
<TR>
              <TD colspan="4" bgcolor='#B2B5E5' ><STRONG class="normaltxtb">1. Additional Booking Information</STRONG></TD>

            </TR>

 <TD width="9%" bgcolor="#EEEEEE"></TD>

<TD width="23%" bgcolor="#EEEEEE" class="normaltxt">Location</TD>

<TD bgcolor="#EEEEEE" class="normaltxt">Date</TD>

<TD bgcolor="#EEEEEE" class="normaltxt">Time</TD>

</TR>





            <TR> 

			  <TD width="9%" bgcolor="#EEEEEE" class="smltxtblue"><font color="rgb(229,228,229)">Pick-up &raquo;</font></TD>

              <TD width="23%" bgcolor="#EEEEEE">



<?php

print VehTypeGet( "vehtype", $vehtype );
print "<input type='hidden' name='vehtype' value='$vehtype'>";



$htmltext = '<input type="hidden" name="distFr'.$rc.'" value="'.$req_districtFr.'">';
$htmltext .= '<input type="hidden" name="distTo'.$rc.'" value="'.$req_districtTo.'">';

$htmltext .= '<input type="hidden" name="locFr'.$req_districtFr.'" value="'.$req_locationFr.'">';
$htmltext .= '<input type="hidden" name="locTo'.$req_districtTo.'" value="'.$req_locationTo.'">';

print $htmltext;
?></TD>



            

              <TD width="41%" align=right bgcolor="#EEEEEE">

<?php

print "\n";
$d1 = mktime ( $starttimehrs,$starttimemins,0, $startmonthveh, $startdayveh, $startyearveh );

print date( 'l jS F, Y', $d1 );
print "<input type='hidden' name='startdayveh' value='$startdayveh'>";
print "<input type='hidden' name='startmonthveh' value='$startmonthveh'>";
print "<input type='hidden' name='startyearveh' value='$startyearveh'>";
print "<input type='hidden' name='starttimehrs' value='$starttimehrs'>";
print "<input type='hidden' name='starttimemins' value='$starttimemins'>";
/*
DaySelect( "startdayveh", $startdayveh );

MonthSelect( "startmonthveh", $startmonthveh );

YearSelect( "startyearveh", $startdayveh );
*/

?>			    </TD>

              <TD width="27%" align=right bgcolor="#EEEEEE">

<?php

print "\n";
print date( 'H:i a', $d1 );
//TimeSelect( "starttimehrs", "starttimemins", $starttimehrs, $starttimemins );

?>			    </TD>

            </TR>

            <TR>

			  <TD bgcolor="#EEEEEE" class="smltxtblue"><font color="rgb(229,228,229)">Return &raquo;</font></TD>

              <TD bgcolor="#EEEEEE">

			  

<?php

//VehTypeSelect( "retloc", $retloc );
print VehTypeGet( "vehtype", $retloc );
print "<input type='hidden' name='retloc' value='$retloc'>";

?>			  </TD>



              

              <TD align=right bgcolor="#EEEEEE">

<?php

print "\n";

$d2 = mktime ( $fintimehrs, $fintimemins,0, $finmonth, $finday, $finyear );

print date( 'l jS F, Y', $d2 );
print "<input type='hidden' name='finday' value='$finday'>";
print "<input type='hidden' name='finmonth' value='$finmonth'>";
print "<input type='hidden' name='finyear' value='$finyear'>";
print "<input type='hidden' name='fintimehrs' value='$fintimehrs'>";
print "<input type='hidden' name='fintimemins' value='$fintimemins'>";



/*
DaySelect( "finday", $finday );

MonthSelect( "finmonth", $finmonth );

YearSelect( "finyear", $finyear );
*/

?>				</TD>

              <TD align=right bgcolor="#EEEEEE">



<?php

print "\n";

//TimeSelect( "fintimehrs", "fintimemins", $fintimehrs, $fintimemins );
print date( 'H:i a', $d2 );




?>			    </TD>

            </TR>
            
<TR>
<TD bgcolor="#EEEEEE" class="smltxtblue"><font color="rgb(229,228,229)">Total &raquo;</font></TD>

</TD>
<TD colspan="2" align=right bgcolor="#EEEEEE" style='font-weight: bold; font-size:14px'>
<?php
    if( $bc->NumDays == 1)
    $DaysText = "1 day";
else
    $DaysText = number_format( $bc->NumDays, 0 )." days";
    print $DaysText;
?>

</TD>
<TD bgcolor="#EEEEEE" class="smltxtblue"></TD>
 </TR>  



<!--Get Price -->

			<TR>

			  <TD bgcolor="#EEEEEE" colspan="4" align="center">

<br/>
<?php

include 'booking_costs_tablev5.php';   

//print $bc->CalcString;

?>

</TD>

              </TR>

                          <TR>
<TR><TD bgcolor="#EEEEEE" colspan="4" align='center'>
   
<input type="submit" name="" value="Continue with your Booking" class="button_Black" style='margin-top: 10px;'>

<!--<p style='text-align: left; width: 80%; margin: 6px; padding: 6px;background-color: white; color:black; border: solid 1px black;'>This will transfer you to our 256 bit Secure On-Line Booking Form, all of the information that you send us will be encrypted and transmitted securely.

</p>-->
            
              

<input type="hidden" name="CurrencyId" id="CurrencyId" value="<?php echo $CurrencyId;?>">   
</TD></TR>
</FORM>

              <TD bgcolor="#EEEEEE" colspan="4" align="center">View the prices in a different currency: 
              <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">      
              
<?php
    CurTypeSelect( "CurrencyId", $CurrencyId );
?>   
                <input type="submit" name="hSubmit" value="Go" class="button_Black">


                
       
              </TR></TR>
              </TABLE>
              
<input type="hidden" name="chosenid" id="chosenid" value="<?php echo $ID;?>">
<input type="hidden" name="vehtype" id="vehtype" value="<?php echo $vehtype;?>">  
<?php
print "<input type='hidden' name='startdayveh' value='$startdayveh'>";
print "<input type='hidden' name='startmonthveh' value='$startmonthveh'>";
print "<input type='hidden' name='startyearveh' value='$startyearveh'>";
print "<input type='hidden' name='starttimehrs' value='$starttimehrs'>";
print "<input type='hidden' name='starttimemins' value='$starttimemins'>";
print "<input type='hidden' name='finday' value='$finday'>";
print "<input type='hidden' name='finmonth' value='$finmonth'>";
print "<input type='hidden' name='finyear' value='$finyear'>";
print "<input type='hidden' name='fintimehrs' value='$fintimehrs'>";
print "<input type='hidden' name='fintimemins' value='$fintimemins'>";
print "<input type='hidden' name='retloc' value='$retloc'>";
$htmltext = '<input type="hidden" name="distFr'.$rc.'" value="'.$req_districtFr.'">';
$htmltext .= '<input type="hidden" name="distTo'.$rc.'" value="'.$req_districtTo.'">';

$htmltext .= '<input type="hidden" name="locFr'.$req_districtFr.'" value="'.$req_locationFr.'">';
$htmltext .= '<input type="hidden" name="locTo'.$req_districtTo.'" value="'.$req_locationTo.'">';

print $htmltext;
?> 
</FORM>
           


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

