<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');


if (!(isset($_POST['SubmitForm_x'])))   {
$whereStmt = ' pricing_extra_type_id="'.addslashes($_GET['extra_type_id']).'" ';
$selectSql = 'SELECT * FROM pricing_extra_type WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Update Pricing Extras</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/pdw.js"></script>
<script type="text/javascript">
function checkForm(){
formErrors = new Array();



var errorText = '';
if (formErrors.length > 0){
for (var i=0; i<formErrors.length; i++)
errorText = errorText + formErrors[i] + '\n';
alert(errorText);
return false;
}

return true;
}
</script>
<?php
include './Includes/Head.php';
?>
</head>
<body>
<?php
include './Includes/BodyHead.php';
?>
<h1>Extras</h1>


<form name="UpdateForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<div >
<table width='100%'>
<tr><td class="tableheader" colspan="2">Update Extras</td></tr>
  <tr>
<th width='30%'>Supplier:</th>
<td>
<?php
     SupplierSelect( $Resultset["fk_extras_supplier_id"] );

?>
</td>
</tr>
<tr>


<th width='30%' >Display Order:</th>
<td><input type="text" name="display_order" value='<?php echo $Resultset["display_order"]?>' id="display_order_ID"/></td>
</tr>
<tr>
<th>Extra Description</th>
<td><input type="text" name="extras_text" size='40' value='<?php echo $Resultset["extras_text"]?>' idsize='40' id="extras_text_ID"/></td>
</tr>
<tr>
<th width='30%' >Checkout Page (0,1,2 or 3):</th>
<td>
<select name="checkout_page" >
<?php
for ( $i=0;$i<=3;$i++)
{
	if ( $i==$Resultset["checkout_page"] )
		print "<option selected value='$i'>$i</option>";	
	else
		print "<option value='$i'>$i</option>";	
	
}
?>
</select>

</td>
</tr>
<tr>
<th>Default</th>
<?php
if ( $Resultset["field_default"] )
	$defcheck1 = "checked='checked'";
else	
	$defcheck0 = "checked='checked'";
	?>
<td>NO: <input type="radio"  name="field_default" <?php echo $defcheck0?> value='0' idsize='80' id="field_default0"/>   
YES: <input type="radio"   name="field_default" <?php echo $defcheck1?> value='1' idsize='80' id="field_default1"/></td>
</tr>
<tr>
<th>Parametrised Output on Pricing Record</th>
<td><input type="text" size='80'  name="extras_booking_output" value='<?php echo $Resultset["extras_booking_output"]?>' idsize='80' id="extras_booking_output_ID"/></td>
</tr>
<tr>
<th>Parameter 1:</th>
<td><input type="text" name="extras_param1" value='<?php echo $Resultset["extras_param1"]?>' idid="extras_param1_ID"/></td>
</tr>
<th>Parameter 2:</th>
<td><input type="text" name="extras_param2" value='<?php echo $Resultset["extras_param2"]?>' idid="extras_param2_ID"/></td>
</tr>
<th>Parameter 3:</th>
<td><input type="text" name="extras_param3" value='<?php echo $Resultset["extras_param3"]?>' idid="extras_param3_ID"/></td>
</tr>


<tr>
<?php
echo '<td class="tablefooter" colspan="2"><a href="javascript:history.back()"><img src="style/back.gif" alt="Back"></a>';
echo '<input type="image" src="style/update.gif" name="SubmitForm">';
?>
<input type="hidden" name="hidden_whereStmt" value='<?php echo $whereStmt; ?>'></td>
</tr>
</table>
</div>
</form>
<?php
include './Includes/BodyFoot.php';
?>

</body>
</html>


<?php
}
else {
$updateSql = 'UPDATE pricing_extra_type SET '
." extras_booking_output='".addslashes($_POST['extras_booking_output'])."'"
.", extras_text='".addslashes($_POST['extras_text'])."'"
.", display_order='".addslashes($_POST['display_order'])."'" 
.", checkout_page='".addslashes($_POST['checkout_page'])."'"  
.", field_default='".addslashes($_POST['field_default'])."'"   
.", extras_param1='".addslashes($_POST['extras_param1'])."'"
.", extras_param2='".addslashes($_POST['extras_param2'])."'" 
.", extras_param3='".addslashes($_POST['extras_param3'])."'" 
.", fk_extras_supplier_id='".addslashes($_POST['supplierid'])."'"    
.' WHERE '.stripslashes($_POST['hidden_whereStmt']);

$MyDb->f_ExecuteSql($updateSql);

header('Location: extratypelist.php');
}
?>


