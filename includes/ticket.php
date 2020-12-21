<?php 

session_start();

if(isset($_SESSION)) {
	$success = $_SESSION['success'];
	$errors = $_SESSION['form_errors'];
}

$go = @$_GET['go'];
if(empty($go)){$go='mytickets';}

$ticket_id = 0;
$creator_id = 0;
$state = "";

if($go == 'mytickets') 
{

	echo '<div class="contenido">
	<div class="inside">';

	if(isset($_SESSION['success'])) 
	{
		echo '<div class="success" style="width:250px;">'.$success.'</div>';
		session_destroy();
	}

	echo '<div class="boxinside">

	<h3 style="margin:0 0 10px 0;">Tus tickets:</h3>';

	$query = "SELECT * FROM ticket WHERE user_id='$id' AND state != 'erased' ORDER BY creation DESC";
	$result = mysqli_query($db, $query) or die(mysqli_error());

	if(mysqli_num_rows($result)) {
		echo '<table cellspacing="0" class="showtickets"><tr class="showticketheader"><td style="width: 75%;">Ticket</td><td style="width: 100px;text-align: center;">Nº de respuestas</td><td style="width: 120px;text-align: center;">Última respuesta</td></tr>';
	  	while($rs=mysqli_fetch_array($result)) {
			echo'<tr class="ticketlist"><td><a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=ticket&go=show&id='.$rs['id'].'">'.$rs['titulo'].'</a></td><td></td><td></td></tr>'; 
		}
		echo '</table>';
	} else {
		echo 'Actualmente no tienes ningún ticket. <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=ticket&go=create"><u>Haz click aquí para crear uno</u></a>.';
	}

	echo '</div>';

		echo '</div>
</div>';

} else if($go == 'create') 
{

	echo '<div class="contenido">
	<div class="inside">';

echo '<h1 style="text-align:center;color:#fff!important;">Crear ticket</h1><br>

<form method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/TicketManager.php">';

	if(isset($errors['empty_title'])) 
	{
		echo '<div class="error" style="width:100%;margin:5px 0 5px 0;">'.$errors['empty_title'].'</div>';
	}

	echo '<h3 style="margin:0px;">Título:</h3><input name="title" type="text" size="20" style="width:100%;" />
	<br><br>';

	if(isset($errors['empty_content'])) 
	{
		echo '<div class="error" style="width:100%;margin:5px 0 5px 0;">'.$errors['empty_content'].'</div>';
	}

	echo '<h3 style="margin:0px;">Contenido:</h3>
	<textarea name="content" rows="10" style="width:100%;"></textarea>
	<br><br>';

	if(isset($errors['empty_captcha'])) 
	{
		echo '<div class="error" style="width:300px;margin:5px 0 5px 0;">'.$errors['empty_captcha'].'</div>';
	}

	if(isset($errors['wrong_captcha'])) 
	{
		echo '<div class="error" style="width:100px;margin:5px 0 5px 0;">'.$errors['wrong_captcha'].'</div>';
	}

	echo '<h4 style="margin:0px;">Captcha:</h4>
	<img src="http://'.$_SERVER['SERVER_NAME'].'/captcha/captcha.php"/><br>
	<input type="text" name="vercode" style="margin-left: 0px;width: 80px;" /><br><br>
	<input type="submit" name="newticket" value="Enviar" style="display:block;margin:auto;" />
</form>';

	echo '</div>
</div>';

} else if($go == 'show') 
{

	(int)$ticket_id = mysqli_real_escape_string($db, $_GET['id']);

	setreaded("ticket_".$ticket_id);

	$get_creator_query = mysqli_query($db, "SELECT user_id as user_id, state as state FROM ticket WHERE id='$ticket_id'");
	
	if(!mysqli_num_rows($get_creator_query)) {
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
	}

	$row = mysqli_fetch_array($get_creator_query);
	$creator_id = $row['user_id'];
	$state = $row['state'];

	$row = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE id='$id'"));
	(int)$creator_points = $row['points'];
	(int)$creator_money = $row['money'];
	(int)$creator_exp = $row['exp'];
	(int)$creator_lvl = $row['lvl'];
	/*$creator_acc_prior = $row['acc_prior'];
	(int)$remainingvisits = $row['remainingvisits'];
	(int)$multiplier = $row['multiplier'];
	(int)$visitas = $row['numvsts'];
	(int)$discount = $row['discount'];
	(int)$lastclaim = $row['lastclaim'];
	(int)$reg_days = round((time() - $row['datetime']) / 86400);

	$acc_prior_string = "";

	if($acc_prior == getprior("free")) 
	{
		$acc_prior_string = "<b style='color:indianred;'>FREE</b>";
	} else if($acc_prior == "prem")
	{
		$acc_prior_string = "<b style='color:green;'>PREMIUM</b>";
	} else if($acc_prior = "vip")
	{
		$acc_prior_string = "<b style='color:green;'>VIP</b>";
	}*/


	if(($acc_prior == getprior("admi") || $creator_id == $id) && ($state == 'opened' || $state == 'closed')) {

		$row = mysqli_fetch_array(mysqli_query($db, "SELECT nickname FROM users WHERE id='$creator_id'"));

		$nick = "";
		$user_id = $row['user_id'];

		if($row['nickname'] == null) 
		{
		  	$nick = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$user_id.'" target="_blank"><u>Usuario #'.$user_id.'</u></a>';
		} else 
		{
		  	$nick = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$cur_id.'" target="_blank"><u>'.$row['nickname'].'</u></a>';
		}
		  		
		$ticketquery = mysqli_query($db, "SELECT * FROM ticket WHERE id='$ticket_id'");

		while($rs = mysqli_fetch_array($ticketquery)) {
			
			echo '<script>
				function setvalues(id, value) {
					document.getElementById(id).value = value;
				}
			</script>';

			if($acc_prior >= getprior('mod')) {
				echo '<form id="changeticket" action="http://'.$_SERVER['SERVER_NAME'].'/forms/ChangeTicketStatus.php" method="post">
					<input type="hidden" id="delete_id" name="delete_id" />
					<input type="hidden" id="close_id" name="close_id" />
				</form>';
			}

				echo '<table class="ticketbody">
				<tr>
					<td style="width:150px;">
						<div class="union">
							<div class="box_title">
								Autor
							</div>
						<div class="contenido">
							<div class="inside" style="text-align:center;">';

								echo '<h3 style="color:#fff!important;">'.$nick.'</h3>';

					echo '<img src="../imgs/user.png" style="display:block;width: 96px;height: 96px;margin: 10px auto;box-shadow: 0px 0px 10px #fff;">

			<div class="groupbutton" style="height:40px;margin: 0 5px 5px 0;">
				<div class="iconbutton"><img src="../imgs/lvl.gif" style="width:16px;height:16px;margin-top:12px;" /></div>
				<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="' .number_format($creator_exp, 0, ',', '.').' Exp"]">Nivel '.$creator_lvl.'</a></div>
			</div>

			<div class="groupbutton" style="height:40px;margin: 0 5px 5px 0;">
			<div class="iconbutton">';

				if(getmypoints(false, false) >= 10000000) {
					echo '<img title="Platino" src="../imgs/point-platinum.png" style="margin-top:12px;" />';
				} else if(getmypoints(false, false) >= 100000) {
					echo '<img title="Oro" src="../imgs/point-gold.png" style="margin-top:12px;" />';
				} else if(getmypoints(false, false) >= 1000) {
					echo '<img title="Plata" src="../imgs/point-silver.png" style="margin-top:12px;" />';
				} else {
					echo '<img title="Cobre" src="../imgs/point-bronze.png" style="margin-top:12px;" />';
				} 

			echo '</div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="'.number_format($creator_points, 0, '.', ',').' [Media por día: '.round($creator_points/$reg_days, 1).' puntos]">'.specialnumformat($creator_points). ' points</a></div>
		</div>

		<div class="groupbutton" style="height:40px;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="../imgs/coins.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Cantidad de dinero [Media por día: ' .round($creator_money/$reg_days, 1).'$]">'.$money.'$</a></div>
		</div>

					</div>
				</div>
				</div>
				</td>
				<td>
				<div class="union">
				<div class="box_title" style="text-align:left;">
					<span style="padding-left:10px;">Ticket: '.$rs['titulo'].'</span>';

					echo '<span style="float:right;padding-right:10px;padding-top:7px;">';

					if($acc_prior >= getprior('mod')) {
						echo '<a href="#" onclick="javascript:setvalues(\'close_id\', \''.$ticket_id. '\""; 
						echo '<a href="#" onclick="javascript:setvalues(\'delete_id\', \''.$ticket_id.'\')+submitformbyid(\'changeticket\');"><img src="imgs/trash.png" title="Borrar este ticket" /></a>'; 
					}

					echo '</span>';


				echo '</div>
				<div class="contenido">
					<div class="inside">';

						echo '<table style="font-size:12px;">
								<tr>
									<td>';

										if($state == 'opened') {
											echo '<img title="Ticket abierto" src="imgs/unlocked.png" />';
										} else {
											echo '<img title="Ticket cerrado" src="imgs/locked.png" />';
										}

									echo '</td>
									<td>
										<b>'.$rs['titulo'].'<b><br>'.'« hace '.strdate($rs['creation']).' »
									</td>
								</tr>
							</table>
							<hr>';

						echo $rs['contenido'];

					echo '</div>
				</div>
				</div>
				</td></tr></table>';

		}

		$commentsquery = mysqli_query($db, "SELECT * FROM ticket_comments WHERE ticket_id='$ticket_id'") or die('Error: '.mysqli_error());

		if(mysqli_num_rows($commentsquery)) {
			$times = 0;
			while($rs=mysqli_fetch_array($commentsquery)) {

						$commenter_id = $rs['user_id'];
						$row = mysqli_fetch_array(mysqli_query($db, "SELECT nickname FROM users WHERE id='$commenter_id'"));

						$nickname = "";

						if($row['nickname'] == null || $row['acc_prior'] == 'admi') 
						{
						  	$nickname = 'Agente de soporte';
						} else if($commenter_id == $id)
						{
						  	$nickname = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$commenter_id.'" target="_blank"><u>'.$nick.'</u></a>';
						}

						$times++;

						echo '<table class="ticketbody">
						<tr>
						<td>
						<div class="union">
						<div class="box_title" style="text-align:left;">
							<span style="padding-left:10px;">Respuesta #'.$times.'</span>
						</div>
						<div class="contenido">
							<div class="inside">';

								echo '<b>'.$nickname.'<b><br>'.'« hace '.strdate($rs['creation']).' »<hr>';

								echo $rs['contenido'];

							echo '</div>
						</div>
						</div>
						</td>
						</tr>
						</table>';

			}
		}

		//Create new comment

		if($state != 'closed') {

			echo '<form action="http://'.$_SERVER['SERVER_NAME'].'/forms/TicketManager.php" method="post">
					<table class="ticketbody">
						<tr>
						<td>
						<div class="union">
						<div class="box_title" style="text-align:left;padding-left:10px;">
							Crear respuesta
						</div>
						<div class="contenido">
							<div class="inside">';


						if(isset($errors['empty_comment'])) 
						{
							echo '<div class="error" style="width:100%;margin:5px 0 5px 0;">'.$errors['empty_comment'].'</div>';
							session_destroy();
						}

						if(isset($_SESSION['success'])) 
						{
							if(isset($success['comment_created'])) 
							{
								echo '<div class="success" style="width:300px;">'.$success['comment_created'].'</div>';
								session_destroy();
							}
						}

						echo '<textarea name="comment" style="width:100%;margin-bottom:10px;" rows="10"></textarea>
								<input type="hidden" name="ticket_id" value="'.$ticket_id.'" />
								<input name="newcomment" type="submit" value="Enviar" style="display:block;margin:auto;" />
							</div>
						</div>
						</div>
						</td>
						</tr>
					</table>
				  </form>';

		}

	} else if(($acc_prior < getprior("mod") || $creator_id == $id) && $state == 'erased') {
		echo '<div class="contenido">
		<div class="inside">

		<h1 style="color:#fff!important;">Error: Este ticket se encuentra borrado.</h1>

		</div>
	</div>';
	}

} else if($go == 'show' && ($acc_prior < getprior("mod") || $creator_id != $id) && ($state == 'opened' || $state == 'closed' || $state == 'erased')) 
{

		echo '<div class="contenido">
	<div class="inside">

	<h1 style="color:#fff!important;">Error: Este no es tu ticket.</h1>

	</div>
</div>';

} else 
{
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
}

?>