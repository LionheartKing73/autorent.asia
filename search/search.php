<?php
$serverhost = "localhost";
$serveruser = "autorent_root";
$serverpwd  = "root@123";
$dbname     = "autorent_DCR";
	$Connect = mysql_connect($serverhost, $serveruser, $serverpwd)
			or exit( "Failed to make Connection" );

	If ( $Connect ) 
	{
		$ConnectedDB = mysql_select_db ( $dbname, $Connect ) ;
		//echo "connected!";

	}
		else
	{
			die ("No connect" );
	}
?>
<div id="start_country" style="display:none;">
			<select id='country' name='country_subdomain'>
<?php

$sql = "Select * from country WHERE 1 ORDER by country_name";
$ResultSet=mysql_query($sql);
echo "doo".$ResultSet;
while($Rec = mysql_fetch_array($ResultSet)){
	
	print "				<option  value='".$Rec["country_subdomain"]."'>".$Rec["country_name"]."</option>\n";
}   
?>
			</select>
		</div>
<!DOCTYPE html>
<html style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba no-hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Car Rentals from Autorent.asia, Book Online Now &amp; Save">
    <title>Autorent.asia</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://24open.asia/carrent/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="https://24open.asia/carrent/assets/ico/favicon.ico">

    <!-- CSS Global -->
    <link href="index_files/bootstrap.css" rel="stylesheet">
    <link href="index_files/bootstrap-select.css" rel="stylesheet">
    <link href="index_files/font-awesome.css" rel="stylesheet">
    <link href="index_files/prettyPhoto.css" rel="stylesheet">
    <link href="index_files/owl_002.css" rel="stylesheet">
    <link href="index_files/owl.css" rel="stylesheet">
    <link href="index_files/animate.css" rel="stylesheet">
    <link href="index_files/swiper.css" rel="stylesheet">
    <link href="index_files/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="index_files/theme.css" rel="stylesheet">

    <!-- Head Libs -->
    <script src="index_files/modernizr.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/plugins/iesupport/html5shiv.js"></script>
    <script src="assets/plugins/iesupport/respond.min.js"></script>
    <![endif]-->
</head>
<body id="home" class="wide">
<!-- PRELOADER -->
<div id="preloader" style="display: none;">
    <div id="preloader-status">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        <div id="preloader-title">one moment please...</div>
    </div>
</div>
<!-- /PRELOADER -->

