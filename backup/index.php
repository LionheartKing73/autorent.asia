<?php
// if this is a Form post, and it is OK, then go to the vehicles page

include 'Includes/DCRheader.php';


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
if ( $vehclass )
    $vc_str="&class=".$vehclass;
if ( $insurance )
    $vc_str.="&insurance=".$insurance;


    
// Check Start and End Dates
$nPickupDate = mktime( $starttimehrs, 0, 0,$startmonthveh,$startdayveh, $startyearveh );
$nDropOffDate = mktime( $fintimehrs, 0, 0,$finmonth,$finday, $finyear );


if ( $posterr )
    $ErrText = "You must complete ALL form fields.";
elseif ( $nPickupDate < $day2after - ( 60 * 60 ) )
{
    $ErrText = "We are sorry but we appear to have no vehicles to suit your request. This maybe because we have no vehicles of the type that you have chosen at that location. Please try selecting a different vehicle type or location. ";
    $ErrText .= "If you are trying to book a one way rental it maybe that the car you have chosen is not available for a one way rental between your two selected locations. Please try selecting a different vehicle."; 
    $ErrText .= "If you are still experiencing difficulties please return to the home page and contact us using the contact us button or by telephone.";
}
elseif ( $nPickupDate >= $nDropOffDate)
    $ErrText = "Sorry, return date must be after pickup date.";


    if ( $_REQUEST["country_subdomain"])
    {
        $xURL="http://".$_REQUEST["country_subdomain"].".diamondcarrental.co.uk/";
        $vehtype=$_REQUEST["vehtype".$_REQUEST["country_subdomain"]];
        

    }
    if ( $_REQUEST["distformFlag"])
    {
         $rc = $_REQUEST["country_subdomain"];
         $req_districtFr = $_REQUEST["distFr".$rc] ;
         $req_districtTo = $_REQUEST["distTo".$rc] ;
 
        $vc_str.="&distFr".$rc."=".$req_districtFr;
        
        
         $req_locationFr = $_REQUEST["locFr".$req_districtFr] ;
         $req_locationTo = $_REQUEST["locTo".$req_districtTo] ;
     
        $vc_str.="&locFr".$req_districtFr."=".$req_locationFr;
             
         $vehtype=$req_locationFr;
         $retloc=$req_locationTo;


    }
    else
    {
        $retloc=$_REQUEST["retloc".$_REQUEST["country_subdomain"] ];
    }
    //var_dump($_REQUEST[ "DiffLocChecked"] );
    
    if ( $_REQUEST[ "DiffLocChecked"] == "0")
    {
        $retloc = $vehtype;
        $vc_str.="&distTo".$rc."=".$req_districtFr;
        $vc_str.="&locTo".$req_districtFr."=".$req_locationFr;      
    }
    else
    {
        $vc_str.="&distTo".$rc."=".$req_districtTo;
        $vc_str.="&locTo".$req_districtTo."=".$req_locationTo; 
    }
    
    $vc_str.="&retloc=".$retloc;

$xURL = "http://autorent.asia/";
//$xURL = "http://127.0.0.1/DCR/";
    
if ( $ErrText )
    $onload_js = 'onload="alert ( \''.$ErrText.'\' )"';
else
    header( "Location:  "."$xURL"."available_vehicles.php?vehtype=$vehtype".$vc_str.$fqs );  

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
  <meta http-equiv="content-type" content="text/html; charset=us-ascii" />

  <title>Autorent Asia</title>
<?php
  include 'Includes/metatags.php';
    include 'includes/head1967.php'; 
?>
  <link href="Style2013.css" rel="stylesheet" type="text/css" />
  
    
  <script type="text/javascript" src="js/jquery.carouFredSel-6.1.0.js"></script>
  
  <script type="text/javascript">

