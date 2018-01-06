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
	$Sql = "select * from vehicles where vehicleid = ".$ID." AND fk_vehicle_country_id = ".$Country->Rec["country_id"];
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in House Query" .mysql_error());
	$EditRow = mysql_fetch_array($ResultSet) ;
	$Class  = $EditRow["class"];

}
Else
{
	$Mode = "Add";
	$Class  = $_REQUEST['Class'];
}
?>


</head>

<?php
include './Includes/BodyHead.php';


?>


<table width=100% align=center cellpadding=0 cellpadding=0 border=0>
<form method="POST" Name="login" action="VehiclePosting.php"  enctype="multipart/form-data">

<tr><td>Manufacturer</td><td><input type=text name=manufacturer value='<?php print $EditRow["manufacturer"]?>'></td>


<td>
<!--Location-->
</td>
<td>
<?php
//include './Includes/locations.php';


?>



</td>

</tr>

<tr><td>Model</td><td><input type=text name=model value='<?php print $EditRow["model"]?>'></td>
</tr>

<tr><td>Supplier</td><td>

<?php
     SupplierSelect( $EditRow["supplierid"] );

?>

</td>
</tr>
<tr>
    <td>Active</td>
<?php
if ( $EditRow["active"] == "1" )
    $activey = "checked";
else
    $activen = "checked"; 
?>
<td bgcolor=white>
<input type=radio name=active value=0 <?php print  $activen?>>No</input>
<input type=radio name=active value=1 <?php print  $activey?>>Yes</input>

</td>
</tr>
<tr>

<td>Ins. Package</td>

<td bgcolor=white>
<?php
if ( $EditRow["package"] == "P" )
    $packagep = "checked";
elseif ( $EditRow["package"] == "G" )
    $packageg = "checked"; 
else
	$packages = "checked"; 
?>
<input type=radio name=package value=G <?php print  $packageg?>>Gold</input>
<input type=radio name=package value=S <?php print  $packages?>>Silver</input>
<input type=radio name=package value=P <?php print  $packagep?>>Platinum</input>
</td>
</tr>
<tr>

<td>Class</td>

<td bgcolor=white>
<?php
GetClassRadioButtons( $Class ) ;
?>
</td>
</tr>
<tr><td>Discount Pricing</td><td>
<select name="pricing_scheme_id">
<?php
	$Sql = "select * from pricing_scheme WHERE fk_scheme_country_id = ".$Country->Rec["country_id"];
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in Pricing Scheme Query" .mysql_error());

	while ($sprow = mysql_fetch_array($ResultSet) ) {
		if ( $sprow[ "pricing_scheme_id" ] == $EditRow["pricing_scheme_id"] )
			$sel = "selected";
		else
			$sel = "";

		print "<option ".$sel." value='".$sprow[ "pricing_scheme_id" ]."'>".$sprow[ "pricing_scheme_name" ]."</option>";
	}
?>
</select>
</td>
</tr>
<tr>
<td>Insurance</td><td><input type=text name=priceperday value=<?php print $EditRow["priceperday"]?>></td>
</tr>

<tr>
<td>
Have Similar?
</td>
<?php
if ( $EditRow["havesimilar"] == "1" )
	$schecky = "checked";
else
	$scheckn = "checked"; 
?>
<td bgcolor=white>
<input type=radio name=havesimilar value=0 <?php print  $scheckn?>>No</input>
<input type=radio name=havesimilar value=1 <?php print  $schecky?>>Yes</input>

</td>
</tr>
<tr>
<td>Reg No</td>
<td><input type=text name=regno value='<?php print $EditRow["regno"]?>'></td>


</tr>


</table>
<br/>
<h4>Vehicle Specifications</h4>

<table width=100% align=center cellpadding=0 cellpadding=0 border=0>
<tr>
	<td>CC</td>
	<td><input type=text name=cc value=<?php print $EditRow["cc"]?>></td>
</tr>
<tr>
	<td>Passengers</td>
	<td><input type=text name=passenger value=<?php print $EditRow["passenger"]?>></td>
</tr>
<tr>
	<td>Transmission</td>
<?php
if ( $EditRow["transmission"] == "A" )
	$stransa = "checked";
else
	$stransm = "checked"; 
?>
<td bgcolor=white>
<input type=radio name=transmission value=A <?php print $stransa?>>Automatic</input>
<input type=radio name=transmission value=M <?php print $stransm?>>Manual</input>

</td>

</tr>
<tr>
	<td>Air</td>
<?php
if ( $EditRow["air"] == "1" )
	$airy = "checked";
else
	$airn = "checked"; 
?>
<td bgcolor=white>
<input type=radio name=air value=0 <?php print  $airn?>>No</input>
<input type=radio name=air value=1 <?php print  $airy?>>Yes</input>

</td>
</tr>
<tr>
	<td>Luggage</td>
	<td><input type=text name=luggage size=250 value='<?php print $EditRow["luggage"]?>'></td>
</tr>
<tr>
	<td>Extras (1)</td>
	<td><input type=text name=extras1 size=60 value='<?php print $EditRow["extras1"]?>'></td>
</tr>
<tr>
	<td>Extras (2)</td>
	<td><input type=text name=extras2 size=60 value='<?php print $EditRow["extras2"]?>'></td>
</tr>
<tr>
	<td>Extras (3)</td>
	<td><input type=text name=extras3 size=60 value='<?php print $EditRow["extras3"]?>'></td>
</tr>
<tr>
	<td>Extras (4)</td>
	<td><input type=text name=extras4 size=60 value='<?php print $EditRow["extras4"]?>'></td>
</tr>
</table>
<br/>
<center>

<input type=submit value=Save name=submit>
</center>


<input type=hidden value='<?php print $ID?>' name=ID>
<input type=hidden value='<?php print $Type?>' name=Type>
<input type=hidden value='<?php print $For?>' name=For>
</form>



<?php
include './Includes/BodyFoot.php';
?>
