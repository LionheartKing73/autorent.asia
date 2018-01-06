<?php
include './Includes/Top.php';

?>
<html>
<head>
<title>Database Administration: Currencies (from USD)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>


</head>

<?php
include './Includes/BodyHead.php';



?>
<h1>Currency List</h1>
 <p class="SmallText">Click on the Currency Name to edit the exchange rate.</p>   
   
<br>
<?php
 /* 
$Sql = "insert into locations ( locationid, location_code, location_name, location_order ) "  ;
 $Sql .= "VALUES ( 22,'samui chaweng', 'Samui Chaweng' , 65 ) ";
 
 $Sql = "update locations set location_code = 'chiangmai air', location_name = 'Chiang Mai Airport' where locationid = 8" ;
 mysql_query( $Sql )  ;
 */
$Sql = "select * from currencies_from_usd  order by currency_code";

$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the currencies section ".$Sql.mysql_error());

$i = 0 
?> 


<table width=50% align=center cellpadding=0 cellpadding=0 border=0>

<tr style='font-weight: bold'>

<td>Code</td>
<td>Name</td>
<td align='right'>Cnv. Rate (1 USD = ?)</td> 
</tr>
<?php

while ($row = mysql_fetch_array($ResultSet) ) {
  /*
	print "<tr><td>";
	print $row[ "currencies_id" ]; //."--".$row[ "location_order" ];
	print "</td>";
    */
	print "<td>";
	print $row[ "currency_code" ];
	print "</td>";

	print "<td><a href='CurrencyUSDEdit.php?Currency=".$row[ "currencies_id" ]."'>";
	print $row[ "currency_name" ];
	print "</a></td>";
        print "<td align='right'>";
    print number_format( $row[ "from_usd_rate" ], 4, ".", "," );
    print "</td>";
     print "<td align='right'><a href='CurrencyUSDEdit.php?mode=Delete&Currency=".$row[ "currencies_id" ]."'> Delete";

    print "</a></td>";
    
    print "</tr>";


}
?>
</table>

 <a href='CurrencyUSDEdit.php?mode=Add'>Add a new Currency</a>




<?php
include './Includes/BodyFoot.php';
?>





















































































