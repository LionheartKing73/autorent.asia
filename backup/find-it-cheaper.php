<?php
// if this is a Form post, and it is OK, then go to the vehicles page
include 'includes/DCRheader.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
  <meta http-equiv="content-type" content="text/html; charset=us-ascii" />

  <title>Car Rentals <?php echo $Country->Rec["country_name"]?> - Diamond Car Rentals</title>
<?php
  include 'Includes/metatags.php';
?>
  <link href="Style2013.css" rel="stylesheet" type="text/css" />
  

  
  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

   <style type="text/css">
   
   .box p
   {
       padding: 4px;
   }
   
   </style>



</head>

<body <?php echo $onload_js;?> >

  <?php
require( 'Includes/DCRBodyHeadv1.php') ;

// Need to set the default Currency to the country currency
$CurrencyId = $Country->Rec["currencies_id"] ;



/*
?>
<!-- Place this tag where you want the +1 button to render. -->
<!--
<div class="g-plusone" data-annotation="inline" data-width="300"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<h1 style='color: rgb( 255,0,0)'> <img src='/Includes/HomePages/<?php echo $Country->Rec["country_subdomain"]."/".$Country->Rec["country_subdomain"].".png"?>' alt='<?php echo $Country->Rec["country_subdomain"]?>'/>  CHEAP  CAR  RENTAL IN <?php echo strtoupper( $Country->Rec["country_name"])?></h1>.

 


<br/>
<br/>


<?php
   
*/

?>

<div class='box' style='margin-left: 80px; margin-right: 80px;' >
<h1>Find it Cheaper</h1>

<p>Diamond Car Rental operates a best price guarantee and promises that if you find a better like for like
part pre-paid rental price before or after booking, but at least 72hrs before your pick up time, we will
beat that price. 

<p>The guarantee applies to all part pre-paid rental prices offered on like for like car hires
by other independent car rental brokers using comparable suppliers. It is valid before or after booking
up until 72hrs before the rental start time. 

<p>The guarantee does not apply to any promotional offers, nor to prices offered by websites not operated directly by an on-line car rental broker, or from call centre’s
or direct offers from companies with whom we do not have a business arrangement. 

<p>Diamond Car Rental will wish to verify the terms and conditions of the alternative offer, including: the supplier, the
car type, the prices, insurance cover & excess and terms and conditions. 

<p>The competitors quote must be the same in all respects, for example, where we have quoted including Premium or Super Loss damage
waiver the comparable quote must be for the same insurance cover, or where the comparable quote
requires you to pay all of the balance immediately or some time prior to your collection time and not at
arrival time. 

<p>Therefore please ensure that you advise us of all of the competitor’s details, especially the
name of the competitor, without these full details we are unable to compare quotes. 


<p>Verification may take some time to complete, when we have compared the details we will contact you by e-mail.
 </div> 
<?php

require( 'Includes/DCRBodyFootv1.php') ;   
?>


</body>
</html>
