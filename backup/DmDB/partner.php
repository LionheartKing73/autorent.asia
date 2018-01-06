<?php
set_include_path( "../" );

include '../classes/AdminPage.class.php';

function STEN ( $name, $d, $m  )
{
      print "Day:";
      print "<select name='low_season_".$name."_day'>";
      for ( $i=0; $i<= 31; $i++ )
      {
            if ( $d == $i )
                $sel = "selected";
            else
                $sel = "";
            print "<option $sel value='$i'>$i</option>";
      }
      print '</select>'; 
      
      print "Month:";
      print "<select name='low_season_".$name."_month'>";
      for ( $i=1; $i<= 12; $i++ )
      {
            if ( $m == $i )
                $sel = "selected";
            else
                $sel = "";
            print "<option $sel value='$i'>".xmonth($i)."</option>";
      }
      print '</select>'; 
}
function xmonth( $i )
{
    if ( $i>0 && $i < 13 )
    {
       $x = mktime( 0,0,0,$i,1,2009);
       return date ("F", $x);
    }
    return " ";
}
class PartnerAdmin extends AdminPage{


function ShowForm( $mode, $Record )
{
print "<TABLE width='95%' align='center' cellpadding='3' border='0' cellspacing='0'>";

// Name
print "\n<tr><td align='left'>Partner Name: </td><td align='left'>";
if ( $mode == "Edit" )
{
	print "<input type='text' name='partner_name' value='".$Record["partner_name"]."'>" ;

}
else 
{
	print $Record["partner_name"];

}
print "</td></tr>";

// Contact
print "\n<tr><td align='left'>Contact: </td><td align='left'>";
if ( $mode == "Edit" )
{
    print "<input type='text' name='partner_contact' value='".$Record["partner_contact"]."'>" ;

}
else 
{
    print $Record["partner_contact"];

}
print "</td></tr>";


// Contact
print "\n<tr><td align='left'>Email: </td><td align='left'>";
if ( $mode == "Edit" )
{
    print "<input type='text' name='partner_email' value='".$Record["partner_email"]."'>" ;

}
else 
{
    print $Record["partner_email"];

}
print "</td></tr>";


// Contact
print "\n<tr><td align='left'>Phone: </td><td align='left'>";
if ( $mode == "Edit" )
{
    print "<input type='text' name='partner_phone' value='".$Record["partner_phone"]."'>" ;

}
else 
{
    print $Record["phone"];

}
print "</td></tr>";

print "</TABLE>";

if ( $mode != "Edit" )
{
print "<p>Embed the following hyperlink in Partner pages to link to DCR and get Partner credit for bookings."  ;
print "<p>";

print "&lt;a href='http://www.diamondcarrental.co.uk/index.php?partner=".$Record["partner_id"]."'&gt;CAR RENTALS at diamondcarrental.co.uk&lt;/a&gt;";

}

}

}


//Class
 
$ThisPage =  New PartnerAdmin( $Secure = True );

$ThisPage->Table = "partner";
$ThisPage->KeyField = "partner_id";
$ThisPage->ListFields = "partner_id, partner_name,partner_contact,partner_email,partner_phone";
$ThisPage->ListTitles = "Key, Name,Contact,Email,Phone";
$ThisPage->ListSortFields = "partner_name";
$ThisPage->ViewFields = "partner_name,partner_id,partner_contact,partner_email,partner_phone";
$ThisPage->EditFields = "partner_name,partner_contact,partner_email,partner_phone";
$ThisPage->TableTitle="Partner";

$ThisPage->Title = "Diamond Car Rental: Partners";

$ThisPage->SendSectionA();

$ThisPage->DoProcess( $_REQUEST[ "country" ] );


print "<p><a href='partner.php'>Partner List</a>";

/* 
TESTING
$Sql = "select * from partner_visit ";
$ResultSet = mysql_query( $Sql ) 
or die ( "There has been an unforeseen error in the bookings section ".$Sql.mysql_error());

while ( $Rec = mysql_fetch_row($ResultSet ))
{
    
    var_dump( $Rec );
    print "<hr/>";
}

*/
$ThisPage->SendSectionB();

?>

