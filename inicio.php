<?

require_once('paginator.class.php');

session_start();

if(isset($_SESSION)) {
	$search_errors = $_SESSION['search_errors'];
}

$pages = new Paginator;
$cat = $_GET['cat'];
$lan = $_GET['lan'];

$colaboratepoints = 2000;

if(empty($cat)) {$cat = 'games';}

if($cat == "games") 
{
	$colaboratepoints = 2000;
} else if($cat == "music") 
{
	$colaboratepoints = 500;
} else if($cat == "films") 
{
	$colaboratepoints = 2500;
} else if($cat == "crack") 
{
	$colaboratepoints = 1000;
}

echo '<script language="javascript">
    
    function resolveSrcMouseover(e) {
		var node = e.srcElement == undefined ? e.target : e.srcElement;
		if (node.nodeName != "UL") {
			node.style.fontWeight= "bold";
		}
	}
	function resolveSrcMouseout(e) {
		var node = e.srcElement == undefined ? e.target : e.srcElement;
		node.style.fontWeight = "normal";
	}

	function gotocat(cat) {
		document.getElementById("cat").value = cat;
		document.getElementById("gotocat").submit();return false;
	}

	function setOption(selectElement, value) {
	    var options = selectElement.options;
	    for (var i = 0, optionsLength = options.length; i < optionsLength; i++) {
	        if (options[i].value == value) {
	            selectElement.selectedIndex = i;
	            return true;
	        }
	    }
	    return false;
	}

</script>

<style type="text/css">
	li {
	   	cursor:url(../ico/mouse/cur1049.cur), pointer;
		display:block; 
	}
	.Folder {
	}
	.ExpandCollapse {
		float:left;
		margin-right:10px;
		width:8px;
	}
	ul {
		list-style-type:none;
	}
</style>';

echo '<table style="margin-left:10%;width:80%;">
	<tr>
		<td style="width:15%;" class="laterales">';

echo '<div class="union">
<div class="box_title">
Categorías
</div>
<div class="contenido">
	<div class="inside">
		<ul onmouseover="resolveSrcMouseover(event);" onmouseout="resolveSrcMouseout(event);" style="padding: 0px;margin: 0px;max-width: 100px;">
			<li onclick="javascript:gotocat(\'games\');"><div id="Folder1" class="ExpandCollapse">☛</div><div class="Folder">Juegos</div></li>
			<!--- <ul id="ExpandCollapseFolder1">
				<li>Item 1</li> 
				<li>Item 2</li>
				<li>Item 3</li>
			</ul> -->
			<li onclick="javascript:gotocat(\'music\');"><div id="Folder2" class="ExpandCollapse">☛</div><div class="Folder">Música</div></li>
			<!--- <ul id="ExpandCollapseFolder2">
				<li>Item 4</li>
				<li>Item 5</li>
			</ul> -->
			<li onclick="javascript:gotocat(\'films\');"><div id="Folder2" class="ExpandCollapse">☛</div><div class="Folder">Películas</div></li>
			<li onclick="javascript:gotocat(\'crack\');"><div id="Folder2" class="ExpandCollapse">☛</div><div class="Folder">Cracks</div></li>
			<li onclick="javascript:gotocat(\'all\');"><div id="Folder2" class="ExpandCollapse">☛</div><div class="Folder">Mostrar todo</div></li>
		</ul>
	</div>
</div>
</div>';

echo '	</td>
		<td class="maincontent" style="width:70%;">';

//<!--- Presentación -->

echo '<div class="contenido">
	<div class="inside" style="text-align:left!important;">
		<h2 style="color:aquamarine;margin-top:0px;">Too Many Downloads!</h2><br>
		¡Bienvenido a TMD! En esta página tu podrás descargar una infinidad de juegos desbloqueables por puntos.<br><br>

		Estos puntos se adquieren cada vez que alguien visite tu "link de referido". Cada vez que alguien haga esto, se sumarán '.(1*$mult).' puntos, que luego te servirán para desbloquear los juegos.<br><br>

		¿A qué esperas para enviar tu link dereferido ahora mismo?<br><br>

		Arriba tienes tu "link de referido", cópialo y envíaselo a tus amigos.<br>
		Ten cuidado, ya que alguién que haya visitado el link de otra persona, solo podrá visitar un total de '.$remainingvisits.' links por día.<br><br>

		NO hace falta que te registres, tu cuenta se crea mediante tu IP ('.$_SERVER['REMOTE_ADDR'].')


	</div>
</div>';

//<!--- Body/Content -->

/*$searchcat = "WHERE cat='$cat'";

if($cat == 'All') 
{
	$searchcat = '';
}*/

echo '<div class="contenido">';

$pages->items_total = mysqli_num_rows(mysqli_query("SELECT * FROM items WHERE cat='$cat'"));
$pages->mid_range = 7;
$pages->paginate();

$query = "SELECT * FROM items WHERE cat='$cat' ORDER BY points ASC $pages->limit";
$result = mysqli_query($query) or die(mysqli_error());

if(mysqli_num_rows($result)) {
	echo '<div class="inside" style="margin:10px auto;">';
  	while($rs=mysqli_fetch_array($result)) {
		include('itembase.php');
  	}
  	//echo '<br class="clear">
  	echo '</div>';

	echo '<div class="paginas">'.$pages->display_pages().'</div>';

} else {
	echo '<div class="inside">';
  	echo 'No hay ninguna descarga disponible, por favor, si lo deseas tu puedes ayudarnos haciendo <a href="#" title="Gana '.$colaboratepoints.' puntos por link válido y 0,05$. A los 10 links válidos ganarás rango de Colaborador."><u>click aquí</u></a> para que haya más links disponibles.';
  	echo '</div>';
}

