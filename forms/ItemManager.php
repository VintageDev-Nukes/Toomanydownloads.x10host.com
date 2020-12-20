<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/jdownloader.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php');
// connect();

$continue = true;

//Forms
$newitemadmin = $_POST['newitemadmin'];
$newitem = $_POST['newitem'];

//Variables
//(int)$delete_id = $_REQUEST['delete_id'];

if (isset($newitemadmin) || isset($newitem)) {

    $approved = "0";
    $sended_by = $_POST['sended_by'];

    if (isset($newitemadmin)) {
        $approved = "1";
        $sended_by = "0";
    }

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $url = $_POST['url'];
    $thumb = mysqli_real_escape_string($db, $_POST['thumb']);
    (int)$points = mysqli_real_escape_string($db, $_POST['points']);

    session_start();

    if (isset($newitem)) {

        if (empty($_POST['vercode'])) {
            $errors['empty_captcha'] = 'Captcha vacía. Introduzca el texto de la imagen.';
            $_SESSION['form_errors'] = $errors;
            $continue = false;
        } else if ($_POST["vercode"] != $_SESSION["vercode"]) {
            $errors['wrong_captcha'] = 'Código erróneo.';
            $_SESSION['form_errors'] = $errors;
            $continue = false;
        }

    }

    if (empty($name)) {
        $errors['empty_name'] = 'Debes introducir un nombre.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if (empty($description)) {
        $errors['empty_description'] = 'Debes introducir una descripción.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if (empty($url)) {
        $errors['empty_url'] = 'Debes introducir una URL o una lista de enlaces.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    } else {
        if ($points > 0) {
            $url = encrypturl($_POST['url']);
        } else if ($points == 0) {
            $url = serialize(preg_split('/\n|\r\n?/', $_POST['url']));
        }
    }

    if (empty($thumb)) {
        $errors['empty_thumb'] = 'Debes introducir una miniatura.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }

    if ($continue) {
        $query = "INSERT INTO items (name, description, url, thumb, points, approved, sended_by) VALUES ('$name', '$description', '$url', '$thumb', '$points', '$approved', '$sended_by')";
        mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
        $success = 'El item fue creado satisfactoriamente.';
        $_SESSION['success'] = $success;
        header("Location: index.php?action=admin&go=items"); //Replace by a <div class="success"></div>
    } else {
        echo "<script>window.history.back();</script>";
    }

}

/*if(isset($delete_id)) {
	$query="DELETE FROM items WHERE id='$delete_id'";
	mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
	header("Location: http://".$_SERVER['SERVER_NAME']."/index.php?action=admin");
}*/

if (isset($_POST['delete'])) {
    $did = $_POST['delete'];
    $query = "UPDATE items SET approved='-1' WHERE id='$did'";
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
    $success = 'El comentario fue borrado.';
    $_SESSION['success'] = $success;
    header("Location: index.php?action=admin&go=items");
}

if (isset($_POST['approve'])) {
    $aid = $_POST['approve'];
    $query = "UPDATE items SET approved='1' WHERE id='$aid'";
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
    $success = 'El comentario fue aprobado.';
    $_SESSION['success'] = $success;
    header("Location: index.php?action=admin&go=items");
}

if (isset($_POST['editdata'])) {

    $item_id = $_POST['editdata_id'];
    $item_cat = $_POST['editdata_cat'];

    $cat = "";

    if ($item_cat == "games") {

        $item_id_str = $item_cat . "_" . $item_id;

        $add = true;
        $edit = false;

        if (mysqli_num_rows(mysqli_query($db, "SELECT id FROM gamedata WHERE item_id='$item_id_str'"))) {
            $add = false;
            $edit = true;
        }

        $finalreq = "";

        $name = mysqli_real_escape_string($db, $_POST['name']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $platform = mysqli_real_escape_string($db, $_POST['platform']);
        $dev = mysqli_real_escape_string($db, $_POST['dev']);
        $distributor = mysqli_real_escape_string($db, $_POST['distributor']);
        $genre = mysqli_real_escape_string($db, $_POST['genre']);
        $players = mysqli_real_escape_string($db, $_POST['players']);
        $lang = mysqli_real_escape_string($db, $_POST['lang']);
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $release = strtotime($_POST['release']);
        $minreq = mysqli_real_escape_string($db, $_POST['minreq']);
        $req = mysqli_real_escape_string($db, $_POST['req']);
        $maxreq = mysqli_real_escape_string($db, $_POST['maxreq']);
        $media_img = $_POST['media_img'];
        $media_video = $_POST['media_video'];
        $fmedia_img = "";
        $fmedia_video = "";

        session_start();

        if ($edit && !$add) {

            if ($name != null) {
                mysqli_query($db, "UPDATE gamedata SET name='$name' WHERE item_id='$item_id_str'");
            }

            if ($description != null) {
                mysqli_query($db, "UPDATE gamedata SET description='$description' WHERE item_id='$item_id_str'");
            }

            if ($platform != null) {
                mysqli_query($db, "UPDATE gamedata SET platform='$platform' WHERE item_id='$item_id_str'");
            }

            if ($dev != null) {
                mysqli_query($db, "UPDATE gamedata SET dev='$dev' WHERE item_id='$item_id_str'");
            }

            if ($distributor != null) {
                mysqli_query($db, "UPDATE gamedata SET distributor='$distributor' WHERE item_id='$item_id_str'");
            }

            if ($genre != null) {
                mysqli_query($db, "UPDATE gamedata SET genre='$genre' WHERE item_id='$item_id_str'");
            }

            if ($players != null) {
                mysqli_query($db, "UPDATE gamedata SET players='$players' WHERE item_id='$item_id_str'");
            }

            if ($lang != null) {
                mysqli_query($db, "UPDATE gamedata SET lang='$lang' WHERE item_id='$item_id_str'");
            }

            if ($age != null) {
                mysqli_query($db, "UPDATE gamedata SET age='$age' WHERE item_id='$item_id_str'");
            }

            if ($release != null) {
                mysqli_query($db, "UPDATE gamedata SET release='$release' WHERE item_id='$item_id_str'");
            }

            if ($req != null || $minreq != null || $maxreq != null) {
                $finalreq = serialize(array(0 => $minreq, 1 => $req, 2 => $maxreq));
                mysqli_query($db, "UPDATE gamedata SET req='$finalreq' WHERE item_id='$item_id_str'");
            }

            if ($media_img != null) {
                $fmedia_img = serialize(preg_split('/\n|\r\n?/', $media_img));
                mysqli_query($db, "UPDATE gamedata SET media_img='$fmedia_img' WHERE item_id='$item_id_str'");
            }

            if ($media_video != null) {
                $fmedia_video = serialize(preg_split('/\n|\r\n?/', $media_video));
                mysqli_query($db, "UPDATE gamedata SET media_video='$fmedia_video' WHERE item_id='$item_id_str'");
            }

            if ($continue) {
                $success = 'La ficha técnica de este juego fue editada correctamente.';
                $_SESSION['success'] = $success;
                header("Location: index.php?action=admin&go=items"); //Replace by a <div class="success"></div>
            } else {
                echo "<script>window.history.back();</script>";
            }

        } else if ($add && !$edit) {

            if (empty($name)) {
                $errors['empty_name'] = 'Debes introducir un nombre.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($description)) {
                $errors['empty_description'] = 'Debes introducir una descripción.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($dev)) {
                $errors['empty_dev'] = 'Debes introducir un desarollador.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($distributor)) {
                $errors['empty_distributor'] = 'Debes introducir un distribuidor.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($genre)) {
                $errors['empty_genre'] = 'Debes introducir un género.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($players)) {
                $errors['empty_players'] = 'Debes introducir una cantidad de jugadores.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($lang)) {
                $errors['empty_lang'] = 'Debes introducir un lenguaje.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($age)) {
                $errors['empty_age'] = 'Debes introducir una edad mínima para jugar.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($release)) {
                $errors['empty_release'] = 'Debes introducir una fecha de lanzamiento.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            }

            if (empty($req) || empty($minreq) || empty($maxreq)) {
                if (empty($req)) {
                    $errors['empty_req'] = 'Debes introducir unos requisitos.';
                    $_SESSION['form_errors'] = $errors;
                    $continue = false;
                } else if (empty($minreq)) {
                    $errors['empty_min-req'] = 'Debes introducir unos requisitos mínimos.';
                    $_SESSION['form_errors'] = $errors;
                    $continue = false;
                } else if (empty($maxreq)) {
                    $errors['empty_max-req'] = 'Debes introducir unos requisitos de alto rendimiento.';
                    $_SESSION['form_errors'] = $errors;
                    $continue = false;
                }
            } else if (isset($req) || isset($minreq) || isset($maxreq)) {
                $finalreq = serialize(array(0 => $minreq, 1 => $req, 2 => $maxreq));
            }

            if (empty($media_img)) {
                $errors['empty_media_img'] = 'Debes introducir unas imágenes.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            } else {
                $fmedia_img = serialize(preg_split('/\n|\r\n?/', $media_img));
            }

            if (empty($media_video)) {
                $errors['empty_media_video'] = 'Debes introducir unos vídeos.';
                $_SESSION['form_errors'] = $errors;
                $continue = false;
            } else {
                $fmedia_video = serialize(preg_split('/\n|\r\n?/', $media_video));
            }

            if ($continue) {
                $query = "INSERT INTO gamedata (item_id, name, gamedesc, platform, dev, distributor, genre, players, lang, age, `release`, media_img, media_video, req) VALUES ('$item_id_str' ,'$name', '$description', '$platform', '$dev', '$distributor', '$genre', '$players', '$lang', '$age', '$release', '$fmedia_img', '$fmedia_video', '$finalreq')";
                mysqli_query($db, $query) or die ('Error: ' . mysqli_error());
                $success = 'La ficha técnica de este juego fue añadida correctamente.';
                $_SESSION['success'] = $success;
                header("Location: index.php?action=admin&go=items"); //Replace by a <div class="success"></div>
            } else {
                echo "<script>window.history.back();</script>";
            }

        }

    }

}

if (isset($_POST['edititem'])) {

    (int)$edid = mysqli_real_escape_string($db, $_POST['edititem_id']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $url = $_POST['url'];
    $thumb = mysqli_real_escape_string($db, $_POST['thumb']);
    (int)$points = mysqli_real_escape_string($db, $_POST['points']);

    session_start();

    /*if(empty($_POST['vercode'])) {
        $errors['empty_captcha'] = 'Captcha vacía. Introduzca el texto de la imagen.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    } else if($_POST["vercode"] != $_SESSION["vercode"])
    {
        $errors['wrong_captcha'] = 'Código erróneo.';
        $_SESSION['form_errors'] = $errors;
        $continue = false;
    }*/

    if (isset($name)) {
        mysqli_query($db, "UPDATE items SET name='$name' WHERE id='$edid'");
    }

    if (isset($description)) {
        mysqli_query($db, "UPDATE items SET description='$description' WHERE id='$edid'");
    }

    if (isset($url)) {
        if ($points > 0) {
            $url = encrypturl($_POST['url']);
        } else if ($points == 0) {
            $url = serialize(preg_split('/\n|\r\n?/', $_POST['url']));
        }
        mysqli_query($db, "UPDATE items SET url='$url' WHERE id='$edid'");
    }

    if (isset($thumb)) {
        mysqli_query($db, "UPDATE items SET thumb='$thumb' WHERE id='$edid'");
    }

    if ($continue) {
        $success = 'El item fue editado satisfactoriamente.';
        $_SESSION['success'] = $success;
        header("Location: index.php?action=admin&go=items"); //Replace by a <div class="success"></div>
    } else {
        echo "<script>window.history.back();</script>";
    }

}

?>