<?php

if($_SERVER['REQUEST_METHOD']=="POST")
{
	include './Includes/mode.php';
	session_start();
	
	$_SESSION['runuserid'] = 0;
	$USERNAME = $_POST['USERNAME'];
	$PASSWORD = $_POST['PASSWORD'];
		
	include './Includes/SqlConn.php';
	$sql = "SELECT * from runuser where username = '$USERNAME'";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	if($num_rows == 0)
	{
		echo "<p align='center'>";
		echo "No such User" . "<br>";
		echo "<a href='./index.php'>Try again</a>";
		echo "</p>";
	}
	else
	{
		$user_record = mysql_fetch_array($result);
		if($PASSWORD != $user_record['password'])
		{
			echo "<p align='center'>";
			echo "Wrong Password" . "<br>";
			echo "<a href='./index.php'>Try again</a>";
			echo "</p>";
		}
		else
		{
			$_SESSION['runuserid'] = $user_record['runuserid'];
			header("Location: ./Members.php");
		}
	}
}
else
{
	header("Location: ./index.php");
}
?>