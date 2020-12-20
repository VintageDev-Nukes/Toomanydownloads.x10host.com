<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$continue = true;
$errors = array();
$success = array();

//Forms

$newticket = $_POST['newticket'];
$newcomment = $_POST['newcomment'];

//Variables
(int)$close_id = mysqli_real_escape_string($_POST['close_id']);
(int)$delete_id = mysqli_real_escape_string($_POST['delete_id']);


if (isset($close_id) || isset($delete_id)) {

    session_start();

    $query = null;
    $str = "";

    if (isset($delete_id) && empty($close_id)) {
        $query = "UPDATE ticket SET state='erased' WHERE id='$delete_id'";
        $str = "borrado";
    }

    if (isset($close_id) && empty($delete_id)) {
        $query = "UPDATE ticket SET state='closed' WHERE id='$close_id'";
        $str = "cerrado";
    }

    mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
    $success = 'El ticket fue ' . $str . ' correctamente.';
    $_SESSION['success'] = $success;

    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/index.php?action=ticket");

}

if (isset($newticket)) {

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

        $query = "INSERT INTO ticket (user_id, titulo, contenido, creation) VALUES ('$user_id', '$title', '$content', '$creation')";
        mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
        $success = 'Su ticket fue creado.';
        $_SESSION['success'] = $success;
        header("location:http://" . $_SERVER['SERVER_NAME'] . "/index.php?action=ticket"); //Replace by a <div class="success"></div>
    } else {
        echo "<script>window.history.back();</script>";
    }

}

if (isset($newcomment)) {

    (int)$id = getmyreferid();
    (int)$ticket_id = mysqli_real_escape_string($_POST['ticket_id']);
    (int)$creation = time();

    $comment = mysqli_real_escape_string($_POST['comment']);

    session_start();

    if (empty($comment)) {
        $errors['empty_comment'] = 'No has escrito nada.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if ($continue) {

        $query = "INSERT INTO ticket_comments (ticket_id, user_id, contenido, creation) VALUES ('$ticket_id', '$id', '$comment', '$creation')";
        mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
        $success = 'El comentario fue añadido satisfactoriamente.';
        $_SESSION['success'] = $success;
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/index.php?action=ticket&go=show&id=" . $ticket_id);
    } else {
        echo "<script>window.history.back();</script>";
    }

}

?>