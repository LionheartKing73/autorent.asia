<?php
include './Includes/Top.php';
include './Includes/mode.php';

?>
<?php
include('general/header.inc');
require_once('general/general.php');
if ( is_numeric($_REQUEST['districtid'] ))
	$districtid = $_REQUEST['districtid'];
else
{
	
	exit;
}
	

// If the OWC form is being posted?
if ( $REQUEST["ftype"] = "owc")
{
	foreach( $_REQUEST as $key=>$value )
	{
		if ( substr($key,0,3 ) == "owc")
		{
			$owcarr = explode("-", $key);
			$owckey = $owcarr[2];
			$diskey = $owcarr[1];
			

			if( ! $owckey && $value )
			{
				if ( is_numeric( $_REQUEST["supplierid"] ))
				{
					
					// Check that the record doesn't already exist
					
				$supplierid = $_REQUEST["supplierid"];
				$owcsql = "insert into one_way_costs " .
						" ( fk_owc_supplier_id, fk_d1_district_id,fk_d2_district_id,one_way_cost ) VALUES " .
						" ( ".$supplierid.", ".$districtid.", ".$diskey.", ".$value." ) ";
						
				}
				
			}
			else
			{
				$owcsql = "update one_way_costs " .
						" SET one_way_cost = $value WHERE one_way_costs_id = $owckey " ;
				
			}
			$Result    = $MyDb->f_ExecuteSql($owcsql);	
				
			
		}
	
	}
	
}



if (!(isset($_POST['SubmitForm_x'])))   {
	
$whereStmt = ' district_id="'.addslashes($districtid).'"';
$selectSql = 'SELECT * FROM district WHERE '.$whereStmt ;
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert/Update District</title>
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
<tr><td class="tableheader" colspan="2">District</td></tr>
<tr>
<th>District Text:</th>
<td><input type="text" name="district_text" id="district_text_ID" value="<?php echo $Resultset['district_text']; ?>"></td>
</tr>
<tr>
<th>District Order:</th>
<td><input type="text" name="district_order" id="district_order_ID" value="<?php echo $Resultset['district_order']; ?>"></td>
</tr>


<tr>
<?php
echo '<td class="tablefooter" colspan="2"><a href="districtlist.php"><img src="style/back.gif" alt="Back"></a>';
echo '<input type="image" src="style/update.gif" name="SubmitForm">';
?>
<input type="hidden" name="districtid" value='<?php echo $Resultset['district_id']; ?>'>
<input type="hidden" name="hidden_whereStmt" value='<?php echo $whereStmt; ?>'></td>
</tr>
</table>
</div>
</form>

<h2>One Way Costs To/From <?php echo $Resultset['district_text']?></h2>




<?php
$selectSql = "SELECT * FROM supplier where allow_one_way_rentals = 1 ";
$ResultSup    = $MyDb->f_ExecuteSql($selectSql);
while ( $RecSup = $MyDb->f_GetRecord($ResultSup))
{
	
	?>
	<form name="OneWayCostsForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?districtid=<?php echo $Resultset['district_id'] ?>&supplierid=<?php echo $RecSup["supplierid"] ?>" onSubmit="return checkForm()">
	
	<?php
	

print "<h3>Supplier: ".$RecSup["supplier_name"]."</h3>";
$selectSql = "SELECT * FROM district d LEFT JOIN one_way_costs ON (( fk_d1_district_id = d.district_id AND fk_d2_district_id = ".$Resultset['district_id']."  ) OR ( fk_d2_district_id = d.district_id AND fk_d1_district_id = ".$Resultset['district_id']." )) AND fk_owc_supplier_id = ".$RecSup["supplierid"]." WHERE d.district_id <> ".$Resultset['district_id']."  AND fk_district_country_id = ".$Country->Rec["country_id"]." ORDER BY d.district_text";


$Result    = $MyDb->f_ExecuteSql($selectSql);

print "<table align='center'>";
	print "<tr>";
print "<th>District</th>";
print "<th>Transfer Cost</th>";
print "</tr>";
while ( $RecOWC = $MyDb->f_GetRecord($Result))
{



	print "<tr>";
print "<td>".$RecOWC["district_text"]."</td>";
print "<td><input name='owc-".$RecOWC["district_id"]."-".$RecOWC["one_way_costs_id"]."' value='".$RecOWC["one_way_cost"]."'/></td>";
print "</tr>";
}




?>
<input type='hidden' name='ftype' value='owc'/>
<tr><td></td><td><input type='submit'  value='Save'/></td></tr>

</form>
<?php
print "</table>";
}
include './Includes/BodyFoot.php';
?>

</body>
</html>


<?php
}
else {
$updateSql = 'UPDATE district SET '
." district_text='".addslashes($_POST['district_text'])."',"
." district_order='".addslashes($_POST['district_order'])."'"

.' WHERE '.stripslashes($_POST['hidden_whereStmt']);

$MyDb->f_ExecuteSql($updateSql);

header('Location: districtlist.php');
}
?>


