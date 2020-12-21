<?php

session_start();

if(isset($_SESSION)) {
	$advsearch_errors = $_SESSION['advsearch_errors'];
} 

echo '<div class="contenido">
		<div class="inside">';

		if(isset($advsearch_errors) && $advsearch_errors != array()) 
		{
			if(isset($advsearch_errors['empty_advsearch'])) {
				echo '<div class="error">'.$advsearch_errors['empty_advsearch'].'</div>';
			}
		}

		echo '<form method="post" action="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=search">
			<h2 style="display:inline;padding-right:10px;">Buscar por:</h2>
			<input type="text" name="advtext" size="20" placeholder="Busqueda" />
			<div class="advsearchdiv" style="display:inline;width:120px;position: relative;top: -2px;">
				<select name="whatsearch">
					<option value="name" selected="selected">Nombre</option>
					<option value="description">Descripción</option>
				</select>
			</div>
			<br>
			<h5 style="margin:0px;">Usa ; para delimitar una cadena de texto en varios resultados.</h5>
			<h2 style="display:inline;padding-right:10px;position:relative;top:5px;">Categoría:</h2>
			<div class="advsearchdiv" style="display:inline;width:120px;position:relative;top:5px;">
				<select name="cat">
					<option value="games" selected="selected">Juegos</option>
					<option value="music">Música</option>
					<option value="films">Películas</option>
					<option value="crack">Cracks</option>
				</select>
			</div>
			<br><br>
			<input name="advanced-search" type="submit" value="Buscar">
		</form>
	</div>
</div>';

session_destroy();

?>