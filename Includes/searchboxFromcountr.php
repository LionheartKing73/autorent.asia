   <div id="menu">
        
        <h1 class='Banner' style='text-align: center; font-size: 18px'>SEARCH FOR CAR HIRE</h1>

       <form method="post" action="nation.php">
<input type="hidden" name="poster" value="yes"/>
              <table align='center' border='0' cellpadding="3" cellspacing="5" width="100%">
                <tbody>

           
                    <tr>
                    <td   valign='top' >Pickup location</td>
                    <td  valign='top' >Pickup date </td>
                    
                    </tr>                 

    

                 <tr>

<td   align='left' valign='top' >

<?php
VehTypeSelect( "vehtype", $vehtype );
?> 
         
                    
                    </td>
                    <td  >
<?php
print "\n";
DaySelect( "startdayveh", $startdayveh );
MonthSelect( "startmonthveh", $startmonthveh );
print "<br/>";
YearSelect( "startyearveh", $startyearveh );
?>

<?php
print "\n";
TimeSelect( "starttimehrs", "starttimemins", $starttimehrs, $starttimemins );
?>


</td>
                  </tr>
                  
                    <tr>
                    <td valign='top' >

 </td>                     
                  
                                      <td   valign='top' >Return date </td>    <tr>
                  
                  
                                      <tr>
                    <td valign='top' >

 </td>              
                    

                    <td valign='top' >
<?php
print "\n";
DaySelect( "finday", $finday );
MonthSelect( "finmonth", $finmonth );
print "<br/>";
YearSelect( "finyear", $finyear );
?>

<?php
print "\n";
TimeSelect( "fintimehrs", "fintimemins", $fintimehrs, $fintimemins );
?>


</td>
</tr>

                 <tr>
                    
                    <td width='50%'   valign='top' >


                    <span id='DiffLoc' style='display: none'>Return location</span>
                    <div id='DiffLocChoose'>
                    <input type='hidden' id='DiffLocChecked' name='DiffLocChecked' value='0'/>
                    <div style='display: inline; float: left'>Return to same location</div>      
                    <input type='button' onclick='javascript:ShowLoc()' style='float: right' value='Yes'/>
                    
                    
                    </div>
                    
                    </td>
                     <td width='50%'  valign='top' > </td>  
                    
                    </tr>                 

    

                 <tr>

<td  align='left' valign='top' >
<div id='RetLocTD' style='display: none'>
<?php



VehTypeSelect( "retloc", $retloc );
?>
</div>

 </td>
                    
                    </tr>
                 <tr>
                    <td width='50%'  valign='top' >Vehicle type </td>
                    <td width='50%'   valign='top' >Currrency </td>
                    
                    </tr>
                    
                 <tr>
                 
                                     <td  align='left' valign='top' >
<?php

GetClassRadioButtons( $vehclass ) ;

?> </td>
                 


                    <td  valign='top'>
                    
                    <?php

CurTypeSelect( "CurrencyId", $CurrencyId );
?> 
                    </td>
     
                    
                    </tr>   

                </tbody>
        </table>

  <div align="right"> 
       
                <input type="submit" value='Go'/>
<br/>

</div>
    </form>


