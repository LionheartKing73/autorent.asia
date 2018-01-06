<?php
/*
Class....... FrameworkDate
Coded By.... Douglas Brown
Date........ 29th January 2009

The standard format for passing dates around the framework is that of MySql (YYYY-MM-DD).
This class allows such dates to be added to and subtracted from, and formatted

Properties
Date        :   The input date in YYYY-MM-DD format
Year
Month
Day
Hour
Minute
Second      :   The various segments of the input date
UnixDate    :   The input date converted to a standard unix date


Methods
Constructor     : Strips the input date into its parts and creates $this->UnixDate
Output          : Outputs the date in YYYY-MM-DD (used after $this-Add)
Format          : Sends the date out in a particular format
                : The default is Thursday 2nd May, 2009
Add             : Adds, subtracts a number of days, weeks, months, etc
*/
  class FrameworkDate
  {
      public $Date="";
      public $Time="";
      public $UnixDate="";
      public $Year="";
      public $Month="";
      public $Day="";
      public $Hour=0;
      public $Minute=0;
      public $Second=0;
      function __construct( $YYYYMMDD )
      {

          $arr=split( " ", $YYYYMMDD);
          $this->Date=$arr[0];
          $this->Time=$arr[1];
          $arr=split( "-", $this->Date );
          $this->Year = $arr[0];
          $this->Month = $arr[1];
          $this->Day = $arr[2];
          if ( $this->Time )
          {
            $arr=split( ":", $this->Time );
              $this->Hour = $arr[0];
              $this->Minute=$arr[1];
              $this->Second=$arr[2];
          }

          $this->UnixDate = mktime( $this->Hour, $this->Minute, $this->Second, $this->Month, $this->Day, $this->Year );

      }
      
      function Output( $with_time="" )
      {
            if ( $with_time )
                return date("Y-m-d H:i" , $this->UnixDate);
            else
                return date("Y-m-d" , $this->UnixDate);         
          
      }
      function Format( $format="" )
      {
          if ( $format )
            return date( $format, $this->UnixDate  );
            elseif ( $this->Time )
                        return date("l jS F, Y H:i" , $this->UnixDate);     
            else
            return date("l jS F, Y" , $this->UnixDate);
          
          
      }

function Add($interval, $number) {

    $date_time_array = getdate($date);
    $hours = $date_time_array["hours"];
    $minutes = $date_time_array["minutes"];
    $seconds = $date_time_array["seconds"];
    $month = $date_time_array["mon"];
    $day = $date_time_array["mday"];
    $year = $date_time_array["year"];

    switch ($interval) {
    
        case "y":
            $this->Year+=$number;
            break;
        case "q":
           $this->Month+=($number*3);
            break;
        case "m":
            $this->Month+=$number;
            break;
        case "d":
            $this->Day+=$number;
            break;
        case "w":
            $this->Day+=($number*7);
            break;
        case "h":
            $this->Hour+=$number;
            break;
        case "n":
            $this->Minute+=$number;
            break;
        case "s":
            $this->Second+=$number; 
            break;            
    }
          $this->UnixDate = mktime( $this->Hour, $this->Minute, $this->Second, $this->Month, $this->Day, $this->Year );
}

      
  }
?>
