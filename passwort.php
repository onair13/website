<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

session_start();

include "function.php";

$tabelle='account';

?>

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;" onload="document.passwort.passwort0.focus();">

<form method="POST" name="passwort">

<h1>Account</h1><br>

<table cellpadding="1" cellspacing="1">
<tr><td><b>Regeln:</b></td></tr>
<tr><td>Passwort mind. 6 Zeichen</td></tr>
</table>

<br>

<table cellpadding="1" cellspacing="1">
<tr><td width="120px"><b>altes Passwort</b></td><td><input class="inputtext01" type="password" size="30" name="passwort0"/></td></tr>
<tr><td width="120px"><b>Passwort</b></td><td><input class="inputtext01" type="password" size="30" name="passwort"/></td></tr>
<tr><td width="120px"><b>Passwort</b></td><td><input class="inputtext01" type="password" size="30" name="passwort2"/></td></tr>
<tr><td height="20px"></td><td></td></tr>
<tr><td></td><td><input class="button06" type="submit" value="Speichern" name="speichern"/></td></tr>
</table>

<input type="hidden" name="tabelle" value="account"/>

</form>

</body>

</html>

<?php

if (isset($_POST['speichern']))
{
 	if (strlen($_POST['passwort']) >= 6)
	{
 		if ($_POST['passwort'] == $_POST['passwort2'])
 		{
 		 	$_POST['passwort'] = md5($_POST['passwort']);
 		 	$_POST['passwort0'] = md5($_POST['passwort0']);
 		 	if (Daten($_POST['tabelle'], $_SESSION['username'], 'username', 'passwort')==$_POST['passwort0'])
 		 	{
				Update($_POST['tabelle'], $_SESSION['username'], 'username', $_POST['passwort'], 'passwort');
				header("Location:account.php");
				exit;
			}
			else echo "<br>Das alte Passwort ist falsch!";
		}
		else echo "<br>Die Passw&oumlrter stimmen nicht &uumlberein!";
	}
	else echo "<br>Das Passwort ist zu kurz!";
}

?>