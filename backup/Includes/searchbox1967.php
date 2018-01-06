<div id="menu">
	<h1 class='Banner' style='text-align: center; font-size: 18px'>SEARCH FOR CHEAP CAR HIRE</h1>
	<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
		<input type="hidden" name="poster" value="yes"/>
		<p>Where would you like to hire the car?</p>
		<div id="start_country">
			<select id='country' name='country_subdomain'>
<?php
$req_districtFr = $_REQUEST["distFr".$req_country] ;
$req_districtTo = $_REQUEST["distTo".$req_country] ;
$req_locationFr = $_REQUEST["locFr".$req_districtFr] ;
$req_locationTo = $_REQUEST["locTo".$req_districtTo] ;
$countrySD = $req_country; 
if($Country->Rec["country_subdomain"]){
	$countrySD = $Country->Rec["country_subdomain"];
}else{
	$countrySD = "thailand";
}
$sql = "Select * from country WHERE country_id =1 ORDER by country_name ";
$ResultSet = mysql_query( $sql ) ;
while($Rec = mysql_fetch_array($ResultSet)){
	if($Rec["country_subdomain"] == $countrySD ){
		$selected = "selected";
	}else{
		$selected = "";
	}
	print "				<option $selected value='".$Rec["country_subdomain"]."'>".$Rec["country_name"]."</option>\n";
}   
?>
			</select>
		</div>
<?php
$Sql = "SELECT district.*, country_subdomain 
		FROM district 
		JOIN country ON country_id = fk_district_country_id WHERE country_id =1
		ORDER BY district_order,district_id";
$ResultSet = mysql_query( $Sql ) ;
while($row = mysql_fetch_array($ResultSet)){
	if($_REQUEST["distFr".$row["country_subdomain"]] == $row["country_subdomain"]."-".$row["district_id"]){
		$selected = "selected";
	}else{
		$selected = "";
	}
	$distFr[$row["country_subdomain"]].="				<option $selected value='".$row["country_subdomain"]."-".$row["district_id"]."'>".$row["district_text"]."</option>\n";
	if($_REQUEST["distTo".$row["country_subdomain"]] == $row["country_subdomain"]."-".$row["district_id"]){
		$selected = "selected";
	}else{
		$selected = "";
	}
	$distTo[$row["country_subdomain"]].="				<option $selected value='".$row["country_subdomain"]."-".$row["district_id"]."'>".$row["district_text"]."</option>\n";
	$RefDistCountry[$row["district_id"]] =  $row["country_subdomain"];
}

foreach($distFr as $key=>$value){
	if($key == $countrySD){
		$dp = "style='display:block'";
	}else{
		$dp = "";
	}
	$distFr[$key] = "		<div $dp class='district' id='DIVFr".$key."'>
			<select class='districtFr' id='distFr".$key."' name='distFr".$key."'> 
".$value."
			</select>\n";
}

foreach($distTo as $key=>$value){
	if($key == $countrySD){
		$dp = "style='display:block'";
	}else{
		$dp = "";
	}
	$distTo[$key] = "		<div $dp class='district' id='DIVTo".$key."'>
			<select class='districtTo' id='distTo".$key."' name='distTo".$key."'> 
".$value."
			</select>\n";
}       

// Now for each country we have an open DIV and the District Selector
// LOCATIONS
$Sql = "SELECT locations.*, district.*, country_subdomain 
		FROM locations 
		JOIN district on district_id = fk_location_district_id 
		JOIN country on country_id = fk_district_country_id WHERE country_id =1
		ORDER BY district_order,district_id,location_order, location_name";
