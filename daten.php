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

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;" onload="document.daten.vorname.focus();">

<form method="POST" name="daten">

<h1>Account</h1><br>

<table cellpadding="1" cellspacing="1">
<tr><td><b>Regeln:</b></td></tr>
<tr><td>Vorname und Nachname mind. 3 Zeichen</td></tr>
<tr><td>G&uumlltige E-Mail Adresse</td></tr>
</table>

<br>

<table cellpadding="1" cellspacing="1">
<tr><td width="120px"><b>Vorname:</b></td><td><input class="inputtext01" type="text" size="30" name="vorname" 
value="<?echo Daten($tabelle, $_SESSION['username'], 'username', 'vorname');?>"/></td></tr>
<tr><td width="120px"><b>Name:</b></td><td><input class="inputtext01" type="text" size="30" name="nachname"
value="<?echo Daten($tabelle, $_SESSION['username'], 'username', 'nachname');?>"/></td></tr>
<tr><td width="120px"><b>E-Mail:</b></td><td><input class="inputtext01" type="text" size="30" name="email"
value="<?echo Daten($tabelle, $_SESSION['username'], 'username', 'email');?>"/></td></tr>
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
	if (strlen($_POST['vorname']) >= 3 && strlen($_POST['nachname']) >= 3)
 	{
	 	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			if (Daten($_POST['tabelle'], $_SESSION['username'], 'username', 'email')==$_POST['email']
			|| !(Daten($_POST['tabelle'], $_POST['email'], 'email', 'email')==$_POST['email']))
		 	{
				Update($_POST['tabelle'], $_SESSION['username'], 'username', $_POST['vorname'], 'vorname');
				Update($_POST['tabelle'], $_SESSION['username'], 'username', $_POST['nachname'], 'nachname');
				Update($_POST['tabelle'], $_SESSION['username'], 'username', $_POST['email'], 'email');
				header("Location:account.php");
				exit;
			}
			else echo "<br>E-Mail ist schon vorhanden!";	
		}
    	else echo "<br>Die E-Mail Adresse ist nicht g&uumlltig!";
    }
    else echo "<br>Vorname oder Nachname sind zu kurz!";
}

?>