<!-- WRAPPER -->
<div class="wrapper">

 

    <!-- CONTENT AREA -->
    <div class="content-area">

        <!-- PAGE -->
        <section class="page-section no-padding slider">
            <div class="container full-width">

                <div class="main-slider">
                    <div class="owl-carousel owl-theme owl-loaded" id="main-slider">

                        <!-- Slide 1 -->
                        
                        <!-- /Slide 1 -->

                        <!-- Slide 2 -->
                        
                        <!-- /Slide 2 -->

                        <!-- Slide 3 -->
                        
                        <!-- /Slide 3 -->

                        <!-- Slide 4 -->
                        
                        <!-- /Slide 4 -->

                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2686px, 0px, 0px); transition: all 0s ease 0s; width: 10744px;"><div class="owl-item cloned" style="width: 1343px; margin-right: 0px;"><div class="item slide3 ver3">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <!-- Search form -->
                                                <div class="form-search light">
                                                    <form action="#">
                                                        <div class="form-title">
                                                            <i class="fa fa-globe"></i>
                                                            <h2>Search for Cheap Rental Cars Wherever Your Are</h2>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpLocation3">Picking Up Location</label>
                                                                        <input class="form-control" id="formSearchUpLocation3" placeholder="Airport or Anywhere" type="text">
																		
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                        	<div id="result"></div>
																			<script>
		$("#formSearchUpLocation3").kendoAutoComplete({
    dataTextField: "Txt",
    select: function(e) {
        var dataItem = this.dataItem(e.item.index());
        
        //output selected dataItem
        $("#result").html(kendo.stringify(dataItem));       
    },
    dataSource: {
        data: [
            { Txt : "GB1", value: 1 },
            { Txt : "GB2", value: 2 },
            { Txt : "GB3", value: 3 },
            { Txt : "GB4", value: 4 }
        ]
    }
});
																			</script>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffLocation3">Dropping Off Location</label>
                                                                        <input class="form-control" id="formSearchOffLocation3" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpDate3">Picking Up Date</label>
                                                                        <input class="form-control datepicker" id="formSearchUpDate3" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Picking Up Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate3">Dropping Off Date</label>
                                                                        <input class="form-control datepicker" id="formSearchOffDate3" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Dropping Off Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                    <button type="submit" id="formSearchSubmit3" class="btn btn-submit ripple-effect btn-theme pull-right">Find Car</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /Search form -->

                                                <h2 class="caption-title">For rental Cars</h2>
                                                <h3 class="caption-subtitle">Best Deals</h3>
                                                <p class="caption-text">
                                                    Sales Up  %45 Off<br>
                                                    All Rental Cars Start from  49$
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 1343px; margin-right: 0px;"><div class="item slide4 ver4">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <h2 class="caption-title">For rental Cars</h2>
                                                <h3 class="caption-subtitle"><span>Best Deals</span></h3>
                                                <p class="caption-text">
                                                    Sales Up  %45 Off<br>
                                                    All Rental Cars Start from  49$
                                                </p>
                                                <p class="caption-text">
                                                    <a class="btn btn-theme ripple-effect btn-theme-md" href="#">See All Vehicles</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 1343px; margin-right: 0px;"><div class="item slide1 ver1">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                          <h2 class="caption-title">Save big money booking online now</h2>
                                                <h3 class="caption-subtitle">SEARCH FOR CHEAP CAR HIRE</h3>
                                                <!-- Search form -->
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-10 col-md-offset-1">

                                                        <div class="form-search dark">
                                                            <form action="#">
                                                                <div class="form-title">
                                                                    <i class="fa fa-globe"></i>
                                                                    <h2>We offer the most competitive prices &amp; the widest choice from the top car rental providers</h2>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpLocation">Picking Up Location</label>
                                                                                <input class="form-control" id="formSearchUpLocation" placeholder="Airport or Anywhere" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpDate">Picking Up Date</label>
                                                                                <input class="form-control datepicker" id="formSearchUpDate" placeholder="dd/mm/yyyy" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                <label>Picking Up Hour</label>
                                                                                <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                                    <option selected="selected">20:00 AM</option>
                                                                                    <option>21:00 AM</option>
                                                                                    <option>22:00 AM</option>
                                                                                </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffLocation">Dropping Off Location</label>
                                                                                <input class="form-control" id="formSearchOffLocation" placeholder="Airport or Anywhere" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffDate">Dropping Off Date</label>
                                                                                <input class="form-control datepicker" id="formSearchOffDate" placeholder="dd/mm/yyyy" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                <label>Dropping Off Hour</label>
                                                                                <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                                    <option selected="selected">20:00 AM</option>
                                                                                    <option>21:00 AM</option>
                                                                                    <option>22:00 AM</option>
                                                                                </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-submit">
                                                                    <div class="container-fluid">
                                                                        <div class="inner">
                                                                            <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                            <button type="submit" id="formSearchSubmit" class="btn btn-submit btn-theme pull-right">Find Car</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- /Search form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 1343px; margin-right: 0px;"><div class="item slide2 ver2">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <!-- Search form -->
                                                <div class="form-search light">
                                                    <form action="#">
                                                        <div class="form-title">
                                                            <i class="fa fa-globe"></i>
                                                            <h2>Search for Cheap Rental Cars Wherever Your Are</h2>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpLocation2">Picking Up Location</label>
                                                                        <input class="form-control" id="formSearchUpLocation2" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffLocation2">Dropping Off Location</label>
                                                                        <input class="form-control" id="formSearchOffLocation2" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpDate2">Picking Up Date</label>
                                                                        <input class="form-control datepicker" id="formSearchUpDate2" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Picking Up Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate2">Dropping Off Date</label>
                                                                        <input class="form-control datepicker" id="formSearchOffDate2" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Dropping Off Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                    <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme ripple-effect pull-right">Find Car</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /Search form -->

                                                <h2 class="caption-subtitle">Find Your Car!<br> Rent A Car Theme</h2>
                                                <p class="caption-text">
                                                    Vivamus in est sit 
