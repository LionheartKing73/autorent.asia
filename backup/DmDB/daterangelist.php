<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>

<?php
include('general/header.inc');
require_once('general/general.php');

//if (isset($_GET['order']))     $myData->setOrderingInfo($_GET['order']);
if (isset($_GET['page']))      $myData->actPageNr = $_GET['page'];
$myData->getWhereClause($_POST['formdata']);



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
$maxRecord = 9999;


$sqlbase = "SELECT * FROM dateranges LEFT JOIN country_region ON fk_daterange_country_region_id = country_region_id  "   .
//    $myData->whereStr." AND enddate >= now() AND fk_daterange_country_id = ".$Country->Rec["country_id"]." ORDER BY region_text, startdate DESC, enddate DESC";
    $myData->whereStr." AND fk_daterange_country_id = ".$Country->Rec["country_id"]." ORDER BY region_text, startdate DESC, enddate DESC";


$sql = $sqlbase; //."LIMIT ".(($myData->actPageNr-1)*$maxRecord).",".$maxRecord;


$Result         = $MyDb->f_ExecuteSql($sql);
$ResultRowNr    = $MyDb->f_GetSelectedRows($Result);
$ResultTotalRow = $MyDb->f_ExecuteSql($sqlbase);
$totalRows      = $MyDb->f_GetSelectedRows($ResultTotalRow);


//$Resultset = $MyDb->f_GetRecord($Result);

?>
<h1>Date Ranges</h1>

<p>Date Format: yyyy-mm-dd (eg 1967-05-25)</p>

<div id ="main">
<table>
<tr>
<th align='center'><a href="daterangelist.php?order=startdate">Calendar No:<?php $myData->setOrderImage("calendar_id"); ?></a></th>  
<th><a href="daterangelist.php?order=region_text">Region:<?php $myData->setOrderImage("region_text"); ?></a></th>     
<th><a href="daterangelist.php?order=startdate">Startdate:<?php $myData->setOrderImage("startdate"); ?></a></th>
<th><a href="daterangelist.php?order=enddate">Enddate:<?php $myData->setOrderImage("enddate"); ?></a></th>
<th><a href="daterangelist.php?order=rangecode">Rangecode:<?php $myData->setOrderImage("rangecode"); ?></a></th>

<th colspan="2">&nbsp;</th>
</tr>
<?php
$row = 0;
while ($Resultset = $MyDb->f_GetRecord($Result)) {
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;
echo '<td align="center">'.$Resultset['calendar_id'].'</td>'; 
echo '<td>'.$Resultset['region_text'].'</td>';    
echo '<td>'.$Resultset['startdate'].'</td>';
echo '<td>'.$Resultset['enddate'].'</td>';
echo '<td>'.$Resultset['rangecode'].'</td>';

echo '<td class="btn"><a href="daterangedelete.php?daterangeid='.$Resultset['daterangeid'].'&startdate='.$Resultset['startdate'].'&enddate='.$Resultset['enddate'].'&rangecode='.$Resultset['rangecode'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="daterangeupdate.php?daterangeid='.$Resultset['daterangeid'].'&startdate='.$Resultset['startdate'].'&enddate='.$Resultset['enddate'].'&rangecode='.$Resultset['rangecode'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>
<tr><th colspan=6><a href="daterangeinsert.php"><img src="style/insert.gif" alt="Insert"/></a></th></tr>
</table>
</div>

<div id ="navigation">
<?php setPager("daterangelist.php?pricing_scheme_id=".$SchemeId,$myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>

<?php
include './Includes/BodyFoot.php';
?>

</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
