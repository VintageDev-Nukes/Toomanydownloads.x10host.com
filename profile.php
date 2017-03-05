<?php 

session_start();

$uid = @$_GET['id'];
$current_action = @$_GET['action'];

if(isset($uid) && $current_action != 'account') {

$get_user_query = mysql_query("SELECT * FROM users WHERE id='$uid'");

if(!mysql_num_rows($get_user_query))
{
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
}

$row = mysql_fetch_array($get_user_query);

$urefernum =  mysql_num_rows(mysql_query("SELECT * FROM users WHERE refer_id='$uid'"));
(int)$upoints = $row['points'];
(int)$umoney = $row['money'];
(int)$ulvl = $row['lvl'];
(int)$uexp = $row['exp'];
$uacc_prior = $row['acc_prior'];
(int)$uremainingvisits = $row['remainingvisits'];
(int)$umultiplier = $row['multiplier'];
(int)$uvisitas = $row['numvsts'];
(int)$udiscount = $row['discount'];
(int)$ulastclaim = $row['lastclaim'];
(int)$uregday = $row['datetime'];
(int)$ulastconn = $row['lastconn'];
(int)$ureg_days = round((time() - $uregday) / 86400);
$uavatar = $row['avatar'];
$urealname = $row['realname'];
(int)$ugender = $row['gender'];
$uip = $row['ip_address'];
$up_txt = $row['personal_text'];
$uheader_banner = $row['header_banner'];
$ubirth = $row['birthdate'];
$ulocation = $row['location'];
$umail = $row['mail'];
$uskype = $row['skype'];
$utweb = $row['website_title'];
$uuweb = $row['website_url'];

if($uacc_prior == -3)
{
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
}

$nick = "";
$user_id = $row['id'];

if($row['nickname'] == null) 
{
  	$nick = '#user'.$user_id;
} else 
{
  	$nick = $row['nickname'];
}

$avatarstr = "";

if($uavatar == null) {
	$avatarstr = 'imgs/user.png';
} else {
	$avatarstr = $uavatar;
}

$genderstr = "";

if($ugender == 1) {
	$genderstr = 'imgs/male.png';
} else if($ugender == 2) {
	$genderstr = 'imgs/female.png';
}

$bannerstr = '';
$tablestr = '';

if($uheader_banner != null) {
	$bannerstr = 'background: url('.$uheader_banner.'); height: 500px;background-size: 100% 100%;';
	$tablestr = 'style="position: absolute;bottom: 0px;"';
}

	/*echo '<div class="union" style="margin-top:20px;width:80%;margin-left:10%;">
  <div class="box_title" style="text-align:left;box-shadow: 0px 0px 0px;border-radius: 0px;">
    <span style="padding-left:10px;font-weight:bold;">'.$nick.'</span>
  </div>
  <table style="width:100%;"><tr>
  <td style="width:128px;background: #fff;border: 1px #000 solid;height: 128px;"><img src="imgs/user.png" style="display: block;margin: auto;"></td>
  <td style="background: #fff;border: 1px #000 solid;vertical-align: top;">
	<h1 style="margin: 5px 0px 5px 10px;color:#000;">'.$nick.'</h1>
	</td></tr></table>
</div>';*/

$statecolor = "transparent";

if((time() - $ulastconn) < 600 && $uacc_prior >= -1) {
	$statecolor = "#00ff00";
}

if(isset($success)) 
{
    echo '<div class="success">'.$success.'</div>';
}

echo '<table style="margin-top:20px;width:80%;margin-left:10%;">
	<tr>
		<td style="width:100%;" colspan="2">
			<div class="union">
				<div class="box_title" style="text-align:left;">
					<span style="padding-left:10px;font-weight:bold;">'.$nick.'</span>
				</div>
				<div class="contenido">
					<div class="inside">
					  <div style="padding-left:10px;color:#555;font-size:11px;text-shadow:0 0 0;font-size:12px; '.$bannerstr.'" class="boxinside"> <!--- style="position:relative; height:16px;float:right;margin-top: -3px;"> -->
					  <table '.$tablestr.'>
					  	<tr>
					  		<td>
						  		<div style="position: relative;z-index: 2;top: 15px;margin-bottom: 25px;" onmouseover="javascript:show(\'chga\');" onmouseout="javascript:hide(\'chga\');">
							  		<div style="width: 127px;height: 129px;border: 9px '.$statecolor.' solid;margin: 0 0 45px 23px;border-radius: 20px;position: relative;top: -20px;"></div>
							  		<img src="'.$avatarstr.'" style="display: block;margin: -198px 0 0 32;width: 126px;height: 126px;position: relative;top: -4px;">
							  		<img src="imgs/msn-frame.png" style="margin: -213px 0 0 0;position: relative;top: 51px;">';

							  		if($acc_prior > getprior("free") && $uid == $id) {
							  			echo '<div class="changeavatar" id="chga" style="display:none;position: absolute;"><a href="#t" name="t" onclick="javascript:show(\'changeavatar\');">Cambiar</a></div>';
								  		echo '<form id="changeavatar" method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/AccountManager.php" style="display:none;position: absolute;">
												<div class="new_avatar" style="position: absolute;min-width: 300px;max-width: 900px;width: 30%;margin-top: 15px;margin-left: -28px;z-index: 1;padding: 5px;font-size:12px;">
													<div class="pointer"></div>
													<div class="pointerBorder" style="display: none"></div>
													<span style="display: block;theight: 100%;"><h2 style="margin: 0px;">Url de tu avatar:</h2><input type="text" name="newavatar" style="width:85%;" /><img src="imgs/valid.png" style="position: relative;top: 6px;margin-left: 10px;" onclick="javascript:submitformbyid(\'changeavatar\');" /></span>
												</div>
											  </form>';
							  		}

						  		echo '</div>
					  		</td>
					  		<td>
					  	<div style="position: relative;float: right;margin-top: -5px;height: 16px;">'; 

						  if($ugender != null) {
						  	echo '<img src="'.$genderstr.'" style="position: absolute;left: -34px;top: 3px;" />';
						  }

					  echo '<img src="imgs/blank.gif" title="'.getLocationInfoByIp($uip)['country'].'" class="flag '.strtolower(getLocationInfoByIp($uip)['countryCode']).' fnone" style="position: absolute;left: -13px;bottom: 0px;"></div>
						</div>
						<table style="font-size:10px;position: relative;top: 18px;">
							<tr>
								<td>
									<h1 style="margin: 5px 0px 5px 0px;color:#ddd;">'.$nick.'</h1>
										Miembro desde hace '.strdate($uregday).'<br>
										<span style="color:#acacac;">Última conexión hace '.strdate($ulastconn).'</span>
									</td>
									<td>
									<form id="upt_ptxt" method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/AccountManager.php" style="display:none;position: absolute;">
										<div class="personal_txt" style="position: absolute;min-width: 300px;max-width: 900px;width: 30%;margin-top: -38px;margin-left: 16px;z-index: 1;padding: 5px;font-size:12px;">
											<div class="pointer"></div>
											<div class="pointerBorder" style="display: none"></div>
											<span style="display: block;text-align: center;height: 100%;line-height: 57px;"><textarea name="new_ptxt" rows="3" style="font-size:12px;width:85%;">'.$up_txt.'</textarea><img src="imgs/valid.png" style="position: relative;top: -16px;margin-left: 10px;" onclick="javascript:submitformbyid(\'upt_ptxt\');" /></span>
										</div>
									</form>';


									if($up_txt != null) {
										echo '<div id="personal_txt" class="personal_txt" style="position: absolute;min-width: 300px;max-width: 900px;width: 30%;margin-top: -38px;margin-left: 16px;z-index: 1;padding: 5px;font-size:12px;">
												<div class="pointer"></div>
												<div class="pointerBorder" style="display: none"></div>
												<div style="float:right;"><a href="#t" name="t" onclick="javascript:show(\'upt_ptxt\')+hide(\'personal_txt\');"><img title="Editar texto personal" src="imgs/page_edit.png"></a></div>
												<div style="display: table;text-align: center;width: 100%;"><span style="display: table-cell;vertical-align: middle;">'.nl2br($up_txt).'</span></div>
											</div>';
									}
								echo '</td></tr>
							</table>

						<div style="width:100%;height:40px;background: rgba(0, 0, 0, 0.6);margin: 10px -206px;padding-left: 196px;padding-right: 18px;position: relative;top: 15px;margin-bottom:20px;">
							<table style="width:100%;height:100%;" class="profile-bar-stats">
								<tr>
									<td style="width:10%;">
										<span title="'.number_format($upoints, 0, ',', '.').' points">'.specialnumformat($upoints).'</span>
										<span>points</span>
									</td>
									<td style="width:10%;">
										<span>'.specialnumformat($umoney).'</span>
										<span>dollars</span>
									</td>
									<td style="width:10%;">
										<span title="'.specialnumformat($uexp).' Exp">'.$ulvl.'</span>
										<span>niveles completados</span>
									</td>
									<td style="width:10%;">
										<span>'.specialnumformat($urefernum).'</span>
										<span>referidos</span>
									</td>
									<td style="width:10%;">
										<span>'.specialnumformat($uvisitas).'</span>
										<span>visitas recibidas</span>
									</td>
								</tr>
							</table>
						</div>

							<div style="float:right;">';

							$onclick = array();
							$newclass = 'class="noact profile"';
							$title = 'title="(Sólo disponible en cuentas activadas)"';

							if($acc_prior > getprior("free")) {
								$onclick[0] = 'onclick="javascript:show(\'upt_ptxt\');"';
								$onclick[1] = 'onclick="javascript:show(\'change_banner\');"';
								$newclass = 'class="profilebutton prof"';
								$title = '';
							}

							if($id == $uid) {

								echo '<div class="profilebutton prof"><img src="imgs/user_edit.gif"><a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account">Editar perfil</a></div>';

								if($up_txt == null) {
									echo '<div '.$newclass.'><img src="imgs/page_white_add.png"><a href="#t" name="t" '.$onclick[0].' '.$title.'>Añadir texto personal</a></div>';
								}
								if($uheader_banner == null) {
									echo '<div '.$newclass.'><img src="imgs/image_add.png"><a href="#t" name="t" '.$onclick[1].' '.$title.'>Añadir imagen al banner</a></div>';
									
								} else {
									echo '<div '.$newclass.'><img src="imgs/image_edit.png"><a href="#t" name="t" '.$onclick[1].' '.$title.'>Editar banner</a></div>';
								}

								echo '<form id="change_banner" method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/AccountManager.php" style="display:none;position: absolute;">
									<div id="img-edit" style="position: absolute;width: 300px;margin-top: 21px;z-index: 1;padding: 5px;font-size: 12px;">
												<div class="pointer"></div>
												<div class="pointerBorder" style="display: none"></div>
												<span style="display: block;height: 100%;"><h2 style="margin: 0px; height: 6px;">Url de tu banner:</h2><br><input type="text" name="new_banner" style="width:85%;" /><img src="imgs/valid.png" style="position: relative;top: 6px;margin-left: 10px;" onclick="javascript:submitformbyid(\'change_banner\');" /></span>
											</div>
									</form>';
							} else {

								echo '
									<div '.$newclass.' '.$title.'><img src="imgs/user_add.gif"><span>Añadir como amigo</span></div>
									<div '.$newclass.' '.$title.'><img src="imgs/mail-send.png"><span>Enviar mensaje</span></div>
									<div class="profilebutton prof"><img src="imgs/report.png"><span><a href="http://toomanydownloads.x10host.com/index.php?action=report&id='.$uid.'">Reportar usuario</a></span></div>';

							}

						echo '</div>
					  </td>
					  	</tr>
					  		</table>
					</div>
				</div>
			</div>
		</td>
	</tr>';

echo '<tr>
		<td style="width:100%;" colspan="2">
<div class="union">
	<div class="box_title" style="text-align:left;">
		<span style="padding-left:10px;font-weight:bold;">Sobre mí</span>
	</div>
	<div class="contenido">
		<div class="inside">';

		$strrealname = '';
		$strgender = '';
		$stryears = '';
		$strlocat = '';
		$strname = '';
		$strmail = '';
		$strskype = '';
		$strweb = '';
		$strutxt = '';

		if($urealname != null) {
			$strrealname = ' que se llama '.$urealname;
		}

		if($ugender == 0) 
		{
			$strgender = 'una persona';
		} else if($ugender == 1)
		{
			$strgender = 'un chico';
		} else if($ugender == 2) 
		{
			$strgender = 'una chica';
		}

		if($ubirth != 1) 
		{
			$stryears = ' de '.strdate($ubirth);
		}

		if($ulocation != null)
		{
			$strlocat = ' de '.$ulocation;
		}

		if($umail != null) 
		{
			$strmail = '<br>Mi correo electrónico es '.$umail;
			if($uskype == null) {
				$strmail .= '.';
			}
		}

		if($uskype != null) 
		{
			if($umail == null) {
				$strskype = '<br>Mi Skype es '.$uskype.'.';
			} else {
				$strskype = ' y mi Skype es '.$uskype.'.';
			}
		}

		if($utweb != null && $uuweb != null) 
		{
			$strweb = '<br>Actualmente, tengo una web que se llama '.$utweb.' y su enlace es: <a href="'.$uuweb.'" target="_nofollow">'.$uuweb.'</a>.';
		}

		if($up_txt != null) 
		{
			$strutxt = '<br>Me gustaría decir que... <i>'.$up_txt.'</i>.';
		}

		echo 'Soy '.$strgender.$strrealname.$stryears.$strlocat.' que actualmente reside en '.getLocationInfoByIp($uip)['country'].'.<br>Soy miembro de esta comunidad desde hace '.strdate($uregday).' y me contecté por última vez hace '.strdate($ulastconn).'.'.$strmail.$strskype.$strweb.$strutxt;

		echo '</div>
	</div>
</div>
</td>
</tr>';

echo '<tr>
<td style="width:80%;vertical-align:top;" rowspan="2">
  <div class="union">
	<div class="box_title" style="text-align:left;">
		<span style="padding-left:10px;font-weight:bold;">Última actividad de este usuario</span>
	</div>
	<div class="contenido">
		<div class="inside">
			<div class="boxinside">';

		$report_query = mysql_query("SELECT * FROM report WHERE user_id='$uid'");

		if(mysql_num_rows($report_query)) {
			while($rs = mysql_fetch_array($ticketquery)) {	
				echo '<div class="'.$rs['type'].'">'.$rs['message'].'</div>';
			}
		} else {
			echo 'No hay actividad reciente de este usuario.';
		}
				
			echo '</div>
		</div>
	</div>
</div>
</td>
<td style="width:20%;">
<div class="union" style="margin-bottom:10px;">
	<div class="box_title" style="text-align:left;">
		<span style="padding-left:10px;font-weight:bold;">Medallas</span>
	</div>
	<div class="contenido">
		<div class="inside">

		</div>
	</div>
</div>
  <div class="union" style="margin-bottom:10px;">
	<div class="box_title" style="text-align:left;">
		<span style="padding-left:10px;font-weight:bold;">Amigos</span>
	</div>
	<div class="contenido">
		<div class="inside">

	</div>
  </div>
</div>
</td>
</tr>
</table>';

}

