<?php
include('Includes/connection.php');
  define('DB_SERVER', $serverhost); // eg, localhost - should not be empty for production servers
  define('DB_SERVER_USERNAME', $serveruser);
  define('DB_SERVER_PASSWORD', $serverpwd);
  define('DB_DATABASE', $dbname );


require_once('classes/SqlHandler.class.php' );

require_once('classes/DbConnect.class.php' );

require_once( 'classes/Security.class.php' );

require_once( 'classes/db_connection.php' );

require_once( 'classes/standard_html_functions.php' );

require_once( 'classes/BaseScreenFlowHandler.class.php' );
require_once( 'classes/Form.class.php' );
require_once( 'classes/Data.class.php' );
require_once( 'classes/DataSet.class.php' );
require_once( 'classes/Date.class.php' );

require_once( 'Includes/functions.php' );   
/*
Class....... Page
Coded By.... Douglas Brown
Date........ 2nd September

The class formats pages for the Play Golf Holidays site.

Properties
SecurePage.........Boolean. Does a user have to be logged on?
CheckSecurePageType..If this is not blank, user access must be checked
PageTypeId.........The authentication Page Type
LoggedIn...........Boolean, is the user Logged in or not
Title..............The Page Title
ERSFEConnect.......ERS front end connection details
SeamlessConnect....Seamless front end connection details
Security...........An instance of the Security Class handling Data access




Methods
DownloadDoc..........Constructor 
StarlinkPage.................Horizontal Menu

*/
class Page{

//***************************************Properties
	var $SecurePage = True;
	var $CheckSecurePageType = "";
	var $LoggedIn = False;
	var $Title = "";
	var $Conn;
	var $SqlHandler = "";
	var $Security;
	var $PageTypeId=0;

      var $BookingRecord="";

 
//***************************************Methods
   
// **** Constructor 

function Page( $IsSecurePage )
{ 
	session_start();

	// Allow a booking to be cancelled
	if( $_REQUEST["newbooking" ]   )
		$_SESSION["booking"] = 0 ;


	$this->SecurePage = $IsSecurePage ;
  
	$this->Conn = db_connection::getInstance()->Link
			or exit( "Failed to make Connection to Authentication DB" );

	If ( $this->Conn ) 
		$ConnectedDB = mysql_select_db ( DB_DATABASE, $this->Conn ) ;
 
	$this->SqlHandler = New SqlHandler( $this->Conn );


// Force a login if required
	if ( $this->SecurePage ) {
	if ( ! $_SESSION['runuserid'] > 0 )
		{
			header("Location: ./index.php");
		}
		else
		{	
			$this->LoggedIn = True;
		}
	}



		
}



// **** Send: Sends the Output to the Browser

    function SendSectionA(){ 
    include_once( './Includes/Top.php' ); 	
    
        include_once( './Includes/Head.php' );     


	include_once( './Includes/BodyHead.php' );
	
   

    }


// **** Send: Sends the Output to the Browser

    function SendSectionB(){ 

    include_once( './Includes/BodyFoot.php' );  


    }


// **** Send: Formats the HTML Head Section

    function HTMLHead(){ 
	
?>
	<HEAD>

	<TITLE><?php echo $this->Title?></TITLE>
	<link type="text/css" rel="stylesheet" href="css/pgh.css" />	
    <link type="text/css" rel="stylesheet" href="css/default.css" />
    
 <script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
   
    <script src="css/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="css/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
    
<?php
	$this->OtherStyleSheets();
?>
	<meta http-equiv="Content-Type" content="text/html; charset="iso-8859-1">
	<meta name="description" content="Here at Golf Holidays Hua Hin dot com we have teamed up with Hua Hin's most reputable golf tour and golf holiday operators to offer you the best selection of golf holiday packages on the net.">
	<meta name="keywords" content="golf holidays hua hin">
	<meta name="audience" content="all">
	<meta name="expires" content="never">
	<meta name="robots" content="index, follow">
	<meta name="rating" content="general, information">
	<meta name="aesop" content="information">
	<meta name="author" content="Hua Hin Media">
	<script type="text/javascript" src="jacs.js" >    </script> 
	<script type="text/javascript" src="ajax.js" >    </script> 

	</HEAD>
<?php

    }

  


// **** Send: Blank StyleSheets for override

    function OtherStyleSheets(){ 
	


    }






// ********************** End Class
} 





?>
