<?php


$welcome = '';

if ($gender == 0) {
    $welcome = 'Bienvenido(a)';
} else if ($gender == 1) {
    $welcome = 'Bienvenido';
} else {
    $welcome = 'Bienvenida';
}

echo '<table style="width:100%;">
  <tr>
    <td>
      <table class="admintable" cellspacing="0">
        <tr>
          <td>Centro de administración</td>
        </tr>
        <tr>
          <td>
            ' . $welcome . ', ' . $nick . '! Este es tu "Centro de Administración". Desde aquí puedes modificar la configuración del sitio, realizar tareas de mantenieminto, ver logs, instalar paquetes, gestionar temas, y muchas otras cosas.<br><br>
            Si tienes algún problema, por favor revisa la página de "Soporte y Créditos". Si esa información no te sirve, envia un correo electrónico al creador de la web <b>(tdm.official1@gmail.com)</b>.
            También puedes encontrar respuestas a tus preguntas y problemas haciendo clic en los símbolos <b>"?"</b> para obtener mayor información de las funciones en cuestión.
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table class="admintable" cellspacing="0" style="margin-top:20px;">
        <tr>
          <td>Estadísticas de la web</td>
        </tr>
        <tr>
          <td>
            Usuarios: ' . $users_num . '<br>
            Usuarios conectados: ' . $connected_users . '<br>
            Items: ' . $items_num . '<br>
            Descargas: ' . $total_downs['totaldowns'] . '<br>
            Puntos totales: ' . $total_points['totalpoints'] . '
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>';


?>