if($current_action == 'account') 
{

if(isset($_SESSION)) {
  $success = $_SESSION['success'];
  $dataerrors = $_SESSION['errors'];
  $emailerrors = $_SESSION['email_errors'];
  $codeerrors = $_SESSION['code_errors'];
  $claimemerror = $_SESSION['claim_email_error'];
  $claimiderror = $_SESSION['claim_id_error'];
  $claimpasserror = $_SESSION['claim_pass_error'];
  $avatarerrors = $_SESSION['avatar_errors'];
  $rnameerrors = $_SESSION['real_name_errors'];
  $gendererrors = $_SESSION['gender_errors'];
  $birtherrors = $_SESSION['birth_errors'];
  $locaterrors = $_SESSION['location_errors'];
  $mailerrors = $_SESSION['mail_errors'];
  $skypeerrors = $_SESSION['skype_errors'];
  $tweberrors = $_SESSION['title_web_errors'];
  $uweberrors = $_SESSION['url_web_errors'];
}

$id = getmyreferid();

$emailstring = $email;
$codestring = '';

if(empty($email)) {
  $emailstring = 'Ninguno';
}

if(empty($code)) {
  $codestring = '<b style="color:red;">No seguro</b>';
} else 
{
  $codestring = '<b style="color:green;">Seguro</b>';
}

$actstr = 'class="profilebutton"';
$link = array();
$link_close = '';

if($acc_prior <= getprior("free")) {
	$actstr = 'class="noact" title="(Sólo disponible en cuentas activadas)"';
} else {
	$link_close = '</a>';
	$link[0] = '<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=info">';
}

echo '<table class="accounttable" style="margin-top:20px;width:80%;margin-left:10%;">
	<tr>
		<td>
			<div class="union">
				<div class="box_title">
					Cuenta
				</div>
				<div class="contenido">
				  <div class="inside" style="text-align:center;">
				  	<div class="profilebutton"><a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account">Ver cuenta</a></div>
				  </div>
				</div>
			</div>
			<div class="union">
				<div class="box_title">
					Editar perfil
				</div>
				<div class="contenido">
				  <div class="inside" style="text-align:center;">
				  	<div class="profilebutton"><a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=conf">Conf. de la cuenta</a></div>
				  	<div '.$actstr.' style="display:block!important;">'.$link[0].'Info. de la cuenta'.$link_close.'</div>
				  </div>
				</div>
			</div>
		</td>
		<td>';

$edit = @$_GET['edit'];

if($edit == 'conf') {

	echo '<form id="form1" name="form1" method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/AccountManager.php">
	<div class="union">
				<div class="box_title">
					Editar perfil
				</div>
				<div class="contenido">
				  <div class="inside" style="text-align:center;">';

				    if(isset($dataerrors) && $dataerrors != array()) //&&  (empty($emailerrors) || empty($codeerrors) || empty($claimemerror) || empty($claimiderror) || empty($claimpasserror)) 
				    {
				      echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($dataerrors).'</div>';
				    } else if(isset($success)) 
				    {
				      echo '<div class="success">'.$success.'</div>';
				    }

				  	echo '<table width="80%" align="center" class="tbl">
				  		<tr>
				            <td align="center" class="sub" colspan="2">
				              <h4>
				                Actualiza tu email
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Nuevo email
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($emailerrors) && $emailerrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($emailerrors).'</div>';
				            }

				              echo '<input type="text" name="updateemail" value="">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="2">
				              <input type="submit" name="newemail" value="Actualizar email">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="4">
				              <h4>
				                Actualiza tu código de seguridad
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Nuevo código
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($codeerrors) && $codeerrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($codeerrors).'</div>';
				            }

				              echo '<input type="password" name="updatecode" value="">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="2">
				              <input type="submit" name="newcode" value="Actualiza tu código">
				            </td>
				          </tr>';

				          if($acc_prior < getprior('ureg')) {

					           echo '<tr>
					            <td align="center" class="sub" colspan="2">
					              <h4>
					                ¿Tu IP ha sido cambiada? Reclama aquí tus puntos
					              </h4>
					            </td>
					          </tr>
					          <tr>
					            <td align="center" class="tbl">
					              <h3>
					                ID de tu antigua cuenta
					              </h3>
					            </td>
					            <td align="center" class="tbl">';

					            if(isset($claimiderror) && $claimiderror != array()) {
					              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($claimiderror).'</div>';
					            }

					              echo '<input type="text" name="oldid" value="">
					            </td>
					          </tr>
					          <tr>
					            <td align="center" class="tbl">
					              <h3>
					                Email de la antigua cuenta
					              </h3>
					            </td>
					            <td align="center" class="tbl">';

					            if(isset($claimemerror) && $claimemerror != array()) {
					              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($claimemerror).'</div>';
					            }

					              echo '<input type="text" name="oldemail" value="">
					            </td>
					          </tr>
					          <tr>
					            <td align="center" class="tbl">
					              <h3>
					                Antiguo código de seguridad
					              </h3>
					            </td>
					            <td align="center" class="tbl">';

					            if(isset($claimpasserror) && $claimpasserror != array()) {
					              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($claimpasserror).'</div>';
					            }

					              echo '<input type="password" name="oldcode" value="">
					            </td>
					          </tr>
					          <tr>
					            <td align="center" class="sub" colspan="2">
					              <input type="submit" name="claimp" value="Reclamar puntos">
					            </td>
					          </tr>';

				      	  }

				echo '</tr>
				</table>
			</div>
		</div>
	</div>
