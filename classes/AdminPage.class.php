<?php

/*
Class....... AdminPage
Coded By.... Douglas Brown
Date........ 14th Sept 2008

The class formats pages for the PGH Location

Properties


Methods
LocationPage..........Constructor 


*/
include 'Page.class.php';

class AdminPage extends Page{

//***************************************Properties

	var $Title = "";
	var $TableTitle = "";
	var $Table = "";
	var $JoinTables = "";
	var $KeyField = "";
	var $Key = 0;
	var $ViewFields = "";
	var $ListFields = "";
	var $ListTitles = "";
	var $ListSortFields = "";
	var $EditFields = "";
	var $phpFile = "";
	var $WhereClause="";
 
//***************************************Methods
   
    function AdminPage( $IsSecurePage ){ 


		parent::Page( $IsSecurePage );
		$this->phpFile = $_SERVER[ 'PHP_SELF' ];
		if ( $_REQUEST[ "key" ] )
		{
			if ( ! is_numeric( $_REQUEST[ "key" ] ) )
			{
				print "Invalid Key";
				exit;
			}
			else
				$this->Key = $_REQUEST[ "key" ];
		} 
		
	}


// Removes the record from the Database

	function DoProcess( ){

		ini_set( 'display_errors', 'On' );
		print "<h2>".$this->Title."</h2>";

		if ( $_REQUEST[ "mode" ] == "Post" )
			$this->DoUpdate();
		elseif ( $_REQUEST[ "key" ] )
		{
			if ( $_REQUEST[ "mode" ] == "Edit" )
				$this->DoEdit( );
			elseif ( $_REQUEST[ "mode" ] == "Del" )
				$this->DoRemove( );
			else 
				$this->DoView( );
		}
		elseif ( $_REQUEST[ "mode" ] == "Add" )
			$this->DoEdit( 0 );
		else
			$this->DoList();

	}

function DoList(){

		print "<TABLE width='100%' align='center' cellpadding='3' border='0' cellspacing='0'>";



		$this->SqlHandler->Sql = "SELECT ".$this->ListFields." from ".$this->Table;
		$this->SqlHandler->Sql .= " ".$this->JoinTables;
		if ( $this->WhereClause )
			$this->SqlHandler->Sql .= " WHERE ".$this->WhereClause;
		$this->SqlHandler->Sql .= " order by ".$this->ListSortFields;
		$this->SqlHandler->Execute();

		if ( $this->SqlHandler->SqlError ) 
		{
		
			print $this->SqlHandler->SqlError ;
		}
		else{
			$TitleArr = split( ",", $this->ListTitles );
			$FieldArr = split( ",", $this->ListFields );
			print "\n<tr><td></td><td></td>";
			// Now 1 column for each list field
			for ( $i=0; $i<sizeof( $TitleArr ); $i++ )
			{
				print "\n<td align='left'>".$TitleArr[ $i ]."</td>";
			}
			print "\n</tr>";
			while ( $Row =  $this->SqlHandler->GetRecord( ) ) {

				print "\n<tr>";
				print "\n<td align='left'>";
				print "<a href='".$this->phpFile."?key=".$Row[$this->KeyField ]."'>";
				print "View</a></td>";
				print "\n<td align='left'>";
				print "<a href='".$this->phpFile."?key=".$Row[$this->KeyField]."&mode=Edit'>";
				print "Edit</a></td>";

				// Now 1 column for each list field
				for ( $i=0; $i<sizeof( $FieldArr ); $i++ )
				{
					print "\n<td align='left'>".$Row[ trim($FieldArr[ $i ]) ]."</td>";
				}
				print "\n<td align='left'><a href='".$this->phpFile."?key=".$Row[$this->KeyField]."&mode=Del'>Delete<a></td>\n</tr>";

			}

			mysql_free_result($this->SqlHandler->ResultSet); 



		}



print "</TABLE>";
if ( $this->WhereClause )
	$QrefAnd="&".$this->WhereClause;
print "<p><a href='".$this->phpFile."?mode=Add".$QrefAnd."'>Add new ".$this->TableTitle."</a></p>";

	}

// Format the Form for View / Edit
// The ShowForm method should be overridden in the child class
function DoDetail( $mode ){

if ( $mode == "Edit" )
{
	$FieldArr = split( ",", $this->EditFields );
	// Now 1 column for each list field
	for ( $i=0; $i<sizeof( $FieldArr ); $i++ )
	{
		if ( $i > 0 )
			$fields.=",";
		$fields .=$this->Table.".".trim($FieldArr[ $i ]);
	}	
	
}
else
	$fields = $this->ViewFields;

$this->SqlHandler->Sql = "SELECT $fields from $this->Table ";
$this->SqlHandler->Sql .= " ".$this->JoinTables." where $this->KeyField = ".$this->Key;
$this->SqlHandler->Execute();


		if ( $this->SqlHandler->SqlError ) 
		{
		
			print $this->SqlHandler->SqlError ;
		}
		else{
			$Row =  $this->SqlHandler->GetRecord( );
			$this->ShowForm( $mode, $Row );

		}

}


function ShowForm( $mode, $Record )
{
// A stub class which should be overridden in the child class

}

// Show record in View mode
function DoView( ){

		print "<center>";
		print "\n<a href='".$this->phpFile."?key=".$this->Key."&mode=Edit'>Edit</a>";
		print "<br/>";
		$this->DoDetail( "View" );

	
	
		print "</center>";
}

// Provides the Add / Edit Form
	function DoEdit(  ){

		print "<center>";
		print "<form method='post' action='".$this->phpFile."'>";
		print "<input type='submit'>";
		print "<input type='hidden' name='key' value='".$this->Key."'>";
		print "<input type='hidden' name='mode' value='Post'>";
		$this->DoDetail( "Edit" );



		print "</form>";
		print "</center>";
	}

