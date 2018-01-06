<?php
include './Includes/Top.php';
include './Includes/mode.php';


?>
<html>
<head>
<title>Stop Sell Administration</title>
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

<?php print $ClassType;?> Stop Sell List 
</td>
<td  class=pageactions>
<?php
	print "<a href='StopSaleAdd.php?Class=".$Class."'>Add new Stop Sale</a>";
?>
</td>

</tr></table>

<br>
<?php

$Sql = "select * from stop_sell JOIN supplier on supplierid = fk_ct_supplier_id JOIN locations on locationid = fk_ct_locations_id LEFT JOIN pricing_scheme on pricing_scheme_id = fk_ct_pricing_scheme_id ";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the Stop Sell section ".$Sql.mysql_error());

$i = 0 
?> 


<table width=100% align=center cellpadding=0 cellpadding=0 border=0>

<tr>
<td>Location</td>  
<td>Supplier</td>
<td>Scheme</td>
<td>Stop Sell From Date</td>
<td>Stop Sell To Date</td>
<td></td>
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

	print $row[ "location_name" ];
    print "</td>";
	print "<td>";
	print $row[ "supplier_name" ];
	print "</td>";
	print "<td>";
	print $row[ "pricing_scheme_name" ];
	print "</td>";
	print "<td>";
	print $row[ "stop_from" ];
	print "</td>";
	print "<td>";
	print $row[ "stop_to" ];
	print "</td>

<td><a href='StopSaleAdd.php?ID=".$row[ "stop_sell_id" ]."'>Edit</a></td>";

	print "<td align='right'>";
	print "<a href='DeleteRecord.php?deltype=ss&ID=".$row[ "stop_sell_id" ]."'>Delete</a>";
	print "</td>";

	print "</tr>";


}
?>
</table>






<?php
include './Includes/BodyFoot.php';
?>





















































































