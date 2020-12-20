<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$continue = true;

$newfb = $_POST['newfb'];

if (isset($newfb)) {

    //Variables
    (int)$user_id = getmyreferid();
    $mensaje = $_POST['mensaje'];
    (int)$creation = time();

    session_start();

    if (empty($mensaje)) {
        $errors['empty_mensaje'] = 'Debes escribir un comentario.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if ($continue) {
        $query = "INSERT INTO feedback (user_id, mensaje, creation) VALUES ('$user_id', '$mensaje', '$creation')";
        mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
        $success = 'Su comentario fue enviado. Su mensaje está pendiente de moderación.';
        $_SESSION['success'] = $success;
        header("location:index.php?action=feedback"); //Replace by a <div class="success"></div>
    } else {
        echo "<script>window.history.back();</script>";
    }

}

if (isset($_POST['delete'])) {
    $did = $_POST['delete'];
    $query = "UPDATE feedback SET approved='-1' WHERE id='$did'";
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
    $success = 'El comentario fue borrado.';
    $_SESSION['success'] = $success;
    header("location:index.php?action=admin&go=feedback");
}

if (isset($_POST['approve'])) {
    $aid = $_POST['approve'];
    $query = "UPDATE feedback SET approved='1' WHERE id='$aid'";
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
    $success = 'El comentario fue aprobado.';
    $_SESSION['success'] = $success;
    header("location:index.php?action=admin&go=feedback");
}


?>