<?

include "function.php";

session_start();

if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
}

$zwischensumme = "0";
$gesamtsumme = "0";

?> 

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;">

<?php

if (!(isset($_SESSION['login'])))
{
    echo "Bitte melden sie sich erst an!";
}
else
{
 
?>

<form method="POST">

<h1>Warenkorb</h1><br>

<input class="button07" style="left:25px; width:181px;" type="submit" value="Warenkorb&#10;löschen" name="löschen"/>
<input class="button07" style="left:231px; width:181px;" type="submit" value="Bestellung&#10;aufgeben" name="bestellen"/>

<div class="contenttabelle">

<table class="tabelle">
<tr>
<th height="50px" width="250">Form</th>
<th height="50px">Gewinde</th>
<th height="50px">L&aumlnge</th>
<th height="50px">Menge</th>
<th height="50px">Preis<br>pro St&uumlck</th>
</tr>

<?php

$result = 0;
$SQL = "";
if  (Datenbank())
{
	$result = mysql_query("SELECT form, username, gewinde, laenge, menge FROM warenkorb WHERE username = '$username'
						   ORDER BY form ASC, gewinde ASC, laenge ASC");

	while ($warenkorb = mysql_fetch_row($result))
	{
		if ($warenkorb[0]=="Zylinderschraube ISO 4762")
		{
			$tabelle="zylinderschrauben";
		}
		else if ($warenkorb[0]=="Zylinderschraube DIN 7984")
		{
			$tabelle="zylinderschraubenflach";
		}
		else if ($warenkorb[0]=="Senkschraube ISO 10642")
		{
			$tabelle="senkschrauben";
		}
		else if ($warenkorb[0]=="Sechskantschraube ISO 4017")
		{
			$tabelle="sechskantschrauben";
		}
		$preis = mysql_fetch_row(mysql_query("SELECT preis FROM $tabelle WHERE gewinde = '$warenkorb[2]' AND laenge = '$warenkorb[3]'"));
		
		echo "<tr>";
		echo "<td>" . $warenkorb[0] . "</td>";
		echo "<td>" . $warenkorb[2] . "</td>";
		echo "<td>" . $warenkorb[3] . " mm</td>";
		echo "<td>" . $warenkorb[4] . "</td>";
		echo "<td>" . number_format($preis[0],2,'.',',') . " &euro;</td>";
		echo "</tr>";
		
		$zwischensumme = $warenkorb[4] * $preis[0];
		$gesamtsumme = $gesamtsumme + $zwischensumme;
	}
}

?>

</table>

</div>

</from>

<div class="contentvorschau">

<table class="vorschau">

<?php

echo '<tr><th height="50px" style="line-height:50px;">Gesamtsumme</th></tr>';
echo '<tr><th class="vorschaubild"><br><br></h3>'. number_format($gesamtsumme,2,'.',',') . '</h3> &euro;</th></tr>';

?>

</th></tr>
</table>

</div>

</body>

</html>

<?php


if (isset($_POST['löschen']))
{
	if (Datenbank())
	{
		mysql_query("DELETE FROM warenkorb WHERE username = '$username'");
		header ("location:warenkorb.php");
	}
}

if (isset($_POST['bestellen']))
{
	if (Datenbank())
	{
		$kontrolle = mysql_num_rows(mysql_query("SELECT * FROM warenkorb WHERE username = '$username'"));
		if (!($kontrolle==0))
		{
			header ("location:bestellung.php");
		}
	}
}

}

?>