
<div id> 

<div id='LeftCol' class='box' style='display: block;  height: 500px; width: 260px;'>

        <div id="menu">
        

        <!--
        <a href="country.php" class='smltxtw'>Home</a>  
        -->    


<br/>
       <form method="post" action="index.php">
<input type="hidden" name="poster" value="yes"/>
              <table align='center' border='0' cellpadding="3" cellspacing="3" width="240px">
                <tbody>
                     <tr>
                    <td colspan="3" valign='top'  class="smltxtb"><p></p></td>
                  </tr>
                  
                 <tr>
                    <td width="160"  valign='top' class="smltxtw">Currrency </td>
                    <td width="298"  valign='top' >
<?php

CurTypeSelect( "CurrencyId", $CurrencyId );
?> 
</td>
                  </tr>
         
                 <tr>
                    <td  valign='top' class="smltxtw">Country </td>  
                    <td   valign='top' >                  
                  
    <select   id='country' name='country_subdomain'>
<?php

if ( $CountryRec["country_subdomain"] )                             // wwww page receives a country indicatoru
    $countrySD =   $CountryRec["country_subdomain"];    
elseif ( $Country->Rec["country_subdomain"] )                       // Country Pages
    $countrySD =   $Country->Rec["country_subdomain"];
else
    $countrySD =   "thailand";                                      // Default
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
</td>
                  </tr>
              
 </table>                 
              <table align='center' border='0' cellpadding="3" cellspacing="2" width="100%">                      
                 <tr>
                    <td   valign='top' class="smltxtw">Pickup location </td></tr>
                   <tr> <td align='right' valign='top' >
 <?php                 



        $Sql = "select fk_location_country_id, location_code, location_name,country_subdomain from  locations JOIN country on country_id = fk_location_country_id order by fk_location_country_id, location_order";
$ResultSet = mysql_query( $Sql ) ;

while ($row = mysql_fetch_array($ResultSet) ) {

    if ( $vehtype == $row["location_code"] )
        $thisloc[$row["country_subdomain"]] .= "\n<option selected='selected' value='".$row["location_code"]."'>".$row["location_name"]."</option>";
    else
       $thisloc[$row["country_subdomain"]] .= "\n<option value='".$row["location_code"]."'>".$row["location_name"]."</option>";
       
    if ( $retloc == $row["location_code"] )
        $thisretloc[$row["country_subdomain"]] .= "\n<option selected='selected' value='".$row["location_code"]."'>".$row["location_name"]."</option>";
    else
       $thisretloc[$row["country_subdomain"]] .= "\n<option value='".$row["location_code"]."'>".$row["location_name"]."</option>";     
}

foreach ( $thisloc as $key=>$Value )
{
if ( $key==$countrySD )
    $style = "style='display: block'";
else
    $style = "style='display: none'";
    
 $thislocx.="\n<div class='Locations'  id='Loc".$key."'><select name='vehtype".$key."'>\n".$Value;
$thislocx .= "</select></div>";      

}
foreach ( $thisretloc as $key=>$Value )
{
   
  
 $thislocy.="\n<div class='Locations'  id='RetLoc".$key."'><select name='retloc".$key."'>\n".$Value;
$thislocy .= "</select></div>";  
}

print $thislocx;


?> 

</td>
                  </tr>
                  

              
                                   <tr>
                    <td  valign='top' class="smltxtw">Vehicle type </td></tr>
                    <tr><td  align='right' valign='top' >
<?php

GetClassRadioButtons( $vehclass ) ;

?> </td>
                  </tr>   
                  
 </table>                 
              <table align='center' border='0' cellpadding="3" cellspacing="2" width="100%">    
  
                                             <tr>
                    <td valign='top' class="smltxtw"> Pickup date  </td> 
                    <td  align='left' valign='top' >
<?php
print "\n";
DaySelect( "startdayveh", $startdayveh );
MonthSelect( "startmonthveh", $startmonthveh );
print "<br/>";
YearSelect( "startyearveh", $startyearveh );
?></td>
                  </tr>
                  
              
                                             <tr>
                    <td  valign='top' class="smltxtw"> Pickup time  </td>
                    <td align='left' valign='top' >
<?php
print "\n";
TimeSelect( "starttimehrs", "starttimemins", $starttimehrs, $starttimemins );
?></td>
                  </tr>
                  
                 
                  
                 <tr>
                    <td colspan='2' valign='top' class="smltxtw">Return location </td> </tr>
                    <tr><td colspan='2' align='right' valign='top' >
<?php
print $thislocy; 
?> </td>
                  </tr>
                                             <tr>
                    <td  valign='top' class="smltxtw"> <span class="smltxtw">Return date </span><span class="smltxt"></span> </td>
                    <td   align='left' valign='top' >
<?php
print "\n";
DaySelect( "finday", $finday );
MonthSelect( "finmonth", $finmonth );
print "<br/>";
YearSelect( "finyear", $finyear );
?></td>
                  </tr>
                  
        
                  
                                             <tr>
                    <td  valign='top' class="smltxtw"> Return time  </td>
                    <td x align='left' valign='top' >
                     

<?php
print "\n";
TimeSelect( "fintimehrs", "fintimemins", $fintimehrs, $fintimemins );


?></td>
                  </tr>
                </tbody>
        </table>

  <div align="right"> 
       

<br/>
<input type='submit' value='Go' name='Go'>
<span style='color: white'>
<?php echo $ErrText;?>&nbsp;</span>
</div>
    </form>


      </div><!-- end menu -->




</div>




