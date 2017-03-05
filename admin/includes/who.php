<?php 

require_once('paginator.class.php');
$pages = new Paginator;

echo '<table class="admintable" cellspacing="0" style="margin-top:20px;">
        <tr>
          <td colspan="2">Tickets revisados</td>
        </tr>
        <tr><td>ID</td><td>Nick</td></tr>';

	$pages->items_total = mysql_num_rows(mysql_query("SELECT * FROM ticket"));
	$pages->mid_range = 7;
	$pages->paginate();

	$now = time();
	$atime = $now - 600;

  $query = "SELECT * FROM users WHERE lastconn > $atime AND acc_prior > -3 ORDER BY lastconn DESC $pages->limit"; //aquí se lee * (todo) de demo
  $result = mysql_query($query) or die(mysql_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

  if(mysql_num_rows($result)) {
    while($rs=mysql_fetch_array($result))  {

		$nick = "";
		$user_id = $rs['id'];

		if($rs['nickname'] == null) 
		{
		  	$nick = '#user'.$user_id;
		} else 
		{
		  	$nick = $rs['nickname'];
		}

      	echo '<tr><td>'.$rs['id'].'</td><td>'.$nick.'</td></tr>';

    }
  } else {
    echo 'No hay ningún resultado.';
  }

  echo '<tr style="background:#333;">
  	<td colspan="2"><div class="paginate">'.$pages->display_pages().'</div></td>
  </tr>
</table>';

?>