$ResultSet = mysql_query( $Sql ) ;
while($row = mysql_fetch_array($ResultSet)){
	if($_REQUEST[ "locFr".$row["district_id"]  ] == $row["locationid"]){
		$selected = "selected";
	}else{
		$selected = "";
	}
	$locFr[$row["country_subdomain"]][$row["district_id"]].="				<option $selected value='".$row["location_code"]."'>".$row["location_name"]."</option>\n";

	if($_REQUEST["locTo".$row["district_id"]] ==  $row["locationid"]){
		$selected = "selected";
	}else{
		$selected = "";
	}
	$locTo[$row["country_subdomain"]][$row["district_id"]].="				<option $selected value='".$row["location_code"]."'>".$row["location_name"]."</option>\n";
}
foreach($locFr as $key=>$arr){
	$ctryFr[$key] = $distFr[$key];
	$displaying_locs=false;
	$first_iteration=true;
	foreach($arr as $dist=>$loctext){
		$display="none";     
		if($_REQUEST["distFr".$key] == $key."-".$dist){
			$display="inline-block";
			$displaying_locs=true;
		}elseif($first_iteration){
			// If this is the initial form display, we show the first location srt 
			// for the first district
			if (!$_REQUEST["finday"]){
				$display="XYXY-sub";
				$first_iteration=false;
			}
		}
		$ctryFr[$key] .= "			<select style='display: ".$display."' class='locFr' id='locFr".$key."-".$dist."' name='locFr".$key."-".$dist."'>\n"; 
		$ctryFr[$key] .= $loctext;
		$ctryFr[$key] .= "			</select>\n";
	}
	if($displaying_locs){
		$ctryFr[$key] = str_replace( "XYXY-sub", "", $ctryFr[$key] );
	}else{
		$ctryFr[$key] = str_replace( "XYXY-sub", "inline-block", $ctryFr[$key] );
	}
	$ctryFr[$key] .= "		</div>\n";
}
foreach($locTo as $key=>$arr){
	$ctryTo[$key] = $distTo[$key];
	$displaying_locs=false;
	$first_iteration=true;
	foreach($arr as $dist=>$loctext){
		$display="none";     
		if ( $_REQUEST["distTo".$key] == $key."-".$dist ){
			$display="inline-block";
			$displaying_locs=true;
		}elseif($first_iteration){
		// If this is teh initial form display, we show the firdt location srt 
		// for the first district
			if(!$_REQUEST["finday"]){
				$display="XYXY-sub";
				$first_iteration=false;
			}
		}
		$ctryTo[$key] .= "			<select style='display: ".$display."' class='locTo' id='locTo".$key."-".$dist."' name='locTo".$key."-".$dist."'>\n"; 
		$ctryTo[$key] .= $loctext;
		$ctryTo[$key] .= "			</select>\n";
	}
	if($displaying_locs){
		$ctryTo[$key] = str_replace( "XYXY-sub", "", $ctryTo[$key] );
	}else{
		$ctryTo[$key] = str_replace( "XYXY-sub", "inline-block", $ctryTo[$key] );
	}
	$ctryTo[$key] .= "		</div>\n";
}

//show FROM selects
foreach($ctryFr as $key=>$value){
	print $value;

}

?>

                 <p>Returning the car to a different location? 
                 <a href="http://www.diamondcarrental.co.uk/one-way-car-rentals.php" title="One-way car rentals">click here</a>.</p>

		<p>When would you like to collect the car?</p>
		<div id="start_day">

<?php
DaySelect("startdayveh", $startdayveh);
?>
		</div>
		<div id="start_month">
<?php
MonthSelect("startmonthveh", $startmonthveh);
?>
		</div>
		<div id="start_year">
<?php
YearSelect("startyearveh", $startyearveh);
?>
		</div>
		<div id="start_time">
<?php
TimeSelect("starttimehrs", "starttimemins", $starttimehrs, $starttimemins);
?>
		</div>
		<p>When would you like to return the car?</p>
		<div id="end_day">
<?php
DaySelect("finday", $finday);
?>
		</div>
		<div id="end_month">
<?php
MonthSelect("finmonth", $finmonth);
?>
		</div>
		<div id="end_year">
<?php
YearSelect("finyear", $finyear);
?>
		</div>
		<div id="end_time">
<?php
TimeSelect("fintimehrs", "fintimemins", $fintimehrs, $fintimemins);
?>
		</div>


		<div id='RetLocTD' style='display: block;position:absolute;margin-left:-5000px;'>
			<input type='button' onclick='javascript:ShowLoc()' style='float: right' value='Yes'/>
<?php
//show TO selects
foreach($ctryTo as $key=>$value){
	print $value;
}
VehTypeSelect( "retloc", $retloc );
GetClassRadioButtons( $vehclass ) ;
CurTypeSelect( "CurrencyId", $CurrencyId );
?>

		</div>

		<div id="search_now">
			
	                <input type="submit" value='Search Now'/>
                        <input type="hidden" name="distformFlag" value='Go'/><br><br>
                        
		</div>
	
                </form>

                </div>

<!-- end menu -->
