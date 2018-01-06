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
<title>Insert into Credit Cards</title>
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
<tr><td class="tableheader" colspan=2>Insert into Credit Card</td></tr>
<tr>
<th>Supplier:</th>
<td>
<?php
     SupplierSelect( 0 );

?>
</td>
</tr>
<tr>


<th width='30%' >Credit Card:</th>
<td><input type="text" size='40' name="credit_card_description" id="credit_card_description_ID"/></td>
</tr>
<tr>
<th>Extra Rate:</th>
<td><input type="text" name="charge_rate"  id="charge_rate_ID"/></td>
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

$insertSql = "INSERT INTO credit_card (
credit_card_description
,charge_rate
,fk_cc_country_id
,fk_cc_supplier_id 
) VALUES ( "
." '".addslashes($_POST['credit_card_description'])."'"   
.", '".addslashes($_POST['charge_rate'])."'"
.", '".addslashes($Country->Rec["country_id"])."'" 
.", '".addslashes($_POST["supplierid"])."'"    
.")";



$MyDb->f_ExecuteSql($insertSql);

header('Location: cclist.php');
}
?>

