<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');


if (!(isset($_POST['SubmitForm_x'])))   {
$whereStmt = ' credit_card_id='.addslashes($_GET['credit_card_id']).' ';
$selectSql = 'SELECT * FROM credit_card WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Update Credit Cards</title>
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
<tr><td class="tableheader" colspan="2">Update Credit Card</td></tr>
  <tr>
<th width='30%'>Supplier:</th>
<td>
<?php
     SupplierSelect( $Resultset["fk_cc_supplier_id"] );

?>
</td>
</tr>
     <tr>


<th width='30%' >Credit Card:</th>
<td><input type="text" value='<?php echo $Resultset["credit_card_description"]?>' size='40' name="credit_card_description" id="credit_card_description_ID"/></td>
</tr>
<tr>
<th>Extra Rate:</th>
<td><input type="text" value='<?php echo $Resultset["charge_rate"]?>' name="charge_rate"  id="charge_rate_ID"/></td>
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
$updateSql = 'UPDATE credit_card SET '
." credit_card_description='".addslashes($_POST['credit_card_description'])."'"
.", charge_rate='".addslashes($_POST['charge_rate'])."'"
.", fk_cc_supplier_id='".addslashes($_POST['supplierid'])."'"  
.' WHERE '.stripslashes($_POST['hidden_whereStmt']);

$MyDb->f_ExecuteSql($updateSql);

header('Location: cclist.php');
}
?>


