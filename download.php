<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$id = getmyreferid();
$mult = getmultbyid($id);
$game_id = $_REQUEST['game_id'];

$row = mysqli_fetch_assoc(mysqli_query($db, "SELECT points FROM users WHERE id='$id'"));
$actualpoints = $row['points'];

$row = mysqli_fetch_assoc(mysqli_query($db, "SELECT points FROM items WHERE id='$game_id'"));
$cost = $row['points']*$mult;

$newpoints = $actualpoints - $cost;

mysqli_query($db, "UPDATE users SET points='$newpoints' WHERE id='$id'");

mysqli_query($db, "UPDATE items SET downloads = downloads + 1 WHERE id='$game_id'");

header('Location: ');

?>