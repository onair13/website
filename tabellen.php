<?

session_start();
if (!($_SESSION['username']=="tomueller"))
{
    echo "<script language=javascript>"; 
	echo "window.open('index.php', '_parent', '')"; 
	echo "</script> "; 
    exit;
}

?>

<html>

<h1>Tabellen ausfüllen</h1><br>

<form method="POST">

<input type="submit" width="200px" name="zylinderschrauben" value="Zylinderschrauben ISO 4762"/><br>
<input type="submit" width="200px" name="senkschrauben" value="Senkschrauben ISO 10642"/><br>
<input type="submit" width="200px" name="sechskantschrauben" value="Sechskantschrauben ISO 4017"/><br>
<input type="submit" width="200px" name="zylinderschraubenflach" value="Zylinderschrauben DIN 7984"/>

</form>

<?php

include "function.php";

if (Datenbank())
{
	$l[0] = 10; $l[1] = 12; $l[2] = 16; $l[3] = 20; $l[4] = 25; $l[5] = 30;		//Längen
	$name="";
	
	if (isset($_POST['zylinderschrauben']))
	{
		$m = 2; 				//Gewinde
		$i = 0; $j = 0;			//Zähler
		$imax = 4; $jmax = 5;	//Zähler (MAX)
		
		$sw[0] = 1.5; $sw[1] = 2.5; $sw[2] = 3; $sw[3] = 4; $sw[4] = 5;		//Schlüsselweiten
		$k[0] = 2; $k[1] = 3; $k[2] = 4; $k[3] = 5; $k[4] = 6;				//Kopfhöhen
		$dk[0] = 3.8; $dk[1] = 5.5; $dk[2] = 7; $dk[3] = 8.5; $dk[4] = 10;	//Kopfdurchmesser
		
		$tabelle = "zylinderschrauben";			//Tabelle
		$name = "Zylinderschraube ISO 4762";	//Bezeichnung
	}
	
	if (isset($_POST['senkschrauben']))
	{
		$m = 3; 				//Gewinde
		$i = 0; $j = 0;			//Zähler
		$imax = 3; $jmax = 5;	//Zähler (MAX)
		
		
		$sw[0] = 2; $sw[1] = 2.5; $sw[2] = 3; $sw[3] = 4;			//Schlüsselweiten
		$k[0] = 1.9; $k[1] = 2.5; $k[2] = 3.1; $k[3] = 3.7;			//Kopfhöhen
		$dk[0] = 5.5; $dk[1] = 7.5; $dk[2] = 9.4; $dk[3] = 11.3;	//Kopfdurchmesser
		
		$tabelle = "senkschrauben";				//Tabelle
		$name = "Senkschraube ISO 10642";		//Bezeichnung
	}
	
	if (isset($_POST['sechskantschrauben']))
	{
		$m = 2; 				//Gewinde
		$i = 0; $j = 0;			//Zähler
		$imax = 4; $jmax = 5;	//Zähler (MAX)
		
		
		$sw[0] = 4; $sw[1] = 5.5; $sw[2] = 7; $sw[3] = 8; $sw[4] = 10;			//Schlüsselweiten
		$k[0] = 1.4; $k[1] = 2; $k[2] = 2.8; $k[3] = 3.5; $k[4] = 4;			//Kopfhöhen
		$dk[0] = 4.3; $dk[1] = 6; $dk[2] = 7.7; $dk[3] = 8.8; $dk[4] = 11.1;	//Kopfdurchmesser
		
		$tabelle = "sechskantschrauben";		//Tabelle
		$name = "Sechskantschraube ISO 4017";	//Bezeichnung
	}
	
	if (isset($_POST['zylinderschraubenflach']))
	{
		$m = 3; 				//Gewinde
		$i = 0; $j = 0;			//Zähler
		$imax = 3; $jmax = 5;	//Zähler (MAX)
		
		$sw[0] = 2; $sw[1] = 2.5; $sw[2] = 3; $sw[3] = 4;				//Schlüsselweiten
		$k[0] = 2; $k[1] = 2.8; $k[2] = 3.5; $k[3] = 4;						//Kopfhöhen
		$dk[0] = 5.5; $dk[1] = 7; $dk[2] = 8.5; $dk[3] = 10;			//Kopfdurchmesser
		
		$tabelle = "zylinderschraubenflach";	//Tabelle
		$name = "Zylinderschraube DIN 7984";	//Bezeichnung
	}
	
	if (!($name==""))
	{
	 	mysql_query("DELETE FROM $tabelle");
	 	mysql_query("ALTER TABLE $tabelle AUTO_INCREMENT =1");
	 	
		echo '<table border="1px" width="300px"><tr><th>'.$name.'</th></tr></table>';
		echo '<table border="1px" width="300px">';

		while ($i<=$imax)
		{
			while ($j<=$jmax)
			{
				echo "<tr><th>M".$m."</th><th>".$l[$j]."</th><th>".$sw[$i]."</th><th>".$k[$i]."</th><th>".$dk[$i]."</th></tr>";
				$SQL = "INSERT INTO $tabelle (form, gewinde, laenge, schluesselweite, kopfdurchmesser, kopfhoehe)
						VALUES ('".$name."','M".$m."','".$l[$j]."','".$sw[$i]."','".$dk[$i]."','".$k[$i]."')";
						$result = mysql_query($SQL);
						$j++;
			}
			$j = 0;
			$m++;
			$i++;
		}
		
		$i = 1;
		{
			while($i<=30)
			{
 				$SQL = "SELECT gewinde, laenge FROM $tabelle WHERE nummer = $i";
		 		$result = mysql_query($SQL);
			 	$value = mysql_fetch_row($result);
			 	$string = substr($value[0],1,1);
				$c=sqrt($string*$value[1])/100;
				$d=round($c,2);
				$SQL = "UPDATE $tabelle SET preis = '$d' WHERE gewinde = '$value[0]' AND laenge = '$value[1]'";
	   	 	    $result = mysql_query($SQL);
				$i++;
			}
		}
		echo "</table>";
	}
	$name="";
}

?>

</table>
</html>





