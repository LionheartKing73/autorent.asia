<?php
// if this is a Form post, and it is OK, then go to the vehicles page
include 'includes/DCRheader.php'; 
if ( $_REQUEST["poster"] == "yes" )
{
 if ( ! is_numeric( $fintimemins ) )
	$posterr=true ;
 if ( ! $fintimehrs  ) 
	$posterr=true ;
 if ( ! $finyear ) 
	$posterr=true ;
 if ( ! $finmonth  ) 
	$posterr=true ;
 if ( ! $finday  ) 
	$posterr=true ;

 if ( ! is_numeric( $starttimemins  ) ) 
	$posterr=true ;
 if (!  $starttimehrs  ) 
	$posterr=true ;
 if (! $startyearveh  ) 
	$posterr=true ;
 if ( ! $startmonthveh  ) 
	$posterr=true ;
 if ( ! $startdayveh  ) 
	$posterr=true ;

if ( $vehtype == 'Please Select' )
		$posterr=true ;

if ( $posterr )
	$ErrText = "You must complete ALL form fields.";
else
	header( "Location: vehicles1.php?vehtype=$vehtype".$fqs );

}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
  <meta http-equiv="content-type" content="text/html; charset=us-ascii" />

  <title>Car Rentals Thailand - Diamond Car Rentals</title>
  <meta name="description" content=
  "Holiday Rentals in Thailand - Book our villas in Thailand direct owners abroad thailand and pay by credit card. Most properties with verified reviews." />
  <meta name="keywords" content=
  "thailand, Villas, holiday homes, vacation rentals, rental homes, holiday villas, villa holiday, vacation rentals by owner, vacation villa, villa rentals, vacation rental, vacation rental homes, rental villas, holiday villas, vacation house rentals, ownersabroadthailand.co.uk" />
  <link href="Style2013.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #FFFFFF; font-size: 129%; }
.style5 {font-size: 12px; }
.style6 {color: #000000}
.style7 {color: #FFFFFF; font-weight: bold; }
-->
  </style>
</head>

<body><div id="page">
  <?php

require( 'Includes/DCRBodyHeadv1.php') ;   

?>
     <div class='box' style='margin-left: 80px; margin-right: 80px;' > 
                                    <h1 class="title2">Contact Diamond Car Rentals </h1>
                            
                                    <p>The quickest and easiest way to to email us directly to: <a href="mailto:info@diamondcarrental.co.uk">info@diamondcarrental.co.uk</a> or simply fill out the form below and one of our friendly staff will contact you back within 24 hours. </p>
                                    <div class="boxed orange">
                                      <form method="post" action="/webformmailer.php">
                                        <input type="hidden" name="recipient" value="info@diamondcarrental.co.uk" />
                                        <input type="hidden" name="redirect" value="/thankyou1.php" />
                                        <table cellspacing="2" cellpadding="3" width="90%" align="center">
                                          <tbody>
                                            <tr bgcolor="#3e7cb9">
                                              <td colspan="2" align="right" valign="top" bgcolor="#102540"><div align="left" class="style7">Contact Us </div></td>
                                            </tr>
                                            <tr>
                                              <td bgcolor="#102540" valign="top" width="160" align="right"><span class="style7">Your Name: </span></td>
                                              <td align="left" valign="top" bgcolor="#920005"><input name="name" type="text" id="your name" size="35" maxlength="100" autocomplete="OFF" /></td>
                                            </tr>
                                            <tr>
                                              <td bgcolor="#102540" valign="top" width="160" align="right"><span class="style7">Your Email: </span></td>
                                              <td align="left" valign="top" bgcolor="#920005"><input name="email" type="text" id="Your Email:" size="35" maxlength="100" autocomplete="OFF" /></td>
                                            </tr>
                                            <tr>
                                              <td bgcolor="#102540" valign="top" width="160" align="right"><span class="style7">Telephone:</span></td>
                                              <td align="left" valign="top" bgcolor="#920005"><input name="Telephone" type="text" id="Telephone" size="35" maxlength="16" autocomplete="OFF" /></td>
                                            </tr>
                                            <tr>
                                              <td bgcolor="#102540" valign="top" width="160" align="right"><span class="style7">Information:</span></td>
                                              <td align="left" valign="top" bgcolor="#920005"><label>
                                                <textarea name="Information" cols="35" rows="5" id="Information"></textarea>
                                              </label></td>
                                            </tr>
                                            <tr bgcolor="#3e7cb9">
                                              <td colspan="2" align="right" valign="top" bgcolor="#920005"><span class="style6"></span></td>
                                            </tr>
                                            <tr>
                                              <td width="160" align="right" valign="top" bgcolor="#920005"><span class="style6"></span></td>
                                              <td align="left" valign="top" bgcolor="#920005"><span class="style6">
                                                <label>
                                                <input type="submit" name="Submit" value="Submit" />
                                                </label>
                                                <label>
                                                <input type="reset" name="Reset" value="Reset" />
                                                </label>
                                              </span></td>
                                            </tr>

                                          </tbody>
                                        </table>
                                                                              </form>



			
                                    <table align="center" cellpadding="0" cellspacing="0">

                                      <tr>
                                        <td><p><strong>Office:</strong></p>
<p>Diamond Car Rental.<br />
                                          52-160 City Road.<br />
London EC1V 2NX.<br />

United Kingdom.</p></td>
                                      </tr>


                                    </table>
                                    <p></p>
                                     <table align="center" cellpadding="0" cellspacing="0">                                   
                                    <tr><td>London:</td><td>+44 203 5145548</td></tr>
 <tr><td>Sydney:</td><td>+61 87 100 1231</td></tr>
 <tr><td>Bangkok:</td><td>+66 87 090 4711</td></tr>
                                     </table>
      </div>


  <!--content end -->


<?php

require( 'Includes/DCRBodyFootv1.php') ;   
?>




</body>
</html>
