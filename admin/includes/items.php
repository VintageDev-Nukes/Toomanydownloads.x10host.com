<?php

$editid = @$_GET['edit'];
$editdata = @$_GET['editdata'];
$newadd = @$_GET['new'];

session_start();

if (isset($_SESSION)) {
    $success = $_SESSION['success'];
    $errors = $_SESSION['form_errors'];
}

if (empty($editid) && empty($editdata) && empty($newadd)) {

    require_once('paginator.class.php');
    $pages = new Paginator;

    if (isset($_SESSION['success'])) {
        echo '<div class="success" style="width:450px;">' . $success . '</div>';
        session_destroy();
    }

    echo '<table class="admintable" cellspacing="0">
	        <tr>
	          <td colspan="3">Nuevos items</td>
	        </tr>
	        <tr><td>ID</td><td>Mensaje</td><td>Acciones</td></tr>';

    $pages->items_total = mysqli_num_rows(mysqli_query($db, "SELECT * FROM items"));
    $pages->mid_range = 7;
    $pages->paginate();

    $query = "SELECT * FROM items ORDER BY id DESC $pages->limit"; //aquí se lee * (todo) de demo
    $result = mysqli_query($db, $query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

    $times = 0;

    if (mysqli_num_rows($result)) {
        while ($rs = mysqli_fetch_array($result)) {
            echo '<tr><td>' . $rs['id'] . '</td><td>' . $rs['name'] . '</td><td>[<a href="index.php?action=admin&go=items&edit=' . $rs['id'] . '">Editar</a>] [<a href="index.php?action=admin&go=items&editdata=' . $rs['id'] . '">Añadir / Editar Ficha técnica</a>] [<a href="#" onclick="javascript:submitformbyid(\'approve\');">Aprobar</a>] [<a href="#" onclick="javascript:submitformbyid(\'delete\');">Borrar</a>]</td></tr>';
            echo '<form method="post" id="approve" action="forms/ItemManager.php"><input type="hidden" name="approve" value="' . $rs['id'] . '"></form>';
            echo '<form method="post" id="delete" action="forms/ItemManager.php"><input type="hidden" name="delete" value="' . $rs['id'] . '"></form>';
        }
    } else {
        echo '<tr><td colspan="3">No hay ningún resultado.</td></tr>';
    }

    echo '<tr style="background:#333;">
	          	<td colspan="3"><div class="paginate">' . $pages->display_pages() . '</div></td>
	          </tr>
	      </table>';


} else if (isset($editid) && empty($editdata) && empty($newadd)) {

    $get_cat = mysqli_query($db, "SELECT * FROM items WHERE id='$editid'");
    $row = mysqli_fetch_array($get_cat);

    $cname = $row['name'];
    $cdesc = $row['description'];
    $cthumb = $row['thumb'];
    $cpts = $row['points'];

    echo '<form method="post" action="forms/ItemManager.php">';

    if (isset($errors['empty_name'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_name'] . '</div>';
    }

    echo '<b>Nombre:</b><br>
		<input type="text" name="name" id="name" maxlength="100" size="30" style="width:100%;" placeholder="' . $cname . '" /><br><br>';

    if (isset($errors['empty_description'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_description'] . '</div>';
    }

    echo '<b>Descripción:</b><br>
		<input type="text" name="description" id="description" maxlength="500" size="30" style="width:100%;" placeholder="' . $cdesc . '" /><br><br>';

    if (isset($errors['empty_url'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_url'] . '</div>';
    }

    echo '<b>Lista de Urls:</b><br>
		<textarea type="text" name="url" id="url" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

    if (isset($errors['empty_thumb'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_thumb'] . '</div>';
    }

    echo '<b>Miniatura:</b><br>
		<input type="text" name="thumb" id="thumb" maxlength="500" size="30" style="width:100%;" placeholder="' . $cthumb . '" /><br><br>';

    echo '<b>Puntos mínimos requeridos:</b><br>
		<input type="number" name="points" id="points" value="' . $cpts . '" size="30" min="0" style="width:213px;" /><br><br>';

    /*if(isset($errors['empty_captcha']))
    {
        echo '<div class="error" style="width:300px;margin:5px 0 5px 0;">'.$errors['empty_captcha'].'</div>';
    }

    if(isset($errors['wrong_captcha']))
    {
        echo '<div class="error" style="width:100px;margin:5px 0 5px 0;">'.$errors['wrong_captcha'].'</div>';
    }*/

    /*echo '<b>Captcha:</b><br>
    <img src="captcha/captcha.php"/><br>
    <input type="text" name="vercode" style="margin-left: 0px;width: 80px;" /><br><br>';*/

    echo '<input type="hidden" name="edititem_id" id="' . $editid . '" />
		<input name="edititem" type="submit" value="Enviar" style="display:block;margin:auto;" />
	</form>';

} else if (empty($editid) && isset($editdata) && empty($newadd)) {

    $get_cat = mysqli_query($db, "SELECT cat as cat, name as name FROM items WHERE id='$editdata'");
    $row = mysqli_fetch_array($get_cat);
    $cname = $row['name'];
    $ccat = $row['cat'];

    echo '<form method="post" action="forms/ItemManager.php">';

    if ($ccat == "games") {

        if (isset($errors['empty_name'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_name'] . '</div>';
        }

        echo '<b>Nombre:</b><br>
			<input type="text" name="name" id="name" maxlength="100" size="30" style="width:100%;" value="' . $cname . '" /><br><br>';

        if (isset($errors['empty_description'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_description'] . '</div>';
        }

        echo '<b>Descripción:</b><br>
			<textarea name="description" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

        if (isset($errors['empty_platform'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_platform'] . '</div>';
        }

        echo '<b>Plataforma:</b><br>
			<input type="text" name="platform" maxlength="100" size="30" style="width:100%;" /><br><br>';

        if (isset($errors['empty_dev'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_dev'] . '</div>';
        }

        echo '<b>Desarrollador:</b><br>
			<input type="text" name="dev" maxlength="100" size="30" style="width:100%;" /><br><br>';

        if (isset($errors['empty_distributor'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_distributor'] . '</div>';
        }

        echo '<b>Distribuidor:</b><br>
			<input type="text" name="distributor" maxlength="100" size="30" style="width:100%;" /><br><br>';

        if (isset($errors['empty_genre'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_genre'] . '</div>';
        }

        echo '<b>Género:</b><br>
			<input type="text" name="genre" maxlength="100" size="30" style="width:100%;" /><br><br>';

        if (isset($errors['empty_players'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_players'] . '</div>';
        }

        echo '<b>Jugadores:</b><br>
			<input type="text" name="players" maxlength="100" size="30" min="1" max="32" style="width:100%;" /><br><br>';

        if (isset($errors['empty_lang'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_lang'] . '</div>';
        }

        echo '<b>Idioma:</b><br>
			<input type="text" name="lang" maxlength="100" size="30" style="width:100%;" /><br><br>';

        if (isset($errors['empty_age'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_age'] . '</div>';
        }

        echo '<b>Edad:</b><br>
			<input type="number" name="age" maxlength="2" value="3" size="30" min="3" max="18" style="width:100%;" /><br><br>';

        if (isset($errors['empty_release'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_release'] . '</div>';
        }

        echo '<b>Fecha de salida:</b><br>
			<input type="text" name="release" maxlength="10" size="30" style="width:100%;" placeholder="00-00-0000" /><br><br>';

        if (isset($errors['empty_min-req'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_min-req'] . '</div>';
        }

        echo '<b>Requisitos mínimos:</b><br>
			<textarea name="minreq" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

        if (isset($errors['empty_req'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_req'] . '</div>';
        }

        echo '<b>Requisitos recomendados:</b><br>
			<textarea name="req" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

        if (isset($errors['empty_max-req'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_max-req'] . '</div>';
        }

        echo '<b>Requisitos de alto rendimiento:</b><br>
			<textarea name="maxreq" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

        if (isset($errors['empty_media_img'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_media_img'] . '</div>';
        }

        echo '<b>Lista de imágenes:</b><br>
			<textarea name="media_img" cols="30" rows="5" style="width:100%;" placeholder="Escriba una lista de enlaces con imagenes separados por saltos de líneas."></textarea><br><br>';

        if (isset($errors['empty_media_video'])) {
            echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_media_video'] . '</div>';
        }

        echo '<b>Lista de vídeos:</b><br>
			<textarea name="media_video" cols="30" rows="5" style="width:100%;" placeholder="Escriba una lista de enlaces con vídeos separados por saltos de líneas."></textarea><br><br>';

    }

    echo '<input type="hidden" name="editdata_cat" value="' . $ccat . '">
	<input type="hidden" name="editdata_id" value="' . $editdata . '" />
	<input name="editdata" type="submit" value="Enviar" style="display:block;margin:auto;" />
		</form>';

} else if (empty($editid) && empty($editdata) && isset($newadd)) {

    echo '<form method="post" action="forms/ItemManager.php">';

    if (isset($errors['empty_name'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_name'] . '</div>';
    }

    echo '<b>Nombre:</b><br>
		<input type="text" name="name" id="name" maxlength="100" size="30" style="width:100%;" /><br><br>';

    if (isset($errors['empty_description'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_description'] . '</div>';
    }

    echo '<b>Descripción:</b><br>
		<input type="text" name="description" id="description" maxlength="500" size="30" style="width:100%;" /><br><br>';

    if (isset($errors['empty_url'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_url'] . '</div>';
    }

    echo '<b>Lista de Urls:</b><br>
		<textarea type="text" name="url" id="url" cols="30" rows="5" style="width:100%;"></textarea><br><br>';

    if (isset($errors['empty_thumb'])) {
        echo '<div class="error" style="width:90%;margin:5px 0 5px 0;">' . $errors['empty_thumb'] . '</div>';
    }

    echo '<b>Miniatura:</b><br>
		<input type="text" name="thumb" id="thumb" maxlength="500" size="30" style="width:100%;" /><br><br>';

    echo '<b>Puntos mínimos requeridos:</b><br>
		<input type="number" name="points" id="points" value="0" size="30" min="0" style="width:213px;" /><br><br>';

    if ($acc_prior < getprior("mod")) {

        if (isset($errors['empty_captcha'])) {
            echo '<div class="error" style="width:300px;margin:5px 0 5px 0;">' . $errors['empty_captcha'] . '</div>';
        }

        if (isset($errors['wrong_captcha'])) {
            echo '<div class="error" style="width:100px;margin:5px 0 5px 0;">' . $errors['wrong_captcha'] . '</div>';
        }

        echo '<b>Captcha:</b><br>
			<img src="captcha/captcha.php"/><br>
			<input type="text" name="vercode" style="margin-left: 0px;width: 80px;" /><br><br>';
    }

    if ($acc_prior >= getprior("mod")) {
        echo '<input name="newitemadmin" type="submit" value="Enviar" style="display:block;margin:auto;" />';
    } else {
        echo '<input name="newitem" type="submit" value="Enviar" style="display:block;margin:auto;" />';
    }

    echo '</form>';

}

?>