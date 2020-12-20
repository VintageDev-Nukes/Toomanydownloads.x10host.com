<?php

$gdid = @$_GET['id'];

$item_id_str = "";

if(isset($gdid)) 
{

	$get_itemdata_query = mysqli_query("SELECT * FROM items WHERE id='$gdid'");

	if(!mysqli_num_rows($get_itemdata_query))
	{
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
	}

	$rs1 = mysqli_fetch_array($get_itemdata_query);

	$ccat = $rs1['cat'];

	if($ccat == "games") {

		$item_id_str = $ccat."_".$gdid;

		$get_gamedata_query = mysqli_query("SELECT * FROM gamedata WHERE item_id='$item_id_str'");

		if(!mysqli_num_rows($get_gamedata_query))
		{
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
		}

		$rs2 = mysqli_fetch_array($get_gamedata_query);

		$name = $rs1['name'];
		$thumb = $rs1['thumb'];
		$desc = $rs2['gamedesc'];
		$platform = $rs2['platform'];
		$dev = $rs2['dev'];
		$distributor = $rs2['distributor'];
		$genre = $rs2['genre'];
		$players = $rs2['players'];
		$lang = $rs2['lang'];
		$release = $rs2['release'];
		$age = $rs2['age'];
		$req = (array)mb_unserialize($rs2['req']);
		$mi = (array)mb_unserialize($rs2['media_img']);
		$mv = (array)mb_unserialize($rs2['media_video']);

		echo '        <link rel="stylesheet" type="text/css" href="resources/demo.css" />
		<link rel="stylesheet" type="text/css" href="resources/style.css" />
		<link rel="stylesheet" type="text/css" href="resources/elastislide.css" />
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
		<script type="text/javascript" src="resources/jquery.tmpl.min.js"></script>
		<script type="text/javascript" src="resources/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="resources/jquery.elastislide.js"></script>
		<script type="text/javascript" src="resources/gallery.js"></script>';

		echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
								<div class="box_title" style="text-align:left;padding-left:10px;">
									<b>Ficha técnica:</b> <i>'.$name.'</i>
								</div>
							<div class="contenido">
								<div class="inside" style="text-align:center;">
									<table style="font-size:12px;">
										<tr>
											<td>
												<img style="border: 6px #BBB ridge;border-radius: 10px;width:180px;height:258px;" src="'.$thumb.'" />
											</td>
											<td>
												'.$desc.'
												<hr style="border: 1px #272727 dashed;">
												<b>Plataforma:</b> '.$platform.'<br>
												<b>Desarrollador:</b> '.$dev.'<br>
												<b>Distribuidor:</b> '.$distributor.'
												<hr style="border: 1px #272727 dashed;">
												<b>Género:</b> '.$genre.'<br>
												<b>Jugadores:</b> '.$players.'<br>
												<b>Idioma:</b> '.$lang.'<br>
												<b>Lanzamiento:</b> '.date('d \d\e F \d\e Y', $release).'<br>
												<b>Pegi:</b> +'.$age.'
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>';

		if($req[0] != null) 
		{
			echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
								<div class="box_title" style="text-align:left;padding-left:10px;">
									Requisitos mínimos
								</div>
							<div class="contenido">
								<div class="inside">
									'.nl2br($req[0]).'
								</div>
							</div>
						</div>';
		}

		if($req[1] != null) 
		{
			echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
								<div class="box_title" style="text-align:left;padding-left:10px;">
									Requisitos recomendados
								</div>
							<div class="contenido">
								<div class="inside">
									'.nl2br($req[1]).'
								</div>
							</div>
						</div>';
		}

		if($req[2] != null) 
		{
			echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
								<div class="box_title" style="text-align:left;padding-left:10px;">
									Requisitos de alto rendimiento
								</div>
							<div class="contenido">
								<div class="inside">
									'.nl2br($req[2]).'
								</div>
							</div>
						</div>';
		}

	}

	echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
			<div class="box_title" style="text-align:left;padding-left:10px;">
				Imágenes
			</div>
			<div class="contenido">
				<div class="inside">

				<div class="content">
				<div id="rg-gallery" class="rg-gallery">
					<div class="rg-thumbs">
						<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class="es-carousel-wrapper">
							<div class="es-nav">
								<span class="es-nav-prev">Previous</span>
								<span class="es-nav-next">Next</span>
							</div>
							<div class="es-carousel">
								<ul>';

									for($i = 0; $i < count($mi); $i++) {
										echo '<li><a href="#"><img src="'.$mi[$i].'" data-large="'.$mi[$i].'" alt="image'.$i.'" data-description="'.$name.'" /></a></li>';
									}

									echo '</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->
			</div><!-- content -->

		</div>
	</div>
</div>';

	echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
			<div class="box_title" style="text-align:left;padding-left:10px;">
				Descargar el juego
			</div>
			<div class="contenido">
				<div class="inside" style="text-align:center;">';

					if(getmypoints(false, false) >= $rs1['points']*$mult) {

						if($rs1['points'] == 0) 
						{

							echo '<div class="downbutton"><div class="outer"><div class="height"><div class="inner" onclick="javascript:show(\'links\');">DESCARGA</div></div></div></div>';
							echo '<div id="links" class="links" style="display:none;"><a style="color: #494949;" href="'.implode("<br>", unserialize($rs1['url'])).'" target="_nofollow">'.implode("<br>", unserialize($rs1['url'])).'</a></div>';

						} else if(getvaluefromcookie('Jdownloader') == "notrunning") 
						{

							echo '<div class="downbutton"><div class="outer"><div class="height"><div class="inner">NECESITAS JD</div></div></div></div>';

						} else if(getvaluefromcookie('Jdownloader') == "running")
						{
							echo '<FORM id="downloadgame_'.$rsa['id'].'" ACTION="http://127.0.0.1:9666/flash/addcrypted2" target="hidden" METHOD="POST" onsubmit="javascript:sended('.$rs1['id'].');">
		   							<INPUT TYPE="hidden" NAME="passwords" VALUE="myPassword"> 
		   							<INPUT TYPE="hidden" NAME="source" VALUE="http://'.$_SERVER['SERVER_NAME'].'/">  
		   							<INPUT TYPE="hidden" NAME="jk" VALUE="function f(){ return \'31323334353637383930393837363534\';}">
		   							<INPUT TYPE="hidden" NAME="crypted" VALUE="'.$rsa['url'].'">
		   							<INPUT TYPE="hidden" NAME="id" VALUE="'.$rsa['id'].'">
		   							<div class="downbutton"><div class="outer"><div class="height"><div class="inner"><input name="downloaded" class="innersubmit" type="submit" value="DESCARGA" /></div></div></div></div>
								</FORM>';
						}

					}

				echo '</div>
			</div>
		</div>';


	echo '<div class="union" style="margin-left:10%;width:80%;margin-top:20px;">
								<div class="box_title" style="text-align:left;padding-left:10px;">
									Juegos similares
								</div>
							<div class="contenido">
								<div class="inside" style="text-align:center;">';

		$get_all_items = mysqli_num_rows(mysqli_query("SELECT * FROM items"));

		$rand = array();

		for($i = 0; $i < 4; $i++) {
			$rand = getrand($rand, $i, $get_all_items);
		}

		for($cid = 0; $cid < 4; $cid++) {

			$gid = $rand[$cid];

			$rs = mysqli_fetch_array(mysqli_query("SELECT * FROM items WHERE cat='$ccat' AND id='$gid' ORDER BY points ASC"));

			include('itembase.php');
	
		}

	echo '</div>
		</div>
	</div>';

} else 
{
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?action=404');
}

?>