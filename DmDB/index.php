<html>
<head>
<title>Diamond Car Rental Hua Hin Database Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
<!--
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #032678;
}
-->
</style>
</head>
<body bgcolor="#EFEFEF">
<h2 align="center" class="style4">Diamond Rent A Car Hua Hin Database Administration</h2>
<table width="600" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#032678">
  <tr>
    <td width="145"><div align="center"><img src="../img/dcrlogo.jpg" width="171" height="125"></div></td>
    <td width="437"><table id="TR1" width=100% align=left border=0 cellpadding="0" cellspacing="0" >
      <?php
If ( $LoginError == "U" ) 
	Print "<tr><td colspan=2 class='WeePostError'>No such User</td></tr>";
ElseIf ( $LoginError == "P" )
	Print "<tr><td colspan=2 class='WeePostError'>Wrong Password</td></tr>";
?>
      <form method="POST" Name="login" action="Login.php">
        <tr>
          <td align=right width=173  class='style4'><div align="right">
            <h3 class="style4">User name:</h3>
          </div></td>
          <td width="206" align=left   class='LeftSubHeading2'> 
              <div align="left">
                <input   class='LoginBoxWee' type=text name="USERNAME" size=20 maxlength=15 value="<?php echo $USERNAME ;?>">
              </div></td>
        </tr>
        <tr>
          <td align=left width=173  class='style4'><div align="right">
            <h3 class="style4">Password:</h3>
          </div></td>
          <td align=left  class='LeftSubHeading2'>
              <div align="left">
                <input   class='LoginBoxWee' type=password name="PASSWORD" size=20  maxlength=10>
              </div>
          </tr>
        <tr>
          <td align=left width=173  class='LeftSubHeading1'></td>
          <td align=left  class='LeftSubHeading1'>        </tr>
        <tr>
        <tr>
          <td colspan=2 align="center">
              <div align="center">
                <input name=sb1 type=submit value="Login"   class='LoginButton'>
            </div></td>
          <input type="hidden" value="CHECK" name="LOGINSTATUS">
          <input type="hidden" value="0" name="Comp">
        </form>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>



































































