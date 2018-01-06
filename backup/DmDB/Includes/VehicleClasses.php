<?php
	if ( $Class=="X" )
	{
		$ClassType = "Extra Large";
		$scheckx = "checked";
	}
	elseif ( $Class=="L" )
	{
		$ClassType = "Large";
		$scheckl = "checked";
	}
	elseif ( $Class=="M" )
	{
		$ClassType = "Medium";
		$scheckm = "checked";
	}
	elseif ( $Class=="S" )
	{
		$schecks = "checked";
		$ClassType = "Small";
	}
	elseif ( $Class == "P" )
	{
		$ClassType = "Prestige"; 
		$scheckp = "checked";
	}
	elseif ( $Class == "U" )
	{
		$ClassType = "Pickups"; 
		$schecku = "checked";
	}
	elseif ( $Class == "B" )
	{
		$ClassType = "Minibuses"; 
		$scheckm = "checked";
	}
?>