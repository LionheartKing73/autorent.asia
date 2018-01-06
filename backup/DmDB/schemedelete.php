<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM  pricing_scheme WHERE  pricing_scheme_id="'.addslashes($_GET['pricing_scheme_id']).'" AND  pricing_scheme_name="'.addslashes($_GET['pricing_scheme_name']).'"';
$MyDb->f_ExecuteSql($deleteSql);

header('Location: schemelist.php');
?>
