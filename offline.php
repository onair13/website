<?

session_start();
if (isset($_SESSION['login']))
{
    unset($_SESSION['login']);
    unset($_SESSION['username']);
    echo "<script language=javascript>"; 
	echo "window.open('index.php', '_parent', '')"; 
	echo "</script> ";
	exit;
}
?>