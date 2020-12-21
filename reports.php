<?php

$rid = @$_GET['id'];

if(empty($rid)) {

require_once('paginator.class.php');
$pages = new Paginator;

echo '<table class="admintable" cellspacing="0">
        <tr>
          <td colspan="3">Nuevos reportes</td>
        </tr>
        <tr><td>ID</td><td>Autor / Creación</td><td>Acciones</td></tr>';

  $query = "SELECT * FROM user_report ORDER BY creation DESC"; //aquí se lee * (todo) de demo
  $result = mysqli_query($db, $query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

  if(mysqli_num_rows($result)) {
    while($rs=mysqli_fetch_array($result))  {
    	if(isnew("report_".$rs['id'])) {
      		echo '<tr><td>'.$rs['id'].'</td><td>Usuario #'.$rs['reported_user'].' ha sido reportado por el usuario #'.$rs['reported_by'].' hace '.strdate($rs['creation']).'</td><td>[<a href="index.php?action=admin&go=report&id='.$rs['id'].'" target="_blank">Ver</a>]<br></td></tr>';
    	}
    }
  } else {
    echo 'No hay ningún resultado.';
  }

  echo '</table>';

echo '<table class="admintable" cellspacing="0" style="margin-top:20px;">
        <tr>
          <td colspan="3">Reportes revisados</td>
        </tr>
        <tr><td>ID</td><td>Autor / Creación</td><td>Acciones</td></tr>';

	$pages->items_total = mysqli_num_rows(mysqli_query($db, "SELECT * FROM ticket"));
	$pages->mid_range = 7;
	$pages->paginate();

  $query = "SELECT * FROM user_report ORDER BY creation DESC $pages->limit"; //aquí se lee * (todo) de demo
  $result = mysqli_query($db, $query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

  if(mysqli_num_rows($result)) {
    while($rs=mysqli_fetch_array($result))  {
    	if(!isnew("report_".$rs['id'])) {
      		echo '<tr><td>'.$rs['id'].'</td><td>Usuario #'.$rs['reported_user'].' ha sido reportado por el usuario #'.$rs['reported_by'].' hace '.strdate($rs['creation']).'</td><td>[<a href="index.php?action=admin&go=report&id='.$rs['id'].'" target="_blank">Ver</a>]<br></td></tr>';
    	}
    }
  } else {
    echo 'No hay ningún resultado.';
  }

  echo '<tr style="background:#333;">
  	<td colspan="3"><div class="paginate">'.$pages->display_pages().'</div></td>
  </tr>
</table>';

} else {

  setreaded("report_".$rid);

  $query = "SELECT * FROM user_report WHERE id='$rid' ORDER BY creation DESC LIMIT 0,1"; //aquí se lee * (todo) de demo
  $result = mysqli_query($db, $query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

  if(mysqli_num_rows($result)) {
    while($rs=mysqli_fetch_array($result)) {

    	$nick = "";
		$user_id = $rs['reported_by'];

    	$row = mysqli_fetch_array(mysqli_query($db, "SELECT nickname FROM users WHERE id='$user_id'"));

		if($row['nickname'] == null) 
		{
		  	$nick = '<a href="index.php?action=profile&id='.$user_id.'" target="_blank"><u>#user'.$user_id.'</u></a>';
		} else 
		{
		  	$nick = '<a href="index.php?action=profile&id='.$cur_id.'" target="_blank"><u>'.$row['nickname'].'</u></a>';
		}

    	echo '<table class="admintable" cellspacing="0">
	        <tr>
	          <td>Reporte #'.$rs['id'].'</td>
	        </tr>
	        <tr>
	        	<td>
	        		« Reporte creado hace '.strdate($rs['creation']).' »<br>
	        		« Reportado por '.$nick.' »
	        		<!--- <h2 style="margin:0px;">Usuario reportado:</h2>'.$rs['reported_user'].'
	        		<h2 style="margin:0px;">Usuario que creó el reporte:</h2>'.$rs['reported_by'].' -->
	        		<hr>
	        		<b>Detalles:</b><br>'.$rs['message'].'
	        	</td>
	        </tr>
        </table>';

    }
  } else {
    echo 'No hay ningún resultado.';
  }

}

?>