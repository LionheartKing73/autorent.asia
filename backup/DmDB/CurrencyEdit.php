<?php
include './Includes/Top.php';

$ID = $_REQUEST['Currency'];



    // If we are in a postback, we check for the existence of the posted records in the DB
    if ( $_POST[ "update" ] )
    {
        $ccode = "'".mysql_real_escape_string( $_REQUEST["ccode"])."'";
        $cname = "'".mysql_real_escape_string( $_REQUEST["cname"])."'"; 
        $crate = "'".mysql_real_escape_string( $_REQUEST["crate"])."'"; 
        
        if( $ccode && $cname && crate )
        {
            if ( $ID )
                $Sql = "update currencies  SET currency_code = $ccode, currency_name = $cname, from_baht_rate = $crate WHERE currencies_id = $ID"; 
            else
                $Sql = "insert into currencies ( currency_code, currency_name, from_baht_rate ) VALUES ( $ccode, $cname, $crate)";
        }

    }
    elseif ( $_REQUEST["mode"] == "Delete")
    {
         if ( $ID ) 
            $Sql = "delete from currencies  WHERE currencies_id = $ID ";
 
    }
    if ( $Sql )
    {
        $ResultSet = mysql_query( $Sql ) 
            or die ( "Failed in Currencies update" .mysql_error());
     header( "location: CurrencyList.php");
    }

if ( is_numeric( $ID ) )
{

    // Get the Location name
    $Sql = "select * from currencies  WHERE ";
    $Sql .= "currencies_id = ".$ID;
    $ResultSet = mysql_query( $Sql ) 
    or die ( "Failed in Currencies Query" .mysql_error());
    $CRow = mysql_fetch_array($ResultSet) ;


}
else
{
     if ( $_REQUEST["mode"] != "Add" )
        $ErrorMessage="No Currency Selected.";
     else
        $NewCurrencyForm=true;
}


?>
<html>
<head>
<title>Database Administration: Currencies</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include './Includes/Head.php';

?>


</head>

<?php
include './Includes/BodyHead.php';


?>

<h1>Currency Edit</h1>

<p class="SmallText"><a href='CurrencyList.php'>Cick here to return to the list</a>.</p> 
<?php
if ( $ErrorMessage )
print "<h2 style='color: red'>".$ErrorMessage."</h2>";
?>


<table width=40% align=center cellpadding=0 cellpadding=0 border=0>
<form method="POST" Name="login" action="CurrencyEdit.php"  enctype="multipart/form-data">

            <tr class="SmallText">
              <td >Currency Code</td>
              <td >
              <input type='text' name='ccode' value = '<?php echo $CRow["currency_code"];?>' />
              </td>
                </tr>
             <tr class="SmallText">
              <td >Currency Description</td>
              <td >
              <input type='text' name='cname' value = '<?php echo $CRow["currency_name"];?>' />
              </td>
                </tr>        
              <tr class="SmallText">
              <td >Currency Exchange Rate to THB</td>
              <td >
              <input type='text' name='crate' value = '<?php echo $CRow["from_baht_rate"];?>' />
              </td>
                </tr>  

              
<?php
//* The end of the vehicle loop *//

  print "<input type=hidden value='1' name='update'>"; 
   

print "</table>";
?>
<center>

<input type=submit value=Save name=submit>
</center>


<input type=hidden value='<?php echo $ID?>' name='Currency'>

</form>



<?php
include './Includes/BodyFoot.php';
?>
