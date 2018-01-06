<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>

<?php
include('general/header.inc');
require_once('general/general.php');

if (isset($_GET['order']))     $myData->setOrderingInfo($_GET['order']);
if (isset($_GET['page']))      $myData->actPageNr = $_GET['page'];
$myData->getWhereClause($_POST['formdata']);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>List of table: Regions</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/myscripts.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>
</head>
<html>
<head>



</head>

<?php
include './Includes/BodyHead.php';
$maxRecord = 20;


$sqlbase = "SELECT * FROM country_region ".$myData->whereStr." AND fk_region_country_id = ".$Country->Rec["country_id"].$myData->getOrderString();

print $sqlbase;

$sql = $sqlbase; //."LIMIT ".(($myData->actPageNr-1)*$maxRecord).",".$maxRecord;


$Result         = $MyDb->f_ExecuteSql($sql);
$ResultRowNr    = $MyDb->f_GetSelectedRows($Result);
$ResultTotalRow = $MyDb->f_ExecuteSql($sqlbase);
$totalRows      = $MyDb->f_GetSelectedRows($ResultTotalRow);



?>
<h1>Regions</h1>



<div id ="main">
<table>
<tr>
<th align='center'><a href="daterangelist.php?order=region_text">Region:<?php $myData->setOrderImage("region_text"); ?></a></th>  


<th colspan="2">&nbsp;</th>
</tr>
<?php
$row = 0;
while ($Resultset = $MyDb->f_GetRecord($Result)) {
    
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;
 
echo '<td>'.$Resultset['region_text'].'</td>';


echo '<td class="btn"><a href="regiondelete.php?regionid='.$Resultset['country_region_id'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="regionupdate.php?regionid='.$Resultset['country_region_id'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>
<tr><th colspan=6><a href="regioninsert.php"><img src="style/insert.gif" alt="Insert"/></a></th></tr>
</table>
</div>

<div id ="navigation">
<?php setPager("regionlist.php",$myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>

<?php
include './Includes/BodyFoot.php';
?>

</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
