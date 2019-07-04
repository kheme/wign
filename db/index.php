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
<td style="font-family: Tahoma; font-size: 9pt" width="425">
<font color="#FFFFFF"><b>WIGN - <span style="font-size: 10px">Manage Database 
Table</span></b></font></td>
<td style="font-family: Tahoma; font-size: 9pt">
<p align="right"><a href="../home.php"><font color="#000000">Home</font></a> |
<a href="../options.php"><font color="#000000">Options</font></a> 
| <a href="../index.php?logout"><font color="#000000">Logout</font></a></td>
</tr>
</table>
<?php
if (!$_GET) {
?>
<p align="center">Select an option below:</p>
<p align="center"><b><a href="create.php"><font color="#000000">Create Table</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="modify.php"><font color="#000000">Modify Table</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="delete.php"><font color="#000000">Delete Table</font></a></b></p>
<?php
}
else if (isset($_GET['db'])) {

}
else if (isset($_GET['admin'])) {

}

?>
</td>
</tr>
<tr><td>&nbsp;<p align="center">&nbsp;</p>
	<p align="center">&nbsp;</p></td></tr>
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