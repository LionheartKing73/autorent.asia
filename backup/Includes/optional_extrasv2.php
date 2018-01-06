<?php
$prev_extras = 0;
$checked_defaults=0;
// Check if there are any eztras passed through from previous page


/// Add the Extras from the previous page as hidden items
foreach( $_REQUEST As $key=>$value )
{
    if ( substr( $key, 0, 4 ) == "xOpt" && $value )
    {
        
        $tmparray = explode( "-", $key);
        $prev_extras_array[] = $tmparray[1];
        
        print "\n<input type='hidden' name='$key' value='$value'/>";

    }
}


$sql = "select * from pricing_extras pe JOIN pricing_extra_type pet " .
        " ON pet.pricing_extra_type_id = pe.fk_extras_pricing_extra_type_id " .
        " WHERE pet.fk_extras_supplier_id = ".$Row["supplierid"] .
        "   AND pe.fk_extras_pricing_scheme_id = ".$Row["pricing_scheme_id"] . 
        "   AND pet.fk_extras_country_id = ".$Country->Rec["country_id"] .
        "   AND days <= ".$bc->NumDays . 
        "   GROUP BY extras_text ORDER BY display_order ";

    $ResultSet = mysql_query( $sql ) 
    or die ( "Failed in Pricing Scheme Query" .mysql_error());
    
    while ($Row2 = mysql_fetch_array($ResultSet) ) { 
        

        // Get the record with he most days
        $sql = "select * from pricing_extras pe JOIN pricing_extra_type pet " .
        " ON pet.pricing_extra_type_id = pe.fk_extras_pricing_extra_type_id " .
        " WHERE pet.pricing_extra_type_id = ".$Row2["pricing_extra_type_id"] .
        "   AND pe.fk_extras_pricing_scheme_id = ".$Row["pricing_scheme_id"] . 
        "   AND pet.fk_extras_country_id = ".$Country->Rec["country_id"] .
        "   AND days <= ".$bc->NumDays . 
        "   ORDER BY days DESC LIMIT 1 ";
    $ResultSet3 = mysql_query( $sql ) 
    or die ( "Failed in Pricing Scheme Query" .mysql_error());
    
    $Row3 = mysql_fetch_array($ResultSet3);
    
    $price = $bc->NumDays * $Row3["extras_rate"];
        
    if ( $Row3["extras_limit"] > 0 )
    {
        if ( $price > $Row3["extras_limit"])
                $price = $Row3["extras_limit"];
    }
  	$extra_amount =$price / $bc->CurrencyRate;
    
    if ( ! $extra_amount )
    {
        $extra_amount = "0.0001";
    } 
    
    // If this extra is to be shown on the current page, retrieve the data
    IF ( $Row2["checkout_page"] != CHECKOUT_PAGE )
    {
		// Check Extras
		foreach ( $prev_extras_array as $qsdata=>$extraid)
		{
			if ( $extraid == $Row3["pricing_extras_id"])
			{
				// We have  a match
				$prev_extras = $prev_extras + $extra_amount;
				
			}
			
		}
		
	}
	else
	{


		     
		   print "<tr><td width='70%' class='smltxtblue' style='padding-bottom: 12px' bgcolor='#DEDEF9'><font color='#03227C'>";

	        $text = str_replace( "PARAM1", $Row3["param1"], $Row3["extras_booking_output"]);
	        $text = str_replace( "PARAM2", $Row3["param2"], $text); 
	        $text = str_replace( "PARAM3", $Row3["param3"], $text); 
	        print $text;
	        

       
	        if ( $Row3["field_default"] )
	        {

	        	$defyes = "checked= 'checked'";
	        	$defno = "";
	        	$checked_defaults=$checked_defaults+($price/ $bc->CurrencyRate);
	        }
	        else	
	        {
	        	$defno = "checked= 'checked'";
	        	$defyes = "";
				
			}
        	
        	

			print "</font></td>"; 
			print '<td valign="bottom"  width="14%" bgcolor="#DEDEF9"  >';
			print 'No: <input  onclick="javascript:setBookingCost();" name="xOpt'.$Row2["pricing_extra_type_id"].'-'.$Row3["pricing_extras_id"].'" value="0" '.$defno.' type="RADIO">&nbsp;&nbsp;Yes';
			print '<input ';
			if ( $Row3["checkout_page"] == 1)
				print 'onclick="javascript:setBookingCost();" ';
			print 'name="xOpt'.$Row2["pricing_extra_type_id"].'-'.$Row3["pricing_extras_id"].'" value="'.$extra_amount.'" '.$defyes.' type="RADIO">'; 
			print "</td>";
			print '<td valign="bottom" width="16%" align="RIGHT"  >';

        
			        print $bc->CurrencyCode." ";
			        print number_format($extra_amount,2);  
			    print '</td>';
			print '</tr>'; 

		}
    }
    

if ( $prev_extras )
{
	

   print "<tr'><td width='70%' class='smltxtblue' bgcolor='#DEDEF9'><font color='#03227C'><b>You have selected additional insurance items totaling</b>";

      
print "</font></td>"; 
print '<td valign="bottom"  width="14%" bgcolor="#DEDEF9">';

print "</td>";
print '<td valign="top" width="16%" align="RIGHT"><b>';

        
        print $bc->CurrencyCode." ";
        print number_format($prev_extras,2);  
 
    print '</b></td>';
print '</tr>'; 
}
    
    ?>

 <tr><td width='70%' class='smltxtblue' bgcolor='#123170' style='color: white'>
<span id='bkTotRow1' style='display: none'><b>YOUR TOTAL PRICE IS JUST:</b></span>
</td><td valign="top"  width="14%" bgcolor="#123170" style='color: white'>
</td><td valign="top" width="16%" align="RIGHT">
<span id='bkTotRow2' style='display: none'><b>
<?php 
$TotalBookingCost=$bc->OnlinePrice+$checked_defaults+$prev_extras;
echo $bc->CurrencyCode?> <span id='totalBookingCost'><?php echo number_format($TotalBookingCost,2)?></b></span>
</span>
</td></tr>   

    <?php
  //print "<tr><td colspan='3'>This is the cost of the rental & any extras & supplier charges if you book online now with Diamond Car Rental.</td></tr>";
  
    //print "<tr><td colspan='3'><br/><br/>Optional extra prices are the total cost for the duration of your rental and are paid for when you collect your car. </td></tr>";

?>
<script type="text/javascript">
<!--
document.getElementById ( "bkTotRow1" ).style.display = "block";
document.getElementById ( "bkTotRow2" ).style.display = "block";

origBookingCost = <?php echo $TotalBookingCost-$checked_defaults?>;

</script>