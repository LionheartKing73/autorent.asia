<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM  supplier WHERE  supplierid="'.addslashes($_GET['supplierid']).'" ';
$MyDb->f_ExecuteSql($deleteSql);

header('Location: supplierlist.php');
?>
