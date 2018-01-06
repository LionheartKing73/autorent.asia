<?php



$sql = "select * from pricing_extras pe JOIN pricing_extra_type pet " .
        " ON pet.pricing_extra_type_id = pe.fk_extras_pricing_extra_type_id " .
        " WHERE pet.fk_extras_supplier_id = ".$Row["supplierid"] .
        "   AND pe.fk_extras_pricing_scheme_id = ".$Row["pricing_scheme_id"] . 
        "   AND pet.fk_extras_country_id = ".$Country->Rec["country_id"] .
        "   AND days <= ".$bc->NumDays . 
        "   GROUP BY extras_text ORDER BY display_order ";
        print "<!--".$sql."-->";
    $ResultSet = mysql_query( $sql ) 
    or die ( "Failed in Pricing Scheme Query" .mysql_error());
    
    while ($Row2 = mysql_fetch_array($ResultSet) ) { 
        
        
        
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
     
   print "<tr><td width='55%' class='smltxtblue' bgcolor='#DEDEF9'><font color='#03227C'>";

        $text = str_replace( "PARAM1", $Row3["param1"], $Row3["extras_booking_output"]);
        $text = str_replace( "PARAM2", $Row3["param2"], $text); 
        $text = str_replace( "PARAM3", $Row3["param3"], $text); 
        print $text;
        
        $extra_amount =$price / $bc->CurrencyRate;
        
        if ( ! $extra_amount )
        {
            $extra_amount = "0.0001";
        }

print "</font></td>"; 
print '<td valign="top"  width="25%" bgcolor="#DEDEF9">';
print 'No: <input  onclick="javascript:setBookingCost();" name="xOpt'.$Row2["pricing_extra_type_id"].'-'.$Row3["pricing_extras_id"].'" value="0" checked="checked" type="RADIO">&nbsp;&nbsp;Yes';
print '<input onclick="javascript:setBookingCost();" name="xOpt'.$Row2["pricing_extra_type_id"].'-'.$Row3["pricing_extras_id"].'" value="'.$extra_amount.'" type="RADIO">'; 
print "</td>";
print '<td valign="top" width="20%" align="RIGHT">';

        
        print $bc->CurrencyCode." ";
        print number_format($extra_amount,2);  
    print '</td>';
print '</tr>'; 


    }
    
    ?>

 <tr><td width='55%' class='smltxtblue' bgcolor='#123170' style='color: white'>
<span id='bkTotRow1' style='display: none'><b>YOUR TOTAL PRICE IS JUST:</b></span>
</td><td valign="top"  width="25%" bgcolor="#123170" style='color: white'>
</td><td valign="top" width="20%" align="RIGHT">
<span id='bkTotRow2' style='display: none'>
<?php echo $bc->CurrencyCode?> <span id='totalBookingCost'><?php echo number_format($bc->OnlinePrice,2)?></span>
</span>
</td></tr>   

    <?php
  print "<tr><td colspan='3'>This is the cost of the rental & any extras & supplier charges if you book online now with Diamond Car Rental.</td></tr>";
  
    print "<tr><td colspan='3'><br/><br/>Optional extra prices are the total cost for the duration of your rental and are paid for when you collect your car. </td></tr>";

?>
<script type="text/javascript">
<!--
document.getElementById ( "bkTotRow1" ).style.display = "block";
document.getElementById ( "bkTotRow2" ).style.display = "block";
-->
</script>