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
<p align="left">
<?php
if (isset($_POST['submit'])) {

$submit=$_POST;
$total=count($submit)-3;
$name=po('id');
$tab=po("tab");
$cols="update $tab set ";
$a=mysql_query("select * from $tab where id='$id'");
$b=ro($a);

$fields = mysql_list_fields("$DATABASE", "$tab");
$columns = mysql_num_fields($fields);

for ($i=0;$i<$columns-1;$i++) {
$col=mysql_field_name($fields, $i);
$td=re($a,0,$col);
$cols.="$col='".$submit["f".($i)]."', ";
}
$cols=substr($cols,0,-2);
$cols.=" where id='$name'";
echo $cols;
if (mysql_query($cols)) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='admin.php'>OK</a></p>";} else {echo "<p>ERROR!<br>".my()."</p><p><a href='javascript:history.go(-1)'>back</a></p>";}


}
else if (!$_GET) {
?><a href="new.php"><font color="#000000">Create New Record</font></a></p>
<p align="center">
Select table to access:</p>
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
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Proceed" type="submit" />&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location='admin.php'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" /></td>
</tr>
</form>
</table>
</div>
<p>&nbsp;<?php
}
else if (isset($_GET['table'])) {
$name=ge("table");
$result=mysql_list_tables($DATABASE);
?>
</p>
<p align="left"><a href="new.php"><font color="#000000">Create New Record</font></a>&nbsp;&nbsp; 
- <a href="admin.php"><font color="#000000">Cancel</font></a></p>
<table style="font-family:Tahoma; font-size:10pt"><tr>
<?php
$fields = mysql_list_fields("$DATABASE", "$name");
$columns = mysql_num_fields($fields);
$col=mysql_field_name($fields, ($columns-1));
echo "<td>";
echo '<table style="font-family:Tahoma; font-size:10pt"><tr><td>&nbsp;</td></tr>';
$a=mysql_query("select $col from $name");
$b=ro($a);
for ($c=0;$c<$b;$c++) {$td=re($a,$c,$col);echo "<tr><td><a onclick=\"if (!confirm('Are You Sure?')) {return false}\" href='?delete=$td&tab=$name'>Delete</a></td><td><a href='?edit=$td&tab=$name'>Edit</a></td></tr>";}
echo "</table>";
?>
</td>
</td>
<?php
$fields = mysql_list_fields("$DATABASE", "$name");
$columns = mysql_num_fields($fields);
for ($i = 0; $i < $columns-1; $i++) {
$col=mysql_field_name($fields, $i);
echo "<td>";
echo '<table style="font-family:Tahoma; font-size:10pt">';
$a=mysql_query("select $col from $name");
$b=ro($a);
echo "<tr><td><b>$col</b></td></tr>";
for ($c=0;$c<$b;$c++) {$td=re($a,$c,$col);echo "<tr><td>$td</td></tr>";}
echo "</table>";
}
}
else if (isset($_GET['delete'])) {
$id=ge("delete");
$tab=ge("tab");
if (mysql_query("delete from $tab where id='$id'")) {echo "<p align='center'>Done!<br>&nbsp;<br><a href='admin.php'>OK</a></p>";}
}
else if (isset($_GET['edit'])) {
$id=ge("edit");
$tab=ge("tab");
$a=mysql_query("select * from $tab where id='$id'");
$b=ro($a);
echo "<p>Editing Table: <b>$tab</b></p>";
$fields = mysql_list_fields("$DATABASE", "$tab");
$columns = mysql_num_fields($fields);
echo "<form method='post' action='admin.php'><table style='font-family:Tahoma; font-size:10pt'>";
for ($i=0;$i<$columns-1;$i++) {
$col=mysql_field_name($fields, $i);
$td=re($a,0,$col);
echo "<tr><td align='right'><b>$col:</b></td><td><input style='font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0' name='f$i' value='$td' /><td></tr>";

}
echo '<tr><td colspan="2" align="center">
<input type="hidden" name="tab" value="'.$tab.'" />
<input type="hidden" name="id" value="'.$id.'" />
<input name="submit" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Save" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" onclick="location=\'home.php\'" onmouseover="this.focus()" style="cursor:hand;font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0" value="Cancel" type="reset" />
</td></tr>
</form>';
}
?>
</tr>
</table>
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