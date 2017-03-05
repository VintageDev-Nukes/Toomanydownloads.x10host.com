<?php 
session_start(); 
require 'check.php'; //continua en el siguiente bloque
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Insertar Item</title>
<style>body {font-family:arial;margin:0;width:100%;height:100%;}</style>

<body>
<form id="form1" name="form1" method="post" action="http://<?php echo $_SERVER['SERVER_NAME']; ?>/forms/ItemManager.php" style="padding:20px;">

<b>Nombre:</b><br>
<input type="text" name="name" id="name" maxlength="100" size="30" /><br><br>
<b>Descripción:</b><br>
<input type="text" name="description" id="description" maxlength="500" size="30" /><br><br>
<b>URL:</b><br>
<textarea type="text" name="url" id="url" cols="30" rows="5"></textarea><br><br>
<b>Miniatura:</b><br>
<input type="text" name="thumb" id="thumb" maxlength="500" size="30" /><br><br>
<b>Puntos mínimos requeridos:</b><br>
<input type="number" name="points" id="points" value="0" size="30" min="0" style="width:213px;" /><br><br>


<font size="3px">Captcha:</font><br>
<img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/captcha/captcha.php"/><br>
<input type="text" name="vercode" /><br><br>
<input name="newitem" type="submit" value="Enviar" />
</form>
</body>
</html>