<?php
include './Includes/Top.php';
include './Includes/mode.php';

include('general/header.inc');
require_once('general/general.php');

//if (isset($_GET['order']))     $myData->setOrderingInfo($_GET['order']);
if ($_REQUEST['page']) 
    $myData->actPageNr = $_REQUEST['page'];

    
//$myData->getWhereClause($_POST['formdata']);

$maxRecord = 9999;

$sqlbase = "SELECT * FROM pricing_scheme JOIN supplier ON fk_scheme_supplier_id = supplierid ".$myData->whereStr." AND fk_scheme_country_id = ".$Country->Rec["country_id"];
//$sql = $sqlbase." ORDER BY supplier_name LIMIT ".(($myData->actPageNr-1)*$maxRecord).",".$maxRecord;
$sql = $sqlbase." ORDER BY pricing_scheme_name";





$Result         = $MyDb->f_ExecuteSql($sql);
$ResultRowNr    = $MyDb->f_GetSelectedRows($Result);
$ResultTotalRow = $MyDb->f_ExecuteSql($sqlbase);
$totalRows      = $MyDb->f_GetSelectedRows($ResultTotalRow);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>List of table: pricing_scheme</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/myscripts.js"></script>
<?php
include './Includes/Head.php';
?>
</head>
<body>
<?php
include './Includes/BodyHead.php';
?>

<h1>Pricing Scheme</h1>

<div id ="main">
<table>
<tr>
<th></th>
<th></th>  
<th>Id:</th>
<th>Supplier:</th>   
<th>Scheme Name:</th>   

<th colspan="2">&nbsp;</th>
</tr>
<?php
$row = 0;
while ($Resultset = $MyDb->f_GetRecord($Result)) {
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;
echo '<td class="btn"><a href="pricinglist.php?pricing_scheme_id='.$Resultset['pricing_scheme_id'].'&pricing_scheme_name='.$Resultset['pricing_scheme_name'].'"><img src="style/detail.gif" alt="Update"/></a></td>';
echo '<td class="btn"><a href="extraslist.php?pricing_scheme_id='.$Resultset['pricing_scheme_id'].'&pricing_scheme_name='.$Resultset['pricing_scheme_name'].'"><img src="style/extras.gif" alt="Extras"/></a></td>';
echo '<td>'.$Resultset['pricing_scheme_id'].'</td>';
echo '<td>'.$Resultset['supplier_name'].'</td>'; 
echo '<td>'.$Resultset['pricing_scheme_name'].'</td>';

echo '<td class="btn"><a href="schemedelete.php?pricing_scheme_id='.$Resultset['pricing_scheme_id'].'&pricing_scheme_name='.$Resultset['pricing_scheme_name'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="schemeupdate.php?pricing_scheme_id='.$Resultset['pricing_scheme_id'].'&pricing_scheme_name='.$Resultset['pricing_scheme_name'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>
<tr><th colspan=5><a href="schemeinsert.php"><img src="style/insert.gif" alt="Insert"/></a></th></tr>
</table>
</div>

<div id ="navigation">
<?php setPager("schemelist.php?SC=1", $myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>
<?php
include './Includes/BodyFoot.php';
?>
</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
