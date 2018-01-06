<?php
//Standard Functions
/// 
// Author: Doug Brown
// Date: Sept 21st 2008
function GenLink( $Link, $Text='', $Id='', $Class='', $AjaxDiv='', $Vars='' )
{

    print CalculateLink( $Link, $Text, $Id, $Class, $AjaxDiv, $Vars );

    }

function CalculateLink( $Link, $Text='', $Id='', $Class='', $AjaxDiv='', $Vars='' )  
{
$Link = GetLink( $Link  );

if ( $AjaxDiv )
{
    $href="javascript: void()";
    $oc="onclick=\"DoRefresh( &quot;".$AjaxDiv."&quot;, &quot;".$Link."&quot;, &quot;".$Vars."&aj=ax&quot; )\"";

}
else
{
    $href=$Link;
}
$OutLink =  '<a href=\"'.$href.'\" '.$oc.' class=\"'.$Class.'\">'.$Text.'</a>';

if ( $_REQUEST["aj"]== "ax")
    print '<a href="'.$href.'" '.$oc.' class="'.$Class.'">'.$Text.'</a>'; 
else
{
?>


<script type="text/javascript"><!--

document.write( <?php echo "'".$OutLink."'"?> ) ;
//--></script>
<noscript>
<a href='<?php echo $Link.'&'.$Vars?>'><?php echo $Text?></a>
</noscript>
<?php
//return  $Link;
}
}
function GetLink( $Link  )
{
// First handle the $Link to replace the current language into the link
$Link = LanguageLink( $Link,"" );

// If this is the result of an Ajax postback we dont need to (and cannot)
// use the Javascript document.write as the JS will not be executed.
if ( $_REQUEST[ "group" ] )
    $GroupLink="&group=".$_REQUEST[ "group" ];
if ( $_SESSION[ "groupid" ] )
    $GroupLink="&group=".$_SESSION[ "groupid"];

return $Link."language=".LANG.$GroupLink;

}
function LanguageLink( $InLink, $InLanguage  )
{
// Removes any existing language QS paramater 
$UrlArr=split( "\?", $InLink );
$NewQs="?";

if ( $UrlArr[1] )
{

    $QsArr=split( "\&", $UrlArr[1] );

    for ( $i=0; $i<=sizeof( $QsArr )-1; $i++ )
    {
        $InArr=split( "\=", $QsArr[$i] );
        if ( $InArr[0] != "language" )
            $NewQs.=$QsArr[$i]."&amp;";
    }

}
if ( $InLanguage )
    $NewQs.="language=".$InLanguage;

$OutLink=$UrlArr[0].$NewQs;

return $OutLink;

}

class SelectBox
{
var $SqlHandler="";
var $Name="";
var $Sql="";
var $RefField="";
var $CodeField="";
var $SelectedValue="";


	function MakeSelectBox( $table, $keyfield, $namefield, $value )
	{


		$this->SqlHandler->Sql = "select ".$keyfield.",".$namefield." from ".$table;

		$this->SqlHandler->Execute();

print $this->SqlHandler->Sql;
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




// Class
}