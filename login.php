<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

$message = "";

session_start();
if (isset($_SESSION['login']))
    unset($_SESSION['login']);
    
include "function.php";

if (isset($_POST['login']))
{
    $_POST['passwort'] = md5($_POST['passwort']);
    if (Login($_POST['tabelle'], $_POST['username'], $_POST['passwort']))
	{
        $_SESSION['login'] = "OK";
        $_SESSION['username'] = $_POST['username'];
		echo "<script language=javascript>"; 
		echo "window.open('online.php', '_parent', '')"; 
		echo "</script> "; 
		exit;
    }
    else 
		$message = "<br>Username nicht vorhanden oder Passwort falsch!";
}

?>

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;" onload="document.login.username.focus();">

<form method="POST" name="login">

<h1>Login</h1><br>

<table cellpadding="1" cellspacing="1">
<tr><td width="120px"><b>Username:</b></td><td><input class="inputtext01" type="text" size="30" name="username"/></td></tr>
<tr><td width="120px"><b>Passwort:</b></td><td><input class="inputtext01" type="password" size="30" name="passwort"/></td></tr>
<tr><td height="20px"></td><td></td></tr>
<tr><td></td><td><input class="button06" type="submit" value="Einloggen" name="login"/></td></tr>
</table>

<input type="hidden" name="tabelle" value="account"/>

</form>

</body>

</html>

<?php

echo $message;

?>