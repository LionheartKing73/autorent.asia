<link rel="shortcut icon" href="/favicon.ico"/>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #FFFFFF}
.style3 {color: #000}
-->
a{
		color: ;
		text-decoration:none;
	}
	a:hover{
		border-bottom:1px dotted #317082;
		color: #307082;
	}
</style>
<link rel="stylesheet" href="css/bubble-tooltip.css" media="screen">
	<script type="text/javascript" src="js/bubble-tooltip.js"></script>
    <div id="bubble_tooltip">
	<div class="bubble_top"><span></span></div>
	<div class="bubble_middle"><span id="bubble_tooltip_content"></span></div>
	<div class="bubble_bottom"></div>
</div>
   <div id="page">
    <div id="sidebar">
      <div id="logo">
        <h1 align="center"><a href="http://www.ownersabroadthailand.co.uk/">Diamond Car Rentals
        </a></h1>

        <h2 align="center"><a href="http://www.ownersabroadthailand.co.uk/">Indo China Holidays and Tours </a></h2>
        <p align="center"><span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=VWzp20tSKr6DKe0siKmwz1TOicXR0Xk9f3lAwprEOkmdPKS7NeR2nvqStwD"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.godaddy.com/security/website-security.aspx" target="_blank">Website Security</a></span></p>
      </div><!-- end header -->

      <div id="menu">
        <ul>
          <li class="first"><a href="index.php">Home</a></li>

          <li>
       <form method="post" action="index.php">
<input type="hidden" name="poster" value="yes">
              <table align=center border=0 cellpadding="3" cellspacing="2" width="100%">
                <tbody>
				     <tr>
                    <td colspan="3" valign=top  class="smltxtb"><p>PRICES AT A GLANCE &amp; BOOKING REQUEST</p></td>
                  </tr>
                  

	

			     <tr>
                    <td width="160" align="right" valign=top class="smltxtw">Pickup location </td>
                    <td width="298" align=left valign=top >
<?php
VehTypeSelect( "vehtype", $vehtype );
?> </td>
                  </tr>
              
                                   <tr>
                    <td width="160" align="right" valign=top class="smltxtw">Vehicle type </td>
                    <td width="298" align=left valign=top >
<?php

VehClassSelect( $vehclass );
?> </td>
                  </tr>    
  
			                                 <tr>
                    <td width="160" align="right" valign=top class="smltxtw"> Pickup date  </td>
                    <td width="298" align=left valign=top >
<?php
print "\n";
DaySelect( "startdayveh", $startdayveh );
MonthSelect( "startmonthveh", $startmonthveh );
YearSelect( "startyearveh", $startyearveh );
?></td>
                  </tr>
			                                 <tr>
                    <td width="160" align="right" valign=top class="smltxtw"> Pickup time  </td>
                    <td width="298" align=left valign=top >
<?php
print "\n";
TimeSelect( "starttimehrs", "starttimemins", $starttimehrs, $starttimemins );
?></td>
                  </tr>
			                                 <tr>
                    <td width="160" align="right" valign=top class="smltxtw"> <span class="smltxtw">Return date </span><span class="smltxt"></span> </td>
                    <td width="298" align=left valign=top >
<?php
print "\n";
DaySelect( "finday", $finday );
MonthSelect( "finmonth", $finmonth );
YearSelect( "finyear", $finyear );
?></td>
                  </tr>
			                                 <tr>
                    <td width="160" align="right" valign=top class="smltxtw"> Return time  </td>
                    <td width="298" align=left valign=top >
                     

<?php
print "\n";
TimeSelect( "fintimehrs", "fintimemins", $fintimehrs, $fintimemins );


?></td>
                  </tr>
                </tbody>
        </table>
<p class="smltxtw"><a href="bookingtime.html" rel="ibox&height=350" title="FAQ's">A minimum of 24hrs advance booking is required.</a>
  <div align="right"> 
       
                <input type="image" src="img/search.jpg" width="116" height="32" border="0" /><br>
<span><a href="bookingtime.html" rel="ibox&height=350" title="Error"><?php echo $ErrText;?></a>&nbsp;</span><span class="smltxtw">&nbsp;</span></div>
    </form>
          </li>
        </ul>
      </div><!-- end menu -->
    </div>
    <!-- Start of StatCounter Code -->
<script type="text/javascript">
var sc_project=6983692; 
var sc_invisible=1; 
var sc_security="1ccb1ca1"; 
</script>

<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script><noscript><div
class="statcounter"><a title="tumblr visit counter"
href="http://statcounter.com/tumblr/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/6983692/0/1ccb1ca1/1/"
alt="tumblr visit counter" ></a></div></noscript>
<!-- End of StatCounter Code -->
    <!-- end sidebar -->