</form>';

} else if($edit == 'info') {

echo '<form id="form1" name="form1" method="post" action="http://'.$_SERVER['SERVER_NAME'].'/forms/AccountManager.php">
	<div class="union">
				<div class="box_title">
					Editar perfil
				</div>
				<div class="contenido">
				  <div class="inside" style="text-align:center;">';

				    if(isset($dataerrors) && $dataerrors != array()) //&&  (empty($emailerrors) || empty($codeerrors) || empty($claimemerror) || empty($claimiderror) || empty($claimpasserror)) 
				    {
				      echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($dataerrors).'</div>';
				    } else if(isset($success)) 
				    {
				      echo '<div class="success">'.$success.'</div>';
				    }

				  	echo '<table width="80%" align="center" class="tbl">';
				  		/*<tr>
				            <td align="center" class="sub" colspan="2">
				              <h4>
				                Avatar
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Nuevo avatar
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($avatarerrors) && $avatarerrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($avatarerrors).'</div>';
				            }

				              echo '<input type="text" name="updateavatar" value="" placeholder="URL de tu avatar">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="2">
				              <input type="submit" name="newavatar" value="Actualizar avatar">
				            </td>
				          </tr>*/
				          echo '<tr>
				            <td align="center" class="sub" colspan="4">
				              <h4>
				                Más sobre mí
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Nombre completo
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($rnameerrors) && $rnameerrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($rnameerrors).'</div>';
				            }

				              echo '<input type="text" name="realname" size="20" value="" placeholder="Su nombre real">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Fecha de nacimiento
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($birtherrors) && $birtherrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($birtherrors).'</div>';
				            }

				              echo '<input type="text" name="birthday" size="2" value="" maxlength="2" placeholder="00"> <span style="display:inline-block;margin:0 auto;">-</span> 
				              <input type="text" name="birthmonth" size="2" value="" maxlength="2" placeholder="00"> <span style="display:inline-block;margin:0 auto;">-</span> 
				              <input type="text" name="birthyear" size="4" value="" maxlength="4" placeholder="0000">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Género
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($gendererrors) && $gendererrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($gendererrors).'</div>';
				            }

				              echo '<div style="position: relative;top: 8px;">
				              	<select name="gender">
					              <option disabled selected>Género</option>
					              <option value="1" data-image="imgs/male.png">Masculino</option>
					              <option value="2" data-image="imgs/female.png">Femenino</option>
				              	</select>
				              </div>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Ubicación
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($locaterrors) && $locaterrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($locaterrors).'</div>';
				            }

				              echo '<input type="text" name="ubication" value="" placeholder="¿Dónde vives?">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="4">
				              <h4>
				                Mi información cibernaútica
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Correo de contacto
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($mailerrors) && $mailerrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($mailerrors).'</div>';
				            }

				              echo '<input type="text" name="updatemail" placeholder="Tu correo electrónico">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Skype
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($skypeerrors) && $skypeerrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($skypeerrors).'</div>';
				            }

				              echo '<input type="text" name="updateskype" placeholder="Tu Skype">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="4">
				              <h4>
				                Tu sitio web
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Título de tu sitio web
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($tweberrors) && $tweberrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($tweberrors).'</div>';
				            }

				              echo '<input type="text" name="updatewebtitle" placeholder="El nombre de tu web">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Url de tu sitio web
				              </h3>
				            </td>
				            <td align="center" class="tbl">';

				            if(isset($uweberrors) && $uweberrors != array()) {
				              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($uweberrors).'</div>';
				            }

				              echo '<input type="text" name="updateweburl" placeholder="El enlace de tu web">
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="sub" colspan="2">
				              <input type="submit" name="newpersinfo" value="Actualiza tu información personal">
				            </td>
				          </tr>
				      </tr>
				</table>
			</div>
		</div>
	</div>
