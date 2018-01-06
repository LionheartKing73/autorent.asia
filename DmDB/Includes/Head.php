<?php
if (@ini_get('register_globals'))
   foreach ($_REQUEST as $key => $value)
       unset($GLOBALS[$key]);
?> 
<link rel="stylesheet" href="css/ppc.css" type="text/css">