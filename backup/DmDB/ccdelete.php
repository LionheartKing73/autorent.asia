<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM credit_card WHERE  credit_card_id="'.addslashes($_REQUEST['credit_card_id']).'" ';
$MyDb->f_ExecuteSql($deleteSql);



header("Location: cclist.php" );  
?>
