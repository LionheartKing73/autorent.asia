<?php
include './Includes/Top.php';
include './Includes/mode.php';
?>
<?php
include('general/header.inc');
require_once('general/general.php');

$deleteSql = 'DELETE FROM pricing_extras WHERE  pricing_extras_id="'.addslashes($_REQUEST['pricing_extras_id']).'" ';
$MyDb->f_ExecuteSql($deleteSql);

if ( is_numeric( $_REQUEST[ "pricing_scheme_id" ] ) )
    $SchemeId = $_REQUEST[ "pricing_scheme_id" ];
else
    $SchemeId = 0;

header('Location: extraslist.php?pricing_scheme_id='.$SchemeId);  
?>
