<?php

session_start();

$id = getmyreferid();
$mult = getmultbyid($id);

$advsearch = mysql_real_escape_string($_POST['advanced-search']);
$searchtype = mysql_real_escape_string($_POST['searchtype']);
$whatsearch = mysql_real_escape_string($_POST['whatsearch']);
$search = mysql_real_escape_string($_POST['search']);
$advanced = mysql_real_escape_string($_POST['advtext']);
$cat = mysql_real_escape_string($_POST['cat']);

$errors = array();
$rand = array();

//print_r($_POST);

if(empty($search) && empty($advsearch)) 
{

	$errors['empty_search'] = 'Debe introducir un valor de busqueda.';
	$_SESSION['search_errors'] = $errors;

	header('Location: http://'.$_SERVER['SERVER_NAME'].'/');

} else if(isset($search) && empty($advanced) && empty($advsearch))
{

	//Show results...

	$search_query = mysql_query("SELECT * FROM items WHERE cat='$cat' AND name LIKE '%$search%' ORDER BY points ASC");

	echo '<div class="contenido">
	<div class="inside">

	<h1 style="margin:0px;">Resultados de la búsqueda:</h1>';

	if(mysql_num_rows($search_query)) {

		$rid = 0;

		while($rs=mysql_fetch_array($search_query)) 
		{

			$rand = array("there_".$rid => $rs['id']);

			include('itembase.php');

			$rid++;

		}

		echo '<hr><h1 style="color:#fff!important;">Resultados similares:</h1>';

		$get_all_items = mysql_num_rows(mysql_query("SELECT * FROM items"));

		for($i = 0; $i < 4; $i++) {
			$rand = getrand($rand, $i, $get_all_items);
		}

		for($cid = 0; $cid < 4; $cid++) {

			$gid = $rand[$cid];

			$rs = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE cat='$cat' AND id='$gid' ORDER BY points ASC"));

			include('itembase.php');
	
		}
	
		echo '<form action="http://'.$_SERVER['SERVER_NAME'].'/"><input type="submit" value="Mostrar más resultados" style="display:block;margin:auto;"></form>';

	} else 
	{
		echo 'No hubo ningún resultado.
		<form action="http://'.$_SERVER['SERVER_NAME'].'/"><input type="submit" value="Volver al inicio" style="display:block;margin:auto;"></form>';
	}

	echo '</div>
	</div>';

} else if(empty($advanced) && isset($advsearch) && empty($search)) 
{
	$errors['empty_advsearch'] = 'Debe introducir un valor de busqueda.';
	$_SESSION['advsearch_errors'] = $errors;

	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=advsearch');
} else if(isset($advanced) && isset($advsearch) && empty($search)) 
{
	//Show results...

	echo '<div class="contenido">
		<div class="inside">';

	$unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
	                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
	                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
	                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
	                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );

	$advanced = strtr($advanced, $unwanted_array);

	$cleaned = preg_replace('/[^A-Za-z0-9\ \; \;]/', '', $advanced);

	$cleaned = str_replace("; ", ";", $cleaned);

	$searchWords = explode(';', $cleaned);

	$num = 1;

	foreach ($searchWords as $key => $value) {

		$search_query = mysql_query("SELECT * FROM items WHERE cat='$cat' AND $whatsearch LIKE '%$value%' ORDER BY points ASC");

		echo '<h1>Resultados de "<b style="color:#1C8B00;">'.$value.'</b>":</h1>';

		if(mysql_num_rows($search_query)) {

			$rid = 0;

			while($rs=mysql_fetch_array($search_query)) 
			{

				$rand = array("there_".$rid => $rs['id']);

				include('itembase.php');

				$rid++;

			}

			if(count($searchWords) > $num) {
				echo '<hr>';
			}

			$num++;

			echo '<hr><h1 style="color:#fff!important;">Resultados similares:</h1>';

		$get_all_items = mysql_num_rows(mysql_query("SELECT * FROM items"));

		for($i = 0; $i < 4; $i++) {
			$rand = getrand($rand, $i, $get_all_items);
		}

		for($cid = 0; $cid < 4; $cid++) {

			$gid = $rand[$cid];

			$rs = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE cat='$cat' AND id='$gid' ORDER BY points ASC"));

			include('itembase.php');
	
		}

		echo '<form action="http://'.$_SERVER['SERVER_NAME'].'/"><input type="submit" value="Mostrar más resultados" style="display:block;margin:auto;"></form>';

		} else 
		{
			echo 'No hubo ningún resultado.
			<form action="http://'.$_SERVER['SERVER_NAME'].'/"><input type="submit" value="Volver al inicio" style="display:block;margin:auto;"></form>';
		}

	}

	echo '</div>
	</div>';

} else 
{
	die('Error: '.$advsearch.', '.$advanced.', '.$search);
}

?>