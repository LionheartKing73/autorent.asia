<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');


if ( is_numeric( $_REQUEST[ "pricing_scheme_id" ] ) )
    $SchemeId = $_REQUEST[ "pricing_scheme_id" ];
else
    $SchemeId = 0;
    
    if ( $_REQUEST['pricing_extras_id'] )
        $extras_id = $_REQUEST['pricing_extras_id'];
    else
        $extras_id = 0;
    if ( is_numeric( $_REQUEST['type'] ) )
        $pricing_extra_type_id = $_REQUEST['type'];
    else
        $pricing_extra_type_id = 0;

$selectSql = "SELECT * FROM pricing_extra_type pet " .
            " JOIN supplier s ON s.supplierid = pet.fk_extras_supplier_id " .
            " LEFT JOIN pricing_extras p " .
            " ON pet.pricing_extra_type_id = p.fk_extras_pricing_extra_type_id " .
            " AND pricing_extras_id='".addslashes( $extras_id )."' " .
            " WHERE pet.pricing_extra_type_id = '".addslashes($_GET['type'])."' ";
$Result    = $MyDb->f_ExecuteSql($selectSql);
$Resultset = $MyDb->f_GetRecord($Result);

if (!(isset($_POST['SubmitForm_x'])))   {  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Update Pricing Extras</title>
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
<h1>Extras: <?php echo $Resultset["supplier_name"]." - ".$Resultset["extras_text"]?></h1>


<form name="UpdateForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkForm()">
<div >
<table width='100%'>

<tr>


<th width='30%' >Days:</th>
<td><input type="text" name="days" value='<?php echo $Resultset["days"]?>' id="days_ID"/></td>
</tr>
<tr>
<th>Rate</th>
<td><input type="text" name="extras_rate" size='40' value='<?php echo $Resultset["extras_rate"]?>' idsize='40' id="extras_rate_ID"/></td>
</tr>
<tr>
<th>Limit</th>
<td><input type="text" name="extras_limit" size='40' value='<?php echo $Resultset["extras_limit"]?>' idsize='40' id="extras_text_ID"/></td>
</tr>
<tr>
<th>Parametrised Output on Pricing Record</th>
<td><?php echo $Resultset["extras_booking_output"]?></td>
</tr>
<tr>
<th>Parameter 1:</th>
<td><input type="text" name="param1" value='<?php echo $Resultset["param1"]?>' id="param1_ID"/></td>
</tr>
<th>Parameter 2:</th>
<td><input type="text" name="param2" value='<?php echo $Resultset["param2"]?>' id="param2_ID"/></td>
</tr>
<th>Parameter 3:</th>
<td><input type="text" name="param3" value='<?php echo $Resultset["param3"]?>' id="param3_ID"/></td>
</tr>


<tr>
<?php
echo '<td class="tablefooter" colspan="2"><a href="javascript:history.back()"><img src="style/back.gif" alt="Back"></a>';
echo '<input type="image" src="style/update.gif" name="SubmitForm">';
?>
<input type="hidden" name="pricing_extras_id" value='<?php echo $extras_id; ?>'>
<input type="hidden" name="pricing_scheme_id" value='<?php echo $SchemeId; ?>'>   
<input type="hidden" name="type" value='<?php echo $pricing_extra_type_id; ?>'>     
</td>
</tr>
</table>
</div>
</form>
<?php
include './Includes/BodyFoot.php';
?>

</body>
</html>


<?php
}
else {
    
    if ( $extras_id )
    {
$updateSql = 'UPDATE pricing_extras SET '
."  fk_extras_pricing_extra_type_id='".addslashes($pricing_extra_type_id  )."'"
.", extras_rate='".addslashes($_POST['extras_rate'])."'"
.", extras_limit='".addslashes($_POST['extras_limit'])."'"  
.", days='".addslashes($_POST['days'])."'"  
.", param1='".addslashes($_POST['param1'])."'"
.", param2='".addslashes($_POST['param2'])."'" 
.", param3='".addslashes($_POST['param3'])."'" 
." WHERE pricing_extras_id = $extras_id ";
    }
    else
    {
$updateSql = "INSERT INTO pricing_extras (
fk_extras_pricing_extra_type_id
,fk_extras_pricing_scheme_id 
,extras_rate
,extras_limit
,days
,param1
,param2 
,param3 

) VALUES ( "
." '".addslashes($pricing_extra_type_id)."'"   
.", '".addslashes($SchemeId)."'"
.", '".addslashes($_POST['extras_rate'])."'"
.", '".addslashes($_POST['extras_limit'])."'"  
.", '".addslashes($_POST['days'])."'"  
.", '".addslashes($_POST['param1'])."'"  
.", '".addslashes($_POST['param2'])."'"   
.", '".addslashes($_POST['param3'])."'"   

.")";   
    }

$MyDb->f_ExecuteSql($updateSql);

      
header('Location: extraslist.php?pricing_scheme_id='.$SchemeId);
}
?>


