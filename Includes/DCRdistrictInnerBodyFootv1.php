</div>
<div id='LeftCol' class='box' style='display: block;  height: 500px; width: 260px;'>

<h1 class="Banner">Change your choice</h1>

        <div id="menu">
        

        <!--
        <a href="country.php" class='smltxtw'>Home</a>  
        -->    


<br/>
       <form method="post" action="DCR-district.php">

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
                  

<?php
/*
if ( $CountryRec["country_subdomain"] )                             // wwww page receives a country indicatoru
    $countrySD =   $CountryRec["country_subdomain"];    
elseif ( $Country->Rec["country_subdomain"] )                       // Country Pages
    $countrySD =   $Country->Rec["country_subdomain"];
else
 */ 
    $countrySD =   "thailand";                                      // Default
  
?>
<?php
 ///////////////DISTRICTION TEST
 if ( $_REQUEST["country_subdomain"] )
    $req_country = $_REQUEST["country_subdomain"] ;
 else
    $req_country = $countrySD; 
 $req_districtFr = $_REQUEST["distFr".$req_country] ;
 $req_districtTo = $_REQUEST["distTo".$req_country] ;
 
$req_locationFr = $_REQUEST[$req_districtFr] ;
$req_locationTo = $_REQUEST[$req_districtTo] ;
 /*
 print "<hr/>";  
 print $req_country;
 print $req_districtFr;
 print $req_districtTo;
  print "<hr/>";  
   */ 
  $countrySD =  $req_country; 

?>


    <select style='width: 146px'  id='country' name='country_subdomain'>
