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
$Type  = $_REQUEST['Type'];
$For  = $_REQUEST['For'];
$ID = $_REQUEST['ID'];

if ( $ID ) 
{
	$Mode = "Edit";
	$Sql = "select * from closing_times where closing_times_id = ".$ID;
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in Query" .mysql_error());
	$EditRow = mysql_fetch_array($ResultSet) ;


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

<h1>Add or Edit Closing Times</h1>
<table width=100% align=center cellpadding=0 cellpadding=0 border=0>
<form method="POST" Name="login" action="CloseTimePosting.php"  enctype="multipart/form-data">

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
<td>Closed From</td>
<td><input type=text name=closed_from value='<?php print $EditRow["closed_from"]?>'></td>


</tr>

<tr>
<td>Closedto</td>
<td><input type=text name=closed_to value='<?php print $EditRow["closed_to"]?>'></td>


</tr>



</table>
<br/>
<p style='font-size: 12px'>If the shop is closed over midnight you need to add 2 entries. For example, if
the shop closes from 10PM to 4AM you need to add one entry from 22:00 to 24:00 and a second entry from 00:00 to 04:00.</p>
<center>

<input type=submit value=Save name=submit>
</center>


<input type=hidden value='<?php print $ID?>' name=ID>

</form>



<?php
include './Includes/BodyFoot.php';
?>
