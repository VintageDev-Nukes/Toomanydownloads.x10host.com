<?php

$uid = getmyreferid();

$row = mysqli_fetch_array(mysqli_query("SELECT acc_prior FROM users WHERE id='$uid'"));

$acc_prior = $row['acc_prior'];

session_start();

$TMDCookie = unserialize(perdec($_COOKIE['TMDCookie']));

$is_logged = $TMDCookie['admin_login'];

if(((!isset($_SESSION['listo'])
    || $_SESSION['listo'] !== true) || !$is_logged) && $acc_prior < getprior("mod")) {
    header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=admin-login'); //Redirige al inicio de sesion en caso de que no tengas la cookie
    exit;
}
?>