<?php

include($_SERVER['DOCUMENT_ROOT'].'/motor.php');
connect(); //Set connection

//Set my id (this has to be changed in order of moderation implementation)
(int)$id = getmyreferid();
$ip = $_SERVER["REMOTE_ADDR"];
$multiplier = getmultbyid($id);

//Destroy any session active...
if($_SESSION) {
	session_destroy();
}

//Clear any data in those variables
$success = array();
$errors = array();
$emailerrors = array();
$codeerrors = array();
$claimemerror = array();
$claimiderror = array();
$claimpasserror = array();
$avatarerrors = array();
$rnameerrors = array();
$birtherrors = array();
$gendererrors = array();
$locaterrors = array();
$mailerrors = array();
$skypeerrors = array();
$tweberrors = array();
$uweberrors = array();

//[GLOBAL] Used by all the ifs in that file
$preproceed = true;
$proceed = true; //If there is no error the form can process correctly
$givepoints = true;



if(isset($_POST['newemail']))
{

	//First of all, start a new session.
	session_start();

	//User has setted a new email.

	$activation = md5(uniqid(rand(), true));
	$newemail = mysql_real_escape_string($_REQUEST['updateemail']);

	$row = mysql_fetch_assoc(mysql_query("SELECT email FROM users WHERE id='$id'"));

	if(empty($newemail)) 
	{
		$emailerrors['emptyemail'] = 'Debe introducir un email.';
		$_SESSION['email_errors'] = $emailerrors;
		$preproceed = false;
		$proceed = false;
	}

	if($row['email'] == $newemail && (empty($row['email']) || empty($newemail))) 
	{
		$emailerrors['sameemail'] = 'El email introducido es el mismo que el actual.';
		$_SESSION['email_errors'] = $emailerrors;
		$preproceed = false;
		$proceed = false;
	}

	if($preproceed) {

		if($row['email'] != null) 
		{
			$givepoints = false;
		}

		$emailset = mysql_query("UPDATE users SET email='$newemail' WHERE id='$id'");
		$actset = mysql_query("UPDATE users SET activation='$activation' WHERE id='$id'");

		if(!$emailset) 
		{
			$errors['emailset'] = 'Error: '.mysql_error(); //Show us the error
			$proceed = false; //An error occurred, the $success message won't appear.
		}

		if(!$actset)
		{
			$errors['actset'] = 'Error: '.mysql_error(); //Show us the error
			$proceed = false; //An error occurred, the $success message won't appear.
		}
	}

	if($proceed) 
	{
		//$success = 'Un email de activación será enviado a su correo electrónico.';
		if($givepoints && round(200/$multiplier, 0) < 10) {
			$success = 'Su email ha sido cambiado. En breve, usted recibirá '.round(200/$multiplier, 0).' puntos.';
		} else 
		{
			$success = 'Su email ha sido cambiado.';
		}
		$_SESSION['success'] = $success;
		if($givepoints) {
			givepointsinactivation(round(200/$multiplier, 0));
		}
	} else
	{
		if(isset($errors)) 
		{
			$_SESSION['errors'] = $errors;
		}
	}

	/*$titulo = 'Verificación de email';
	$mensaje = 'Hola,<br><br>gracias por registrarte en nuestra página web, haz click en el siguiente enlace para activar tu cuenta:<br>http://'.$_SERVER['SERVER_NAME'].'/index.php?action=confirm&time='.md5(time()).'&key='.$activation.'<br><br>'.(200/$multiplier).' puntos serán añadidos a su cuenta después de la activación.<br><br>Saludos,<br>el administrador de TooManyDownloads!<br>http://'.$_SERVER['SERVER_NAME'].'/';
	$cabeceras = 'From: noreply@toomanydownloads.com';

	mail($email, $titulo, $mensaje, $cabeceras);

	sleep(3);*/

	//Finally, go to the last position.
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=conf');

}

