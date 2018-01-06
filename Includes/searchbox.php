         <div id="menu">
        
        <h1 class='Banner' style='text-align: center; font-size: 18px'>SEARCH FOR CAR HIRE</h1>

       <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
<input type="hidden" name="poster" value="yes"/>
              <table align='center' border='0' cellpadding="3" cellspacing="5" width="100%">
                <tbody>

          
                    <tr>
                    <td   valign='top' >Pickup location</td>
                    <td  valign='top' >Pickup date </td>
                    
                    </tr>                 

    

                 <tr>

<td   align='left' valign='top' >
    <select id='country' name='country_subdomain'>
<?php

if ( $Country->Rec["country_subdomain"] )
    $countrySD =   $Country->Rec["country_subdomain"];
else
    $countrySD =   "thailand";
        $sql="Select * from country ORDER by country_name ";

        $ResultSet = mysql_query( $sql ) ;

        while ( $Rec = mysql_fetch_array( $ResultSet ) )
        {
            if ( $Rec["country_subdomain"] == $countrySD )
                $selected = "selected";
            else
                $selected = "";
                    print "<option $selected value='".$Rec["country_subdomain"]."'>";
                    print $Rec["country_name"] ;
                    print "</option>";
            }   
?>
</select>

<?php                 



        $Sql = "select fk_location_country_id, location_code, location_name,country_subdomain from  locations JOIN country on country_id = fk_location_country_id order by fk_location_country_id, location_order";
$ResultSet = mysql_query( $Sql ) ;

while ($row = mysql_fetch_array($ResultSet) ) {

    if ( $vehtype == $row["location_code"] )
        $thisloc[$row["country_subdomain"]] .= "\n<option selected='selected' value='".$row["location_code"]."'>".$row["location_name"]."</option>";
    else
       $thisloc[$row["country_subdomain"]] .= "\n<option value='".$row["location_code"]."'>".$row["location_name"]."</option>";
}

foreach ( $thisloc as $key=>$Value )
{
if ( $key==$countrySD )
    $style = "style='display: block'";
else
    $style = "style='display: none'";
    
 $thislocx.="\n<div class='Locations'  id='Loc".$key."'><select name='vehtype".$key."'>\n".$Value;
$thislocx .= "</select></div>";      
 $thislocy.="\n<div class='Locations'  id='RetLoc".$key."'><select name='retloc".$key."'>\n".$Value;
$thislocy .= "</select></div>";  
}

print $thislocx;


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
print $thislocy;
//VehTypeSelect( "retloc", $retloc );
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

      </div>
      
      <!-- end menu -->
