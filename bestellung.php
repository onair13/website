<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

include "function.php";

session_start();
if (!(isset($_SESSION['login'])))
{
    echo "<script language=javascript>"; 
	echo "window.open('index.php', '_parent', '')"; 
	echo "</script> "; 
    exit;
}

$username = $_SESSION['username'];

?>

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;">

<form method="POST">

<h1>Bestellung</h1><br>

Versand nur innerhalb Deutschlands!

<h2>Lieferadresse</h2>

<table cellpadding="1" cellspacing="1">
<tr><td width="120px"><b>Strasse:</b></td><td><input class="inputtext01" type="text" size="30" name="strasse"/></td></tr>
<tr><td width="120px"><b>Hausnummer:</b></td><td><input class="inputtext01" type="text" size="30" name="hausnummer"/></td></tr>
<tr><td width="120px"><b>PLZ:</b></td><td><input class="inputtext01" type="text" size="30" name="plz"/></td></tr>
<tr><td width="120px"><b>Ort:</b></td><td><input class="inputtext01" type="text" size="30" name="ort"/></td></tr>
<tr><td height="20px"></td><td></td></tr>
<tr><td></td><td><input class="button06" type="submit" value="Absenden" name="absenden"/></td></tr>
</table>

</form>

</body>

</html>

<?php

if (isset($_POST['absenden']))
{
	if (Datenbank())
	{
	 	if (!($_POST['strasse'] == ""))
	 	{
			if (!($_POST['hausnummer'] == "" ))
			{
				if ($_POST['plz'] > 9999 && $_POST['plz'] < 100000)
				{
					if (!($_POST['ort'] == ""))
					{
						mysql_query("DELETE FROM warenkorb WHERE username = '$username'");
						header ("location:weiterleiten2.php");
					}
					else echo "Keinen Ort eingetragen!";
				}
				else echo "Keine g&uumlltige Postleitzahl eingetagen!";
			}
			else echo "Keine Hausnummer eingetragen!";
		}
		else echo "Keine Strasse eingetragen!";
	}
}

?>