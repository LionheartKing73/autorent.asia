<?php
  require_once('mysql.php');

  $serverhost = "{Connection_Host}";
  $serveruser = "{Connection_User}";
  $serverpwd  = "{Connection_Password}";
  $dbname     = "{Connection_DB}";

  $MyDb       = new cMysqlDB($serverhost,$serveruser,$serverpwd,$dbname);
?>