echo '</div>';


echo '	</td>
		<td style="width:15%;" class="laterales">';

echo '<div class="union">
<div class="box_title">
Buscador
</div>
<div class="contenido">
	<div class="inside">';

	if(isset($search_errors) && $search_errors != array()) 
	{
		if(isset($search_errors['empty_search'])) {
			echo '<div class="error">'.$search_errors['empty_search'].'</div>';
		}
	}

	//Añadir opción de busqueda avanzada

		echo '<form method="post" action="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=search">
			<input type="text" name="search" size="10" maxlength="30" placeholder="Busqueda" />
			<br>
			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="submit" value="Buscar" style="display: block;margin: auto;margin-top: 5px;background: url(imgs/search.png) 0px center no-repeat;padding-left:30px;" /><br>
			O quizás desees... <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=advsearch"><u>Hacer una búsqueda avanzada</u></a>.
		</form>
	</div>
</div>
</div>';

if($_POST['jdownloader'] == "notrunning") 
{
	echo '<div class="union">
<div class="box_title">
Recomendaciones
</div>
<div class="contenido">
	<div class="inside">
	<img src="http://sergiodeluz.files.wordpress.com/2010/06/jdownloader.png" style="width:128px;height:128px;margin: 0 auto 0px auto;display: block;" /><br>
	[ESTA WEB USA JDOWNLOADER]<br>
	Es necesario JDownloader para poder descargarse cualquier cosa de esta página web.<br>
	<a href="http://jdownloader.org/download/offline" style="color:#81BEF7;" target="_nofollow">>> Descargar</a>
	</div>
</div>
</div>';
}

$orderby = $_GET['orderby'];

if(empty($orderby)) {$orderby = 'points';}

$query = "SELECT * FROM users ORDER BY $orderby DESC LIMIT 0,3";
$result = mysqli_query($query) or die(mysqli_error());

echo '<div class="union">
<div class="box_title">
Top usuarios
</div>
<div class="contenido">
	<div class="inside">

	<form method="get" id="changeorder">
		Clasificar por: 
		<select name="orderby" id="orderby" onchange="javascript:submitformbyid(\'changeorder\');">
		  <option value="points" selected="selected" data-image="imgs/point-gold.png">Puntos</option>
		  <option value="money" data-image="imgs/coins.png">Dinero</option>
		  <option value="lvl" data-image="imgs/lvl.gif">Nivel</option>
		  <option value="exp" data-image="imgs/exp.png">Experiencia</option>
		  <option value="numvsts" data-image="imgs/ip.png">Visitas</option>
		</select>
	</form>';

		$times = 0;

		$string = "";
		$nick = "";

		if(mysqli_num_rows($result)) {

  			while($rs=mysqli_fetch_array($result))
  			{

  				$cur_id = $rs['id'];

  				if($orderby == "points") 
  				{
  					$string = specialnumformat($rs['points']).' puntos';
  				} else if($orderby == "money") 
  				{
  					$string = specialnumformat($rs['money']).'$';
  				} else if($orderby == "lvl") 
  				{
  					$string = 'Nivel '.$rs['lvl'];
  				} else if($orderby == "exp") 
  				{
  					$string = specialnumformat($rs['exp']).' exp';
  				} else if($orderby == "numvsts") 
  				{
  					$string = 'Visitas '.specialnumformat($rs['numvsts']);
  				}

  				$row = mysqli_fetch_assoc(mysqli_query("SELECT nickname FROM users WHERE id='$cur_id'"));

  				if($row['nickname'] == null) 
  				{
  					$nick = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$cur_id.'" target="_blank"><u>Usuario #'.$cur_id.'</u></a>;';
  				} else 
  				{
  					$nick = '<a href="http://'.$_SERVER['SERVER_NAME'].'/?action=profile&id='.$cur_id.'" target="_blank"><u>'.$row['nickname'].'</u></a>:';
  				}
  				
  				$times++;

  				if($times == 3) 
  				{
  					echo '<img style="position:relative;top:3px;padding-right:3px;" src="imgs/medal-bronze.png" />';
  				} else if($times == 2) 
  				{
  					echo '<img style="position:relative;top:3px;padding-right:3px;" src="imgs/medal-silver.png" />';
  				} else if($times == 1)
  				{
  					echo '<img style="position:relative;top:3px;padding-right:3px;" src="imgs/medal-gold.png" />';
  				}

  				echo $nick.' '.$string.'<br>';
  			}

  		} else 
  		{
  			die('Hubo un error al procesar los "Top Usuarios".');
  		}

	echo '</div>
</div>
</div>';

echo '	</td>
	</tr>
</table>';

echo '<iframe name="hidden" style="display:none;"></iframe>';

echo '<form id="gotocat" method="get"><input type="hidden" id="cat" name="cat" /></form>';

/*if(isset($_POST['search_errors'])) 
{
	if(isset($_SESSION)) {
		$search_errors = $_SESSION['search_errors'];
	}
} else 
{
	session_destroy();
}*/

if(isset($_POST['jdownloader'])) 
{
	session_destroy();
}

if(isset($_GET['orderby'])) 
{
	echo "<script>window.onload=function(){setOption(document.getElementById('orderby'), '".$orderby."')};</script>";
}

if(isset($_GET['lan'])) 
{
	echo "<script>window.onload=function(){setOption(document.getElementById('countries'), '".$lan."')};</script>";
}

//print_r($_REQUEST);

?>