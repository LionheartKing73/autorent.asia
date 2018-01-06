<?php
// if this is a Form post, and it is OK, then go to the vehicles page
include 'Includes/DCRheader.php';

// The booking will be coming from the www site but we should try to hold onto the country 
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


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
  <meta http-equiv="content-type" content="text/html; charset=us-ascii" />


  <title>Autorent Asia: Booking Confirmed</title>
<?php
  include 'Includes/metatags.php';
  include 'Includes/head1967.php';  
?>
  <link href="Style2013.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #FFFFFF; font-size: 129%; }
.style5 {font-size: 12px; }
-->
  </style>
</head>

<body>
  <?php
require( 'Includes/DCRBodyHeadv1.php') ;   
require( 'Includes/DCRInnerBodyHeadv1.php') ; 
?>
<!-- content  starts -->   


 <div style='padding: 5px'> 
<h1  class="Banner">Thank You</h1>
                              
      <br/>
                                   
 <p>Thank you for booking your rental car with Diamond Car Rental, your voucher and the receipt for your booking deposit will follow shortly.
<p>This may take up to 12 hours, please check your e-mail inbox and your spam or junk boxes.
<p>If there is anything else we can help you with please do not hesitate to us by e-mail at: 
<a href="mailto:info@diamondcarrental.co.uk">info@diamondcarrental.co.uk.</a>
                              
      <br/>
      <br/>  
<p>Thank you kindly for your business and we look forward to serving yourself, your family and your friends in the future.
                               
      <br/>
      <br/>  
<p>Diamond Car Rental.
<p><em>Your personal car rental assistant in over 2500 locations in Europe, the Asia Pacific, Australasia, Japan, Fiji & Sri Lanka.</em>
       <br/>
      <br/>  
       <br/>
      <br/>                             
</div>

   

<?php
require( 'Includes/DCRInnerBodyFootv3.php') ;  
require( 'Includes/DCRBodyFootv1.php') ;  
?>

<!-- Google Code for bookings Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1009386266;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "XSHGCPal7QIQmoao4QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1009386266/?label=XSHGCPal7QIQmoao4QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


</body>
</html>
