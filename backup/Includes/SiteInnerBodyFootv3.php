    </div>
<div id='LeftCol' style='display: block;  width: 260px; background-color: rgb(235,241,222)'>

        <div id="menu">
        <ul>
          <li class="first"><a href="country.php" class='smltxtw'>Home</a></li>
		<li class="first"><a href="http://www.diamondcarrental.co.uk/index.php"  class='smltxtw'>Choose another country</a></li>
          <li>
       <form method="post" action="country.php">
<input type="hidden" name="poster" value="yes"/>
              <table align='center' border='0' cellpadding="3" cellspacing="0" width="240px">
                <tbody>
                     <tr>
                    <td colspan="3" valign='top'  class="smltxtb"><p>PRICES AT A GLANCE &amp; BOOKING REQUEST</p></td>
                  </tr>
                  
                 <tr>
                    <td width="160" align="right" valign='top' class="smltxtw">Currrency </td>
                    <td width="298" align='left' valign='top' >
<?php

CurTypeSelect( "CurrencyId", $CurrencyId );
?> 
</td>
                  </tr>
    

                 <tr>
                    <td width="160" align="right" valign='top' class="smltxtw">Pickup location </td>
                    <td width="298" align='left' valign='top' >
<?php
VehTypeSelect( "vehtype", $vehtype );
?> </td>
                  </tr>
              
                                   <tr>
                    <td width="160" align="right" valign='top' class="smltxtw">Vehicle type </td>
                    <td width="298" align='left' valign='top' >
<?php

GetClassRadioButtons( $vehclass ) ;

?> </td>
                  </tr>    
  
                                             <tr>
                    <td width="160" align="right" valign='top' class="smltxtw"> Pickup date  </td>
                    <td width="298" align='left' valign='top' >
<?php
print "\n";
DaySelect( "startdayveh", $startdayveh );
MonthSelect( "startmonthveh", $startmonthveh );
print "<br/>";
YearSelect( "startyearveh", $startyearveh );
?></td>
                  </tr>
                                             <tr>
                    <td width="160" align="right" valign='top' class="smltxtw"> Pickup time  </td>
                    <td width="298" align='left' valign='top' >
<?php
print "\n";
TimeSelect( "starttimehrs", "starttimemins", $starttimehrs, $starttimemins );
?></td>
                  </tr>
                 <tr>
                    <td width="160" align="right" valign='top' class="smltxtw">Return location </td>
                    <td width="298" align='left' valign='top' >
<?php
VehTypeSelect( "retloc", $retloc );
?> </td>
                  </tr>
                                             <tr>
                    <td width="160" align="right" valign='top' class="smltxtw"> <span class="smltxtw">Return date </span><span class="smltxt"></span> </td>
                    <td width="298" align='left' valign='top' >
<?php
print "\n";
DaySelect( "finday", $finday );
MonthSelect( "finmonth", $finmonth );
print "<br/>";
YearSelect( "finyear", $finyear );
?></td>
                  </tr>
                                             <tr>
                    <td width="160" align="right" valign='top' class="smltxtw"> Return time  </td>
                    <td width="298" align='left' valign='top' >
                     

<?php
print "\n";
TimeSelect( "fintimehrs", "fintimemins", $fintimehrs, $fintimemins );


?></td>
                  </tr>
                </tbody>
        </table>

  <div align="right"> 
       
                <input type="image" src="img/search.jpg"/>
<br/>
<span style='color: white'>
<?php echo $ErrText;?>&nbsp;</span>
</div>
    </form>
          </li>
        </ul>
<div style='text-align: center; margin-bottom: 26px'>
<a href='contact-us.php' class='smltxtw'>CONTACT US</a>
</div>

<div style='text-align: center; width: 100%'>
<img src="img/payments.png" alt='Payments' border="0"/>
 </div>
      </div><!-- end menu -->




</div>
