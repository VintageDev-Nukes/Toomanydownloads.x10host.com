<?php
session_start(); //crea la cookie

if ($acc_prior < getprior("admi")) {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/');
}

?>

<div class="contenido">
    <div class="inside">

        <?php

        if (isset($_POST['login'])) {

            $completa = $_POST['pass'];
            $comparar = md5($completa); //codifica lo escrito en md5
            $final = $code;  //la codifica md5
            if ($comparar == $final) {
                if ($acc_prior >= getprior("admi")) {
                    $_SESSION['listo'] = true;
                    setcookie("TMDCookie", perenc(serialize(array('admin_login' => true))), time() + 365 * 86400);
                    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php?action=admin'); //redirige a la pagina despues de inicias sesion
                    exit;
                } else {
                    echo '<div class="error">Tu no eres un administrador, por tanto no puedes acceder a la administración.</div>';
                }
            } else {
                echo '<div class="error">Contraseña de usuario incorrecta.</div>';
            }
        }
        //continua en el siguiente bloque
        ?>

        <center>
            <h3 style="color:#fff;">Contraseña:</h3>
            <form method="post" action="">
                <input type="password" style="text-align:center;" name="pass"><br>
                <input type="submit" name="login" value="Iniciar sesión">
            </form>
        </center>
    </div>
</div>
