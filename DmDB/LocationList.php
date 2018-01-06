<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<html>
<head>
<title>Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php

if ( $_POST["AddNewLoc"])
{
   $Sql = "insert into locations ( fk_location_country_id,location_code, location_name, location_order) VALUES ("  .
   intval( $Country->Rec["country_id"]) . 
   ", '".mysql_real_escape_string( $_POST["new_location_code"])  . 
   "', '".mysql_real_escape_string( $_POST["new_location"])  .
   "', ".intval( $_POST["display_order"]) . " )";
   
$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the locations section ".$Sql.mysql_error());
    
    
}elseif ( $_POST["DeleteLoc"])  
{
    $Sql = "delete from location_vehicles WHERE locationid = ".intval( $_REQUEST["locationid"])." )";
   
$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the location vehicles delete section ".$Sql.mysql_error());   

    $Sql = "delete from locations WHERE locationid = ".intval( $_REQUEST["locationid"])." )";
   
$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the location delete section ".$Sql.mysql_error());  
    
}
include './Includes/Head.php';
?>


</head>

<?php
include './Includes/BodyHead.php';



?>

<table width=100% cellpadding=4 cellspacing=0 border=0>
<tr><td class=pagetitle width=50%>

<?php print $ClassType;?> Location List 
</td>
<td  class=pageactions>

</td>

</tr></table>

<br>
<?php
 /* 
$Sql = "insert into locations ( locationid, location_code, location_name, location_order ) "  ;
 $Sql .= "VALUES ( 22,'samui chaweng', 'Samui Chaweng' , 65 ) ";
 
 $Sql = "update locations set location_code = 'chiangmai air', location_name = 'Chiang Mai Airport' where locationid = 8" ;
 mysql_query( $Sql )  ;
 */
$Sql = "select * from locations LEFT JOIN country_region on fk_location_country_region_id = country_region_id " .
"LEFT JOIN district on fk_location_district_id = district_id WHERE fk_location_country_id = ".$Country->Rec["country_id"]." order by location_order";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the locations section ".$Sql.mysql_error());

$i = 0 
?> 


<table width=90% align=center cellpadding=0 cellpadding=0 border=0 style='font-size: 12px'>

<tr style='font-weight: bold'>
<td>Id</td>
<td>Region</td>
<td>District</td>  
<td>Code</td>
<td>Location</td>
<td>Order</td> 
</tr>
<?php

while ($row = mysql_fetch_array($ResultSet) ) {

	print "<tr><td>";
	print $row[ "locationid" ]; //."--".$row[ "location_order" ];
	print "</td>";
        print "<td>";
    print $row[ "region_text" ];
    print "</td>";
        print "<td>";
    print $row[ "district_text" ];
    print "</td>"; 
	print "<td>";
	print $row[ "location_code" ];
	print "</td>";

	print "<td><a href='LocationEdit.php?Location=".$row[ "locationid" ]."'>";
	print $row[ "location_name" ];
	print "</a></td>";
        print "<td>";
    print $row[ "location_order" ];
    print "</td>";
    print "<td align='right'>";
	print "<a href='DeleteRecord.php?deltype=loc&ID=".$row[ "locationid" ]."'>Delete</a>";
	print "</td>";

    
    print "</tr>";


}
?>
</table>

<br/>
<br/>
<hr/>
<h3>Add New Location ...</h3>
<form method='post' action='<?PHP echo $_SERVER["PHP_SELF"]?>'>
<p>Code <input type='text' name='new_location_code'>&nbsp;&nbsp;&nbsp;Location <input type='text' name='new_location'>&nbsp;&nbsp;&nbsp;Display Order <input type='text' name='display_order'></p>   
<input type='hidden' name='AddNewLoc' value="Do">  
<input type='submit' name='Add'>
</form>






<?php
include './Includes/BodyFoot.php';
?>





















































































