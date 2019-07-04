<?php
require "conn";
require "config.php";
if (isset($_GET['logout'])) {unset($_SESSION['wign']);session_destroy();}

//		Show setup for first installation		//
if ($USERNAME=="USERNAME" && $PASSWORD=="PASSWORD") {red("setup.php");}
else {
?>
<html>
<body style="padding:25px" bgcolor="#FdFdFd">
<div align="center">
<table style="font-family:Tahoma; font-size:10pt;border:1px solid #CCCCCC" cellpadding="4" cellspacing="0" width="600" bgcolor="#F8F8F8" style="font-family: Tahoma; font-size: 10pt">
<tr>
<td>
<table style="border:1px solid #000080;" cellpadding="3" cellspacing="0" width="100%" bgcolor="#666699">
<tr>
<td style="font-family: Tahoma; font-size: 9pt">
<font color="#FFFFFF"><b>WIGN - <span style="font-size: 10px">Administrator's 
Access </span></b></font></td>
</tr>
</table>
<?php
if (!$_POST) {
?>
<form method="POST" name="form" action="index.php">
<div align="center">
<table border="0" cellpadding="2" bordercolor="#D3D3D3" cellspacing="2" style="border-collapse:collapse; font-size:9pt" width="50%">
<tr>
<td width="30%">
<p align="right"><b>Username: </b></p></td>
<td width="70%">
<input class="in" name="user" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" />
</td>
</tr>
<tr>
<td width="30%">
<p align="right"><b>Password: </b></p></td>
<td width="70%">
<input class="in" name="pass" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" type="password" /></td>
</tr>
<tr>
<td width="30%">&nbsp;</td>
<td width="70%">
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Login" type="submit" />
</td>
</tr>
</table>
</div>
</form>
<?php
}
else {
if (po("user")==$USER && po("pass")==$PASS) {$_SESSION['wign']="";echo "<script>location.replace('home.php')</script>";}
else {
echo "<p>&nbsp;</p><p align='center'><b>ERROR:</b> Invalid Login!</p>";
?>
<form method="POST" action="index.php">
<div align="center">
<table border="0" cellpadding="2" bordercolor="#D3D3D3" cellspacing="2" style="border-collapse:collapse; font-size:9pt" width="50%">
<tr>
<td width="30%">
<p align="right"><b>Username: </b></p></td>
<td width="70%">
<input class="in" name="user" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" />
</td>
</tr>
<tr>
<td width="30%">
<p align="right"><b>Password: </b></p></td>
<td width="70%">
<input class="in" name="pass" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" type="password" /></td>
</tr>
<tr>
<td width="30%">&nbsp;</td>
<td width="70%">
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Login" type="submit" />
</td>
</tr>
</table>
</div>
</form>
<?php
}
}
?>
</td>
</tr>
<tr><td>&nbsp;<p>&nbsp;</p><p>&nbsp;</td></tr>
<tr>
<td>
<p align="center">Powered by BackandFront</td>
</tr>
</table>
</div>
</body>
</html>
<?php
}
?>