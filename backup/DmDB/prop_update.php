<?php
// Added Doug Brown, 14th November 2015 to ensure only logged-in users can update the data
session_start();
if(!isset($_SESSION['myusername'])){
	header("location:index.php");
}



include("../library/sqlconn.php");

$id = $_GET["id"];
$mytable = "tbl_properties";
$ref= $_POST["ref"];
$property= $_POST["property"];
$sale= $_POST["sale"];
$rent = $_POST["rent"];
$beach = $_POST["beach"];
$client = $_POST["client"];
$location = $_POST["location"];
$document= $_POST["document"];
$sprice= $_POST["sprice"];
$sprice = str_replace(',', '', $sprice);
$rprice= $_POST["rprice"];
$rprice = str_replace(',', '', $rprice);
$lsize= $_POST["lsize"];
$lsize_r= $_POST["lsize_r"];
$lsize_w= $_POST["lsize_w"];
	if(($lsize > 0) || ($lsize_r > 0) || ($lsize_w > 0)){
		if($lsize == 0){
			$lsize = ($lsize_r * 1600)+($lsize_w*4);
		}
		if(($lsize_r == 0) && ($lsize_w == 0)){
			$mod = $lsize % 1600;
			$lsize_r = ($lsize - $mod)/1600;
			$lsize_w = $mod/4;
		}
	}
$hsize= $_POST["hsize"];
$bedroom= $_POST["bedroom"];
$bathroom= $_POST["bathroom"];
$intro= $_POST["intro"];
$intro_th= $_POST["intro_th"];
$detail= $_POST["detail"];
$detail_th= $_POST["detail_th"];
$note= $_POST["note"];
$page= $_POST["page"];

$sql = "UPDATE $mytable SET
p_ref = '".$ref."',
p_client = '".$client."',
p_rent = '".$rent."',
p_sale = '".$sale."',
p_rprice = '".$rprice."',
p_sprice = '".$sprice."',
p_property = '".$property."',
p_beach = '".$beach."',
p_location = '".$location."',
p_lsize = '".$lsize."',
p_lsize_r = '".$lsize_r."',
p_lsize_w = '".$lsize_w."',
p_hsize = '".$hsize."',
p_document = '".$document."',
p_bedroom = '".$bedroom."',
p_bathroom = '".$bathroom."',
p_intro = '".$intro."',
p_intro_th = '".$intro_th."',
p_detail = '".$detail."',
p_detail_th = '".$detail_th."',
p_notes = '".$note."',
p_f_page_ind='".$page."' WHERE p_id = '".$id."'";



mysqli_query($con, $sql);
	#print "<meta http-equiv=refresh content=0;URL=prop_view.php>";
header("location:prop_view.php"); 


?>