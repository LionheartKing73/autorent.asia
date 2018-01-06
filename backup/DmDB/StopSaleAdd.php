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

$ID = $_REQUEST['ID'];

if ( $ID ) 
{
	$Mode = "Edit";
	$Sql = "select * from stop_sell where stop_sell_id = ".$ID;
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in Query" .mysql_error());
	$EditRow = mysql_fetch_array($ResultSet) ;
	$Class  = $EditRow["class"];

}
Else
{
	$Mode = "Add";

}
?>


</head>

<?php
include './Includes/BodyHead.php';


?>

<h1>Add or Edit Stop Sales</h1>
<table width=100% align=center cellpadding=0 cellpadding=0 border=0>
<form method="POST" Name="login" action="StopSalePosting.php"  enctype="multipart/form-data">

<tr>


<td>
Location
</td>
<td>


<?php
     LocationSelect( $EditRow["fk_ct_locations_id"] );

?>

</td>

</tr>



<tr><td>Supplier</td><td>

<?php
     SupplierSelect( $EditRow["fk_ct_supplier_id"] );

?>

</td>
</tr>
<tr>

<td>Pricing Scheme</td>

<td bgcolor=white>
<?php
     SchemeSelect( $EditRow["fk_ct_pricing_scheme_id"] );

?>
</td>
</tr>

<tr>
<td>Stop From (YYYY-MM-DD)</td>
<td><input type=text name=stop_from value='<?php print $EditRow["stop_from"]?>'></td>


</tr>

<tr>
<td>Stop To YYYY-MM-DD)</td>
<td><input type=text name=stop_to value='<?php print $EditRow["stop_to"]?>'></td>


</tr>



</table>
<br/>
<center>

<input type=submit value=Save name=submit>
</center>


<input type=hidden value='<?php print $ID?>' name=ID>

</form>



<?php
include './Includes/BodyFoot.php';
?>
