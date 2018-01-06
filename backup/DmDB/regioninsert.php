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
<h1>Region</h1>


<form name="InsertForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">

<div id="insertblock">
<table>
<tr><td class="tableheader" colspan=2>Insert into region</td></tr>
<tr><td class="tableheader" colspan="2">Regions</td></tr>
<tr>
<th>Region Text:</th>
<td><input type="text" name="region_text" id="region_text_ID" value="<?php echo $Resultset['region_text']; ?>"></td>
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

$insertSql = "INSERT INTO country_region (
region_text
,fk_region_country_id

) VALUES ( "
." '".addslashes($_POST['region_text'])."'"   
.", '".addslashes($Country->Rec["country_id"])."'" 
.")";



$MyDb->f_ExecuteSql($insertSql);

header('Location: regionlist.php');
}
?>

