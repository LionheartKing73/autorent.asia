<?php
/*
  The country-by-country site operation depends on the subdomain
  We stirp that out of the URL and select the country record form the database

*/



class Country 
{
    var $Status=0;
    var $StatusMessage="";
    var $SubDomain="";
    var $Rec="";  

    
    function __construct()
    {

        $url = $_SERVER['HTTP_HOST'];
        if ( $url == '127.0.0.1')
            $url = "thailand.diamondcarrental.co.uk";
        
        $sd_arr = explode( ".", $url );

        
        for ( $i=0; $i<=sizeof( $sd_arr); $i++ )
        {
            if ( $sd_arr[$i] == "diamondcarrental" && $i>=0 )
            {

                break;
            }
        }
        $this->SubDomain = $sd_arr[$i-1];  
        
        if ( ! $this->SubDomain || $this->SubDomain == "www")
             $this->SubDomain = "";
        else
        {
            $sql="Select * from country LEFT JOIN currencies_from_usd ON currencies_id = fk_country_currency_id " . 
            "where country_subdomain = '".$this->SubDomain."'";

             $ResultSet = mysql_query( $sql ) ;
          
          $this->Status = mysql_errno(); 
          if ( $this->Status )
          {
            $this->StatusMessage =  mysql_error(); 

          }
          else
            $this->Rec = mysql_fetch_array( $ResultSet );  
        }


 
    }
    
    
}

function fulldomain($domainb) {
    $bits = explode('/', $domainb);
    if ($bits[0]=='http:' || $bits[0]=='https:')
        {
        return $bits[0].'//'.$bits[2].'/';
        } else {
        return 'http://'.$bits[0].'/';
        }
    unset($bits);
    }
    



$Country = new Country();

$Country->Rec["country_id"] =1 ;









?>