amet risus rutrum facilisis sed ut mauris. Aenean aliquam ex ut sem 
aliquet, eget vestibulum erat pharetra. Maecenas vel urna nulla. Mauris 
non risus pulvinar.
                                                </p>
                                                <p class="caption-text">
                                                    <a class="btn btn-theme ripple-effect btn-theme-md" href="#">See All Vehicles</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 1343px; margin-right: 0px;"><div class="item slide3 ver3">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <!-- Search form -->
                                                <div class="form-search light">
                                                    <form action="#">
                                                        <div class="form-title">
                                                            <i class="fa fa-globe"></i>
                                                            <h2>Search for Cheap Rental Cars Wherever Your Are</h2>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpLocation3">Picking Up Location</label>
                                                                        <input class="form-control" id="formSearchUpLocation3" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffLocation3">Dropping Off Location</label>
                                                                        <input class="form-control" id="formSearchOffLocation3" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpDate3">Picking Up Date</label>
                                                                        <input class="form-control datepicker" id="formSearchUpDate3" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Picking Up Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate3">Dropping Off Date</label>
                                                                        <input class="form-control datepicker" id="formSearchOffDate3" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Dropping Off Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                    <button type="submit" id="formSearchSubmit3" class="btn btn-submit ripple-effect btn-theme pull-right">Find Car</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /Search form -->

                                                <h2 class="caption-title">For rental Cars</h2>
                                                <h3 class="caption-subtitle">Best Deals</h3>
                                                <p class="caption-text">
                                                    Sales Up  %45 Off<br>
                                                    All Rental Cars Start from  49$
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 1343px; margin-right: 0px;"><div class="item slide4 ver4">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <h2 class="caption-title">For rental Cars</h2>
                                                <h3 class="caption-subtitle"><span>Best Deals</span></h3>
                                                <p class="caption-text">
                                                    Sales Up  %45 Off<br>
                                                    All Rental Cars Start from  49$
                                                </p>
                                                <p class="caption-text">
                                                    <a class="btn btn-theme ripple-effect btn-theme-md" href="#">See All Vehicles</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 1343px; margin-right: 0px;"><div class="item slide1 ver1">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <h2 class="caption-title">Save big money booking online now</h2>
                                                <h3 class="caption-subtitle">SEARCH FOR CHEAP CAR HIRE</h3>
                                                <!-- Search form -->
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-10 col-md-offset-1">

                                                        <div class="form-search dark">
                                                            <form action="#">
                                                                <div class="form-title">
                                                                    <i class="fa fa-globe"></i>
                                                                    <h2>We offer the most competitive prices &amp; the widest choice from the top car rental providers</h2>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpLocation">Picking Up Location</label>
                                                                                <input class="form-control" id="formSearchUpLocation" placeholder="Airport or Anywhere" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchUpDate">Picking Up Date</label>
                                                                                <input class="form-control datepicker" id="formSearchUpDate" placeholder="dd/mm/yyyy" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                <label>Picking Up Hour</label>
                                                                                <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                                    <option selected="selected">20:00 AM</option>
                                                                                    <option>21:00 AM</option>
                                                                                    <option>22:00 AM</option>
                                                                                </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-inputs">
                                                                    <div class="container-fluid">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffLocation">Dropping Off Location</label>
                                                                                <input class="form-control" id="formSearchOffLocation" placeholder="Airport or Anywhere" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label">
                                                                                <label for="formSearchOffDate">Dropping Off Date</label>
                                                                                <input class="form-control datepicker" id="formSearchOffDate" placeholder="dd/mm/yyyy" type="text">
                                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                                <label>Dropping Off Hour</label>
                                                                                <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                                    <option selected="selected">20:00 AM</option>
                                                                                    <option>21:00 AM</option>
                                                                                    <option>22:00 AM</option>
                                                                                </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row row-submit">
                                                                    <div class="container-fluid">
                                                                        <div class="inner">
                                                                            <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                            <button type="submit" id="formSearchSubmit" class="btn btn-submit btn-theme pull-right">Find Car</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- /Search form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 1343px; margin-right: 0px;"><div class="item slide2 ver2">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <!-- Search form -->
                                                <div class="form-search light">
                                                    <form action="#">
                                                        <div class="form-title">
                                                            <i class="fa fa-globe"></i>
                                                            <h2>Search for Cheap Rental Cars Wherever Your Are</h2>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpLocation2">Picking Up Location</label>
                                                                        <input class="form-control" id="formSearchUpLocation2" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffLocation2">Dropping Off Location</label>
                                                                        <input class="form-control" id="formSearchOffLocation2" placeholder="Airport or Anywhere" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpDate2">Picking Up Date</label>
                                                                        <input class="form-control datepicker" id="formSearchUpDate2" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Picking Up Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate2">Dropping Off Date</label>
                                                                        <input class="form-control datepicker" id="formSearchOffDate2" placeholder="dd/mm/yyyy" type="text">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Dropping Off Hour</label>
                                                                        <select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select" style="display: none;">
                                                                            <option selected="selected">20:00 AM</option>
                                                                            <option>21:00 AM</option>
                                                                            <option>22:00 AM</option>
                                                                        </select><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div><div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="20:00 AM"><span class="filter-option pull-left">20:00 AM</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input class="input-block-level form-control" autocomplete="off" type="text"></div><ul class="dropdown-menu inner selectpicker" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;20:00 AM&lt;/span&gt;"><span class="text">20:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;21:00 AM&lt;/span&gt;"><span class="text">21:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-normalized-text="&lt;span class=&quot;text&quot;&gt;22:00 AM&lt;/span&gt;"><span class="text">22:00 AM</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                                    <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme ripple-effect pull-right">Find Car</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /Search form -->

                                                <h2 class="caption-subtitle">Find Your Car!<br> Rent A Car Theme</h2>
                                                <p class="caption-text">
                                                    Vivamus in est sit 
