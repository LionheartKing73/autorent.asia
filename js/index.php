<?php
 ini_set("display_errors", "On") ;  
    $wsdl = "https://webservices.sixt.de/webservices/reservation/wsdl/test/countrylist_1.29.wsdl";
    
        $config = array(
        'login'=>'reservation',
        'features'=>SOAP_SINGLE_ELEMENT_ARRAYS,
        'password'=>'Gaih47Wouf',
        'exceptions'=>true,
        "trace"=>true
        );
        
        $auth = array(
        'CustomerName'=>'DiamondCarRentals0712',
        'Specification'=>'Doug',
        'Password'=>'Hifr49Luph',
        'Language'=>'en'
        );
        

    $sc = new SoapClient( $wsdl,$config );
    
    
    

    
    if ( $sc->__setSoapHeaders( new SoapHeader( 'http://www.sixt.de/res', 'Authentication', $auth ) ) )
    {
     //var_dump( $sc->__GetFunctions() );  
         print "<p>";  
    $CountryList = $sc->CountryList();
    
    var_dump( $CountryList );
    print "<p>"; 
    print "REQUEST : " . $sc->__getLastRequest();
    print "<p>"; 
    print "REQUEST HEADERS: " . $sc->__getLastRequestHeaders(); 
    
        print "<p>"; 
    print "RESPONSE : " . $sc->__getLastResponse();
    print "<p>"; 
    print "RESPONSE HEADERS: " . $sc->__getLastResponseHeaders(); 
    }
    else
    print "SET FAILED";
    
?>