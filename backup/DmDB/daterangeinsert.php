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
<h1>Date Ranges</h1>

<p>Date Format: yyyy-mm-dd (eg 1967-05-25)</p>
<form name="InsertForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">

<div id="insertblock">
<table>
<tr><td class="tableheader" colspan=2>Insert into dateranges</td></tr>
<tr>
<th>Calendar No:</th>
<td><input type="text" name="calendar_id" id="calendar_ID"/></td>
</tr>
<tr>
<th>Region:</th>
<td>
<?php
    RegionSelect( "country_region_id", 0 ) ;
?>

</td>
</tr>
<tr>
<th>Startdate:</th>
<td><input type="text" name="startdate" id="startdate_ID"/></td>
</tr>
<tr>
<th>Enddate:</th>
<td><input type="text" name="enddate" id="enddate_ID"/></td>
</tr>
<tr>
<th>Rangecode:</th>
<td><input type="text" name="rangecode" id="rangecode_ID"/></td>
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

$insertSql = "INSERT INTO dateranges (
calendar_id
,startdate
,enddate
,rangecode
,fk_daterange_country_id
,fk_daterange_country_region_id

) VALUES ( "
." '".addslashes($_POST['calendar_id'])."'"   
.", '".addslashes($_POST['startdate'])."'"
.", '".addslashes($_POST['enddate'])."'"
.", '".addslashes($_POST['rangecode'])."'"  
.", '".addslashes($Country->Rec["country_id"])."'" 
.", '".addslashes($_POST["country_region_id"])."'"   
.")";



$MyDb->f_ExecuteSql($insertSql);

header('Location: daterangelist.php');
}
?>

