<?php

require_once('paginator.class.php');
$pages = new Paginator;

echo '<table class="admintable" cellspacing="0">
        <tr>
          <td colspan="3">Nuevos tickets</td>
        </tr>
        <tr><td>ID</td><td>T�tulo</td><td>Acciones</td></tr>';

$query = "SELECT * FROM ticket ORDER BY creation DESC"; //aqu� se lee * (todo) de demo
$result = mysqli_query($query) or die(mysqli_error()); //Aqu� se muestra el resultado que est� listo para ser mostrado con un while linea: 19

if (mysqli_num_rows($result)) {
    while ($rs = mysqli_fetch_array($result)) {
        if (isnew("ticket_" . $rs['id'])) {
            echo '<tr><td>' . $rs['id'] . '</td><td>' . $rs['titulo'] . '</td><td>[<a href="http://' . $_SERVER['SERVER_NAME'] . '/index.php?action=ticket&go=show&id=' . $rs['id'] . '" target="_blank">Ver</a>]<br></td></tr>';
        }
    }
} else {
    echo 'No hay ning�n resultado.';
}

echo '</table>';

echo '<table class="admintable" cellspacing="0" style="margin-top:20px;">
        <tr>
          <td colspan="3">Tickets revisados</td>
        </tr>
        <tr><td>ID</td><td>T�tulo</td><td>Acciones</td></tr>';

$pages->items_total = mysqli_num_rows(mysqli_query("SELECT * FROM ticket"));
$pages->mid_range = 7;
$pages->paginate();

$query = "SELECT * FROM ticket ORDER BY creation DESC $pages->limit"; //aqu� se lee * (todo) de demo
$result = mysqli_query($query) or die(mysqli_error()); //Aqu� se muestra el resultado que est� listo para ser mostrado con un while linea: 19

if (mysqli_num_rows($result)) {
    while ($rs = mysqli_fetch_array($result)) {
        if (!isnew("ticket_" . $rs['id'])) {
            echo '<tr><td>' . $rs['id'] . '</td><td>' . $rs['titulo'] . '</td><td>[<a href="http://' . $_SERVER['SERVER_NAME'] . '/index.php?action=ticket&go=show&id=' . $rs['id'] . '" target="_blank">Ver</a>]<br></td></tr>';
        }
    }
} else {
    echo 'No hay ning�n resultado.';
}

echo '<tr style="background:#333;">
          	<td colspan="3"><div class="paginate">' . $pages->display_pages() . '</div></td>
          </tr>
        </table>';

?>