if(isset($_POST['newcode']))
{

	//First of all, start a new session.
	session_start();

	//User has setted a new code.

	$rawcode = $_REQUEST['updatecode'];
	$newcode = md5($_REQUEST['updatecode']);

	$row = mysql_fetch_assoc(mysql_query("SELECT password FROM users WHERE id='$id'"));

	if(empty($rawcode)) 
	{
		$codeerrors['emptycode'] = 'Debe introducir un código.';
		$_SESSION['code_errors'] = $codeerrors;
		$preproceed = false;
		$proceed = false;
	}

	if($preproceed) {

		if($row['password'] != null) 
		{
			$givepoints = false;
		}

		$codeset = mysql_query("UPDATE users SET password='$newcode' WHERE id='$id'");

		if(!$codeset) 
		{
			$errors['codeset'] = 'Error: '.mysql_error(); //Show us the error
			$proceed = false; //An error occurred, the $success message won't appear.
		}

	}

	if($proceed) 
	{
		//$success = 'Un email de activación será enviado a su correo electrónico.';
		if($givepoints) {
			$success = 'Su código ha sido cambiado. En breve, usted recibirá '.round(50/$multiplier, 0).' puntos.';
		} else 
		{
			$success = 'Su código ha sido cambiado.';
		}
		$_SESSION['success'] = $success;
		if($givepoints) {
			givepointsinactivation(round(50/$multiplier, 0));
		}
	} else
	{
		if(isset($errors)) 
		{
			$_SESSION['errors'] = $errors;
		}
	}

	//Finally, go to the last position.
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=conf');

}

if(isset($_POST['claimp']))
{

	//First of all, start a new session.
	session_start();

	//User has reclaimed his old points.

	$row = null;

	$oldid = mysql_real_escape_string($_REQUEST['oldid']);

	$rawoldcode = $_REQUEST['oldcode'];
	$oldcode = md5($_REQUEST['oldcode']);

	$oldemail = mysql_real_escape_string($_REQUEST['oldemail']);

	$oldpoints = 0;

	if(empty($oldid)) 
	{
		$claimiderror['claim_id_empty'] = 'Debes introducir una ID.';
		$_SESSION['claim_id_error'] = $claimiderror;
		$preproceed = false;
		$proceed = false;
	} 

	if(empty($rawoldcode)) 
	{
		$claimpasserror['claim_pass_empty'] = 'Debes introducir una contraseña.';
		$_SESSION['claim_pass_error'] = $claimpasserror;
		$preproceed = false;
		$proceed = false;
	}

	if(empty($oldemail)) 
	{
		$claimemerror['claim_email_empty'] = 'Debes introducir un correo.';
		$_SESSION['claim_email_error'] = $claimemerror;
		$preproceed = false;
		$proceed = false;
	}

	$idquery = mysql_query("SELECT id FROM users WHERE id='$oldid'");

	if(mysql_num_rows($idquery)) {

		if(!is_numeric($oldid))
		{
			$claimiderror['claim_id_notnumeric'] = 'Debes introducir un valor numérico.';
			$_SESSION['claim_id_error'] = $claimiderror;
			$preproceed = false;
			$proceed = false;
		}

		$emailquery = mysql_query("SELECT email FROM users WHERE email='$oldemail'");

		if(!$emailquery) 
		{
			$errors['getoldemail'] = 'Error: '.mysql_error();
			$preproceed = false;
			$proceed = false;
		}

		$row = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id='$oldid'"));

		if(!$row) 
		{
			$errors['getoldpass'] = 'Error: '.mysql_error();
			$preproceed = false;
			$proceed = false;
		}

	} else 
	{
		if(!empty($oldid)) {
			$claimiderror['claim_id_noexists'] = 'El usuario ligado a la ID que tu diste no existe.';
			$_SESSION['claim_id_error'] = $claimiderror;
		}

		$preproceed = false;
		$proceed = false;
	}

	if($preproceed) 
	{

		if(mysql_num_rows($emailquery)) //The email put in the box exists proceed the next block
		{

			$userpass = $row['password'];

			if($oldcode === $userpass) 
			{

				$row = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$oldid'"));
				$oldpoints = $row['points'];

				if($ip == $row['ip_address']) 
				{
					
					$errors['sameuser'] = '¡El usuario del que intentas obtener los puntos eres tú!';
					$proceed = false;

				} else 
				{

					//Update the main account to transfer the old stats
					$updatequery = mysql_query("UPDATE users SET acc_prior='-3' WHERE id='$id'");
					$updatequery = mysql_query("UPDATE users SET ip_address='$ip' WHERE id='$oldid'");

					if(!$updatequery) 
					{
						$errors['updateuser'] = 'Error: '.mysql_error();
						$proceed = false;
					} 

				}

			} else 
			{
				$claimpasserror['claim_pass_notcorrect'] = 'La contraseña dada es incorrecta.';
				$_SESSION['claim_pass_error'] = $claimpasserror;
				$proceed = false;
			}

		} else 
		{
			$claimemerror['claim_email_noexists'] = 'El correo dado no es el mismo que el del usuario ligado a la ID que tu diste.';
			$_SESSION['claim_email_error'] = $claimemerror;
			$proceed = false;
		}

	}

	if($proceed) 
	{

		//Give points of the old account

		$success = 'Sus puntos fueron restablecidos. '.number_format($oldpoints, 0, ',', '.').' puntos fueron añadidos a su nueva cuenta.';
		$_SESSION['success'] = $success;
		//setpoints($oldid, $oldpoints);

	} else
	{
		if(isset($errors)) 
		{
			$_SESSION['errors'] = $errors;
		}
	}

	//Finally, go to the last position.
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=conf');


}

