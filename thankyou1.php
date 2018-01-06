<?php
// if this is a Form post, and it is OK, then go to the vehicles page
include 'dbheader1.php';
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
  "Holiday Rentals in Thailand - Book our villas in Thailand direct Indo China Holidays and Tours and pay by credit card. Most properties with verified reviews." />
  <meta name="keywords" content=
  "thailand, Villas, holiday homes, vacation rentals, rental homes, holiday villas, villa holiday, vacation rentals by owner, vacation villa, villa rentals, vacation rental, vacation rental homes, rental villas, holiday villas, vacation house rentals, ownersabroadthailand.co.uk" />
  <link href="Style2012.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #FFFFFF; font-size: 129%; }
.style5 {font-size: 12px; }
-->
  </style>
</head>

<body><div id="page">
  <?php
require( 'Includes/SiteBodyHeadv3.php') ;
?>
<!-- content  starts -->   
   


      <div class="boxed">
                                    <h1 class="title2">Thank You for Contacting  Diamond Car Rentals </h1>
                            
                                    <p>Your message has been received and one of our staff will contact you within 24 hours to discuss your requirements. </p>
                                    <p>Feel Free to browse our other websites:</p>
        <p><a href="http://www.ownersabroadthailand.co.uk">www.ownersabroadthailand.co.uk </a></p>
        <p><a href="http://www.playgolfholidays.co.uk">www.playgolfholidays.co.uk</a></p>
        <p><a href="http://www.bestpricegreenfees.com">www.bestpricegreenfees.com </a></p>
      </div>

                                          <div class="boxed orange">
                                                                                        <div class="col-one">
                                                                                          <h2 class="title3">Clients Testimonials </h2>
                                                                                
                                                                                          <ul><li>
                                                                                            <p>Thank you Diamond Car Rental, your splendid service  following a 20 hour journey from Europe was really appreciated. Richard Cranum,  Kensington.</p>
                                                                                          </li>
                                                                                            <li>
                                                                                              <p>Our first trip to Thailand was a pure delight, Indo China Holidays and Tours and Diamond Car Rental provided really good service, we will  definitely be back.&nbsp; Andrew McAllister,  Perth.</p>
                                                                                            </li>
                                                                                            <li>
                                                                                              <p>Our Toyota Alphard was just the right choice; being met by  someone who spoke excellent English at Bangkok airport at 2.00am helped us off  to a good start, great directions from the agent eased our worries on the  journey to our vacation rental home in Hua Hin. Excellent service from Indo China Holidays and Tours. Steve Jones &amp; family, Beijing.</p>
                                                                                            </li>
                                                                                            <li>
                                                                                              <p>A fabulous golfing holiday, thank you Diamond Car Rental  &amp; Play Golf Holidays, our package worked really well and the minibus was  roomy and very comfortable; see you again later this year, Atlas Financial golf  society, Singapore.</p>
                                                                                            </li>
                                                                                          </ul>
                                                                                        </div>
                                    
                                                                                        <div class="col-two">
                                                                                          <h2 class="title3">&nbsp;</h2>
                                                                                
                                                                                          <ul>
                                                                                            <li><a href="#"></a>We will definitely rent from Diamond Car Rental every time  now. On our last visit to our holiday home in Pattaya a drunken driver hit the  car and drove away without stopping, the immediate response from the 24hour  insurance office and the attendance of a member of the insurance staff at the  police station was just what we needed. Thank you, Kjell Gustafson, Stockholm.<br />
                                                                                              <br />
                                                                                            </li>
                                                                                            <li> Just got back from a great golfing weekend, thank you  Diamond Car Rental &amp; Play Golf Holidays, we will definitely be back soon.  The guys at Asia Trading, Hong Kong.<br />
                                                                                              <br />
                                                                                            </li>
                                                                                            <li>Having a holiday home in Hua Hin is just great, using  Diamond Car Rental for our limousine transfers and car rental has made it a  real pleasure; keep up the friendly &amp; efficient service guys, Ronnie &amp;  family, Dubai.&nbsp; </li>
                                                                                          </ul>
                                                                                        </div>
                                    
                                            <div style="clear: both;"></div>
                                          </div>
   

  <!--content end -->


<?php
require( 'Includes/SiteBodyFootv3.php') ;   
?>




</body>
</html>
