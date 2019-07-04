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
<font color="#FFFFFF"><b>WIGN - <span style="font-size: 10px">Database Interface</span></b></font></td>
<td style="font-family: Tahoma; font-size: 9pt">
<p align="right"><a href="home.php"><font color="#000000">Home</font></a> |
<a href="options.php"><font color="#000000">Options</font></a> 
| <a href="index.php?logout"><font color="#000000">Logout</font></a></td>
</tr>
</table>
<p align="center">
<?php
if (!isset($_POST['submit']) && !$_GET) {
?>
Select a table add entry:<div align="center">
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
?>
</select></td>
</tr>
<tr>
<td width="100%" colspan="2" align="center">
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Proceed" type="submit" />&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location='home.php'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></td>
</tr>
</form>
</table>
<?php
}
else if (isset($_GET['table'])) {
echo "<p align='center'>Enter Table Content</p>";
$table=ge("table");
$a=mysql_query("select * from $table");
$b=ro($a);
$fields = mysql_list_fields("$DATABASE", "$table");
$columns = mysql_num_fields($fields);
echo "<form method='post' action='new.php'><table align='center' style='font-family:Tahoma; font-size:10pt'>";
for ($i=0;$i<$columns-1;$i++) {
$col=mysql_field_name($fields, $i);
echo "<tr><td align='right'><b>$col:</b></td><td><input style='font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0' name='f$i' value='' /><td></tr>";
}
echo '<tr><td colspan="2" align="center">
<input type="hidden" name="id" value="'.date("U").'">
<input type="hidden" name="table" value="'.$table.'">
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Insert" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location=\'new.php\'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" />
</td></tr>
</form>
</table>';
}
else if ($_POST) {

$submit=$_POST;
$total=count($submit)-3;
$table=$_POST['table'];
$cols="";
$IDd=date("U");
for ($i=0;$i<$total;$i++) {$cols.="'".$submit["f".($i)]."',";}
$cols=substr($cols,0,-1);
$cols.=",'$IDd'";
$cols="insert into $table values(".$cols.")";
if (mysql_query($cols)) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='new.php'>OK</a></p>";} else {echo "<p>ERROR!<br>".my()."</p><p><a href='javascript:history.go(-1)'>back</a></p>";}
}
?>
<p>&nbsp;</p>
<p>&nbsp;<p>&nbsp;</div>
<tr>
<td>
<p align="center">Powered by BackandFront</td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p></td></tr>
</div>
</body>
</html>
<?php
}
?>