<?php
    include './Includes/Top.php';    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <head>
<title>SIXT Vehicles</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/myscripts.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';
?>
</head>


<body>
<?php
//ini_set( 'display_errors', 'On' );
include './Includes/BodyHead.php';     
?>


<?php


 define( 'SIXT_WSDL', 'https://webservices.sixt.de/webservices/reservation/test/soap_2.00?wsdl') ;

     $wsdl = SIXT_WSDL;
    
        $config = array(
        'login'=>'reservation',
        'features'=>SOAP_SINGLE_ELEMENT_ARRAYS,
        'password'=>'Gaih47Wouf',
        'exceptions'=>true,
        "trace"=>true
        );
        
        $auth = array(
        'CustomerName'=>'DiamondCarRentals0712',
        'Specification'=>'',
        'Password'=>'Hifr49Luph',
        'Language'=>'en'
        );
        

    $sc = new SoapClient( $wsdl,$config );
    
    
 

    
if ( $sc->__setSoapHeaders( new SoapHeader( 'http://www.sixt.de/res', 'Authentication', $auth ) ) )
{
            $stations = array(
        'CountryCode'=>$Country->Rec["country_code"]  );

        $StationsList = $sc->StationList( $stations);
        $StationsArray=$StationsList->Stations;   

    if ( $_REQUEST["query"])
    {   

         $Car = array ( "Type"=>$_REQUEST[ "cartype"] )   ;
         $Fromst=$_REQUEST["FromStation"]  ;
         $Tost=$_REQUEST["ToStation"]  ; 
         $FromDt=$_REQUEST["startyearveh"].$_REQUEST["startmonthveh"].$_REQUEST["startdayveh"];    
         $FromTm=$_REQUEST["starttimehrs"].$_REQUEST["starttimemins"];
         $ToDt=$_REQUEST["finyear"].$_REQUEST["finmonth"].$_REQUEST["finday"];    
         $ToTm=$_REQUEST["fintimehrs"].$_REQUEST["fintimemins"];   
         //$Pickup = array ( "StationID"=>$Fromst, "Date"=>'20130911', "Time"=>'1100' )   ;
         $Pickup = array ( "StationID"=>$Fromst, "Date"=>$FromDt, "Time"=>$FromTm )   ;  
         $Return = array ( "StationID"=>$Tost, "Date"=>$ToDt, "Time"=>$ToTm )   ;    
         $av = array(
            'POS'=>$Country->Rec["country_code"],
            'Car'=>$Car,
            'Pickup'=>$Pickup,
            'Return'=>$Return            );
            



        try{  
                $AvList = $sc->Availability( $av); 
    for ( $i =0; $i<sizeof( $StationsArray ); $i++ )
    {
       $LkSt[ $StationsArray[$i]->StationID ] = $StationsArray[$i]->Name;
    }
    $crt["P"]="Personal";
    $crt["F"]="Fun"; 
    $crt["L"]="Trucks";  

          
     print "<h3>Car Type: ".$crt[$_REQUEST[ "cartype"]]." From ".$LkSt[ $Fromst ]." $FromDt $FromTm to  ".$LkSt[ $Tost ]." $ToDt $ToTm</h3>";

               
                print "<table>";



                //reget_object_vars($StationsList  )   ; 
                print "<br/>" ;
                reget_object_vars($AvList->Offers  )   ;    
                print "</table>";    
            }
            catch (Exception $e) { 
                trigger_error($e);
            }
    }  
    else
    {   


        set_time_limit( 300 );
        print "<br/>";
        print "<br/>"; 
        print "<hr/>";
        print "<br/>";
        print "<br/>";  
?>
<form method='post' action='<?php echo $_SERVER["PHP_SELF"]?>'>;     
<?php   
    print "Pickup <select name='FromStation'>";
    for ( $i =0; $i<sizeof( $StationsArray ); $i++ )
    {
       print "<option value='".$StationsArray[$i]->StationID."'>";
       print $StationsArray[$i]->Name ."</option>";
    }
    print  "</select>";
    print "DropOff <select name='ToStation'>";
    for ( $i =0; $i<sizeof( $StationsArray ); $i++ )
    {
       print "<option value='".$StationsArray[$i]->StationID."'>";
       print $StationsArray[$i]->Name ."</option>";
    }
    print  "</select>";


?>

<p>Type: <select name='cartype' >
<option value='P'>Personal</option>
<option value='F'>Fun</option> 
<option value='L'>Trucks</option> 
</select>
  <input type='submit' value='Go'>
    <input type='hidden' name='query' value='Go'>  

<p>Pickup<select name='startdayveh' id='startdayveh'><option value='0'>DAY</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option selected='selected' value='29'>29</option><option value='30'>30</option><option value='31'>31</option></select><select name='startmonthveh' id='startmonthveh'>
<option value='00'>MONTH</option>
<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option selected='selected' value='05'>May</option>
<option value='06'>June</option>
<option value='07'>Jul</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option></select><br/><select name='startyearveh' id='startyearveh'><option value='0'>YEAR</option>
<option selected='selected' value='2013'>2013</option>
<option value='2014'>2014</option>
<option value='2015'>2015</option>
<option value='2016'>2016</option></select>

<select name='starttimehrs' id='starttimehrs'><option  value='00'>HRS</option><option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option selected='selected' value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option></select><select name='starttimemins' id='starttimemins'><option value='0'>MINS</option><option selected='selected' value='00'>00</option><option value='30'>30</option></select>
  
<p>Dropoff <select name='finday' id='finday'><option value='0'>DAY</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option value='29'>29</option><option selected='selected' value='30'>30</option><option value='31'>31</option></select><select name='finmonth' id='finmonth'>
<option value='0'>MONTH</option>
<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option selected='selected' value='05'>May</option>
<option value='06'>June</option>
<option value='07'>Jul</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option></select><br/><select name='finyear' id='finyear'><option value='0'>YEAR</option>
<option selected='selected' value='2013'>2013</option>
<option value='2014'>2014</option>
<option value='2015'>2015</option>
<option value='2016'>2016</option></select>

<select name='fintimehrs' id='fintimehrs'><option  value='00'>HRS</option><option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option selected='selected' value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option></select><select name='fintimemins' id='fintimemins'><option value='0'>MINS</option><option selected='selected' value='00'>00</option><option value='30'>30</option></select>
  </form>
<?php  
    }
}
?>


     

<?php
   include './Includes/BodyFoot.php';
   
   
function reget_object_vars( $in  )
{
    foreach ($in as $key => $value) {

        if ( $key=="AvailabilityRow")
        {
        print "<Tr><td colspan='2' style='background-color: black; color: white'>OFFER </td></tr>";
        }

        if ( is_object( $value ) )
        {
         
         reget_object_vars(  $value  )    ;
        }
        elseif ( $key=="ImageUrl")
        {
        print "<Tr><td colspan='2'><img src='".$value."'></td></tr>";    
        }
        else
        echo "<tr><td>$key</td><td>$value</td></tr>";  
    }         

}   
?>

</body>
</html>
