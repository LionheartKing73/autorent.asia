<?php
/// The list of classes can be extended here

$ClassArray[ "ECON" ] = "Small"; 
$ClassArray[ "MBUS" ] = "Medium"; 
$ClassArray[ "EXE4" ] = "Standard"; 
$ClassArray[ "COMP" ] = "Large";  
$ClassArray[ "SUV" ] = "SUV 7 seat";               
$ClassArray[ "MPV" ] = "Minibus 12 seat";  
$ClassArray[ "PCKP" ] = "Pickup 4dr";  
$ClassArray[ "MINI" ] = "Mini";  
$ClassArray[ "SUV5" ] = "SUV 5 seat"; 
$ClassArray[ "MPV6" ] = "MPV 6 seat"; 
$ClassArray[ "MPV7" ] = "MPV 7 seat"; 
$ClassArray[ "MPV8" ] = "MPV 8 seat"; 
$ClassArray[ "MPVX" ] = "MPV 10 seat"; 
$ClassArray[ "MIXV" ] = "Minibus 15 seat"; 
$ClassArray[ "PCK2" ] = "Pickup 2dr"; 
   
$ClassSrtArray[ ] = "MINI";
$ClassSrtArray[ ] = "ECON";  
$ClassSrtArray[ ] = "MBUS";  
$ClassSrtArray[ ] = "EXE4";                       
$ClassSrtArray[ ] = "COMP"; 
$ClassSrtArray[ ] = "SUV5"; 
$ClassSrtArray[ ] = "SUV";
$ClassSrtArray[ ] = "MPV6";
$ClassSrtArray[ ] = "MPV7";
$ClassSrtArray[ ] = "MPV8";
$ClassSrtArray[ ] = "MPVX";
$ClassSrtArray[ ] = "MPV"; 
$ClassSrtArray[ ] = "MIXV"; 
$ClassSrtArray[ ] = "PCK2"; 
$ClassSrtArray[ ] = "PCKP"; 
$ClassSrtArray[ ] = "AUTO"; 
 

 /*
$ClassSrtArray[ ] = "SPCV"; 
$ClassSrtArray[ ] = "LXRY"; 

*/



$ClassArray[ "SPCV" ] = "Sports &amp; Convertible ";   
$ClassArray[ "LXRY" ] = "Luxury &amp; Specialist";      
                          

function GetClass( $Class ) 
{
global $ClassArray;

return $ClassArray[ $Class ];

}
function GetClassRadioButtons( $Class ) 
{
global $ClassArray;

print "<select name='class'>";
print "<option value=''>All Types</option>"; 
	foreach ($ClassArray as $key => $value)
	{
		if ( $Class == $key )
			print "<option selected value='".$key."'>".$value."</option>";
		else
			print "<option  value='".$key."'>".$value."</option>"; 

	}
    print "</select>";
return $ClassRadioButtonText;

}

?>