if(isset($_POST['newavatar'])) {

	//First of all, start a new session.
	session_start();

	//Then, set variables
	$avatar = mysql_real_escape_string($_POST['newavatar']);

	mysql_query("UPDATE users SET avatar='$avatar' WHERE id='$id'");

	$success = 'Su perfil fue actualizado satisfactoriamente.';
	$_SESSION['success'] = $success;

	/*if(isset($avatar)) {
		mysql_query("UPDATE users SET avatar='$avatar' WHERE id='$id'");
	} else {
		$avatarerrora['empty_avatar'] = 'URL de avatar vacío.';
		$_SESSION['avatar_errors'] = $avatarerrors;
		$proceed = false;
	}

	if($proceed) {
		$success = 'Su perfil fue actualizado satisfactoriamente.';
		$_SESSION['success'] = $success;
	}*/

	//Finally, go to the last position.
	//header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=info');
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=profile&id='.$id);

}

if(isset($_POST['newpersinfo'])) {

	//First of all, start a new session.
	session_start();

	//Then, set variables
	//$rawbirthdate = mysql_real_escape_string($_POST['updateavatar']);
	$rname = mysql_real_escape_string($_POST['realname']);
	$birthdate = strtotime($_POST['birthday'].'-'.$_POST['birthmonth'].'-'.$_POST['birthyear']);
	$gender = mysql_real_escape_string($_POST['gender']);
	$location = mysql_real_escape_string($_POST['ubication']);
	$skype = mysql_real_escape_string($_POST['updateskype']);
	$mail = mysql_real_escape_string($_POST['updatemail']);		
	$tweb = mysql_real_escape_string($_POST['updatewebtitle']);
	$uweb = mysql_real_escape_string($_POST['updateweburl']);

	if($rname != null) {
		mysql_query("UPDATE users SET realname='$rname' WHERE id='$id'");
	}

	if($birthdate != null) {
		mysql_query("UPDATE users SET birthdate='$birthdate' WHERE id='$id'");
	}

	if($gender != null) {
		mysql_query("UPDATE users SET gender='$gender' WHERE id='$id'");
	}

	if($location != null) {
		mysql_query("UPDATE users SET location='$location' WHERE id='$id'");
	}

	if($skype != null) {
		mysql_query("UPDATE users SET skype='$skype' WHERE id='$id'");
	}

	if($mail != null) {
		mysql_query("UPDATE users SET mail='$mail' WHERE id='$id'");
	}

	if($tweb != null) {
		mysql_query("UPDATE users SET website_title='$tweb' WHERE id='$id'");
	}

	if($uweb != null) {
		mysql_query("UPDATE users SET website_url='$uweb' WHERE id='$id'");
	}

	if($proceed) {
		$success = 'Su perfil fue actualizado satisfactoriamente.';
		$_SESSION['success'] = $success;
	}

	//Finally, go to the last position.
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account&edit=info');

}

if(isset($_POST['new_banner'])) {

	//First of all, start a new session.
	session_start();

	$newbanner = mysql_real_escape_string($_POST['new_banner']);

	mysql_query("UPDATE users SET header_banner='$newbanner' WHERE id='$id'");

	$success = 'Su perfil fue actualizado satisfactoriamente.';
	$_SESSION['success'] = $success;

	//Finally, go to the last position.
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=profile&id='.$id);

}

if(isset($_POST['new_ptxt'])) {

	//First of all, start a new session.
	session_start();

	$new_ptxt = htmlspecialchars(mysql_real_escape_string($_POST['new_ptxt']));

	mysql_query("UPDATE users SET personal_text='$new_ptxt' WHERE id='$id'");

	$success = 'Su perfil fue actualizado satisfactoriamente.';
	$_SESSION['success'] = $success;

	//Finally, go to the last position.
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=profile&id='.$id);

}

?>