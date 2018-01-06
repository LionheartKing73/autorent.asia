<?php
include './Includes/Top.php';
include './Includes/mode.php';


?>

<?php

include('general/header.inc');

require_once('general/general.php');


if (isset($_GET['order']))     $myData->setOrderingInfo($_GET['order']);
if (isset($_GET['page']))      $myData->actPageNr = $_GET['page'];
if (isset($_POST['formdata'])) $myData->getWhereClause($_POST['formdata']);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>List of table: supplier</title>
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
$sqlbase = "SELECT * FROM supplier ".$myData->whereStr.$myData->getOrderString();



$sql = $sqlbase."LIMIT ".(($myData->actPageNr-1)*$maxRecord).",".$maxRecord;


$Result         = $MyDb->f_ExecuteSql($sql);
$ResultRowNr    = $MyDb->f_GetSelectedRows($Result);
$ResultTotalRow = $MyDb->f_ExecuteSql($sqlbase);
$totalRows      = $MyDb->f_GetSelectedRows($ResultTotalRow);


?>
<h1>Suppliers</h1>



<div id ="main">
<table>
<tr>
<th><a href="supplierlist.php?order=startdate">Supplier Name:<?php $myData->setOrderImage("supplier_name"); ?></a></th>
<th align='center'><a href="supplierlist.php?order=startdate">Calendar No:<?php $myData->setOrderImage("calendar_id"); ?></a></th>  
<th>Use 1st Day Method</th>
<th>Allow one-way rentals</th>
<th>One way fee</th>
<th>One way days</th>

<th colspan="2">&nbsp;</th>
</tr>
<?php
$yesno[0] = "No";
$yesno[1] = "Yes";
$row = 0;
while ($Resultset = $MyDb->f_GetRecord($Result)) {
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;

echo '<td>'.$Resultset['supplier_name'].'</td>';  
echo '<td align="center">'.$Resultset['calendar_id'].'</td>';  
echo '<td align="center">'.$yesno[$Resultset['first_day_method']].'</td>';  
echo '<td align="center">'.$yesno[$Resultset['allow_one_way_rentals']].'</td>';  
echo '<td align="center">'.$Resultset['one_way_rental_fee'].'</td>';  
echo '<td align="center">'.$Resultset['owr_fee_max_days'].'</td>';  


echo '<td class="btn"><a href="supplierdelete.php?supplierid='.$Resultset['supplierid'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="supplierupdate.php?supplierid='.$Resultset['supplierid'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>
<tr><th colspan=6><a href="supplierinsert.php"><img src="style/insert.gif" alt="Insert"/></a></th></tr>
</table>
</div>

<div id ="navigation">
<?php setPager("supplierlist.php?a=1",$myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>

<?php
include './Includes/BodyFoot.php';
?>

</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
