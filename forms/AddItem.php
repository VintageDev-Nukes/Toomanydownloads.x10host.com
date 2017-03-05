<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/jdownloader.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
connect();

$name = mysql_real_escape_string($_POST['name']);
$description = mysql_real_escape_string($_POST['description']);
$url = encrypturl($_POST['url']);
$thumb = mysql_real_escape_string($_POST['thumb']);
$points = mysql_real_escape_string($_POST['points']);

session_start(); 
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  { 
echo "<script>alert('El c\u00f3digo es err\u00f3neo.');
window.history.back();</script>";
} else { 
mysql_query("SET NAMES 'utf8'");
$query="INSERT INTO items (name, description, url, thumb, points) VALUES ('$name', '$description', '$url', '$thumb', '$points')";
mysql_query($query) or die ('Error: ' . mysql_error());
header("location:http://".$_SERVER['SERVER_NAME']."/okay.html");
}

?>