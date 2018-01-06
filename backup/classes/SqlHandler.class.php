<?php
/*
Class....... SqlHandler
Coded By.... Douglas Brown
Date........ 27th April 2007

The class executes SQL .

Properties
Sql................The SQL statement
SqlError...........The error  returned from SQL
ResultSet..........The ResultSet from a SELECT statement



Methods
ERSSqlhandler................Constructor 
Execute......................Run the SQL
NumRows......................How many rows returned

*/
class SqlHandler{

//***************************************Properties
	var $Sql = "";
	var $SqlError = "";
	var $SqlErrorNo = 0;
    	var $ResultSet = "";
	var $Link;


 
//***************************************Methods
   
// **** Constructor 

function SqlHandler( $ConnectLink )
{ 
$this->Link = $ConnectLink;

	
}
function  Execute(  ){


	$this->ResultSet = mysql_query( $this->Sql, $this->Link  ) ;

	$this->SqlErrorNo = mysql_errno($this->Link);
	$this->SqlError = mysql_error($this->Link);


}

function  GetRow(  ){

$Row =  mysql_fetch_row( $this->ResultSet);


return $Row;

}
function  GetNthRecord( $n ){

mysql_data_seek($this->ResultSet, $n - 1);
$Record =  mysql_fetch_assoc( $this->ResultSet);


return $Record;

}

function  GetRecord(  ){

$Record =  mysql_fetch_assoc( $this->ResultSet);


return $Record;

}


function  AffectedRows(  ){
//Returns the number of rows affected by an update or delete


$Count = mysql_affected_rows( $this->Link  );


return $Count;

}
function  LastInsertedId(  ){

return mysql_insert_id( $this->Link );

}

function  NumRows(  ){

$Count =  mysql_num_rows( $this->ResultSet);


return $Count;

}

// ********************** End Class
} 

// for legacy code which named the class ERSSqlHandler and is now confusing
// as we access other MySQL systems
class ERSSqlHandler extends SqlHandler
{

}
?>