$(function() {



                //    Scrolled by user interaction
                $('#foo2').carouFredSel({
                    auto: false,
                    prev: '#prevBing',
                    next: '#next2',
                    pagination: "#pager2",
                    mousewheel: true,
                    swipe: {
                        onMouse: true,
                        onTouch: true
                    }
                });



            });
            
            
             $(document).ready(function() {
             $('.Locations').hide();
             $('#Loc'+$('#country').attr('value')).show();
             $('#RetLoc'+$('#country').attr('value')).show();             
             $('#country').change( function()
                {

                   $('.Locations').hide();
                   $('#Loc'+$(this).attr('value')).show();
                   $('#RetLoc'+$(this).attr('value')).show();
                } )  ;  
                    });
            function ShowLoc()
            {
            	document.getElementById('DiffLocChecked').value = "1";
            	
                document.getElementById('RetLocTD').style.display = "block";
                document.getElementById('DiffLoc').style.display = "block";
                document.getElementById('DiffLocChoose').style.display = "none";
                
            }
       
</script> 
  

  

        <style type="text/css" media="all">
            html, body {
                padding: 0;
                margin: 0;
                /* height: 100%; */
            }
            body, div, p {
                font-family: Arial, Helvetica, Verdana;
                color: #333;
            }
            body {
                background-color: #eee;
            }

            a, a:link, a:active, a:visited {
                color: black;
                text-decoration: underline;
            }
            a:hover {
                color: #9E1F63;
            }
            #intro {
                width: 580px;
                margin: 0 auto;
            }
            .wrapper {
                background-color: white;
                width: 480px;
                margin: 40px auto;
                padding: 50px;
                box-shadow: 0 0 5px #999;
            }
            .list_carousel {
                background-color: white;
                margin: 0px;
                width: 388px;
                
            }
            .list_carousel img
            {
                   height: 46px;
                                    display: block;
                float: left;

            }
            .list_carousel ul {
                margin: 0;
                padding: 0;
                list-style: none;

            }
            .list_carousel li {

                text-align: center;
                background-color: #eee;
  
                padding: 0;
                 display: block;
                float: left;
            }
            .list_carousel.responsive {
                width: auto;
                margin-left: 0;
            }
            .clearfix {
                float: none;
                clear: both;
            }
            .prev {
display: block;
                
                margin-right: 5px;  

            }
            .next {

                     margin-left: 5px;       
            }
            .pager {
                float: left;
                width: 300px;
                text-align: center;
            }
            .pager a {
                margin: 0 5px;
                text-decoration: none;
            }
            .pager a.selected {
                text-decoration: underline;
            }
            .timer {
                background-color: #999;
                height: 6px;
                width: 0px;
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

<div id='RightCol' style='display: block;width: 470px;  float: right;'>     

<div id='Suppliers' style='padding-top: 8px; ' class='box'>

<?php
if  ( $Country->Rec["country_id"] ==  1 )
{
	
	?>

<img width='60px' alt='Budget'src="images/Home/Budget.jpg" />
<img width='60px' alt='National'src="images/Home/national_logo_lrg.gif" />
<img width='60px' alt='Europcar'src="images/Home/Europcar.jpg" /> 
<img width='60px' alt='Hertz'src="images/Home/Hertz.jpg" />
<img width='60px' alt='Sixt'src="images/Home/Sixt.jpg" />
<img width='50px' alt='Sixt'src="images/Home/Siam-Car-Rentals.png" />
<img width='60px' alt='TRAC'src="images/Home/TRAC_logo.gif" /> 
<?php
}
else
{
	?>
<img width='60px' alt='Alamo'src="images/Home/Alamo.jpg" />
<img width='60px' alt='Avis'src="images/Home/Avis.jpg" />   
<img width='60px' alt='Budget'src="images/Home/Budget.jpg" />
<img width='60px' alt='Europcar'src="images/Home/Europcar.jpg" />    
<img width='60px' alt='Hertz'src="images/Home/Hertz.jpg" />
<img width='60px' alt='Sixt'src="images/Home/Sixt.jpg" />
<img width='60px' alt='Thrifty'src="images/Home/Thrifty.jpg" /> 	
	
	<?php
}
?>
<!--
 
<a style="padding-left: 1px; display: inline; float: left;" class="prev" href="#" id="prevBing"><img  height='42px' width='32px'  style='display: block; float: left; height: 42px; width: 32px' border=0 alt="Prev" src="images/Carousel/prev.png" /></a>      
<a  style='padding-right: 1px; float: right; display: inline' class="next" id='next2' href="#"><img height='42px' width='32px' style='display: block; height: 42px; width: 32px' border=0 alt="next" src="images/Carousel/next.png" /></a>       
                
<div class="list_carousel" style=" float: right; display: inline;" >


                <div style="display: inline; text-align: start;float: left; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: 388px;  margin: 0px; overflow: hidden; cursor: move;" class="caroufredsel_wrapper">
            


                     
                <ul style="text-align: left; margin: 0px;  width: 831px;  z-index: auto;" id="foo2">
                
<li><img alt='Sixt' width='98px;' height='46px' src="images/Carousel/sixt-46.png" /></li> 

 
<li><img alt='Hertz' width='138px;' height='46px' src="images/Carousel/hertz-46.png" /></li>  

<li><img alt='Budget' width='127px;' height='46px' src="images/Carousel/budget-46.png" /></li> 
<li><img alt='Avis' width='138px;' height='46px' src="images/Carousel/avis-46.png" /></li>
  


           <li><img alt='Alamo'  width='103px;'  height='46px' src="images/Carousel/alamo-46.png" /></li>  
<li><img alt='NCR' width='106px;' height='46px' src="images/Carousel/ncr-46.png" /></li>  
<li><img alt='Enterprise' width='230px;' height='46px' src="images/Carousel/enterprise-46.png" /></li>  
<li><img alt='Europcar' width='180px;' height='46px' src="images/Carousel/europcar-46.png" /></li> 
<li><img alt='Thrifty' width='115px;' height='46px' src="images/Carousel/thrifty-46.png" /></li> 
 
                

          
                </ul>
          
   
                </div>
  

      
                  
  

            </div>
  -->
            </div>

 
<div id="Bottom">

<div id='Deals' class='box' style='padding-top: 20px'>

<table width='100%'>
<tr><td valign='top' class='Deal-Location'>Economy 4/5dr Auto</td><td valign='top' align='right'>daily from just <span class='Deal-Price'>8.48GBP</span></td><td><img width='62px' src='images/DealCars/car1.png'></td></tr>
<tr><td colspan='3'><hr/></td></tr>
<tr'><td valign='top' class='Deal-Location'>Compact 4/5dr Auto</td><td valign='top' align='right'>daily from just <span class='Deal-Price'>12.36GBP</span></td><td><img width='62px' src='images/DealCars/car2.png'></td></tr>
<tr><td colspan='3'><hr/></td></tr>
<tr><td valign='top' class='Deal-Location'>2dr x 2wd Xtracab</td><td valign='top' align='right'>daily from just <span class='Deal-Price'>18.30GBP</span></td><td><img width='62px' src='images/DealCars/car3.png'></td></tr>
<tr><td colspan='3'><hr/></td></tr>
<tr><td valign='top' class='Deal-Location'>SUV 5/5 Seat Auto</td><td valign='top' align='right'>daily from just <span class='Deal-Price'>18.31GBP</span></td><td><img width='62px' src='images/DealCars/car4.png'></td></tr>
<tr><td colspan='3'><hr/></td></tr>
<tr><td valign='top' class='Deal-Location'>12/15 Seat Minibus</td><td valign='top' align='right'>daily from just <span class='Deal-Price'>15.55GBP</span></td><td><img width='62px' src='images/DealCars/car5.png'></td></tr>
</table>

</div>
<div id='Highlights' class='box' >

<h1 class='Banner' style='text-align: center;'>ALL OF OUR PRICES INCLUDE ALL LOCAL AND NATIONAL TAX &amp; VAT</h1>

<ul style='margin-left: 18px; margin-top: 15px'>
<li>SAVE BIG money, book online now</li>
<li>U find it cheaper WE will BEAT it</li>
<li>NO hidden extras Guaranteed</li>
<li>EASY online booking CLEAR pricing</li>
</ul>

</div>


</div>


<?php
ini_set( 'display_errors', 'Off' );

/*
if ( ! include( 'includes/HomePages/'.$Country->Rec["country_subdomain"].".php" ) )
    require( "includes/HomePages/main.php" );  
    */
?>
    </div>
<div id='LeftCol' class='box' style='display: block;'>
<?php
 include "Includes/searchboxOWC.php";
?>
       


      </div><!-- end menu -->




</div>

<?php

require( 'Includes/DCRBodyFootv1.php') ;   
?>


</body>
</html>
