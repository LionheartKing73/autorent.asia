<?php
include './Includes/Top.php';
include './Includes/mode.php';

include('general/header.inc');
require_once('general/general.php');
/*
$selectSql = 'ALTER TABLE pricing_scheme ADD insurance_rate DECIMAL(10,2) DEFAULT 0' ;
$Result    = $MyDb->f_ExecuteSql($selectSql);

var_dump( $MyDb );
exit;

*/

if (!(isset($_POST['SubmitForm_x'])))   {
$whereStmt = ' pricing_scheme_id="'.addslashes($_GET['pricing_scheme_id']).'" AND  pricing_scheme_name="'.addslashes($_GET['pricing_scheme_name']).'"';
$selectSql = 'SELECT * FROM pricing_scheme WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert into pricing_scheme</title>
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

<h1>Pricing Scheme</h1>
<form name="UpdateForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<div id="insertblock">
<table>
<tr><td class="tableheader" colspan="2">Insert into pricing_scheme</td></tr>


<tr>
<th>Pricing_scheme_name:</th>
<td><input type="text" name="pricing_scheme_name" id="pricing_scheme_name_ID" value="<?php echo $Resultset['pricing_scheme_name']; ?>"></td>
</tr>

<tr>
<th>Supplier:</th>
<td>
<?php
     SupplierSelect( $Resultset["fk_scheme_supplier_id"] );

?>
</td>
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
$updateSql = 'UPDATE pricing_scheme SET '

." fk_scheme_supplier_id='".addslashes($_POST['supplierid'])."'"   
//.",insurance_rate='".addslashes($_POST['insurance_rate'])."'"
.", pricing_scheme_name='".addslashes($_POST['pricing_scheme_name'])."'"

.' WHERE '.stripslashes($_POST['hidden_whereStmt']);

$MyDb->f_ExecuteSql($updateSql);

header('Location: schemelist.php');
}
?>


