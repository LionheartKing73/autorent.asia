<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM pricing_extra_type WHERE  pricing_extra_type_id="'.addslashes($_REQUEST['extra_type_id']).'" ';
$MyDb->f_ExecuteSql($deleteSql);



header("Location: extratypelist.php" );  
?>
