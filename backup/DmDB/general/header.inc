<?php
  session_start();
  include('usersession.php');
  include('db/db_connection.php');

  if (!isset($_SESSION['usr']))
  {
      $myData = new usersession();
  }
  else
  {
      $myData = unserialize($_SESSION['usr']);
  }

?>