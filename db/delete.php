<?php
require "../config.php";
require "../conn";
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
<td style="font-family: Tahoma; font-size: 9pt">
<font color="#FFFFFF"><b>WIGN - <span style="font-size: 10px">Manage Database 
Table : Delete Table</span></b></font></td>
<td style="font-family: Tahoma; font-size: 9pt">
<p align="right"><a href="../home.php"><font color="#000000">Home</font></a> |
<a href="../options.php"><font color="#000000">Options</font></a> 
| <a href="../index.php?logout"><font color="#000000">Logout</font></a></td>
</tr>
</table>
<?php
if (!$_GET) {
?>
<p align="center">Select a table to delete:</p>
<div align="center">
<table border="0" cellpadding="3" cellspacing="0" width="100%" style="font-size: 9pt">
	<form>
	<tr>
		<td width="50%">
		<p align="right">Table Name:</td>
		<td width="50%">
<select size="1" name="table" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0">
<?php
$result=mysql_list_tables($DATABASE);
while ($row = mysql_fetch_row($result)) {print "<option value='".$row[0]."'>$row[0]</option>\n";}
mysql_free_result($result);
//echo $result;
?>
</select></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
<input name="submit" onclick='if (!confirm("Are you sure?")) {return false}' onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Delete" type="submit" />&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location='index.php'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></td>
	</tr>
	</form>
</table>
</div>
<?php
}
else {
$name=ge("table");
mysql_query("drop table `$name`");
echo "<p align='center'>Done!<br>&nbsp;<br><a href='index.php'>OK</a></p>";
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