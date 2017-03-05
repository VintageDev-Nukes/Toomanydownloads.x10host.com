<?php 

require_once('paginator.class.php');
$pages = new Paginator;

echo '<table class="admintable" cellspacing="0">
        <tr>
          <td colspan="3">Nuevos tickets</td>
        </tr>
        <tr><td>ID</td><td>Título</td><td>Acciones</td></tr>';

  $query = "SELECT * FROM ticket ORDER BY creation DESC"; //aquí se lee * (todo) de demo
  $result = mysql_query($query) or die(mysql_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

  if(mysql_num_rows($result)) {
    while($rs=mysql_fetch_array($result))  {
    	if(isnew("ticket_".$rs['id'])) {
      		echo '<tr><td>'.$rs['id'].'</td><td>'.$rs['titulo'].'</td><td>[<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=ticket&go=show&id='.$rs['id'].'" target="_blank">Ver</a>]<br></td></tr>';
    	}
    }
  } else {
    echo 'No hay ningún resultado.';
  }

  echo '</table>';

echo '<table class="admintable" cellspacing="0" style="margin-top:20px;">
        <tr>
          <td colspan="3">Tickets revisados</td>
        </tr>
        <tr><td>ID</td><td>Título</td><td>Acciones</td></tr>';

        	$pages->items_total = mysql_num_rows(mysql_query("SELECT * FROM ticket"));
        	$pages->mid_range = 7;
        	$pages->paginate();

          $query = "SELECT * FROM ticket ORDER BY creation DESC $pages->limit"; //aquí se lee * (todo) de demo
          $result = mysql_query($query) or die(mysql_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

          if(mysql_num_rows($result)) {
            while($rs=mysql_fetch_array($result)) {
            	if(!isnew("ticket_".$rs['id'])) {
              		echo '<tr><td>'.$rs['id'].'</td><td>'.$rs['titulo'].'</td><td>[<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=ticket&go=show&id='.$rs['id'].'" target="_blank">Ver</a>]<br></td></tr>';
            	}
            }
          } else {
            echo 'No hay ningún resultado.';
          }

        echo '<tr style="background:#333;">
          	<td colspan="3"><div class="paginate">'.$pages->display_pages().'</div></td>
          </tr>
        </table>';

?>