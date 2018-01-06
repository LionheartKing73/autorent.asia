<?php
include './Includes/mode.php';
session_start();
IF ( $Logoff ) 
	$_SESSION['runuserid'] = 0;


if ($HTTP_POST_VARS["LOGINSTATUS"]=="CHECK")
{

	$LoginError = False;	
	$_SESSION['runuserid'] = 0;

	$USERNAME=str_replace("'","",$HTTP_POST_VARS["USERNAME"]);
	$PASSWORD=str_replace("'","",$HTTP_POST_VARS["PASSWORD"]);

	//* We try to Select the User Record from the runuser Table *//

include './Includes/SqlConn.php';


	$Sql = "Select * from runuser where username = '" .Trim( $USERNAME ) . "'";
echo $Sql ;

	$result = @mysql_query($Sql, $Connect );

if (!$result) {

	print mysql_error();
  die( 'Invalid query: ' . mysql_error()  );

}

	$num_rows = mysql_num_rows($result);

	If ( $num_rows == 0 )
		$LoginError = "U";
	Else
	{
		$UserRecord = mysql_fetch_array( $result ) ;

            If ( Trim( $PASSWORD ) != Trim( $UserRecord["password"])  )
			$LoginError = "P";

	}		

	If ( $LoginError ) 

		include './index.php';
		
			
	Else
	{
		$_SESSION['runuserid'] = $UserRecord["runuserid"];
			header("Location: ./Members.php");

	}

}
Else
		include './index.php';


?>






