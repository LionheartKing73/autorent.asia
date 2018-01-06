<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM  country_region WHERE  country_region_id="'.addslashes($_GET['regionid']).'" ';
$MyDb->f_ExecuteSql($deleteSql);

header('Location: regionlist.php');
?>
