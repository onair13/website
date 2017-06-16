<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

include "function.php";

?>

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;" onload="document.registrieren.vorname.focus();">

<form method="POST" name="registrieren">

<h1>Registrieren</h1><br>

<table cellpadding="1" cellspacing="1">
<tr><td><b>Regeln:</b></td></tr>
<tr><td>Vorname, Nachname und Username mind. 3 Zeichen</td></tr>
<tr><td>G&uumlltige E-Mail Adresse</td></tr>
<tr><td>Passwort mind. 6 Zeichen</td></tr>
</table>

<br>

<table cellpadding="1" cellspacing="1">
<tr><td width="120px"><b>Vorname:</b></td><td><input class="inputtext01" type="text" size="30" name="vorname"/></td></tr>
<tr><td width="120px"><b>Name:</b></td><td><input class="inputtext01" type="text" size="30" name="nachname"/></td></tr>
<tr><td width="120px"><b>E-Mail:</b></td><td><input class="inputtext01" type="text" size="30" name="email"/></td></tr>
<tr><td width="120px"><b>Username:</b></td><td><input class="inputtext01" type="text" size="30" name="username"/></td></tr>
<tr><td width="120px"><b>Passwort:</b></td><td><input class="inputtext01" type="password" size="30" name="passwort"/></td></tr>
<tr><td width="120px"><b>Passwort:</b></td><td><input class="inputtext01" type="password" size="30" name="passwort2"/></td></tr>
<tr><td height="20px"></td><td></td></tr>
<tr><td></td><td><input class="button06" type="submit" value="Registrieren" name="registrieren"/></td></tr>
</table>

<input type="hidden" name="tabelle" value="account"/>

</form>

</body>

</html>

<?php

if (isset($_POST['registrieren']))
{
 	if (strlen($_POST['vorname']) >= 3 && strlen($_POST['nachname']) >= 3 && strlen($_POST['username']) >= 3)
	{
	 	if (!(Daten($_POST['tabelle'], $_POST['username'], 'username', 'username')==$_POST['username']))
	 	{
		 	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
			 	if (!(Daten($_POST['tabelle'], $_POST['email'], 'email', 'email')==$_POST['email']))
			 	{
					if (strlen($_POST['passwort']) >= 6)
					{
	 		       		if ($_POST['passwort'] == $_POST['passwort2'])
 	 	  				{
    						$_POST['passwort'] = md5($_POST['passwort']);
    						Registrieren($_POST['tabelle'], $_POST['vorname'], $_POST['nachname'], $_POST['email'],
							$_POST['username'], $_POST['passwort']);
							header("Location:weiterleiten.php");
    			    		exit;
   						}
   					    else echo "<br>Die Passw&oumlrter stimmen nicht &uumlberein!";
			   		}
    				else echo "<br>Das Passwort ist zu kurz!";
	 	   		}
    			else echo "<br>E-Mail ist schon vorhanden!";
    		}
    		else echo "<br>Die E-Mail Adresse ist nicht g&uumlltig!";
    	}
    	else echo "<br>Username ist schon vorhanden!";
    }
    else echo "<br>Vorname, Nachname oder Username sind zu kurz!";
}

?>