<?php    
    

    
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
 
 <?php
 // DISTRICTS
 
        $Sql =  "select district.*, country_subdomain from district " . 
                "JOIN country on country_id = fk_district_country_id order by district_text";
                
        $ResultSet = mysql_query( $Sql ) ;
        while ($row = mysql_fetch_array($ResultSet) ) {
            
            
            if ( $_REQUEST["distFr".$row["country_subdomain"]] == $row["country_subdomain"]."-".$row["district_id"] )
                $selected = "selected";
            else
                $selected = "";
            $distFr[$row["country_subdomain"]].="\n<option $selected value='".$row["country_subdomain"]."-".$row["district_id"]."'>";
            $distFr[$row["country_subdomain"]].=$row["district_text"]."</option>";

            if ( $_REQUEST["distTo".$row["country_subdomain"]] == $row["country_subdomain"]."-".$row["district_id"] )
                $selected = "selected";
            else
                $selected = "";           
            $distTo[$row["country_subdomain"]].="\n<option $selected value='".$row["country_subdomain"]."-".$row["district_id"]."'>";
            $distTo[$row["country_subdomain"]].=$row["district_text"]."</option>";   
            
            
            $RefDistCountry[$row["district_id"]] =  $row["country_subdomain"];      
            
        }
        
        foreach ( $distFr as $key=>$value )
        {
            if ( $key == $req_country )
                $dp = "block";
            else
                $dp = "none";
                
            $distFr[$key] = "<div  style=' display: $dp' class='district' id='DIVFr".$key."'><select style='width: 220px; 'class='districtFr' id='distFr".$key."' name='distFr".$key."'>".$value."</select>";

        }
        foreach ( $distTo as $key=>$value )
        {
            if ( $key == $req_country )
                $dp = "block";
            else
                $dp = "none";

            $distTo[$key] = "<div  style='display: $dp' class='district' id='DIVTo".$key."'><select style='width: 220px; ' class='districtTo' id='distTo".$key."' name='distTo".$key."'>".$value."</select>";
        }       
 // Now for each country we have an open DIV and the District Selector
        
 // LOCATIONS

        $Sql =  "select locations.*, district.*, country_subdomain from locations " . 
                "JOIN district on district_id = fk_location_district_id " .
                "JOIN country on country_id = fk_district_country_id order by location_name";
                
        $ResultSet = mysql_query( $Sql ) ;

        while ($row = mysql_fetch_array($ResultSet) ) {
            
            
            if ( $_REQUEST[ "locFr".$row["district_id"]  ] ==  $row["locationid"])
                $selected = "selected";
            else
                $selected = "";
            $locFr[$row["country_subdomain"]][$row["district_id"]].="\n<option $selected value='".$row["locationid"]."'>";
            $locFr[$row["country_subdomain"]][$row["district_id"]].=$row["location_name"]."</option>";
            
            if ( $_REQUEST["locTo".$row["district_id"]] ==  $row["locationid"])
                $selected = "selected";
            else
                $selected = "";          
            $locTo[$row["country_subdomain"]][$row["district_id"]].="\n<option $selected value='".$row["locationid"]."'>";
            $locTo[$row["country_subdomain"]][$row["district_id"]].=$row["location_name"]."</option>";          
            
        }
        
        foreach( $locFr as $key=>$arr )
        {
                $ctryFr[$key] = $distFr[$key];
                $displaying_locs=false;
                $first_iteration=true;
                foreach( $arr as $dist=>$loctext )
                {
                  if ( $_REQUEST["distFr".$key] == $key."-".$dist )
                  {
                    $display="block";
                    $displaying_locs=true;
                  }
                  elseif ( $first_iteration)
                  {
                    // If this is teh initial form display, we show the firdt location srt 
                    // for the first district
                    $display="XYXY-sub";  
                    $first_iteration=false;
                  }
                  else
                    $display="none";
                  $ctryFr[$key] .= "<select style='width: 220px; display: ".$display."' class='locFr".$RefDistCountry[$district]."' id='locFr".$key."-".$dist."' name='locFr".$dist."'>"; 
                  $ctryFr[$key] .= $loctext;
                  $ctryFr[$key] .= "</select>";
                }
                if ( $displaying_locs )
                    $ctryFr[$key] = str_replace( "XYXY-sub", "", $ctryFr[$key] );
                else
                     $ctryFr[$key] = str_replace( "XYXY-sub", "block", $ctryFr[$key] );
                
                $ctryFr[$key] .= "</div>";
        }
        foreach( $locTo as $key=>$arr )
        {
                $ctryTo[$key] = $distTo[$key];
                $displaying_locs=false;
                $first_iteration=true;
                foreach( $arr as $dist=>$loctext )
                {
                  if ( $_REQUEST["distTo".$key] == $key."-".$dist )
                  {
                    $display="block";
                    $displaying_locs=true;
                  }
                  elseif ( $first_iteration)
                  {
                    // If this is teh initial form display, we show the firdt location srt 
                    // for the first district
                    $display="XYXY-sub";  
                    $first_iteration=false;
                  }
                  else
                    $display="none";
                  $ctryTo[$key] .= "<select style='width: 220px; display: ".$display."' class='locTo".$RefDistCountry[$district]."' id='locTo".$key."-".$dist."' name='locTo".$dist."'>"; 
                  $ctryTo[$key] .= $loctext;
                  $ctryTo[$key] .= "</select>";
                }
                if ( $displaying_locs )
                    $ctryTo[$key] = str_replace( "XYXY-sub", "", $ctryTo[$key] );
                else
                     $ctryTo[$key] = str_replace( "XYXY-sub", "block", $ctryTo[$key] );
                
                $ctryTo[$key] .= "</div>";
        }      
        
 

 ?>                
              <table align='center' border='0' cellpadding="3" cellspacing="2" width="100%">                      
                 <tr>
                    <td   valign='top' class="smltxtw">Pickup location </td></tr>
                   <tr> <td align='left' valign='top' >
 <?php 
        foreach ( $ctryFr as $key=>$value )
        {
            print $value;

        }
            
/*

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
*/

?> 
<br/>
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
                    <tr><td colspan='2' align='left' valign='top' >
<?php
        foreach ( $ctryTo as $key=>$value )
        {
            print $value;

        }
?> 
<br/>

</td>
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




