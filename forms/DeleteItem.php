<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$id = $_REQUEST['id'];

$query = "DELETE FROM items WHERE id='$id'";
mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
header("location:http://" . $_SERVER['SERVER_NAME'] . "/index.php?action=admin");

?>