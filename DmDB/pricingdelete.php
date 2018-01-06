<?php
include './Includes/Top.php';
include './Includes/mode.php';
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM  pricing WHERE  pricing_id="'.addslashes($_GET['pricing_id']).'" AND  pricing_scheme_id="'.addslashes($_GET['pricing_scheme_id']).'" AND  days="'.addslashes($_GET['days']).'" AND  months="'.addslashes($_GET['months']).'" AND  price="'.addslashes($_GET['price']).'"';
$MyDb->f_ExecuteSql($deleteSql);

header('Location: pricinglist.php?pricing_scheme_id='.$_GET['pricing_scheme_id']);
?>
