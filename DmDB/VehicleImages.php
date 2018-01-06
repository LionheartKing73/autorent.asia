<?php
include './Includes/Top.php';
include './Includes/mode.php';



$ID = $_GET['ID'];
if ( ! $ID ) 
{
$ID=0;
}
Else
{
	$Mode = "Edit";
	$Sql = "select * from vehicles where vehicleid = ".$ID;
	$ResultSet = mysql_query( $Sql ) 
	or die ( "Failed in Vehicle Query" .mysql_error());
	$EditRow = mysql_fetch_array($ResultSet) ;

	$regno = $EditRow[ "regno" ];

}


?>
<html>
<head>
<title>Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php

include './Includes/Head.php';
$ID = $_GET['ID'];
?>


</head>

<?php

include './Includes/BodyHead.php';

//* The Image directory will be *//


$imagedir = "Images/";



if ( $_GET['PF'] || $_GET['UF'] ) 
{
?>


<h2><font color='red'>There was an error in uploading the Property Image(s)</font></h3>

<?php
if ( $_GET['UF'] ) {

	switch ($_GET['UF'])
	{
	case 1:
  		$ErrorMessage="The uploaded file exceeds the upload_max_filesize directive in php.ini.";
  		break;  
	case 2:
  		$ErrorMessage="The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
 		 break;
	case 3:
  		$ErrorMessage="The uploaded file was only partially uploaded.";
  		break;  
	case 4:
  		$ErrorMessage="No file was uploaded.";
 		 break;
	case 6:
  		$ErrorMessage="Missing a temporary folder. ";
 		 break;
  
	};

print "<p><font color='red'>".$ErrorMessage."</font></p>";
}

}
else
{
?>

<h1>Vehicle Images: Registration <?php print $regno?></h1>
<?php
}
?>

<table width=100% align=center cellpadding=0 cellpadding=0 border=0>
<form method="POST" Name="login" action="ImagePosting.php"  enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />


<tr><td>Full Size Images</td>

<!--
<td>Thumbnails</td>
-->

</tr>
<tr><td><hr></td><td><hr></td></tr>
<tr><td>Main Image</td><td></td></tr>
<tr><td>
<?php
if ( strlen( $EditRow[ "mainimage" ]) > 0  ) 
{
print "<img src='".$imagedir.$EditRow[ "mainimage" ]."'>";
print "<a href='ImageDelete.php?ID=".$ID."&image=mainimage'>Delete</a>";
}
Else
{
 
print "<input name='mainimage' type='file' />";

}
?>
</td>


</tr>




<tr><td></td><td>
<input type=submit value=Save name=submit>
</td>


</tr>


<input type=hidden value='<?=$ID?>' name=ID>


</form>
</table>


<?php
include './Includes/BodyFoot.php';
?>





















































































