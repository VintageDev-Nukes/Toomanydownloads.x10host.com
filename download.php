<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
connect();

$id = getmyreferid();
$mult = getmultbyid($id);
$game_id = $_REQUEST['game_id'];

$row = mysql_fetch_assoc(mysql_query("SELECT points FROM users WHERE id='$id'"));
$actualpoints = $row['points'];

$row = mysql_fetch_assoc(mysql_query("SELECT points FROM items WHERE id='$game_id'"));
$cost = $row['points']*$mult;

$newpoints = $actualpoints - $cost;

mysql_query("UPDATE users SET points='$newpoints' WHERE id='$id'");

mysql_query("UPDATE items SET downloads = downloads + 1 WHERE id='$game_id'");

header('Location: http://'.$_SERVER['SERVER_NAME'].'/');

?>