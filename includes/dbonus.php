<?php 

echo '<div class="contenido">
	<div class="inside" style="text-align:center;">
		<h1>¡Consigue <b title="'.$givepoints.' puntos">'.specialnumformat($givepoints).' puntos</b> diarios!</h1><br>';

		if(isset($_POST['claimed'])) 
		{
			//Check the last claim
			if(!stilltoday($lastclaim)) 
			{
				setpoints($id, $dailybonus);
				uptlastclaim();
			} else 
			{
				echo '<div class="error">¡Ya has solicitado hoy el último bonus disponible, espera hasta mañana!</div>';
			}

		} else {

			if(stilltoday($lastclaim)) 
			{
				echo '<div class="sucess">Ya has reclamado los puntos diarios de hoy. Vuelve mañana para recibir más.</div><input type="button" value="Reclamar puntos" disabled />';
			} else 
			{

				if($minvisits == 0)
				{
					echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'"><input name="claimed" type="submit" value="Reclamar puntos" /></form>';
				} else 
				{
					echo '<div class="error">Para poder reclamar nada, antes necesitas visitar '.$visitstodo.' personas.<br><br>
					Visitas hechas: '.($visitstodo-$minvisits).'<br>
					Visitas restantes: '.$minvisits.'</div>';
				}

			}

		}

	echo '</div>
</div>';

?>