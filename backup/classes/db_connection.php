<?php
class db_connection{
// This class is used to share a single connection to the ERS DB

/*** Declare instance ***/
private static $instance = NULL;

/**
*
* the constructor is set to private so
* so nobody can create a new instance using new
*
*/
private function __construct() {
  /*** maybe set the db name here later ***/
}

/**
*
* Return DB instance or create intitial connection
*
* @return object (PDO)
*
* @access public
*
*/
public static function getInstance() {
;
if (!self::$instance)
{


	$DbConnect = &New DbConnect( DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE ); 

	if ($DbConnect->Status ) {
		print "Failed to connect to ERSFE database ".$DbConnect->StatusMessage;
		exit;
		// Failed to initialise the Db connection to the OSC Db
		
	}

	self::$instance = new SqlHandler( $DbConnect->Link );

}
return self::$instance;
}

/**
*
* Like the constructor, we make __clone private
* so nobody can clone the instance
*
*/
private function __clone(){
}

} /*** end of class ***/
?>