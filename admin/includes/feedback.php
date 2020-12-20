<?php

session_start();

if (isset($_SESSION)) {
    $success = $_SESSION['success'];
    $errors = $_SESSION['form_errors'];
}

if (isset($_SESSION['success'])) {
    echo '<div class="success" style="width:450px;">' . $success . '</div>';
    session_destroy();
}

echo '<table name="approved" class="admintable" cellspacing="0">
        <tr>
          <td colspan="3">Nuevos comentarios</td>
        </tr>
        <tr><td>ID</td><td>Mensaje</td><td>Acciones</td></tr>';

$query = "SELECT * FROM feedback ORDER BY creation DESC"; //aquí se lee * (todo) de demo
$result = mysqli_query($query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

$times = 0;

if (mysqli_num_rows($result)) {
    while ($rs = mysqli_fetch_array($result)) {
        if ($rs['approved'] == 0) {
            echo '<tr><td>' . $rs['id'] . '</td><td>' . $rs['mensaje'] . '</td><td>[<a href="#" onclick="javascript:submitformbyid(\'approve\');">Aprobar</a>] [<a href="#" onclick="javascript:submitformbyid(\'delete\');">Borrar</a>]</td></tr>';
            echo '<form method="post" id="approve" action="http://' . $_SERVER['SERVER_NAME'] . '/forms/FeedBackManager.php"><input type="hidden" name="approve" value="' . $rs['id'] . '"></form>';
            echo '<form method="post" id="delete" action="http://' . $_SERVER['SERVER_NAME'] . '/forms/FeedBackManager.php"><input type="hidden" name="delete" value="' . $rs['id'] . '"></form>';
            $times++;
        }
    }
}

if ($times == 0) {
    echo '<tr><td colspan="3">No hay ningún resultado.</td></tr>';
}

echo '</table>';

echo '<table name="deleted" class="admintable" cellspacing="0" style="margin-top:20px;">
        <tr>
          <td colspan="2">Comentarios borrados</td>
        </tr>
        <tr><td>ID</td><td>Mensaje</td></tr>';

$query = "SELECT * FROM feedback ORDER BY creation DESC"; //aquí se lee * (todo) de demo
$result = mysqli_query($query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

$times = 0;

if (mysqli_num_rows($result)) {
    while ($rs = mysqli_fetch_array($result)) {
        if ($rs['approved'] == -1) {
            echo '<tr><td>' . $rs['id'] . '</td><td>' . $rs['mensaje'] . '</td></tr>';
            $times++;
        }
    }
}

if ($times == 0) {
    echo '<tr><td colspan="2">No hay ningún resultado.</td></tr>';
}

echo '</table>';

?>