<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

if (!(isset($_POST['SubmitForm_x'])))
{ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>Insert into dateranges</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link href="style/style.css" rel="stylesheet" type="text/css"/>
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
<h1>Supplier Extras</h1>


<form name="InsertForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">

<div >
<table width='100%'>
<tr><td class="tableheader" colspan=2>Insert into Supplier Extra Options</td></tr>
<tr>
<th>Supplier:</th>
<td>
<?php
     SupplierSelect( $EditRow["supplierid"] );

?>
</td>
</tr>
<tr>


<th width='30%' >Display Order:</th>
<td><input type="text" name="display_order" id="display_order_ID"/></td>
</tr>
<tr>
<th>Extra Description</th>
<td><input type="text" name="extras_text" size='40' id="extras_text_ID"/></td>
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
<td>NO: <input type="radio"  name="field_default" checked="checked" value='0' idsize='80' id="field_default0"/>   
YES: <input type="radio"   name="field_default"  value='1' idsize='80' id="field_default1"/></td>
</tr>
<tr>
<th>Parametrised Output on Pricing Record</th>
<td><input type="text" name="extras_booking_output" size='80' id="extras_booking_output_ID"/></td>
</tr>
<tr>
<th>Parameter 1:</th>
<td><input type="text" name="extras_param1" id="extras_param1_ID"/></td>
</tr>
<th>Parameter 2:</th>
<td><input type="text" name="extras_param2" id="extras_param2_ID"/></td>
</tr>
<th>Parameter 3:</th>
<td><input type="text" name="extras_param3" id="extras_param3_ID"/></td>
</tr>

<tr>
<td class="tablefooter" colspan="2"><a href="javascript:history.back()"><img src="style/back.gif" alt="Back"/></a>
<input type="image" src="style/insert.gif" name="SubmitForm" alt="Insert"/></td>
</tr>
</table>
</div>
</form>
<?php
include './Includes/BodyFoot.php';
?>
</body>
</html>

<?php } else {

$insertSql = "INSERT INTO pricing_extra_type (
display_order
,checkout_page
,field_default
,extras_text
,extras_booking_output
,extras_param1
,extras_param2 
,extras_param3 
,fk_extras_country_id
,fk_extras_supplier_id

) VALUES ( "
." '".addslashes($_POST['display_order'])."'"   
.", '".addslashes($_POST['checkout_page'])."'" 
.", '".addslashes($_POST['field_default'])."'" 
.", '".addslashes($_POST['extras_text'])."'"
.", '".addslashes($_POST['extras_booking_output'])."'"
.", '".addslashes($_POST['extras_param1'])."'"  
.", '".addslashes($_POST['extras_param2'])."'"   
.", '".addslashes($_POST['extras_param3'])."'"   
.", '".addslashes($Country->Rec["country_id"])."'" 
.", '".addslashes($_POST["supplierid"])."'"   
.")";



$MyDb->f_ExecuteSql($insertSql);

header('Location: extratypelist.php');
}
?>

