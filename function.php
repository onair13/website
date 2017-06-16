<?

function Datenbank()
{
    include "config.php";
    $handle = @mysql_connect($HOST, $DB_USER, $DB_PASSWORD);
    if (!$handle)
        die("Verbindung zum Server fehlgeschlagen");
    $handle = @mysql_select_db($DB_NAME, $handle);
    if (!$handle)
        die("Datenbank nicht gefunden.");
    return $handle;
}

function Escape($value = "")
{
    $result = "";
    if (Datenbank()) {
        $result = mysql_real_escape_string($value);
    }
    return $result;
}

function Registrieren($tabelle, $vorname, $nachname, $email, $username, $passwort)
{
    $result =0;
    $SQL ="";
    if (Datenbank())
	{
		$vorname = Escape($vorname);
        $nachname = Escape($nachname);
        $email = Escape($email);
        $username = Escape($username);
        $passwort = Escape($passwort);
        $SQL = "INSERT INTO $tabelle (vorname, nachname, email, username, passwort) values ('".$vorname."','".$nachname."','".$email."',
		'".$username."','".$passwort."')";
		$result = mysql_query($SQL);
    }
    return $result;
}

function Login($tabelle, $username, $passwort)
{
 	$result = 0;
    $SQL = "";
    if (Datenbank())
	{
        $username = Escape($username);
        $passwort = Escape($passwort);
        $SQL = "SELECT * FROM $tabelle WHERE username= '$username' AND passwort = '$passwort' ";
        $result = mysql_query($SQL);
        return mysql_num_rows($result);
    }
}

function Daten($tabelle, $input, $inputfield, $output)
{
 	$result = 0;
    $SQL = "";
    if (Datenbank())
	{
        $input = Escape($input);
        $inputfield = Escape($inputfield);
        $output = Escape($output);
        $SQL = "SELECT $output FROM $tabelle WHERE $inputfield = '$input'";
        $result = mysql_query($SQL);
		$value= mysql_fetch_row($result); 
		return $value[0];
	}
}

function Update($tabelle, $input, $inputfield, $output, $outputfield)
{
 	$result = 0;
    $SQL = "";
    if (Datenbank())
	{
        $input = Escape($input);
        $inputfield = Escape($inputfield);
        $output = Escape($output);
        $outputfield = Escape($outputfield);
        $SQL = "UPDATE $tabelle SET $outputfield = '$output' WHERE $inputfield = '$input'";
        $result = mysql_query($SQL);
        return $result;
	}
}

function Löschen($tabelle, $username)
{
 	$result = 0;
    $SQL = "";
    if (Datenbank())
	{
        $username = Escape($username);
        $SQL = "DELETE FROM $tabelle WHERE username= '$username'";
        $result = mysql_query($SQL);
        return $result;
	}
}

?>