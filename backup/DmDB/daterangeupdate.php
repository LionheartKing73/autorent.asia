<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');


if (!(isset($_POST['SubmitForm_x'])))   {
$whereStmt = ' daterangeid="'.addslashes($_REQUEST['daterangeid']).'" AND  startdate="'.addslashes($_REQUEST['startdate']).'" AND  enddate="'.addslashes($_REQUEST['enddate']).'" AND  rangecode="'.addslashes($_REQUEST['rangecode']).'"';
$selectSql = 'SELECT * FROM dateranges WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert into dateranges</title>
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
<h1>Date Ranges</h1>

<p>Date Format: yyyy-mm-dd (eg 1967-05-25)</p>
<form name="UpdateForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<div id="insertblock">
<table>
<tr><td class="tableheader" colspan="2">Insert into dateranges</td></tr>
<tr>
<th>Calendar No:</th>
<td><input type="text" name="calendar_id" id="calendar_id_ID" value="<?php echo $Resultset['calendar_id']; ?>"></td>
</tr>
<tr>
<th>Region:</th>
<td>
<?php
    RegionSelect( "country_region_id", $Resultset['fk_daterange_country_region_id']) ;
?>

</td>
</tr>
<tr>
<th>Startdate:</th>
<td><input type="text" name="startdate" id="startdate_ID" value="<?php echo $Resultset['startdate']; ?>"></td>
</tr>
<tr>
<th>Enddate:</th>
<td><input type="text" name="enddate" id="enddate_ID" value="<?php echo $Resultset['enddate']; ?>"></td>
</tr>
<tr>
<th>Rangecode:</th>
<td><input type="text" name="rangecode" id="rangecode_ID" value="<?php echo $Resultset['rangecode']; ?>"></td>
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
$updateSql = 'UPDATE dateranges SET '
." startdate='".addslashes($_POST['startdate'])."'"
.", enddate='".addslashes($_POST['enddate'])."'"
.", calendar_id='".addslashes($_POST['calendar_id'])."'"  
.", rangecode='".addslashes($_POST['rangecode'])."'"
.", fk_daterange_country_region_id='".addslashes($_POST['country_region_id'])."'"    
.' WHERE '.stripslashes($_POST['hidden_whereStmt']);

$MyDb->f_ExecuteSql($updateSql);

header('Location: daterangelist.php');
}
?>


