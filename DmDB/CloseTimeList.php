<?php
include './Includes/Top.php';
include './Includes/mode.php';


?>
<html>
<head>
<title>Closing Times Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>


</head>

<?php
include './Includes/BodyHead.php';

$errarr["STARTTIME"]="Closed To Time cannot be before Closed From Time";




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

<?php print $ClassType;?> Closing Times List 
</td>
<td  class=pageactions>
<?php
	print "<a href='CloseTimeAdd.php?Class=".$Class."'>Add new Closing Time</a>";
?>
</td>

</tr></table>

<br>
<?php

if ( $_REQUEST["err"] )
{
	print "<div style='color: red'>NOT Posted: ";
	print $errarr[ $_REQUEST["err"]];
	print "</div>";
	
}

$Sql = "select * from closing_times JOIN supplier on supplierid = fk_ct_supplier_id JOIN locations on locationid = fk_ct_locations_id";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the vehicles section ".$Sql.mysql_error());

$i = 0 
?> 


<table width=100% align=center cellpadding=0 cellpadding=0 border=0>

<tr>
<td>Location</td>  
<td>Supplier</td>
<td>Close time</td>
<td>Re-open</td>
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
	print $row[ "closed_from" ];
	print "</td>";
	print "<td>";
	print $row[ "closed_to" ];
	print "</td>

<td><a href='CloseTimeAdd.php?ID=".$row[ "closing_times_id" ]."'>Edit</a></td>";

	print "<td align='right'>";
	print "<a href='DeleteRecord.php?deltype=ct&ID=".$row[ "closing_times_id" ]."'>Delete</a>";
	print "</td>";

	print "</tr>";


}
?>
</table>






<?php
include './Includes/BodyFoot.php';
?>





















































































