<?php

		if($rs['approved'] == 1) {
	  		if($rs['points'] > 0) 
	  		{
				$ptstring = specialnumformat($rs['points']*$mult).' pts';
	  		} else 
	  		{
	  			$ptstring = "FREE";
	  		}
	    	echo '<div class="grid_1" id="item">
				<div class="reward_image">
					<h5 title="'.number_format($rs['points']*$mult, 0, ',', '.').' puntos">'.$ptstring.'</h5>
					<a href="index.php?action=itemdata&id='.$rs['id'].'" style="position: absolute;right: 0px;margin: 3px 5px 0 0;"><img src="imgs/itemdata.png" /></a>
					<img src="'.$rs['thumb'].'" alt="'.$rs['description'].'" width="180" height="180">
				</div>
				<div class="reward_text">
					<span style="float: left">'.$rs['name'].'<br>Descargas: '.$rs['downloads'].'</span>
				</div>';
				if(getmypoints(false, false) >= $rs['points']*$mult) {

					if($rs['points'] == 0) 
					{

						echo '<div id="content_'.$rs['id'].'" style="background: url(imgs/fondot.png) 0 0 repeat fixed; width:100%; height:100%; position:fixed; left:0; top:0; z-index:20; display:none;" onclick=\'hide("content_'.$rs['id'].'")\'">
							  <img style="position:absolute; right: 50%; top: 50%; margin-right: -424px; margin-top: -324px; z-index:30;" src="imgs/RedCross.png" onclick="hide(\'content_'.$rs['id'].'\')" />
							  <div id="boxt" class="transbox" style="z-index:25; position: absolute; left: 50%; top: 50%; width: 800px; height: 600px; margin-top: -300px; margin-left: -400px; overflow: auto; background: #333; border: 5px #000 solid;border-radius:10px;">';
							    
							  echo '<h1>Descargar normal:</h1>

							  <input type="button" onclick="javascript:show(\'links\');" value="Mostrar enlaces" /><br>

							  <div id="links" style="display:none;"><a href="'.implode("<br>", unserialize($rs['url'])).'" target="_nofollow">'.implode("<br>", unserialize($rs['url'])).'</a></div>';

							  	if(getvaluefromcookie('Jdownloader') == "running")
								{

								    echo '<hr style="margin-top: 20px;width: 90%;border: 1px #111 dashed;">
								    <h1>Descargar con JDownloader:</h1>
								    <FORM id="downloadgame_'.$rs['id'].'" ACTION="http://127.0.0.1:9666/flash/addcrypted2" target="hidden" METHOD="POST" onsubmit="javascript:sended('.$rs['id'].');">
			   							<INPUT TYPE="hidden" NAME="passwords" VALUE="myPassword"> 
			   							<INPUT TYPE="hidden" NAME="source" VALUE="">  
			   							<INPUT TYPE="hidden" NAME="jk" VALUE="function f(){ return \'31323334353637383930393837363534\';}">
			   							<INPUT TYPE="hidden" NAME="crypted" VALUE="'.encrypturl($rs['url']).'">
			   							<INPUT TYPE="hidden" NAME="id" VALUE="'.$rs['id'].'">
			   							<input name="downloaded" type="submit" value="Descargar" />
									</FORM>';

								}

								echo '<hr style="margin-top: 20px;width: 90%;border: 1px #111 dashed;"><h1>... O quizás desees ver su ficha ténica:

								<form action="index.php?action=itemdata&id='.$rs['id'].'"><input type="submit" value="Ver la ficha ténica de este Item" /></form></h1>';

							  echo '</div>
						</div>';

						echo '<div class="groupbutton" style="height:32px;float:left;">
								<div class="iconbutton" style="border-radius:0px;"><img src="imgs/unlocked.png" style="margin-top:8px;width:16px;height:16px;" /></div>
								<div class="button" style="border-radius:0px;">
		   						<input type="button" onclick="javascript:show(\'content_'.$rs['id'].'\');" value="Descargar" class="down-submit" />
							</div>
						</div>';
					} else if(getvaluefromcookie('Jdownloader') == "notrunning") 
					{
						echo '<div class="groupbutton" style="height:32px;float:left;">
							<div class="iconbutton" style="border-radius:0px;"><img src="imgs/locked.png" style="margin-top:8px;width:16px;height:16px;" /></div>
							<div class="button" style="border-radius:0px;"><a href="http://jdownloader.org/download/offline" target="_nofollow" style="line-height:32px;text-decoration:none;font-size:16px;color:yellow;">Necesitas JD</a></div>
						</div>';
					} else if(getvaluefromcookie('Jdownloader') == "running")
					{

						echo '<div id="content_'.$rs['id'].'" style="background: url(imgs/fondot.png) 0 0 repeat fixed; width:100%; height:100%; position:fixed; left:0; top:0; z-index:20; display:none;" onclick=\'hide("content_'.$rs['id'].'")\'">
							  <img style="position:absolute; right: 50%; top: 50%; margin-right: -424px; margin-top: -324px; z-index:30;" src="imgs/RedCross.png" onclick="hide(\'content_'.$rs['id'].'\')" />
							  <div id="boxt" class="transbox" style="z-index:25; position: absolute; left: 50%; top: 50%; width: 800px; height: 600px; margin-top: -300px; margin-left: -400px; overflow: auto; background: #333; border: 5px #000 solid;border-radius:10px;">
							  <h1>Descarga del archivo:</h1>
							   <FORM id="downloadgame_'.$rs['id'].'" ACTION="http://127.0.0.1:9666/flash/addcrypted2" target="hidden" METHOD="POST" onsubmit="javascript:sended('.$rs['id'].');">
		   							<INPUT TYPE="hidden" NAME="passwords" VALUE="myPassword"> 
		   							<INPUT TYPE="hidden" NAME="source" VALUE="">  
		   							<INPUT TYPE="hidden" NAME="jk" VALUE="function f(){ return \'31323334353637383930393837363534\';}">
		   							<INPUT TYPE="hidden" NAME="crypted" VALUE="'.$rs['url'].'">
		   							<INPUT TYPE="hidden" NAME="id" VALUE="'.$rs['id'].'">
		   							<input name="downloaded" type="submit" value="Descargar" />
								</FORM>
								<hr style="margin-top: 20px;width: 90%;border: 1px #111 dashed;"><h1>... O quizás desees ver su ficha ténica:
								<form action="index.php?action=itemdata&id='.$rs['id'].'"><input type="submit" value="Ver la ficha ténica de este Item" /></form></h1>
							  </div>
						</div>';

						echo '<div class="groupbutton" style="height:32px;float:left;">
								<div class="iconbutton" style="border-radius:0px;"><img src="imgs/unlocked.png" style="margin-top:8px;width:16px;height:16px;" /></div>
								<div class="button" style="border-radius:0px;">
		   						<input type="button" onclick="javascript:show(\'content_'.$rs['id'].'\');" value="Descargar" class="down-submit" />
							</div>
						</div>';
						//Detect if the form submit was correct and delete points and sum one download
					}

				} else {
				echo '<div class="groupbutton" style="height:32px;float:left;">
						<div class="iconbutton" style="border-radius:0px;"><img src="imgs/locked.png" style="margin-top:8px;width:16px;height:16px;" /></div>
						<div class="button" style="border-radius:0px;"><a href="#" style="line-height:32px;text-decoration:none;font-size:16px;color:indianred;">Bloqueado</a></div>
					</div>';
				}
			echo '</div>';
		}

?>