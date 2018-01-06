<?php
/*
Class....... BaseScreenFlowHandler
Coded By.... Douglas Brown
Date........ Dec 2008

The page provides a template for override in child classes for the ScreenFlow functionality. 
A series of methods is added to the child class. Each method is invoked by passing in an action
parameter with the same name as the method. Parameters are passed in special Forms (newProcessForm)
or hyperlinks (NewProcessLink).
Two separate methods can be called, one triggered by loadaction which does not output HTML
and the other one is triggered by action which does trigger HTML


Properties
HandlerId           :   A unique identifier for the ScreenFlow, allowing multiple Flows on one page
Div                 :   The DIV into which the ScreenFlow will be directed by Ajax
FirstTime           :   Identifies when the ScreenFlow is being called for the first time in a ScreenFlow
Do                  :   True if this particular ScreenFlow is to be executed
LoadAction          :   The request loadaction to be executed (from the previous page)
Action              :   The request ction to be executed (from the previous page)


Methods
Constructor         :   Parses the incoming Form/Link data and works out what to do
PreOutput           :   Processing for the loadaction
Output              :   Processing for the action
Init                :   The start of the screen flow. All other methods for the ScreenFlow are added 
                        to the child class
NewProcessForm      :   Creates a Form with all of the HandlerId and Ajax variables set
NewProcessLink      :   Creates a Link with all of the HandlerId and Ajax variables set
                        


*/
$InProcess=false;
class BaseScreenFlowHandler{
    public $HandlerId="";
    public $Div="";

	function __construct( $HandlerId )
	{
		$this->HandlerId = $HandlerId;
		$this->Div = "Handle".$HandlerId;
		if ( $_REQUEST[ "HandlerId" ]  )
		{
			global $InProcess;
			$InProcess = true;
			if (  $HandlerId == $_REQUEST[ "HandlerId" ] )
				$this->Do=true;
		}
		else
			$this->FirstTime=true;
		$this->LoadAction= $_REQUEST[ "loadaction" ];
		$this->Action= $_REQUEST[ "action" ];
		if ( ! $this->Action )
			$this->Action="Init";
		$this->PreOutput();

		
	}
	function __destruct()
	{	

	}	


	function PreOutput()
	{

		if ( $this->LoadAction && $this->Do )
		{

			$function = $this->LoadAction;
			$this->$function();


		}

	}
	function Output()
	{
		if (  $this->FirstTime )
			print "<div class='handler' id='Handle".$this->HandlerId."'>";
		if ( $this->Do || $this->FirstTime )
		{
			$function = $this->Action;
            $this->PageHeader();
			$this->$function();
            $this->PageFooter();

		}	
		if (  $this->FirstTime )
			print "</div>";
	}
	function Init()
	{

	}
    function PageHeader()
    {

    }
    function PageFooter()
    {

    }
	function NewProcessForm( $Formid )
	{
		$Form=new Form( $Formid );
		$Form->AjaxDiv=$this->Div;
		$Form->Start();
		print $Form->Hidden( "HandlerId", $this->HandlerId );
		print $Form->Hidden( "aj", "ax" );
		return $Form;
	}
	function NewProcessLink( $text, $action, $id="", $class="" )
	{
GenLink( $_SERVER["PHP_SELF"] , $text,$id,$class,$this->Div, "action=".$action."&HandlerId=".$this->HandlerId);


	}


}



?>