<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM  dateranges WHERE  daterangeid="'.addslashes($_REQUEST['daterangeid']).'"';
$MyDb->f_ExecuteSql($deleteSql);

print $deleteSql;



//header('Location: daterangelist.php');
?>