	function DoUpdate( ){

		$FieldArr = split( ",", $this->EditFields );
		if ( $this->Key )
		{
			// Now 1 column for each list field
			$SetClause = "set ";
			for ( $i=0; $i<sizeof( $FieldArr ); $i++ )
			{
				if ( $i > 0 )
					$SetClause .= ",";
				$SetClause .= $FieldArr[ $i ]." = '".trim($_REQUEST[ trim($FieldArr[ $i ]) ])."'";


			}
			$this->SqlHandler->Sql = "UPDATE $this->Table ";
			$this->SqlHandler->Sql .= $SetClause;
			$this->SqlHandler->Sql .= " where ".$this->KeyField." = ".$this->Key;

			$this->SqlHandler->Execute();
			if ( $this->SqlHandler->SqlError )
				print $this->SqlHandler->SqlError;
			$this->DoView();


		}
		else
		{
			// Now 1 column for each list field
			$InsertClause = "";
			for ( $i=0; $i<sizeof( $FieldArr ); $i++ )
			{
				if ( $i > 0 )
					$InsertClause .= ",";
				$InsertClause .= "'".$_REQUEST[ $FieldArr[ $i ] ]."'";
			}
			$this->SqlHandler->Sql = "INSERT INTO $this->Table ( ".$this->EditFields." ) ";
			$this->SqlHandler->Sql .= " VALUES ( ".$InsertClause." ) ";

			$this->SqlHandler->Execute();
			if ( $this->SqlHandler->SqlError )
				print $this->SqlHandler->SqlError;
			$this->DoList();
		}


	}

// Removes the record from the Database

	function DoRemove(  ){

		$this->SqlHandler->Sql = "DELETE from ".$this->Table;
		$this->SqlHandler->Sql .= " where ".$this->KeyField." = ".$this->Key;
		$this->SqlHandler->Execute();

		$this->DoList();
	}



// **** Send: Sends the Output to the Browser


    function ShowMenu(){ 

?>
      <div id="menu">
<ul>
<li id="active"><a href="booking.php" id="current">&nbsp;&nbsp;Bookings</a></li>  
<li id="active"><a href="country.php" id="current">&nbsp;&nbsp;Countries</a></li>
<li id="active"><a href="location.php" id="current">&nbsp;&nbsp;Locations</a></li>
<li id="active"><a href="course.php" id="current">&nbsp;&nbsp;Golf Courses</a></li>
<li id="active"><a href="hotel.php" id="current">&nbsp;&nbsp;Hotels</a></li>
<li id="active"><a href="partner.php" id="current">&nbsp;&nbsp;Partners</a></li>  
<li id="active"><a href="contacts.php" id="current">&nbsp;&nbsp;Contacts</a></li>
<li id="active"><a href="Login.php?Logoff=yes" id="current">&nbsp;&nbsp;Logout</a></li>
</ul>
      </div>
    </div><!-- end sidebar -->

    <div id="content">
      <div>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="740" height="220">
          <param name="movie" value="http://www.playgolfholidays.co.uk/Movie1.swf" />
          <param name="quality" value="high" />
          <embed src="http://www.playgolfholidays.co.uk/Movie1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="740" height="220"></embed>
        </object>
      </div>



<?php

	}

// **** Send: Formats a Select Box

	function MakeSelectBox( $table, $keyfield, $namefield, $value )
	{


		$this->SqlHandler->Sql = "select ".$keyfield.",".$namefield." from ".$table;

		$this->SqlHandler->Execute();

		print "\n<select name='".$keyfield."'>";
		if ( $this->SqlHandler->SqlError ) 
			print  $this->SqlHandler->SqlError ;
		else{
			while ( $Row =  $this->SqlHandler->GetRecord( ) ) {


				$Key = $Row[ $keyfield ];
				$Agent = $Row[  $namefield ];

				if ( $value == $Key )
					$sel = "selected";
				else
					$sel = "";

				print  "<option ".$sel." value='".$Key."'>".$Agent."</option>";


			}
		}
		print   "</select>";	
	}










// ********************** End Class
} 





?>
