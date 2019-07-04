<?php
require "conn";
require "config.php";
if (isset($_GET['logout'])) {unset($_SESSION['wign']);session_destroy();}

//		Show setup for first installation		//
if (!isset($_SESSION['wign'])) {red("index.php");}
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
<td style="font-family: Tahoma; font-size: 9pt" width="425">
<font color="#FFFFFF"><b>WIGN - <span style="font-size: 10px">Change Password</span></b></font></td>
<td style="font-family: Tahoma; font-size: 9pt">
<p align="right"><a href="home.php"><font color="#000000">Home</font></a> |
<a href="options.php"><font color="#000000">Options</font></a> 
| <a href="index.php?logout"><font color="#000000">Logout</font></a></td>
</tr>
</table>
<?php
if (!$_POST) {
?>
<p align="center">Change your WIGN access password</p>
<form method="post">
<div align="center">
<table border="0" cellpadding="3" cellspacing="0" width="100%" style="font-size: 9pt">
	<tr>
		<td width="50%">
		<p align="right">Old Password:</td>
		<td width="50%">
<input class="in" name="old" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" type="password" /></td>
	</tr>
	<tr>
		<td width="50%">
		<p align="right">New Password:</td>
		<td width="50%">
<input class="in" name="new" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" type="password" /></td>
	</tr>
	<tr>
		<td width="50%">
		<p align="right">Confirm Password:</td>
		<td width="50%">
<input class="in" name="con" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" type="password" /></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Proceed" type="submit" />&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location='home.php'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></td>
	</tr>
	</form>
</table>
</div>
<?php
}
else {
$old=po("old");
$new=po("new");
$con=po("con");

if ($new!=$con) {echo"<p align='center'><b>ERROR:</b> Your PASSWORDS do not match!</p><p align='center'><a href='javascript:history.go(-1)'>Back</a></p>";}
else {


$a=fopen("config.php","r");
$b=fread($a,filesize("config.php"));
if (strpos($b,$old)) {
$b=str_replace("'$old'","'$new'",$b);
$a=fopen("config.php","w");
fwrite($a,$b);

//echo "$b";

echo "<p>&nbsp;</p><p align='center'><a href='home.php'>OK</a></p>";
}
else {echo "<p><b>ERROR:</b> INVALID Login!</p><p align='center'><a href='options.php'>Back</a></p>";}

}

}
?>
</tr>
<tr><td>&nbsp;<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p></td></tr>
<tr>
<td>
<p align="center">Powered by BackandFront</td>
</tr>
</table>
</table>
</td>
</tr>
</div>
</body>
</html>
<?php
}
?>