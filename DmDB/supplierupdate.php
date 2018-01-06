<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

if (!(isset($_POST['SubmitForm_x'])))   {
$whereStmt = ' supplierid='.addslashes($_GET['supplierid']);
$selectSql = 'SELECT * FROM supplier WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Update Suppliers</title>
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
<h1>Suppliers</h1>


<form name="UpdateForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<div id="insertblock">
<table>
<tr><td class="tableheader" colspan="2">Update Suppliers</td></tr>
<tr>
<th>Supplier Name:</th>
<td><input type="text" name="supplier_name" id="supplier_name_ID" value="<?php echo $Resultset['supplier_name']; ?>"></td>
</tr>
<tr>
<th>Calendar No:</th>
<td><input type="text" name="calendar_id" id="calendar_id_ID" value="<?php echo $Resultset['calendar_id']; ?>"></td>
</tr>
<tr>
<th>Use First Day of booking for rates:</th>
<td>
<?php
    if ( $Resultset['first_day_method'] )
        $fd_checked = "checked";
    else
        $fd_unchecked = "checked";
        print "No <input type=radio value='0' name='first_day_method' $fd_unchecked>";
        print "   Yes <input type=radio value='1' name='first_day_method' $fd_checked>";
    
?></td>
</tr>
<tr>
<th>Allow One way rentals?:</th>
<td>
<?php
    if ( $Resultset['allow_one_way_rentals'] )
        $ow_checked = "checked";
    else
        $ow_unchecked = "checked";
        print "No <input type=radio value='0' name='allow_one_way_rentals' $ow_unchecked>";
        print "   Yes <input type=radio value='1' name='allow_one_way_rentals' $ow_checked>";
    
?></td>
</tr>
<tr>
<th>One Way Rental Fee:</th>
<td><input type="text" name="one_way_rental_fee" id="one_way_rental_fee_ID" value="<?php echo $Resultset['one_way_rental_fee']; ?>"></td>
</tr>
<tr>
<th>For bookings not over (days):</th>
<td><input type="text" name="owr_fee_max_days" id="owr_fee_max_days_ID" value="<?php echo $Resultset['owr_fee_max_days']; ?>"></td>
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
$updateSql = 'UPDATE supplier SET '
." supplier_name='".addslashes($_POST['supplier_name'])."'"
.", first_day_method='".addslashes($_POST['first_day_method'])."'"
.", allow_one_way_rentals='".addslashes($_POST['allow_one_way_rentals'])."'"
.", one_way_rental_fee='".addslashes($_POST['one_way_rental_fee'])."'"
.", owr_fee_max_days='".addslashes($_POST['owr_fee_max_days'])."'"
.", calendar_id='".addslashes($_POST['calendar_id'])."'"  


.' WHERE '.stripslashes($_POST['hidden_whereStmt']);



$MyDb->f_ExecuteSql($updateSql);

header('Location: supplierlist.php');
}
?>