amet risus rutrum facilisis sed ut mauris. Aenean aliquam ex ut sem 
aliquet, eget vestibulum erat pharetra. Maecenas vel urna nulla. Mauris 
non risus pulvinar.
                                                </p>
                                                <p class="caption-text">
                                                    <a class="btn btn-theme ripple-effect btn-theme-md" href="#">See All Vehicles</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style=""><i class="fa fa-angle-left"></i></div><div class="owl-next" style=""><i class="fa fa-angle-right"></i></div></div><div style="" class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div></div></div></div>
                </div>

            </div>
        </section>
		

    <div id="to-top" class="to-top" style="bottom: -100px;"><i class="fa fa-angle-up"></i></div>

</div>
<!-- /WRAPPER -->

<!-- JS Global -->
<script src="index_files/jquery-1.js"></script>
<script src="index_files/bootstrap.js"></script>
<script src="index_files/bootstrap-select.js"></script>
<script src="index_files/superfish.js"></script>
<script src="index_files/jquery_003.js"></script>
<script src="index_files/owl.js"></script>
<script src="index_files/jquery_004.js"></script>
<script src="index_files/jquery_002.js"></script>
<script src="index_files/jquery.js"></script>
<!--<script src="assets/plugins/smooth-scrollbar.min.js"></script>-->
<!--<script src="assets/plugins/wow/wow.min.js"></script>-->
<script>
    // WOW - animated content
    //new WOW().init();
</script>
<script src="index_files/swiper.js"></script>
<script src="index_files/moment-with-locales.js"></script>
<script src="index_files/bootstrap-datetimepicker.js"></script>

<!-- JS Page Level -->
<script src="index_files/theme-ajax-mail.js"></script>
<script src="index_files/theme.js"></script>


</body></html>