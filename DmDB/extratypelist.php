<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>

<?php
include('general/header.inc');
require_once('general/general.php');

//if (isset($_GET['order']))     $myData->setOrderingInfo($_GET['order']);
if (isset($_REQUEST['page']))      
    $myData->actPageNr = $_REQUEST['page'];
    

//$myData->getWhereClause($_POST['formdata']);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>List of table: dateranges</title>
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
$maxRecord = 40;


$sqlbase = "SELECT * FROM pricing_extra_type LEFT JOIN supplier on supplierid =  fk_extras_supplier_id   "   .
   " WHERE fk_extras_country_id = ".$Country->Rec["country_id"]." ORDER BY supplier_name, display_order  ";


$sql = $sqlbase." LIMIT ".(($myData->actPageNr-1)*$maxRecord).",".$maxRecord;


$Result         = $MyDb->f_ExecuteSql($sql);
$ResultRowNr    = $MyDb->f_GetSelectedRows($Result);
$ResultTotalRow = $MyDb->f_ExecuteSql($sqlbase);
$totalRows      = $MyDb->f_GetSelectedRows($ResultTotalRow);


//$Resultset = $MyDb->f_GetRecord($Result);

?>
<h1>Supplier Extras</h1>



<div id ="main" style='width: 100%'>
<table width='100%'>
<tr>
<th align='center'><a href="daterangelist.php?order=startdate">Supplier:<?php $myData->setOrderImage("calendar_id"); ?></a></th>  
<th><a href="daterangelist.php?order=region_text">Order:<?php $myData->setOrderImage("region_text"); ?></a></th>     
<th><a href="daterangelist.php?order=region_text">Description:<?php $myData->setOrderImage("region_text"); ?></a></th>   
<th><a href="daterangelist.php?order=startdate">Booking Output:<?php $myData->setOrderImage("startdate"); ?></a></th>
<th >Page</th>
<th >Default</th>
<th colspan="2">&nbsp;</th>
</tr>
<?php
$row = 0;
while ($Resultset = $MyDb->f_GetRecord($Result)) {
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;
echo '<td align="center">'.$Resultset['supplier_name'].'</td>'; 
echo '<td>'.$Resultset['display_order'].'</td>';      
echo '<td>'.$Resultset['extras_text'].'</td>';
echo '<td>'.$Resultset['extras_booking_output'].'</td>';
echo '<td>'.$Resultset['checkout_page'].'</td>';
echo '<td>'.$Resultset['field_default'].'</td>';

echo '<td class="btn"><a href="extratypedelete.php?extra_type_id='.$Resultset['pricing_extra_type_id'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="extratypeupdate.php?extra_type_id='.$Resultset['pricing_extra_type_id'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>
<tr><th colspan=6><a href="extratypeinsert.php"><img src="style/insert.gif" alt="Insert"/></a></th></tr>
</table>
</div>

<div id ="navigation">
<?php setPager("extratypelist.php?p=1",$myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>

<?php
include './Includes/BodyFoot.php';
?>

</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
