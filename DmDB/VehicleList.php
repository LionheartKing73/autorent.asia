<?php
include './Includes/Top.php';
include './Includes/mode.php';


?>
<html>
<head>
<title>Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>


</head>

<?php
include './Includes/BodyHead.php';


//* COnfigure the SQL depending on the input parameters *//

$Class= $_GET['Class'];

if ( $Class ) 
{
	$addsql = " and class = '".$Class."'";

$ClassType = GetClass( $Class );



}
	
?>

<table width=100% cellpadding=4 cellspacing=0 border=0>
<tr><td class=pagetitle width=50%>

<?php print $ClassType;?> Vehicle List 
</td>
<td  class=pageactions>
<?php
	print "<a href='VehicleAdd.php?Class=".$Class."'>Add new vehicle</a>";
?>
</td>

</tr></table>

<br>
<?php

$Sql = "select * from vehicles WHERE fk_vehicle_country_id = ".$Country->Rec["country_id"]." ".$addsql." order by active DESC, class, regno";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the vehicles section ".$Sql.mysql_error());

$i = 0 
?> 


<table width=100% align=center cellpadding=0 cellpadding=0 border=0>

<tr>
<td>Class</td>  
<td>Ref/Reg</td>
<td>Manufacturer</td>
<td>Model</td>
<td>Daily Rental</td>
<td></td>
<td></td>
</tr>
<?php

while ($row = mysql_fetch_array($ResultSet) ) {

    if ( ! $row["active"])
        $rstyle="style='background-color: rgb( 200,200,200)'";
    else
        $rstyle="";
	print "<tr $rstyle><td>";
	print $row[ "class" ];
	print "</td>";
    print "<td>";
    print $row[ "regno" ];
    print "</td>";
	print "<td>";
	print $row[ "manufacturer" ];
	print "</td>";

	print "<td>";
	print $row[ "model" ];
	print "</td>";
	print "<td>";
	print $row[ "priceperday" ];
	print "</td>

<td><a href='VehicleAdd.php?ID=".$row[ "vehicleid" ]."&Class=".$Class."'>Edit</a>";

	print "</td>";
	print "<td>";
	print "<td><a href='VehicleImages.php?ID=".$row[ "vehicleid" ]."&Class=".$Class."'>Images</a></td>";
	
		print "<td align='right'>";
	print "<a href='DeleteRecord.php?deltype=ve&ID=".$row[ "vehicleid" ]."'>Delete</a>";
	print "</td>";
	print "</tr>";


}
?>
</table>






<?php
include './Includes/BodyFoot.php';
?>





















































































