<?php
include './Includes/Top.php';
include './Includes/mode.php';

include('general/header.inc');
require_once('general/general.php');

if (!(isset($_POST['SubmitForm_x'])))
{ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>Insert into pricing_scheme</title>
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
<h1>Pricing Scheme</h1>
<form name="InsertForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">

<div id="insertblock">
<table>
<tr><td class="tableheader" colspan=2>Insert into pricing_scheme</td></tr>


<tr>
<th>Pricing_scheme_name:</th>
<td><input type="text" name="pricing_scheme_name" id="pricing_scheme_name_ID"/></td>
</tr>

<tr>
<th>Supplier:</th>
<td>
<?php
 SupplierSelect( 0 ); 
 ?>
</td>
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

$insertSql = "INSERT INTO pricing_scheme (
pricing_scheme_id
,pricing_scheme_name
,fk_scheme_supplier_id  
,fk_scheme_country_id

) VALUES ( "
." '".addslashes($_POST['pricing_scheme_id'])."'"
.", '".addslashes($_POST['pricing_scheme_name'])."'"
.", '".addslashes($_POST['supplierid'])."'"  
.", '".addslashes($Country->Rec["country_id"])."'"   

.")";

$MyDb->f_ExecuteSql($insertSql);
     
header('Location: schemelist.php');
}
?>

