<?php
require "../config.php";
require "../conn";
if (isset($_GET['logout'])) {unset($_SESSION['wign']);session_destroy();}

//		Show setup for first installation		//
if (!isset($_SESSION['wign'])) {red("index.php");}
else {
?>
<html>
<head>
<script src="../script.php"></script>
</head>
<body style="padding:25px" bgcolor="#FdFdFd">
<div align="center">
<table style="font-family:Tahoma; font-size:10pt;border:1px solid #CCCCCC" cellpadding="4" cellspacing="0" width="600" bgcolor="#F8F8F8" style="font-family: Tahoma; font-size: 10pt">
<tr>
<td>
<table style="border:1px solid #000080;" cellpadding="3" cellspacing="0" width="100%" bgcolor="#666699">
<tr>
<td style="font-family: Tahoma; font-size: 9pt" width="425">
<font color="#FFFFFF"><b>WIGN - <span style="font-size: 10px">Manage Database 
Table : Modify Table</span></b></font></td>
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
?>
</select></td>
</tr>
<tr>
<td width="100%" colspan="2" align="center">
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Proceed" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location='index.php'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></td>
</tr>
</form>
</table>
</div>
<?php
}
else if (isset($_GET['add'])) {
echo "<p></p>";
$cols=ge("add");
echo "<form action='modify.php'>";
echo "<p>Enter a name for each field below:<br><br>";
for ($i=0;$i<$cols;$i++) {
echo '<input class="in" name="f'.$i.'" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" /><br>'."\n";
}
echo '<p><input name="new" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Modify Table" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" onclick="location=\'index.php\'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></p><input type="hidden" name="tname" value="'.$_GET['tname'].'"></form>';
}
else if (isset($_GET['table'])) {
$name=ge("table");
$fields = mysql_list_fields("$DATABASE", "$name");
$columns = mysql_num_fields($fields);
echo  "<p><a href='' onclick='addd()' id='adlink'>Insert new column(s)</a></p>";
echo "<p align='center'>Table Columns<br>&nbsp;<table width='70%' style='font-family: Verdana; font-size: 8pt'>";
for ($i = 0; $i < $columns; $i++) {echo "<tr><td width='50%' align='right'>".mysql_field_name($fields, $i) . "</td><td width='50%'><a onclick='if (!confirm(\"Are you sure?\")) {return false}' href='?drop=$name&delete=".mysql_field_name($fields, $i)."'>Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick='if (confirm(\"Are You Sure?\")) {location=\"?new=\"+prompt(\"New Name\",\"".mysql_field_name($fields, $i)."\")+\"&tab=$name&rename=".mysql_field_name($fields, $i)."\"}' href='#'>Rename</a></td></tr>";}
echo "</table>";
echo '<p>&nbsp;</p><form name="f"><input type="hidden" name="table" value="'.$_GET['table'].'"><p align="center"><input name="reset" onclick="location=\'modify.php\'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></p></form>';
}
else if (isset($_GET['drop'])) {
$id=ge("delete");
$drop=ge("drop");
if (mysql_query("alter table `$drop` drop `$delete`")) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='modify.php'>OK</a></p>";}
else if (mysql_error()=="You can't delete all columns with ALTER TABLE; use DROP TABLE instead") {
echo "<p>ERROR!<br>&nbsp;<br>You can't delete all the columns in a table; please delete the table instead!";
echo "<br>&nbsp;<br><a href='modify.php'>OK</a></p>";

}
}
else if (isset($_GET['rename'])) {
$id=ge("rename");
$table=ge("tab");
$new=ge("new");
if (mysql_query("alter table `$table` change `$id` `$new` text")) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='modify.php'>OK</a></p>";}

}
else if (isset($_GET['new'])) {
$submit=$_GET;
$total=count($submit)-2;
$name=$_GET['tname'];
$cols="";
for ($i=0;$i<$total;$i++) {$cols.="add `".$submit["f".($i)]."` text, ";}
$cols=substr($cols,0,-2);
$cols="alter table `$name` ".$cols;
if (mysql_query($cols)) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='modify.php'>OK</a></p>";} else {echo "<p>ERROR!<br>".my()."</p><p><a href='javascript:history.go(-1)'>back</a></p>";}
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