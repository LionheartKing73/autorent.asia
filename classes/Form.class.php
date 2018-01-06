<?php
/*
Class....... Form
Coded By.... Douglas Brown
Date........ 1st January 2009

The class encapsulates the creation and retrieval of data from HTML Forms.

Usage
-----
$Frm = new Form( "forma");
$Frm->Start();
print $Frm->Text("field1");
print $Frm->DatePicker("start_date");
$Frm->End();

after posting ...
$Frm = new Form( "forma");
print "POSTED".$Frm->Data->field1;
print "Date".$Frm->Data->start_date;

Properties
Id          : Used for both the id and the name properties of the form
Method		: POST or GET (for non-Ajax)
Target		: The target php script
Task		: Which task will be run by the Form post
Mode        : when disabled, all fields are shut down
Data        : after posting, holds the form data as object properties
Ajax        : Set to false if you want a full page POST
AjaxDiv     : change from content if you want to post results to a different DIV

Methods
constructor     :  Sets the form ID, after posting, retrieves the form data
Start           :   Sends the form tag with an enveloping DIV
End             : Sends the close form tag and some hidden controls
Text            : returns HTML for a standard TEXT field
DatePicker      : returns HTML for a date field with Javascript picker
Password        : returns HTML for a password field
Submit          : returns HTML for a Submit button
Radio           : returns HTML for a single radio button
Select          : returns HTML for a Select drop down box
Hidden          : returns HTML for a hidden field
CheckStatus     : Called by all of the above to enable disabling of form
*/

class  Form{

public $Id="";
public $Method	="POST";
public $Target	="";
public $Task = "";
public $Mode = "";		//if set to disabled, all the form fields are shut down and the confirm button is hidden
public $Data="";	// After posting, the data is available as properties in this class
public $Ajax=true;
public $AjaxDiv="content";


	function __construct( $Id="" )
	{
		$this->Id=$Id;
		$this->Target=$_SERVER["PHP_SELF"];

		// Check that the current Form has been posted - if so, get the form fields into teh object
		if ( $_REQUEST[ "form" ] == $Id )
		{

			// get the form postings into object properties
			foreach ( $_REQUEST as $field=>$value )
			{
				$this->Data->$field = $value;

			}
		}

	}

	function Start()
	{
		if ( $this->Ajax )
			$Target="javascript:void()";
		else
			$Target=$this->Target;
		print "\n<div id='".$this->Id."FormDIV'>";
		print "\n<form id='$this->Id' name='$this->Id'  method='$this->Method' action='$Target'>";

	}
	function End()
	{
		if ( $this->Task )
			print $this->Hidden( "action", $this->Task,"" );

		print $this->Hidden( "form", $this->Id,"" );
		print "\n</form>";
		print "\n</div>";

	}

	function Text( $name, $value, $extra="")
	{
		$this->CheckStatus();
		return "<input type='text' name='$name' id='$name' value='$value' $extra $this->extra/>";

	}
    function DatePicker( $name, $value, $type="", $extra="")
    {
        // type is for if he have different types of picker

        return $this->BaseDatePicker( $name, $value, $type, $extra="");

    }
    function BaseDatePicker( $name, $value, $type="", $extra="")
    {
        $this->CheckStatus();
        
        $Html = "\n<input  type='text' name='$name' id='$name' value='$value' $extra $this->extra/>";
        //$Html .= "\n<input type='text' name='$name' id='$name' value='$value' $extra $this->extra/>";  
        if ( $this->Mode != "disabled")
        {
        $Html .= "\n<img src='./img/cal.gif' ";
        $Html .= "title='Click Here' alt='Click Here' ";
        $Html .= "onclick='JACS.show(document.getElementById(\"".$name."\"),event)';/>";
        }
        
        return $Html;
        
    }

	function Password( $name, $value, $extra="")
	{
		$this->CheckStatus();
		return  "\n<input type='password' name='$name' id='$name' value='' $extra $this->extra/>";

	}
	function Submit( $name, $value, $extra="")
	{
		$this->CheckStatus;
		if ( ! $this->Ajax )
			return "\n<input type='submit' name='$name' id='$name' value='$value' $extra  $this->extra/>";
		else
			return "\n<input name=\"$name\" type=\"button\" value=\"".$value."\" onclick='javascript:PostForm( \"$this->AjaxDiv\" ,\"".$this->Id."\"  )'>";

	}
        function CheckBox( $name, $value, $default, $extra="")
    {
        $this->CheckStatus;
        if ( $value == $default )
            $checked="checked";

        return "\n<input type='checkbox' name='$name' value='$value' $extra $checked  $this->extra/>";

    }
	function Radio( $name, $value, $default, $extra="")
	{
		$this->CheckStatus;
		if ( $value == $default )
			$checked="checked";

		return "\n<input type='radio' name='$name' value='$value' $extra $checked  $this->extra/>";

	}
	function Select( $name, $options, $values, $default="", $extra="" )
	{
		$this->CheckStatus;
		$output= "\n<select name='$name' id='$name' $extra $this->extra>";
		for ( $i=0; $i< sizeof( $values ); $i++ )
		{
			if ( $values[ $i ] ==  $default )
				$output.= "\n<option selected value='$values[$i]'>$options[$i]</option>";
			else
				$output.=  "\n<option value='$values[$i]'>$options[$i]</option>";
		}
		$output.=  "\n</select>";
		return $output;

	}
	function Hidden( $name, $value, $extra="")
	{
		return "\n<input type='hidden' name='$name' id='$name' value='$value' $extra />";

	}
	private function CheckStatus ()
	{
		if ( $this->Mode == "disabled" )
			$this->extra = "disabled";

	}


} // End Form class