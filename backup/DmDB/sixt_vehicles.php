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

         print "<p>";  
         
         if ( $_REQUEST["check"])
         {
             
         }
         else
         {
             
      
                 $stations = array(
        'CountryCode'=>$Country->Rec["country_code"]

        );
    $StationsList = $sc->StationList( $stations);
    $StationsArray=$StationsList->Stations;
    
    set_time_limit( 300 );
    
    for ( $i =0; $i<sizeof( $StationsArray ); $i++ )
    {
        print "<h3>".$StationsArray[$i]->StationID.": ".$StationsArray[$i]->Name."</h3>";
           print "<table>";
           print "<tr><th>CARS: Group</th>";
           print "<th>Examples</th>";      
                      print "<th align='right'>Passengers";
           
           print '</th>';   
           print "<th align='right'>Doors";

           print '</th>';  
           "</tr>";  

       $VehiclesList = $sc->VehModelList(array('StationID'=>$StationsArray[$i]->StationID) ); 
       for ( $j=0; $j<sizeof( $VehiclesList->Cars ); $j++ )
       {
           $ret = $VehiclesList->Cars[$j];

            $CarList="";  
            print "<tr>";
           print "<td >";
           print $ret->Group ;
           print '</td>';     
           print "<td>";      
           foreach( $ret->Examples as $key=>$value )
           {
                $CarList .=", ".$value;
           }
           print substr( $CarList, 2 );
           print '</td>';
           print "<td align='right'>";
           print $ret->PassengerNo ;
           print '</td>';   
           print "<td align='right'>";
           print $ret->DoorsNo ;
           print '</td>';     
            print "<td align='right'>";
           print "<a href='".$_SERVER["PHP_SELF"]."?check=1'>availability</a>";
           print '</td>';                       
           print "</tr>";


       }   
           print "</table>";  
           if ( $i>5 )
           break;
           /*
           print "<table>";
           print "<tr><th>TRUCKS: Examples</th></tr>";  

       $VehiclesList = $sc->VehModelList(array('StationID'=>$StationsArray[$i]->StationID) ); 
       for ( $j=0; $j<sizeof( $VehiclesList->Trucks ); $j++ )
       {
           $ret = $VehiclesList->Trucks[$j];

            $CarList="";  
            print "<tr><td>";      
           foreach( $ret->Examples as $key=>$value )
           {
                $CarList .=", ".$value;
           }
           print substr( $CarList, 2 );
           print '</td>';
           
           print "</tr>";


       }   
           print "</table>";   
           */    
             }    
    }
    
    }

?>


     

<?php
   include './Includes/BodyFoot.php';   
?>

</body>
</html>
