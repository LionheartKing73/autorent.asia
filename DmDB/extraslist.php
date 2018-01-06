<?php
include './Includes/Top.php';
include './Includes/mode.php';
$myData="";
include('general/header.inc');
require_once('general/general.php');

function TranslateText( $text, $param1, $param2, $param3)
{
        $text = str_replace( "PARAM1", $param1, $text);
        $text = str_replace( "PARAM2", $param2, $text); 
        $text = str_replace( "PARAM3", $param3, $text); 
        
        return $text;
}
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
if (isset($_GET['page'])) 
     $myData->actPageNr = $_GET['page'];
else
     $myData->actPageNr = 1; 
//if (isset($_POST['formdata'])) $myData->getWhereClause($_POST['formdata']);

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

$sqlbase = "SELECT * FROM pricing_scheme s " .
            " JOIN pricing_extra_type pet ON  pet.fk_extras_supplier_id = s.fk_scheme_supplier_id " .    
            " JOIN pricing_extras p ON  p.fk_extras_pricing_scheme_id = s.pricing_scheme_id  " .
            "AND p.fk_extras_pricing_extra_type_id = pet.pricing_extra_type_id " .
            "WHERE s.pricing_scheme_id = ".$SchemeId." ORDER by display_order, extras_text, days ";

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
<h1>Extras: <?php echo $Resultset[ "pricing_scheme_name" ]?></h1>


<div >
<table width='100%'>
<tr>
<th>Order:</th>
<th>Extra</a></th>
<th>Booking Text</th>

<th>Days</th> 
<th>Rate</th> 
<th>Limit</th> 

<th colspan="2">&nbsp;</th>
</tr>
<?php
}
$str = (($row++ % 2) == 0 ) ? '<tr>' : '<tr class="odd">';
echo $str;

echo '<td>'.$Resultset['display_order'].'</td>';
echo '<td>'.$Resultset['extras_text'].'</td>';
echo '<td>';
echo TranslateText( $Resultset['extras_booking_output'],$Resultset['param1'],$Resultset['param2'],$Resultset['param3'] );
print '</td>';

echo '<td>'.$Resultset['days'].'</td>'; 
echo '<td>'.$Resultset['extras_rate'].'</td>'; 
echo '<td>'.$Resultset['extras_limit'].'</td>'; 

echo '<td class="btn"><a href="extrasdelete.php?pricing_scheme_id='.$SchemeId.'&type='.$Resultset['pricing_extra_type_id'].'&pricing_extras_id='.$Resultset['pricing_extras_id'].'"><img src="style/delete.gif" alt="Delete"/></a></td>';
echo '<td class="btn"><a href="extrasupdate.php?pricing_scheme_id='.$SchemeId.'&type='.$Resultset['pricing_extra_type_id'].'&pricing_extras_id='.$Resultset['pricing_extras_id'].'"><img src="style/update.gif" alt="Update"/></a></td>';
echo '</tr>';
}
?>

</table>
</div>

<div id ="navigation">
<?php setPager("extraslist.php?pricing_scheme_id=".$SchemeId,$myData->actPageNr,ceil($totalRows/$maxRecord)); ?>
</div>

<?php
// Now handle the inserts
$sql = "SELECT * FROM pricing_scheme s " .
            " JOIN pricing_extra_type pet ON  pet.fk_extras_supplier_id = s.fk_scheme_supplier_id " .    
              "WHERE s.pricing_scheme_id = ".$SchemeId." ORDER by display_order, extras_text "; 
$ResultSet = mysql_query( $sql ) ;
print "<ul>";
while ($row = mysql_fetch_array($ResultSet) ) {   

print '<li><a href="extrasupdate.php?pricing_scheme_id='.$SchemeId.'&type='.$row['pricing_extra_type_id'].'">Insert new pricing for '.$row[extras_text].'</a>';   
}  
print "</ul>";      
              
include './Includes/BodyFoot.php';
?>
</body>

</html>
<?php
$_SESSION['usr']=serialize($myData);
?>
