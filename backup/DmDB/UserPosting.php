<?php
include './Includes/LoginCheck.php';
include './Includes/mode.php';


	$username=str_replace("'","",$HTTP_POST_VARS["username"]);
	$password=str_replace("'","",$HTTP_POST_VARS["password"]);
	$password2=str_replace("'","",$HTTP_POST_VARS["password2"]);

	$firstname=str_replace("'","",$HTTP_POST_VARS["firstname"]);
	$surname=str_replace("'","",$HTTP_POST_VARS["surname"]);
	$ID=str_replace("'","",$HTTP_POST_VARS["ID"]);





//* Now check the input values *//

	$PostFailed = False;
  	if (strlen($username)<3 )
	{
		$PostFailed = $PostFailed . "u";
	}
  	if (strlen($password)==0)
		$PostFailed = $PostFailed . "p";

  	if (strlen($username)>10)
		$PostFailed = $PostFailed . "U";

  	if (strlen($password)>10)
		$PostFailed = $PostFailed . "P";

	//Check if password has been entered correctly twice
  	if ($password!=$password2)
		$PostFailed = $PostFailed . "X";

  	if (strlen($firstname)==0)
		$PostFailed = $PostFailed . "f";
  	if (strlen($surname)==0)
		$PostFailed = $PostFailed . "s";

	//Check if this user name exists

if ( ! $ID ){
	$sql="SELECT * from runuser where username = '".trim($username)."'";
	$result = @mysql_query($sql, $Connect )
   			or die("Invalid query: " . mysql_error( $Connect));
	$num_rows = mysql_num_rows($result);

	if ( $num_rows > 0   )
			$PostFailed = $PostFailed . "D";
	}


if ( $PostFailed ) 
		{

	include 'UserAdd.php';
	}
	else
	{

		if ( ! $ID ){
		$Sql= "insert into runuser ( username, password, firstname, surname ) values ( '";
		$Sql.= trim( $username )."','".trim( $password )."','".trim( $firstname )."','".trim( $surname )."')";
		}
		Else
		{
		$Sql= "update runuser set username = '".$username."',";
		$Sql.= "password='".$password."',";
		$Sql.= "firstname='".$firstname."',";
		$Sql.= "surname='".$surname."'";
		$Sql.= " where runuserid = ".$ID;

		}
		$InsertStatus = @mysql_query($Sql, $Connect );


		If ( ! $InsertStatus ) 
			Print "THE " . $Sql . " statement FAILED BECAUSE " . mysql_error( $Connect ) ;

		Else
		{
			header("Location: Users.php");
		}


	}




	
	

	

?>
