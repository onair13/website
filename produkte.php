<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

include "function.php";

session_start();

if (isset($_POST['zylinderschrauben']))
{
	$_SESSION['form'] = 'zylinderschrauben';
}

if (isset($_POST['senkschrauben']))
{
	$_SESSION['form'] = 'senkschrauben';
}

if (isset($_POST['sechskantschrauben']))
{
	$_SESSION['form'] = 'sechskantschrauben';
}

if (isset($_POST['zylinderschraubenflach']))
{
	$_SESSION['form'] = 'zylinderschraubenflach';
}

$tabelle = $_SESSION['form'];

?>

<html>

<style type="text/css">
	@import"style.css";
</style>

<body style="background-color:#f0f0f0; font-family:arial; color:#585858;">

<form method="POST">

<h1>Produkte</h1><br>

<input class="button07" style="left:25px; width:181px;" type="submit" value="Zylinderschrauben&#10;ISO 4762" name="zylinderschrauben"/>
<input class="button07" style="left:231px; width:181px;" type="submit" value="Zylinderschrauben&#10;DIN 7984" name="zylinderschraubenflach"/>
<input class="button07" style="left:437px; width:181px;" type="submit" value="Senkschrauben&#10;ISO 10642" name="senkschrauben"/>
<input class="button07" style="left:643px; width:181px;" type="submit" value="Sechskantschrauben&#10;ISO 4017" name="sechskantschrauben"/>


<?
if(isset($_SESSION['login']))
{
	echo '<input class="button07" style="right:25px; width:200px;" type="submit" value="In den Warenkorb" name="warenkorb"/>';
}
?>

<div class="contenttabelle">

<?php

$result = 0;
$SQL = "";
if (Datenbank())
{
	if ($_SESSION['form'] != "")
	{
	   	$SQL = "SELECT nummer, gewinde, laenge, schluesselweite, kopfdurchmesser, kopfhoehe, preis FROM $tabelle
		   		ORDER BY gewinde ASC, laenge ASC";
		$result = mysql_query($SQL);
		
		?>
		<table class="tabelle">
		<tr>
		<th height="50px">Gewinde<br>[d]</th>
		<th height="50px">L&aumlnge<br>[l]</th>
		<th height="50px" width="120px">Schl&uumlsselweite<br>[sw]</th>
		<th height="50px" width="145px">Kopfdurchmesser<br>[dk]</th>
		<th height="50px">Kopfh&oumlhe<br>[k]</th>
		<th height="50px">Preis<br>pro St&uumlck</th>
		<?
		
		if(isset($_SESSION['login']))
		{
			echo '<th width="60px" height="50px">Menge<br></th>';
		}
		
		?>
		</tr>
		<?
		
		while ($row = mysql_fetch_row($result))
		{
			?>
			<tr>
			<?
			
			echo "<td>" . $row[1] . "</td>";
			echo "<td>" . $row[2] . " mm</td>";
			echo "<td>" . number_format($row[3],1,'.',',') . " mm</td>";
			echo "<td>" . number_format($row[4],1,'.',',') . " mm</td>";
			echo "<td>" . number_format($row[5],1,'.',',') . " mm</td>";
			echo "<td>" . number_format($row[6],2,'.',',') . " &euro;</td>";
			
			if(isset($_SESSION['login']))
			{
				echo '<td><input class="inputtext02" type="text" name="menge_' . $row[0] . '"
					  maxlength="4" style="text-align:right;"/></td>';
			}
				
			?>
			</tr>
			<?
		}
		
		?>
		</table>
		<?
	}
	else 
	{
		echo "<br>Bitte w&aumlhlen sie eine Kategorie aus!";
	}
}
?>

</div>

<div class="contentvorschau">

<table class="vorschau">

<?php

if ($_SESSION['form'] == "zylinderschrauben")
{
 	echo '<tr><th height="50px">Zylinderschraube<br>ISO 4762</th></tr>';
	echo '<tr><th class="vorschaubild"><img src="zylinderschraube.png" width="160" height="240"></th></tr>';
}
else if ($_SESSION['form'] == "zylinderschraubenflach")
{
 	echo '<tr><th height="50px">Zylinderschraube<br>DIN 7984</th></tr>';
	echo '<tr><th class="vorschaubild"><img src="zylinderschraube.png" width="160" height="240"></th></tr>';
}
else if ($_SESSION['form'] == "senkschrauben")
{
  	echo '<tr><th height="50px">Senkschraube<br>ISO 10642</th></tr>';
 	echo '<tr><th class="vorschaubild"><img src="senkschraube.png" width="160" height="240"></th></tr>';
}
else if ($_SESSION['form'] == "sechskantschrauben")
{
  	echo '<tr><th height="50px">Sechskantschraube<br>ISO 4017</th></tr>';
 	echo '<tr><th class="vorschaubild"><img src="sechskantschraube.png" width="160" height="240"></th></tr>';
}
else
{
	echo "<br>Vorschau";
}

?>

</th></tr>
</table>

</div>

</form>

<?php

if (isset($_POST['warenkorb']))
{
	$i = mysql_fetch_row(mysql_query("SELECT MAX(nummer) from $tabelle"));
	$n = 1;
	while($n<=$i[0])
	{	
	 	$feld = "menge_" . $n;
	 	if (isset($_POST[$feld]))
	 	{
		 	if ($_POST[$feld] >0 && $_POST[$feld] <10000)
	 		{
	 		 	$value = mysql_fetch_row(mysql_query("SELECT form, gewinde, laenge FROM $tabelle WHERE nummer = '$n'")); 
				mysql_query("INSERT INTO warenkorb (username, form, gewinde, laenge, menge)
				VALUES ('".$_SESSION['username']."','".$value[0]."','".$value[1]."','".$value[2]."','".$_POST[$feld]."')");
			}
		}
		$n++;
	}
}

?>

</body>

</html>