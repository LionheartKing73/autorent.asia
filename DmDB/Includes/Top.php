<?php
include 'LoginCheck.php';
include 'GetCountry.php'; 


include 'VehicleClassDefinitions.php';


Function RegionSelect( $name, $regionid )
{
    global $Country;
    if ( ! $Country->Rec["country_id"] )
        $ctry = 1 ;
    else  
        $ctry = $Country->Rec["country_id"];  
 print "<select name='".$name."' size='1' id='".$name."' >";
        print "\n<option value='0'>No Region</option>";     

        $Sql = "select country_region_id, region_text from  country_region WHERE fk_region_country_id =  ".$ctry." ORDER BY region_text";
$ResultSet = mysql_query( $Sql ) ;

while ($row = mysql_fetch_array($ResultSet) ) {

    if ( $regionid == $row["country_region_id"] )
        print "\n<option selected='selected' value='".$row["country_region_id"]."'>".$row["region_text"]."</option>";
    else
        print "\n<option value='".$row["country_region_id"]."'>".$row["region_text"]."</option>";
}
   print "</select>";  
}
Function DistrictSelect( $name, $regionid )
{
    global $Country;
    if ( ! $Country->Rec["country_id"] )
        $ctry = 1 ;
    else  
        $ctry = $Country->Rec["country_id"];  
 print "<select name='".$name."' size='1' id='".$name."' >";
   

        $Sql = "select district_id, district_text from  district WHERE fk_district_country_id =  ".$ctry." ORDER BY district_text";
$ResultSet = mysql_query( $Sql ) ;

while ($row = mysql_fetch_array($ResultSet) ) {

    if ( $regionid == $row["district_id"] )
        print "\n<option selected='selected' value='".$row["district_id"]."'>".$row["district_text"]."</option>";
    else
        print "\n<option value='".$row["district_id"]."'>".$row["district_text"]."</option>";
}
  print "</select>";
}
function SupplierSelect( $curr )
{
    $Sql = "select * from supplier ORDER BY supplier_name";
    $ResultSet = mysql_query( $Sql ) 
    or die ( "Failed in Suppliers Query" .mysql_error());
    print "<select name='supplierid'>"; 
    while ($sprow = mysql_fetch_array($ResultSet) ) {
        if ( $sprow[ "supplierid" ] == $curr )
            $sel = "selected";
        else
            $sel = "";

        print "<option ".$sel." value='".$sprow[ "supplierid" ]."'>".$sprow[ "supplier_name" ]."</option>";
    }
    print "</select>";
}  


function LocationSelect( $curr )
{
    $Sql = "select * from locations where fk_location_country_id = 1 ORDER BY location_name";
    $ResultSet = mysql_query( $Sql ) 
    or die ( "Failed in Location Query" .mysql_error());
    print "<select name='fk_ct_locations_id'>"; 
    while ($sprow = mysql_fetch_array($ResultSet) ) {
        if ( $sprow[ "locationid" ] == $curr )
            $sel = "selected";
        else
            $sel = "";

        print "<option ".$sel." value='".$sprow[ "locationid" ]."'>".$sprow[ "location_name" ]."</option>";
    }
    print "</select>";
}   

function SchemeSelect( $curr )
{
    $Sql = "select * from pricing_scheme where fk_scheme_country_id = 1 ORDER BY pricing_scheme_name";
    $ResultSet = mysql_query( $Sql ) 
    or die ( "Failed in Scheme Query" .mysql_error());
    print "<select name='fk_ct_pricing_scheme_id'>"; 
    while ($sprow = mysql_fetch_array($ResultSet) ) {
        if ( $sprow[ "pricing_scheme_id" ] == $curr )
            $sel = "selected";
        else
            $sel = "";

        print "<option ".$sel." value='".$sprow[ "pricing_scheme_id" ]."'>".$sprow[ "pricing_scheme_name" ]."</option>";
    }
    print "</select>";
}






?>