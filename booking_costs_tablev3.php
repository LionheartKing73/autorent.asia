<?php

print "<table border='0' width=85%'>";

print "<tr><td colspan='3'><h3><strong>NOW FOR THE GOOD NEWS</strong></h3></td></tr>";

print "<tr bgcolor='#DDDDE5'><td align='left' colspan='2' width='75%'><strong>Our usual  LOW  walk in rate is just &nbsp;&nbsp;</strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $bc->WalkinPrice, 2 )."</td></tr>";
if ( $bc->OWCprice)
{
	
	print "<tr bgcolor='#DDDDE5'><td align='left' colspan='2' width='75%'><strong>This includes a suppliers one way drop fee&nbsp;&nbsp;</strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $bc->OWCprice, 2 )."</td></tr>";
}
print "<tr bgcolor='#DDDDE5'><td align='left' colspan='2'><strong>Booking on-line now will save you at least 25%</strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $bc->WalkinPrice - $bc->OnlinePrice, 2 )."</td></tr>";

print "<tr  bgcolor='#AEA3D3'><td align='left' colspan='2'><strong>Book on-line now for our really low promotional price &nbsp;&nbsp;</strong><br/>Including unlimited mileage, self drive insurance, no cancellation fees and no amendment fees.</strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $bc->OnlinePrice, 2 )."</td></tr>";
?>



<?php
print "<tr><td colspan='3'><h3><strong>AND NOW EVEN MORE GOOD NEWS</strong></h3></td></tr>";

if ( $bc->BookingBalance && $price > $bc->BookingBalance )

{

    $deposit = ($price - $bc->BookingBalance - $bc->OWCprice ) + $bc->Extras;


    print "<tr bgcolor='#DDDDE5'><td align='left' colspan='2'><strong>To guarantee your booking at this  INCREDIBLY LOW price you just pay this now &nbsp;&nbsp; </strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $deposit, 2 )."</h4></td></tr>"; 

    print "<tr bgcolor='#DDDDE5'><td align='left' colspan='2'><strong>Then you pay the balance of this  REALLY LOW  price when you collect the car &nbsp;&nbsp;</strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $bc->BookingBalance +$bc->OWCprice , 2 )."</h4></td></tr>"; 

}




//print "<tr bgcolor='#D2A3D3'><td align='left' colspan='2'><strong>So our unbelievably  LOW PRICE";
 
