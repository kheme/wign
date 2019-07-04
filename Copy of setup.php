<?php
require"conn";
if (isset($_GET['finish'])) {unlink("setup.php");red("index.php");}
?>
<html>
<body style="padding:25px" bgcolor="#FdFdFd">
<div align="center">
<table style="border:1px solid #CCCCCC" cellpadding="4" cellspacing="0" width="600" bgcolor="#F8F8F8" style="font-family: Tahoma; font-size: 10pt">
<tr>
<td>
<table style="border:1px solid #000080" cellpadding="3" cellspacing="0" width="100%" bgcolor="#666699">
<tr>
<td style="font-family: Tahoma; font-size: 9pt">
<font color="#FFFFFF"><b>WIGN - <font style="font-size:10px">MySQL Database Server Setup</font></b></font></td>
</tr>
</table>
<?php
if (!$_POST) {
?>
<p align="center">Enter the information provided by your hosting 
company below to setup your MySQL Database Server.<br>
&nbsp;<div align="center">
<table border="0" cellpadding="0" width="50%" cellspacing="3" style="font-family: Tahoma; font-size: 8pt">
<form method="POST">
<tr>
<td>Database Host/IP:</td>
<td>
<input type="text" name="host" size="20" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0"></td>
</tr>
<tr><td>Database Name:</td><td>
<input type="text" name="database" size="20" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0"></td>
</tr>
<tr><td>Database Username:</td><td>
<input type="text" name="db_user" size="20" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0"></td>
</tr>
<tr><td>Database Password:</td><td>
<input type="password" name="db_pass" size="20" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0"></td>
</tr>
<tr>
<td colspan="2" align="center"><hr size="1">
Click the button below to establish a connection with your MySQL Database Server<p>
<input type="submit" value="Submit" name="submit" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0"></td>
</tr>
</form>
</table>
</div>
<?php
}
else {
$redy=0;
$host=po("host");
$db=po("database");
$user=po("db_user");
$pass=po("db_pass");
echo "<p>Connection to MySQL Database Server on $host: ";
if (@mysql_connect("$host","$user","$pass")) {echo "Complete!";$redy++;} else {echo "Failed!<br />Reason: ".my()."</p>\n";}

echo "<p>Selecting Database <b>[$db]</b> on $host: ";
if (@mysql_select_db("$db")) {echo "Complete!";$redy++;} else {echo "Failed!<br />Reason: ".my()."</p>";}

if ($redy==2) {
echo "<p>Your MySQL Database Server setup was successful! Click below to save these settings and finish this setup!</p>";
echo "<p>&nbsp;</p><p align='center'><a href='?finish'>Finish Setup</a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";

$a=fopen("config.php","r");
$b=fread($a,filesize("config.php"));
$b=str_replace("'LOCALHOST'","'$host'",$b);
$b=str_replace("'DATABASE'","'$db'",$b);
$b=str_replace("'USERNAME'","'$user'",$b);
$b=str_replace("'PASSWORD'","'$pass'",$b);
$a=fopen("config.php","w");
fwrite($a,$b);
}


}
?>
</td>
</tr>
<tr>
<td>
&nbsp;</td>
</tr>
<tr>
<td>
<p align="center">Powered by BackandFront</td>
</tr>
</table>
</div>
</body>
</html>