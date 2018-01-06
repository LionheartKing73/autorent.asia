<?php

/*
Class....... Data 
Coded By.... Douglas Brown
Date........ 1st January 2009

The class handles all the direct insert/update/delete access function to Starlink databases. Pass in a connection link to the DB and the tablename. The DataSet class handles data retrieval other than by Primary key
Read the record into properties in $this->Record.
Set $Record properties and use the Write function to update or insert

Properties
----------
SqlHandler		: 	The standard Sql handler 
Table			:	The table name
PrimaryKey		:	The table's primary key (by default it is the tablename suffixed by _id. This can be overridden
Id			    :	The id value of the primary key
Record		    :	The other fields in the table
AffectedRows	:	The number of records altered, read or inserted
DeleteFailedChildRows   : Boolean if the delete was prohibited because of child data constraints
Status		    :	The status code
StatusMessage	:	The associated status message

Methods
-------
Constructor		:	Initialises for processing
Read			:	Gets a record and creates the class properties accordingly
Write			:	Inserts or Updates
Remove          :   Delete
GetUpdateSQL	:	Create the update Sql statement (protecting agains Sql injection)
GetInsertSQL	:	Create the insert Sql statement (protecting agains Sql injection)
InterpretField  :   Plays with the value of the data depending on the type


*/
class Data 
{
public $SqlHandler	 = "";
public $Table		 = "";
public $PrimaryKey	 = "";
public $Id		 = 0;
public $Record		 = "";
public $AffectedRows=0;
public $DeleteFailedChildRows=0;
public $Status		 = 0;
public $StatusMessage = "";

	function Data( $connection_link, $tablename )
	{

		$this->SqlHandler = new SqlHandler(  $connection_link );
		$this->Table	= $tablename;
		$this->PrimaryKey = $tablename."_id";

	}

	function Read ( $id )
	{
		if ( is_numeric ( $id ) )
		{
			$this->SqlHandler->Sql = "select * from $this->Table where $this->PrimaryKey = $id ";
			$this->SqlHandler->Execute();

			if ( ! $this->SqlHandler->SqlError )
			{
				$this->AffectedRows = $this->SqlHandler->AffectedRows();
				if ( $this->AffectedRows == 1 )
				{
					$Record=$this->SqlHandler->GetRecord();
					foreach ( $Record as $field=>$value )
					{
						$this->Record->$field = $value;
					}
				}
				else
				{
					$this->Status=100;
					$this->StatusMessage="Record $id not found in table $this->Table";
				}
			}
			else
			{
				$this->Status=$this->SqlHandler->SqlErrorNo;
				$this->StatusMessage=$this->SqlHandler->SqlError;
			}
		}
		else
		{
			$this->Status=-1;
			$this->StatusMessage="Invalid id:  $id for table $this->Table";
		}
	}

	function Write ( $id )
	{

		if ( is_numeric( $id ) ) 
		{
			if ( $id )
				$this->SqlHandler->Sql = $this->GetUpdateSQL( $id );
			else
				$this->SqlHandler->Sql = $this->GetInsertSQL( $id );

			if ( $this->SqlHandler->Sql )
			{

				$this->SqlHandler->Execute();

				if ( ! $this->SqlHandler->SqlError )
				{	

					$this->AffectedRows=$this->SqlHandler->AffectedRows();

					if ( $id )
						$this->Id = $id;
					else
                    {
						$this->Id=$this->SqlHandler->LastInsertedId();

                    }
	
				}
				else
				{
					$this->Status=$this->SqlHandler->SqlErrorNo;
					$this->StatusMessage=$this->SqlHandler->SqlError;
				}
			}
			else
			{
				$this->Status=-2;
				$this->StatusMessage="No data to update for table $this->Table";
			}
		}
		else
		{
			$this->Status=-1;
			$this->StatusMessage="Invalid id:  $id for table $this->Table";
		}

	}

function Remove ( $id )
{
	if ( is_numeric ( $id ) )
	{
		$this->SqlHandler->Sql = "delete from $this->Table where $this->PrimaryKey = $id ";
		$this->SqlHandler->Execute();

		if ( $this->SqlHandler->SqlError )
		{
			if ( $this->SqlHandler->SqlErrorNo = 1451 )
			{
				$this->Status=0;
				$this->StatusMessage="";
				$this->DeleteFailedChildRows=true;
			}
			else
			{
				$this->Status=$this->SqlHandler->SqlErrorNo;
				$this->StatusMessage=$this->SqlHandler->SqlError;
			}
		}
	}


}

	private function GetInsertSQL( $id )
	{
  	                        
		if ( $this->Record )
		{

			$fields="";
			$values="";
			foreach ( $this->Record as $field=>$value )
			{

                $value = $this->InterpretField( $field, $value );
                if ( $fields )
					$fields.=",".$field;
				else
					$fields=$field;
				// List the values
				if ( $values )
					$values.=",".$value;
				else
					$values=$value;

			}
               
			$sql = "insert into $this->Table ( $fields ) VALUES ( $values )";		
		}

		return $sql;

	}

	private function GetUpdateSQL( $id )
	{

		if ( $this->Record )
		{

			foreach ( $this->Record as $field=>$value )
			{

                $value = $this->InterpretField( $field, $value );
				// List the field names
				if ( $set_statement )
					$set_statement.=",".$field." = ".$value;
				else
					$set_statement=$field." = ".$value;

			}
             $sql = "update $this->Table set $set_statement where $this->PrimaryKey = $id";

		}

		return $sql;
	}
        private function InterpretField( $field, $value )
    {
                $value = mysql_real_escape_string($value);
                if ( $field == "password")
                    $value="'".tep_encrypt_password($value)."'";
                elseif( $value == "now()")
                    $value = "now()";
                else
                    $value ="'".$value."'";
           return $value;
    
    }
}