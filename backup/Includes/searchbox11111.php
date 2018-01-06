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
            if ( $key == $countrySD )
                $dp = "block";
            else
                $dp = "none";
                
            $distFr[$key] = "<div  style=' display: $dp' class='district' id='DIVFr".$key."'><select style='width: 220px;'       class='districtFr' id='distFr".$key."' name='distFr".$key."'>".$value."</select>";

        }
        foreach ( $distTo as $key=>$value )
        {
            if ( $key == $countrySD )
                $dp = "block";
            else
                $dp = "none";

            $distTo[$key] = "<div  style='display: $dp' class='district' id='DIVTo".$key."'><select style='width: 220px;'  class='districtTo' id='distTo".$key."' name='distTo".$key."'>".$value."</select>";
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
                  $ctryFr[$key] .= "<select style='width: 220px; display: ".$display."' class='locFr".$RefDistCountry[$dist]."' id='locFr".$key."-".$dist."' name='locFr".$dist."'>"; 
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
                  $ctryTo[$key] .= "<select style='width: 220px; display: ".$display."' class='locTo".$RefDistCountry[$dist]."' id='locTo".$key."-".$dist."' name='locTo".$dist."'>"; 
                  $ctryTo[$key] .= $loctext;
                  $ctryTo[$key] .= "</select>";
                }
                if ( $displaying_locs )
                    $ctryTo[$key] = str_replace( "XYXY-sub", "", $ctryTo[$key] );
                else
                     $ctryTo[$key] = str_replace( "XYXY-sub", "block", $ctryTo[$key] );
                
                $ctryTo[$key] .= "</div>";
        }      
        
        
         foreach ( $ctryFr as $key=>$value )
        {
            print $value;

        }


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
        foreach ( $ctryTo as $key=>$value )
        {
            print $value;

        }
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
