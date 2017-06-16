<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

include "function.php";

$tabelle = "account";

session_start();
if (!(isset($_SESSION['login'])))
{
    echo "<script language=javascript>"; 
	echo "window.open('index.php', '_parent', '')"; 
	echo "</script> "; 
    exit;
}

?>

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;">

<form method="POST">

<h1>Account</h1><br>

<table cellpadding="1" cellspacing="1">
<tr><td width="120px"><b>Vorname:</b></td><td><?echo Daten($tabelle, $_SESSION['username'], 'username', 'vorname')?></td></tr>
<tr><td width="120px"><b>Name:</b></td><td><?echo Daten($tabelle, $_SESSION['username'], 'username', 'nachname')?></td></tr>
<tr><td width="120px"><b>E-Mail:</b></td><td><?echo Daten($tabelle, $_SESSION['username'], 'username', 'email')?></td></tr>
<tr><td width="120px"><b>Username:</b></td><td><?echo $_SESSION['username']?></td></tr>
<tr><td height="20px"></td><td></td></tr>
<tr><td></td><td><a class="button05" href="account.php" target="contentbelegarbeit">Profilbild &aumlndern</a></td></tr>
<tr><td></td><td><a class="button05" href="daten.php" target="contentbelegarbeit">Daten &aumlndern</a></td></tr>
<tr><td></td><td><a class="button05" href="passwort.php" target="contentbelegarbeit">Passwort &aumlndern</a></td></tr>
<tr><td></td><td><input class="button06" type="submit" value="Account l&ouml;schen" name="loeschen"/></td></tr>
<tr><td height="20px"></td><td></td></tr>
</table>

<input type="hidden" name="tabelle" value="account"/>

<div class="profilbild">Profilbild</div>

</form>

</body>

</html>

<?php

if (isset($_POST['loeschen']))
{
 	Löschen($_POST['tabelle'], $_SESSION['username']);
 	unset($_SESSION['login']);
	header("Location:löschen.php"); 
    exit;
}

?>