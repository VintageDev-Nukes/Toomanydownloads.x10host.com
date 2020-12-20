<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/jdownloader.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
connect();

$name = mysqli_real_escape_string($_POST['name']);
$description = mysqli_real_escape_string($_POST['description']);
$url = encrypturl($_POST['url']);
$thumb = mysqli_real_escape_string($_POST['thumb']);
$points = mysqli_real_escape_string($_POST['points']);

session_start(); 
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  { 
echo "<script>alert('El c\u00f3digo es err\u00f3neo.');
window.history.back();</script>";
} else { 
mysqli_query("SET NAMES 'utf8'");
$query="INSERT INTO items (name, description, url, thumb, points) VALUES ('$name', '$description', '$url', '$thumb', '$points')";
mysqli_query($query) or die ('Error: ' . mysqli_error());
header("location:http://".$_SERVER['SERVER_NAME']."/okay.html");
}

?>