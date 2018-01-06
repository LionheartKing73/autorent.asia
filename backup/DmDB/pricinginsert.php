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
<title>Insert into pricing</title>
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
<h1>Prices</h1>
<form name="InsertForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<input type="hidden" name="pricing_scheme_id" value="<?php echo $_REQUEST['pricing_scheme_id'];?>">

<div id="insertblock">
<table>
<tr><td class="tableheader" colspan=2>Insert into pricing</td></tr>

<tr>
<th>Date Range Code</th>
<td>
<?php
$selectSql = 'SELECT distinct rangecode FROM dateranges ORDER BY rangecode' ;
$drResult    = $MyDb->f_ExecuteSql($selectSql);
print "<select name='daterange_code'>";
while ($drResultset = $MyDb->f_GetRecord($drResult)) {

	$RC = $drResultset[ "rangecode" ];
	if (  $RC == $Resultset[ "daterange_code" ] )
		$sel = "selected";
	else	
		$sel = "";
	print "<option value='".$RC."'>".$RC."</option>";

}
print "</select>";
?>
</td>
</tr>
<tr>
<th>Days:</th>
<td><input type="text" name="days" id="days_ID"/></td>
</tr>
<tr>
<th>Months:</th>
<td><input type="text" name="months" id="months_ID"/></td>
</tr>
<tr>
<th>Walk-In:</th>
<td><input type="text" name="full_rate" id="full_rate_ID" ></td>
</tr>
<tr>
<th>Price:</th>
<td><input type="text" name="price" id="price_ID"/></td>
</tr>
<th>Balance (Minus Deposit):</th>
<td><input type="text" name="booking_balance" id="booking_balance_ID" value="<?php echo $Resultset['booking_balance']; ?>"></td>
</tr>

<tr>
<th>Insurance Rate:</th>
<td><input type="text" name="insurance_rate" id="insurance_rate_ID" value="<?php echo $Resultset['insurance_rate']; ?>"></td>
</tr>
<th>Personal Accident Ins. Rate:</th>
<td><input type="text" name="pai_rate" id="pai_rate_ID" value="<?php echo $Resultset['pai_rate']; ?>"></td>
</tr>
<tr>
<th>Child Seat Rate:</th>
<td><input type="text" name="child_seat_rate" id="child_seat_rate_ID" value="<?php echo $Resultset['child_seat_rate']; ?>"></td>
</tr>
<tr>
<th>GPS (English):</th>
<td><input type="text" name="gps_en_rate" id="gps_en_rate_ID" value="<?php echo $Resultset['gps_en_rate']; ?>"></td>
</tr>
<tr>
<th>GPS (Thai):</th>
<td><input type="text" name="gps_th_rate" id="gps_th_rate_ID" value="<?php echo $Resultset['gps_th_rate']; ?>"></td>
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

$insertSql = "INSERT INTO pricing (
pricing_scheme_id
,daterange_code
,days
,months
,full_rate
,price
,insurance_rate
,pai_rate
,child_seat_rate
,gps_en_rate
,gps_th_rate
,booking_balance

) VALUES ( "
." '".addslashes($_POST['pricing_scheme_id'])."'"
.", '".addslashes($_POST['daterange_code'])."'"
.", '".addslashes($_POST['days'])."'"
.", '".addslashes($_POST['months'])."'"
.", '".addslashes($_POST['full_rate'])."'"
.", '".addslashes($_POST['price'])."'"
.", '".addslashes($_POST['insurance_rate'])."'"
.", '".addslashes($_POST['pai_rate'])."'"
.", '".addslashes($_POST['child_seat_rate'])."'"
.", '".addslashes($_POST['gps_en_rate'])."'"
.", '".addslashes($_POST['gps_th_rate'])."'"
.", '".addslashes($_POST['booking_balance'])."'"  
.")";


$MyDb->f_ExecuteSql($insertSql);

header('Location: pricinglist.php?pricing_scheme_id='.$_POST['pricing_scheme_id']);
}
?>

