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

	
?>


<br>
<?php
$Sql = "select bookings.*, partner.*, vehicles.*, l1.location_name fromloc, l2.location_name toloc from bookings LEFT OUTER JOIN partner_visit on bookings.partner_visit_id = partner_visit.partner_visit_id ";
$Sql .= " LEFT OUTER JOIN partner on partner.partner_id = partner_visit.fk_visit_partner_id ";
$Sql .= " LEFT OUTER JOIN locations l1 on l1.location_code = bookings.pickup ";
$Sql .= " LEFT OUTER JOIN locations l2 on l2.location_code = bookings.dropoff ";

$Sql .= " JOIN vehicles ON bookings.vehicleid = vehicles.vehicleid order by bookingsid desc";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the bookings section ".$Sql.mysql_error());

$i = 0 
?> 


<table width=100% align=center cellpadding=0 cellpadding=0 border=0>

<tr>

<td>Id</td>
<td>Partner</td>   
<td>Model</td>
<td>Who</td>
<td>Email</td>
<td>Phone</td>
<td>Pickup</td>
<td>Time</td>
</tr>
<?php

while ($row = mysql_fetch_array($ResultSet) ) {

	print "<tr><td><a href='BookingView.php?ID=".$row[ "bookingsid" ]."'>";
	print $row[ "bookingsid" ];
	print "</a></td>";
    print "<td>";
    print $row[ "partner_name" ];
    print "</td>";
	print "<td>";
	print $row[ "manufacturer" ]." ". $row[ "model" ];
	print "</td>";

	print "<td>";
	print $row[ "name" ];
	print "</td>";
	print "<td>";
	print $row[ "email" ];
	print "</td>";
	print "<td>";
	print $row[ "phone" ];
	print "</td>";
	print "<td>";
	print $row[ "fromloc" ];
	print "</td>";
	print "<td>";
	print $row[ "pickupdate" ]." ".$row[ "pickuptime" ];
	print "</td>";
	print "</tr>";


}
?>
</table>






<?php
include './Includes/BodyFoot.php';
?>





















































































