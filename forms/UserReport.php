<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$continue = true;

$newreport = $_POST['reported'];

if (isset($newreport)) {

    //Variables
    (int)$user_id = getmyreferid();
    (int)$reported = $_POST['ruid'];
    $reason = mysqli_real_escape_string($db, $_POST['reason']);
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

    if (empty($reported)) {
        $errors['empty_reported'] = 'Debes introducir la ID del usuario a reportar.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if (empty($reason)) {
        $errors['empty_reason'] = 'No has escrito nada.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if (!mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE id='$reported'"))) {
        $errors['user_not_exists'] = 'El usuario dado no existe.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if ($continue) {
        $query = "INSERT INTO user_report (reported_by, reported_user, message, creation) VALUES ('$user_id', '$reported', '$reason', '$creation')";
        mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
        $success = 'Su reporte fue enviado. En breve, un administrador del equipo revisará su reporte. Gracias.';
        $_SESSION['success'] = $success;
        header("location:http://" . $_SERVER['SERVER_NAME'] . "/index.php?action=report"); //Replace by a <div class="success"></div>
    } else {
        echo "<script>window.history.back();</script>";
    }

}

?>