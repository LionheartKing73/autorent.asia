<?php
/*
Class....... DbConnect
Coded By.... Douglas Brown
Date........ 16th August 2007

The class connects to MySQL database.

Properties
Link................The Connection Link
Status..............The MySQL error code
StatusMessage.......The related MySQL error message



Methods
DbConnect................Constructor 


*/
class  DbConnect{

//***************************************Properties
	var $Link;


 
//***************************************Methods
   
// **** Constructor 

	function DbConnect( $osc_server, $osc_username, $osc_password, $osc_database )
	{
		$this->Link = mysql_connect($osc_server, $osc_username, $osc_password, true ) ;
		if ( ! $this->Link )
		{

			$this->Status = mysql_errno();
			$this->StatusMessage = mysql_error();
	
		}
		else
		{
			mysql_select_db($osc_database) ;
			$this->Status = mysql_errno($this->Link);
			if ( $this->Status ) {

				$this->StatusMessage = mysql_error($this->Link);

			}
		}

 	}


// ********************** End Class
} 







?>
