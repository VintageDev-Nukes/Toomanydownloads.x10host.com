<form method="post" action="test.php">
	Test: <textarea rows="5" cols="50" name="test"></textarea>
	<br>
	<input type="submit" name="form1" value="Enviar" />
</form>

<?php
if(isset($_POST['form1'])) 
{
	echo 'Enviado aquí sus resultados:<br>';
	echo br2nl(nl2br($_REQUEST['test']));
} else 
{
	echo 'Sin enviar.';
}

function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}  
?>