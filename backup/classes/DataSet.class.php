<?php

/*
Class....... DataSet
Coded By.... Douglas Brown
Date........ 4th January 2009

Handles the retrieval of data by any other means than by primary key (handled in Data.class.php)

Properties
----------
Link		: 	The database connection link
Table			:	The primary table name
Fields		:	The fields to retrieve
Join			:	The Join syntax 	
Where			:	The where clause
Sql			:	The Sql which is generate
OrderBy		:	The order by clause
GroupBy		:	The group by clause
MaxRows		:	The number of rows returned is limited
DataRows    :   the number of rows read
Data			:	The actual data in an array of associative arrays
Status		:	The status code
StatusMessage	:	The associated status message

Methods
-------
Constructor		:	Initialises for processing
AddToJoin		:	Adds a new JOIN clause
AddToWhere		:	Adds a new WHERE item
GenSql          :   Pieces together the sql statement
ShowSql         :   Prints out the sql
Read            :   Reads the data into the dataset


*/
class DataSet
{
public $Link	 = "";
public $Table		 = "";
public $Fields ="*";
public $Join	 = "";
public $Where	 = 0;
public $Sql	= "";
public $OrderBy	= "";
public $GroupBy	= "";
public $MaxRows	= 100;
public $DataRows	 = 0;
public $Data		= "";
public $Status		 = 0;
public $StatusMessage = "";


	function DataSet( $connection_link, $tablename )
	{

		$this->Link =  $connection_link ;
		$this->Table	= $tablename;


	}

	function AddToJoin ( $jointable, $remotefield, $localfield, $type="", $joinrelationship="=", $joinextra="")
	{

		$this->Join .=$type." JOIN ".$jointable." ON ".$remotefield." $joinrelationship ".$localfield." ".$joinextra." ";

	}
	function GenSql()
	{
		$this->Sql = "select ".$this->Fields." from $this->Table ".$this->Join;
        if ( $this->Where )
		    $this->Sql .= " where ".$this->Where;
            if ($this->GroupBy )
          $this->Sql .= " GROUP BY ".$this->GroupBy;
          if ( $this->OrderBy )
                  $this->Sql .= " ORDER BY ".$this->OrderBy;
                  
		$this->Sql .= " LIMIT ".$this->MaxRows;
	}
	function ShowSql()
	{
		print $this->Sql;
	}
	function AddToWhere ( $field,  $value, $whererelationship="=" )
	{

		$where = $field." ".$whererelationship." '".mysql_real_escape_string($value )."'";
		if ( $this->Where )
			$this->Where.=" AND ".$where;
		else
			$this->Where=$where;
	}
	function Read (  )
	{
		$this->GenSql();

		$SqlHandler = new SqlHandler( $this->Link );
		$SqlHandler->Sql = $this->Sql;

		$SqlHandler->Execute();
		if ( ! $SqlHandler->SqlError )
		{
			$i=0;
			while ($Record=$SqlHandler->GetRecord())
			{	
				$DataRecord="";

				foreach ( $Record as $field=>$value )
				{
					$DataRecord->$field = $value;
				}
				$this->Data[$i]=$DataRecord;
                $i=$i+1;
			}
			$this->DataRows =$i;
		}
		else
		{
			$this->Status=$SqlHandler->SqlErrorNo;
			$this->StatusMessage=$SqlHandler->SqlError;
		}

	}

	
}