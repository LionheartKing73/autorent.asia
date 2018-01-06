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
<h1>No Hidden Extras Guaranteed.</h1>
<br/>


We guarantee that there should be no hidden extras. When you have chosen your car click where it
says: “Book Now” this will open the page where we have listed all of the insurance details and the
available extras like GPS and child seats, with their costs and other costs such as arrivals and departures
out of hours.
<br/>
<br/>
<br/>

 </div> 
<?php

require( 'Includes/DCRBodyFootv1.php') ;   
?>


</body>
</html>
