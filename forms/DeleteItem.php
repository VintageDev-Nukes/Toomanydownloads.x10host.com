<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
connect();

$id = $_REQUEST['id'];

$query="DELETE FROM items WHERE id='$id'";
mysql_query($query) or die ('Error: ' . mysql_error());
header("location:http://".$_SERVER['SERVER_NAME']."/index.php?action=admin");

?>