//print " is just &nbsp;&nbsp;</strong></td><td align='right'><h4>".$bc->CurrencyCode." ".number_format( $price, 0 )."</h4></td></tr>";
?>
            <TR><TD colspan="3"><br/><br/></TD></TR>

  <?php  
  
  if ( $Country->Rec["country_id"] < 0   )
  {        
    if ( $bc->Insurance )
    {   
    ?>  
            <TR>

              <TD bgcolor="#DDDDE5" class="smltxtblue"><font color="#DEA2F9">Optional Super Damage Waiver Insurance:</font></TD>
                            <TD ="#DDDDE5">
              No: <INPUT TYPE=RADIO NAME='hOptWaiver' " VALUE='0' <?php echo $OptWaiverUnselected?>  >&nbsp;&nbsp;Yes:
              <INPUT TYPE=RADIO NAME='hOptWaiver' " VALUEVALUE='1' <?php echo $OptWaiverSelected?> > 
               </TD>
               
               <TD ALIGN='RIGHT'>
<?php

    print $bc->CurrencyCode." ";
    print number_format($bc->Insurance,2);

?>
               </TD>

            </TR> 
<?php
}
    if ( $bc->OptAccidentCost )
    {
?>
            <TR>

              <TD bgcolor="#DDDDE5" class="smltxtblue"><font color="#DEA2F9">Optional Personal Accident Insurance:</font></TD>
                            <TD  bgcolor="#DDDDE5">
              No: <INPUT TYPE=RADIO  " NAME='hOptAccident' VALUE='0' <?php echo $OptAccidentUnselected?>  >&nbsp;&nbsp;Yes:
              <INPUT TYPE=RADIO " NAME='hOptAccident' VALUE='1' <?php echo $OptAccidentSelected?> > 
               </TD>
               <TD ALIGN='RIGHT'>
<?php


    print $bc->CurrencyCode." ";
    print number_format($bc->OptAccidentCost,2);

?>
               </TD>
            </TR> 
 <?php
    } // If there is Accident cover available
        if ( $bc->OptChildSeatCost )
    {
?>           
             <TR>

              <TD bgcolor="#DDDDE5" class="smltxtblue"><font color="#DEA2F9">Optional Child Seat:</font></TD>
                            <TD  bgcolor="#DDDDE5">
              No: <INPUT TYPE=RADIO  NAME='hOptChildSeat' VALUE='0' <?php echo $OptChildSeatUnselected?>  >&nbsp;&nbsp;Yes:
              <INPUT TYPE=RADIO NAME='hOptChildSeat' VALUE='1' <?php echo $OptChildSeatSelected?> > 
               </TD>
               <TD ALIGN='RIGHT'>
<?php

    print $bc->CurrencyCode." ";
    print number_format($bc->OptChildSeatCost,2);

?>
            </TD>
            </TR> 
<?php
    } // If there are ChildSeats available
        if ( $bc->OptChildSeatCost )
    {
?>             
             <TR>

              <TD bgcolor="#DDDDE5" class="smltxtblue"><font color="#DEA2F9">Second Child Seat:</font></TD>
                            <TD  bgcolor="#DDDDE5">
              No: <INPUT TYPE=RADIO NAME='hOptChildSeat2' VALUE='0' <?php echo $OptChildSeat2Unselected?>  >&nbsp;&nbsp;Yes:
              <INPUT TYPE=RADIO NAME='hOptChildSeat2' VALUE='1' <?php echo $OptChildSeat2Selected?> > 
               </TD>
               <TD ALIGN='RIGHT'>
<?php

    print $bc->CurrencyCode." ";
    print number_format($bc->OptChildSeatCost,2);

?>
            </TD>
            </TR>   
  <?php
    } // If there are ChildSeats available
        if ( $bc->OptGpsThCost )
    {
?>             
            <TR>

              <TD bgcolor="#DDDDE5" class="smltxtblue"><font color="#DEA2F9">Optional Thai Language GPS:</font></TD>
                            <TD  bgcolor="#DDDDE5">
              No: <INPUT TYPE=RADIO  NAME='hOptGpsTh' VALUE='0' <?php echo $OptGpsThUnselected?>  >&nbsp;&nbsp;Yes:
              <INPUT TYPE=RADIO NAME='hOptGpsTh' VALUE='1' <?php echo $OptGpsThSelected?> > 
               </TD>
                              <TD ALIGN='RIGHT'>
<?php


    print $bc->CurrencyCode." ";
    print number_format($bc->OptGpsThCost,2);

?>
               </TD>
<?php
    } // If there are Thau GPS available
        if ( $bc->OptGpsEnCost )
    {
?> 
            </TR>                     
              <TR>

              <TD bgcolor="#DDDDE5" class="smltxtblue"><font color="#DEA2F9">Optional English Language GPS:</font></TD>
                            <TD  bgcolor="#DDDDE5">
              No: <INPUT TYPE=RADIO  NAME='hOptGpsEn' VALUE='0' <?php echo $OptGpsEnUnselected?>  >&nbsp;&nbsp;Yes:
              <INPUT TYPE=RADIO  NAME='hOptGpsEn' VALUE='1' <?php echo $OptGpsEnSelected?> > 
               </TD>
                              <TD ALIGN='RIGHT'>
<?php


    print $bc->CurrencyCode." ";
    print number_format($bc->OptGpsEnCost,2);

?>
               </TD>
            </TR>  


<?php
    } // English GPS
?>
<TR><TD colspan="3" ><br/>Optional extra prices are the total cost for the duration of your rental and are paid for when you collect your car.
</TD></TR>

<?php
    }
    else
        require 'Includes/optional_extras.php';
?>
</table>

<br/>
<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-annotation="inline" data-width="300"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
 <br/>
<?php
print "<br/>";

//print "<div><span class='title6'><strong>WHY ARE WE SO CHEAP&nbsp;&nbsp;<a href='whywearecheap.html' rel='ibox&height=350' title='Why are we cheap'><img src='images/questionmark.gif' width='13' height='13' /></a></strong></span></div><br>";

print "<div><span class='title6'><strong>Received a cheaper quote?&nbsp;&nbsp;<a href='compare.php'>Let us know</a></strong></span></div><br>";

?>
 
