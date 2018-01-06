<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

if (!(isset($_POST['SubmitForm_x'])))   {
$whereStmt = ' country_region_id="'.addslashes($_GET['regionid']).'"';
$selectSql = 'SELECT * FROM country_region WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);

print $selectSql;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert/Update Region</title>
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
<h1>Regions</h1>


<form name="UpdateForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<div id="insertblock">
<table>
<tr><td class="tableheader" colspan="2">Regions</td></tr>
<tr>
<th>Region Text:</th>
<td><input type="text" name="region_text" id="region_text_ID" value="<?php echo $Resultset['region_text']; ?>"></td>
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
$updateSql = 'UPDATE country_region SET '
." region_text='".addslashes($_POST['region_text'])."'"


.' WHERE '.stripslashes($_POST['hidden_whereStmt']);

$MyDb->f_ExecuteSql($updateSql);

header('Location: regionlist.php');
}
?>


