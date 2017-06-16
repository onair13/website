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

?> 

<html>

<style type="text/css">
	@import"style.css";
</style>

<head>
	<title>Schrauben-Handel</title>
</head>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;">

<div class="header">
<b>Schrauben-Handel</b>
<div class="bannerlinks"></div>
<div class="bannerrechts"></div>
<a class="button03" href="account.php" target="contentbelegarbeit"><b>Account</b></a>
<a class="button04" href="offline.php" target="contentbelegarbeit"><b>Logout</b></a>
<div class="username"><b><?echo $_SESSION['username'];?></b></div>
</div>

<div class="sidebar">
<a class="button01" href="startseite.php" target="contentbelegarbeit">Startseite</a>
<a class="button01" href="produkte.php" target="contentbelegarbeit">Produkte</a>
<a class="button01" href="warenkorb.php" target="contentbelegarbeit">Warenkorb</a>
<a class="button01" href="impressum.php" target="contentbelegarbeit">Impressum</a>
<a class="button01" href="info.php" target="contentbelegarbeit">Informatik II</a>
</div>

<div class="content">
<iframe src="startseite.php" width="100%" height="100%" frameborder="no" name="contentbelegarbeit">
</iframe>
</div>

</body>

</html>