</form>';


} else if(empty($edit)) {

		echo '
			<div class="union">
				<div class="box_title">
				Detalles de la cuenta
				</div>
				<div class="contenido">
				  <div class="inside" style="text-align:center;">
				      
				    Por favor, recuerda tu ID de la cuenta, email y código de seguridad por si los necesitases para recuperar tus puntos si tu IP cambia o si usas una IP dinámica.

				    <br><br>';

				  	echo '<table width="80%" align="center" class="tbl">
				        <tbody>
				          <tr>
				            <td align="center" class="sub" colspan="2">
				              <h4>
				                Información de tu cuenta
				              </h4>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                ID de usuario
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3>
				                '.$id.'
				              </h3>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Código de seguridad
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3>
				                Código de seguridad - '.$codestring.'
				              </h3>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Link de referido
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3>
				                http://'.$_SERVER['SERVER_NAME'].'/?ref='.$id.'
				              </h3>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Tu email
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3>
				                '.$emailstring.'
				              </h3>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Tus puntos
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3 title="'.getmypoints(false, true, true, false).'">
				                '.str_replace(' points', '', getmypoints(true)).'
				              </h3>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Fecha de registro
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3>
				                '.date('d-m-Y', $datetime).'
				              </h3>
				            </td>
				          </tr>
				          <tr>
				            <td align="center" class="tbl">
				              <h3>
				                Tu IP
				              </h3>
				            </td>
				            <td align="center" class="tbl">
				              <h3>
				                '.$ip.'
				              </h3>
				            </td>
				          </tr>
				        </tbody>
				      </table>
				    </form>
				  </div>
				 </div>
				</div>
			</td>
		</tr>
	</table>';

}

echo '	</td>
	</tr>
</table>';

//Una vez mostrado todo, destruir la sesion
session_destroy();

}

?>