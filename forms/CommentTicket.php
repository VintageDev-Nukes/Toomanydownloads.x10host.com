<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$continue = true;

(int)$id = getmyreferid();
(int)$ticket_id = mysqli_real_escape_string($db, $_POST['ticket_id']);
(int)$creation = time();

$comment = mysqli_real_escape_string($db, $_POST['comment']);

session_start();

if (empty($comment)) {
    $errors['empty_comment'] = 'No has escrito nada.';
    $_SESSION['form_errors'] = $errors;
    $continue = false;
}

if ($continue) {
    mysqli_query($db, "SET NAMES 'utf8'");
    $query = "INSERT INTO ticket_comments (ticket_id, user_id, contenido, creation) VALUES ('$ticket_id', '$id', '$comment', '$creation')";
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
    $success['comment_created'] = 'El comentario fue añadido satisfactoriamente.';
    $_SESSION['success'] = $success;
    header("Location: index.php?action=ticket&go=show&id=" . $ticket_id);
} else {
    echo "<script>window.history.back();</script>";
}

?>