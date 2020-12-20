<?php

session_start();

if(isset($_SESSION)) {
	$success = $_SESSION['success'];
	$errors = $_SESSION['form_errors'];
}

require_once('paginator.class.php');
$pages = new Paginator;

echo '<div class="contenido">
	<div class="inside">
	<table class="showtickets" cellspacing="0">
        <tr class="showticketheader">
          <td colspan="3">Últimos comentarios de usuarios de la comunidad</td>
        </tr>
        <tr style="background:#111;"><td>Mensaje</td><td>Creación</td><td>Por</td></tr>';
        
      	$pages->items_total = mysqli_num_rows(mysqli_query("SELECT * FROM ticket"));
		$pages->mid_range = 7;
		$pages->paginate();

		  $query = "SELECT * FROM feedback ORDER BY creation DESC $pages->limit"; //aquí se lee * (todo) de demo
		  $result = mysqli_query($query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

		  if(mysqli_num_rows($result)) {
		    while($rs=mysqli_fetch_array($result)) {
		    	if($rs['approved'] == 1) {

			    	$nick = "";
			  		$user_id = $rs['user_id'];

			      	$row = mysqli_fetch_array(mysqli_query("SELECT nickname FROM users WHERE id='$user_id'"));

			  		if($row['nickname'] == null) 
			  		{
			  		  	$nick = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$user_id.'" target="_blank"><i>#user'.$user_id.'</i></a>';
			  		} else 
			  		{
			  		  	$nick = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$cur_id.'" target="_blank"><i>'.$row['nickname'].'</i></a>';
			  		}

		    		echo '<tr><td>'.$rs['mensaje'].'</td><td>Hace '.strdate($rs['creation']).'</td><td>'.$nick.'</td></tr>';
		    	}
		   }
		  } else {
		    echo '<tr><td colspan="3">No hay ningún resultado.</td></tr>';
		  }

		echo '<tr style="background:#333;">
	  		<td colspan="3"><div class="paginate">'.$pages->display_pages().'</div></td>
	  	</tr></table>';

	  	if(isset($_SESSION['success'])) 
		{
			echo '<div class="success" style="width:450px;">'.$success.'</div>';
			session_destroy();
		}

	  	if(isset($errors['empty_mensaje'])) 
		{
			echo '<div class="error" style="width:100%;margin:5px 0 5px 0;">'.$errors['empty_mensaje'].'</div>';
		}

		echo '<form method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/FeedBackManager.php">
			<table class="admintable" cellspacing="0" style="margin-top:20px;">
		        <tr>
		          <td>Añadir comentario</td>
		        </tr>
		        <tr>
		          <td>
		          	<b style="font-size:14px;">Mensaje:</b><br>
		          	<textarea name="mensaje" style="width:100%;" rows="5"></textarea><br>
		          	<input type="submit" name="newfb" style="display:block;margin:auto;" />
		          </td>
		        </tr>
		      </table>
		    </form>
		    </div></div>';

		if(isset($_SESSION)) 
		{
			session_destroy();
		}

?>