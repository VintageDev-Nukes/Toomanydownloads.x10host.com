<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
connect();

$errors = array();
$success = array();
$continue = true;

//Variables
(int)$user_id = getmyreferid();
$title = mysqli_real_escape_string($_POST['title']);
$content = mysqli_real_escape_string($_POST['content']);
(int)$creation = time();

session_start();

if (empty($_POST['vercode'])) {
    $errors['empty_captcha'] = 'Captcha vacía. Introduzca el texto de la imagen.';
    $_SESSION['form_errors'] = $errors;
    $continue = false;
} else if ($_POST["vercode"] != $_SESSION["vercode"]) {
    $errors['wrong_captcha'] = 'Código erróneo.';
    $_SESSION['form_errors'] = $errors;
    $continue = false;
}

if (empty($title)) {
    $errors['empty_title'] = 'El título está vacío, por favor, escriba algo.';
    $_SESSION['form_errors'] = $errors;
    $continue = false;
}

if (empty($content)) {
    $errors['empty_content'] = 'No has escrito nada.';
    $_SESSION['form_errors'] = $errors;
    $continue = false;
}

if ($continue) {
    mysqli_query("SET NAMES 'utf8'");
    $query = "INSERT INTO ticket (user_id, titulo, contenido, creation) VALUES ('$user_id', '$title', '$content', '$creation')";
    mysqli_query($query) or die ('Error: ' . mysqli_error());
    $success['ticket_created'] = 'Su ticket fue creado.';
    $_SESSION['success'] = $success;
    header("location:http://" . $_SERVER['SERVER_NAME'] . "/index.php?action=ticket"); //Replace by a <div class="success"></div>
} else {
    echo "<script>window.history.back();</script>";
}

?>