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
Table : Create Table</span></b></font></td>
<td style="font-family: Tahoma; font-size: 9pt">
<p align="right"><a href="../home.php"><font color="#000000">Home</font></a> |
<a href="../options.php"><font color="#000000">Options</font></a> 
| <a href="../index.php?logout"><font color="#000000">Logout</font></a></td>
</tr>
</table>
<?php
if (!$_GET && !$_POST) {
?>
<p align="center">Enter the details of your table:</p>
<div align="center">
<table border="0" cellpadding="3" cellspacing="0" width="100%" style="font-size: 9pt">
<form>
<tr>
<td width="50%" align="right">Table Name:</td>
<td width="50%">
<input class="in" name="name" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" /></td>
</tr>
<tr>
<td width="50%" align="right">Number of Fields:</td>
<td width="50%">
<input class="in" name="cols" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" value="1" /></td>
</tr>
<tr>
<td width="100%" colspan="2" align="center">
<input name="submit" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Proceed" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location='index.php'" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></td>
</tr>
</form>
</table>
</div>
<?php
}
else if ($_GET && !$_POST) {
$cols=ge("cols");
$name=ge("name");
if (($cols+1)==1) {echo"<p>ERROR!</p><p>Please go back and please specify how many columns you want in your table!</p><br><a href='javascript:history.go(-1);'>OK</a>";}
else {
echo "<form method='post' action='create.php'>";
echo '<p>Table Name: <input class="in" name="name" value="'.$name.'" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" /></p>';
echo "<p>Enter a name for each field below:<br><br>";
for ($i=0;$i<$cols;$i++) {
echo '<input class="in" name="f'.$i.'" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" /><br>'."\n";
}
echo '<p><input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Generate Table" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" onclick="location=\'index.php\'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></p></form>';
}
}
else if ($_POST) {
$submit=$_POST;
$total=count($submit)-2;
$name=$_POST['name'];
$cols="";
$IDd=date("U");
for ($i=0;$i<$total;$i++) {$cols.="`".$submit["f".($i)]."` text,";}
$cols=substr($cols,0,-1);
$cols.=",`id` text";
$cols="create table `$name`(".$cols.")";
if (mysql_query($cols)) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='index.php'>OK</a></p>";} else {echo "<p>ERROR!<br>".my()."</p><p><a href='javascript:history.go(-1)'>back</a></p>";}
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