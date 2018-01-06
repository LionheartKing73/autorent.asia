<?php
/*
Class....... Security
Coded By.... Douglas Brown
Date........ 22nd May 2007

The class handles Data access security depending on User Type

Properties

Methods

*/

// Constants - could be changed in different implementations
define('USERTYPE_STARLINKADMIN', 1);
define('USERTYPE_RESELLER', 2);
define('USERTYPE_SUPERADMIN', 3);
define('USERTYPE_RESELLERADMIN', 4);
define('USERTYPE_STARLINKACCOUNTS', 5);

class  Security{

//***************************************Properties

var $UserId =0 ;
var $UserName = "";
var $UserTypeId = 0 ;
var $ChainId = 0 ;
var $SeamlessConnect;
var $ERSFEConnect;

 
//***************************************Methods
   
// **** Constructor 

function Security( $SeamlessConnect, $ERSFEConnect )
{
	// get the User Type from the Session
	$this->UserId = $_SESSION["userid"];
	$this->UserTypeId = $_SESSION["usertypeid"];
	$this->UserName = $_SESSION["username"];
	$this->ChainId = $_SESSION["chainid"];
	$this->SeamlessConnect = $SeamlessConnect;
	$this->ERSFEConnect = $ERSFEConnect;
}



function ResellerSelectList( $CurrReseller) {
// This function will print a formatted HTML select list of all Resellers
// which the current user can view

// The standard Resellers get no select list
if ( $this->UserTypeId == USERTYPE_RESELLER ) 
	return "";

$SqlHandler = &New ERSSqlHandler( $this->SeamlessConnect );

// The standard Admin users can see ALL Resellers
if ( $this->UserTypeId == USERTYPE_RESELLERADMIN ) 
	$SqlHandler->Sql = "Select tag, name from commission_receivers where chain_key = ".$this->ChainId." order by tag";
else
	$SqlHandler->Sql = "Select tag, name from commission_receivers order by tag";

	$SqlHandler->Execute();

	$Return =    "\n<select name='Reseller'>";
	if ( $SqlHandler->SqlError ) 
		print  $SqlHandler->SqlError ;
	else{
		while ( $Row =  $SqlHandler->GetRow( ) ) {
			$Agent = $Row[ 0 ];
			$Tag   = $Row[ 0 ];
			$Name   = $Row[ 1 ];

			if ( $CurrReseller == $Tag )
				$sel = "selected";
			else
				$sel = "";

			$Return .= "<option ".$sel." value='".$Agent."'>".$Agent." ".$Name."</option>";
			}
	}
	$Return .=    "\n</select>";

return $Return;
}
function CanViewReseller( $Reseller ) {

// True or False: can the current user view the specificied Reseller details 

$CanView = false;

// The standard Admin users can see ALL Resellers
if ( $this->UserTypeId == USERTYPE_SUPERADMIN ) 
	$CanView = true;
elseif ( $this->UserTypeId == USERTYPE_STARLINKADMIN ) 
	$CanView = true;
elseif ( $this->UserTypeId == USERTYPE_STARLINKACCOUNTS ) 
	$CanView = true;

// For the Reseller Admin type, we need to check that they're in 
// the same chain

elseif ( $this->UserTypeId == USERTYPE_RESELLERADMIN ) {

	$SqlHandler = &New ERSSqlHandler( $this->ERSFEConnect );

	$SqlHandler->Sql = "SELECT chain_id from feusers where username LIKE '".$Reseller."'";

	$SqlHandler->Execute();
	if ( $SqlHandler->SqlError ) 
		return $SqlHandler->SqlError ;
	else{
		$Row =  $SqlHandler->GetRow( );
		if ( $this->ChainId == $Row[ 0 ] )
			$CanView = true;
	}
}
$CanView = true;

return $CanView;
}

function CanViewAllChains( ) {

// True or False: can the current user view the specificied Reseller details 

$CanView = false;

// The standard Admin users can see ALL Chains
if ( $this->UserTypeId == USERTYPE_SUPERADMIN ) 
	$CanView = true;
elseif ( $this->UserTypeId == USERTYPE_STARLINKADMIN ) 
	$CanView = true;
elseif ( $this->UserTypeId == USERTYPE_STARLINKACCOUNTS ) 
	$CanView = true;


return $CanView;
}


// ********************** End Class
} 







?>
