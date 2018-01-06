<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM  district WHERE  district_id="'.addslashes($_GET['districtid']).'" ';
$MyDb->f_ExecuteSql($deleteSql);

header('Location: districtlist.php');
?>
