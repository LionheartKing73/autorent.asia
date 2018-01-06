<?php
include './Includes/Top.php';
include './Includes/mode.php';

include('general/header.inc');
require_once('general/general.php');

      /*
$sql = "insert into supplier (supplier_name) values ( 'Hertz' );"  ;
$red = mysql_query( $sql ); 
 
$sql = "alter table bookings add column payment_type_id integer default 1";
$red = mysql_query( $sql );

  $sql = "select * from bookings;"  ;
$red = mysql_query( $sql ); 
  $Rec = mysql_fetch_array( $red );
  var_dump( $Rec );
   */  
if (isset($_GET['order']))     $myData->setOrderingInfo($_GET['order']);
if (isset($_GET['page']))      $myData->actPageNr = $_GET['page'];
if (isset($_POST['formdata'])) $myData->getWhereClause($_POST['formdata']);

$maxRecord = 20;
if ( is_numeric( $_REQUEST[ "pricing_scheme_id" ] ) )
	$SchemeId = $_REQUEST[ "pricing_scheme_id" ];
else
	$SchemeId = 0;

/*
$selectSql = 'ALTER TABLE pricing ADD insurance_rate DECIMAL(10,2) DEFAULT 0' ;
$Result    = $MyDb->f_ExecuteSql($selectSql);

var_dump( $MyDb );
exit;

*/

$sqlbase = "SELECT p.*,s.pricing_scheme_name FROM pricing_scheme s, pricing p WHERE p.pricing_scheme_id = ".$SchemeId." and p.pricing_scheme_id = s.pricing_scheme_id ORDER BY months, days, daterange_code";

$sql = $sqlbase."LIMIT ".(($myData->actPageNr-1)*$maxRecord).",".$maxRecord;
$Result         = $MyDb->f_ExecuteSql($sql);
$ResultRowNr    = $MyDb->f_GetSelectedRows($Result);
$ResultTotalRow = $MyDb->f_ExecuteSql($sqlbase);
$totalRows      = $MyDb->f_GetSelectedRows($ResultTotalRow);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>List of table: pricing</title>
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


<?php
$row = 0;


while ($Resultset = $MyDb->f_GetRecord($Result)) {
if ( $row == 0 )
{
?>
<h1>Prices: <?php echo $Resultset[ "pricing_scheme_name" ]?></h1>


<div id ="main">
<table>
<tr>
<th>Date Range Code:</th>
<th>Days</a></th>
<th>Mths</th>
<th>Walk-in</a></th>
<th>Price</a></th>
<th>Balance (Minus Deposit)</a></th> 
<th>Ins. Rate</th> 
<th>PAI</th> 
<th>Child Seat</th> 
<th>GPS (en)</th> 
<th>GPS (th)</th> 
<th colspan="2">&nbsp;</th>
</tr>
<?php
}
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;
echo '<td>'.$Resultset['daterange_code'].'</td>';
echo '<td>'.$Resultset['days'].'</td>';
echo '<td>'.$Resultset['months'].'</td>';
echo '<td>'.$Resultset['full_rate'].'</td>';
echo '<td>'.$Resultset['price'].'</td>';
echo '<td>'.$Resultset['booking_balance'].'</td>'; 
echo '<td>'.$Resultset['insurance_rate'].'</td>'; 
echo '<td>'.$Resultset['pai_rate'].'</td>'; 
echo '<td>'.$Resultset['child_seat_rate'].'</td>'; 
echo '<td>'.$Resultset['gps_en_rate'].'</td>'; 
echo '<td>'.$Resultset['gps_th_rate'].'</td>'; 
echo '<td class="btn"><a href="pricingdelete.php?pricing_id='.$Resultset['pricing_id'].'&pricing_scheme_id='.$Resultset['pricing_scheme_id'].'&days='.$Resultset['days'].'&months='.$Resultset['months'].'&price='.$Resultset['price'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="pricingupdate.php?pricing_id='.$Resultset['pricing_id'].'&pricing_scheme_id='.$Resultset['pricing_scheme_id'].'&days='.$Resultset['days'].'&months='.$Resultset['months'].'&price='.$Resultset['price'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>
<tr><th colspan=8><a href="pricinginsert.php?pricing_scheme_id=<?php echo $SchemeId?>"><img src="style/insert.gif" alt="Insert"/></a></th></tr>
</table>
</div>

<div id ="navigation">
<?php setPager("pricinglist.php?pricing_scheme_id=".$SchemeId,$myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>

<?php
include './Includes/BodyFoot.php';
?>
</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
