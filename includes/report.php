<?php

session_start();

if(isset($_SESSION)) {
	$success = $_SESSION['success'];
	$errors = $_SESSION['form_errors'];
} 

echo '<div class="union" style="margin-top:20px;width:80%;margin-left:10%;">
			<div class="box_title">
				<span style="padding-left:10px;font-weight:bold;">Repotar usuario</span>
			</div>
			<div class="contenido">
				<div class="inside">';

				if(isset($_SESSION['success'])) 
				{
					echo '<div class="success" style="width:550px;">'.$success.'</div>';
					session_destroy();
				}

				echo '<form id="ureporter" method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/UserReport.php">';

				$ruid = @$_GET['id'];

				if(isset($errors['user_not_exists']) && empty($errors['empty_reported'])) 
				{
					echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['user_not_exists'].'</div>';
				}

				if(empty($ruid)) {

					if(isset($errors['empty_reported'])) 
					{
						echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['empty_reported'].'</div>';
					}

					echo '<h3 style="margin:0px!important;color:#fff!important;">ID del usuario:</h3><input type="text" size="30" name="ruid" maxlength="7" placeholder="Escriba la ID del usuario a reportar" /><br><br>';
				
				} else {
					echo '<input type="hidden" name="ruid" value="'.$ruid.'" />';
				}				

				if(isset($errors['empty_content'])) 
				{
					echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">'.$errors['empty_content'].'</div>';
				}

				echo '<h3 style="color:#fff!important;margin:0px;">Razón del reporte:</h3>

				<textarea name="reason" style="width:100%;" rows="5" placeholder="Escriba la razón del reporte."></textarea>
				<br><br>';

				if(isset($_SESSION['success'])) 
				{
					session_destroy();
				}

				if(isset($errors['empty_captcha'])) 
				{
					echo '<div class="error" style="width:300px;margin:5px 0 5px 0;">'.$errors['empty_captcha'].'</div>';
				}

				if(isset($errors['wrong_captcha'])) 
				{
					echo '<div class="error" style="width:100px;margin:5px 0 5px 0;">'.$errors['wrong_captcha'].'</div>';
				}


				if(isset($errors['empty_reported']) || isset($errors['user_not_exists']) || isset($errors['empty_content']) || isset($errors['empty_captcha']) || isset($errors['wrong_captcha'])) 
				{
					session_destroy();
				}

				echo '<h4 style="margin:0px;">Captcha:</h4>
						<img src="http://'.$_SERVER['SERVER_NAME'].'/captcha/captcha.php"/><br>
						<input type="text" name="vercode" style="margin-left: 0px;width: 80px;" /><br><br>
						<input type="submit" name="reported" value="Reportar usuario" style="display:block;margin:auto;" />
						<br>
						<b>Aviso:</b> Todo aquel reporte que no sea de utilidad podrá ser castigado con duras penalizaciones tales como borrado de la cuenta o ban.
					</form>
				</div>
			</div>
		</div>';

?>