<?php

echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
								<div class="box_title" style="text-align:left;padding-left:10px;">
									Comparte tu juego
								</div>
							<div class="contenido">
								<div class="inside">
									<h1 style="color:#fff!important;">Gana rango colaborador 2000 puntos y 5$.</h1>';

		echo '<form method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/ItemManager.php">';

		if(isset($errors['empty_name'])) 
		{
			echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['empty_name'].'</div>';
		}
		
		echo '<b>Nombre:</b><br>
		<input type="text" name="name" id="name" maxlength="100" size="30" style="width:100%;" /><br><br>';

		if(isset($errors['empty_description'])) 
		{
			echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['empty_description'].'</div>';
		}

		echo '<b>Descripción:</b><br>
		<input type="text" name="description" id="description" maxlength="500" size="30" style="width:100%;" /><br><br>';

		if(isset($errors['empty_url'])) 
		{
			echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['empty_url'].'</div>';
		}

		echo '<b>Lista de Urls:</b><br>
		<textarea type="text" name="url" id="url" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

		if(isset($errors['empty_thumb'])) 
		{
			echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['empty_thumb'].'</div>';
		}

		echo '<b>Miniatura:</b><br>
		<input type="text" name="thumb" id="thumb" maxlength="500" size="30" style="width:100%;" /><br><br>';

		echo '<b>Puntos mínimos requeridos:</b><br>
		<input type="number" name="points" id="points" value="0" size="30" min="0" style="width:213px;" /><br><br>';

		if(isset($errors['empty_captcha'])) 
		{
			echo '<div class="error" style="width:300px;margin:5px 0 5px 0;">'.$errors['empty_captcha'].'</div>';
		}

		if(isset($errors['wrong_captcha'])) 
		{
			echo '<div class="error" style="width:100px;margin:5px 0 5px 0;">'.$errors['wrong_captcha'].'</div>';
		}

		echo '<b>Captcha:</b><br>
		<img src="http://'.$_SERVER['SERVER_NAME'].'/captcha/captcha.php"/><br>
		<input type="text" name="vercode" style="margin-left: 0px;width: 80px;" /><br><br>';

		echo '<input type="hidden" name="sended_by" value="'.$id.'" />
		<input name="newitem" type="submit" value="Enviar" style="display:block;margin:auto;" />';

		echo '</form>
			</div>
		</div>
	</div>';

?>