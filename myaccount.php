<?php

session_start();

if(isset($_SESSION)) {
  $success = $_SESSION['success'];
  $dataerrors = $_SESSION['errors'];
  $emailerrors = $_SESSION['email_errors'];
  $codeerrors = $_SESSION['code_errors'];
  $claimemerror = $_SESSION['claim_email_error'];
  $claimiderror = $_SESSION['claim_id_error'];
  $claimpasserror = $_SESSION['claim_pass_error'];
}

$id = getmyreferid();

$row = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM $dbtableinfo WHERE id='$id'"));

$ip = $row['ip_address'];
$email = $row['email'];
$datetime = $row['datetime'];
$pass = $row['password'];

$emailstring = $email;
$codestring = '';

if(empty($email)) {
  $emailstring = 'Ninguno';
}

if(empty($pass)) {
  $codestring = '<b style="color:red;">No seguro</b>';
} else 
{
  $codestring = '<b style="color:green;">Seguro</b>';
}

echo '<div class="contenido">
  <div class="inside" style="text-align:center;">
    
    <h1 style="color:aquamarine;">
       Detalles de la cuenta
    </h1><br>
      
    Por favor, recuerda tu ID de la cuenta, email y código de seguridad por si los necesitases para recuperar tus puntos si tu IP cambia o si usas una IP dinámica.

    <br><br>';

    if(isset($dataerrors) && $dataerrors != array()) //&&  (empty($emailerrors) || empty($codeerrors) || empty($claimemerror) || empty($claimiderror) || empty($claimpasserror)) 
    {
      echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($dataerrors).'</div>';
    } else if(isset($success)) 
    {
      echo '<div class="success">'.$success.'</div>';
    }

    /*if(isset($_GET)) {
      echo '<pre>'.$_GET['test'].'</pre>';
    }*/
    
  	echo '<form id="form1" name="form1" method="post" action="forms/AccountManager.php">
      <table width="80%" align="center" class="tbl">
        <tbody>
          <tr>
            <td align="center" class="sub" colspan="2">
              <h4>
                Información de tu cuenta
              </h4>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                ID de usuario
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3>
                '.$id.'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Código de seguridad
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3>
                Código de seguridad - '.$codestring.'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Link de referido
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3>
                ?ref='.$id.'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Tu email
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3>
                '.$emailstring.'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Tus puntos
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3 title="'.getmypoints(false, true, true, false).'">
                '.str_replace(' points', '', getmypoints(true)).'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Fecha de registro
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3>
                '.date('d-m-Y', $datetime).'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Tu IP
              </h3>
            </td>
            <td align="center" class="tbl">
              <h3>
                '.$ip.'
              </h3>
            </td>
          </tr>
          <tr>
            <td align="center" class="sub" colspan="2">
              <h4>
                Actualiza tu email
              </h4>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Nuevo email
              </h3>
            </td>
            <td align="center" class="tbl">';

            if(isset($emailerrors) && $emailerrors != array()) {
              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($emailerrors).'</div>';
            }

              echo '<input type="text" name="updateemail" value="">
            </td>
          </tr>
          <tr>
            <td align="center" class="sub" colspan="2">
              <input type="submit" name="newemail" value="Actualizar email">
            </td>
          </tr>
          <tr>
            <td align="center" class="sub" colspan="4">
              <h4>
                Actualiza tu código de seguridad
              </h4>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Nuevo código
              </h3>
            </td>
            <td align="center" class="tbl">';

            if(isset($codeerrors) && $codeerrors != array()) {
              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($codeerrors).'</div>';
            }

              echo '<input type="password" name="updatecode" value="">
            </td>
          </tr>
          <tr>
            <td align="center" class="sub" colspan="2">
              <input type="submit" name="newcode" value="Actualiza tu código">
            </td>
          </tr>
          <tr>
            <td align="center" class="sub" colspan="2">
              <h4>
                ¿Tu IP ha sido cambiada? Reclama aquí tus puntos
              </h4>
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                ID de tu antigua cuenta
              </h3>
            </td>
            <td align="center" class="tbl">';

            if(isset($claimiderror) && $claimiderror != array()) {
              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($claimiderror).'</div>';
            }

              echo '<input type="text" name="oldid" value="">
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Email de la antigua cuenta
              </h3>
            </td>
            <td align="center" class="tbl">';

            if(isset($claimemerror) && $claimemerror != array()) {
              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($claimemerror).'</div>';
            }

              echo '<input type="text" name="oldemail" value="">
            </td>
          </tr>
          <tr>
            <td align="center" class="tbl">
              <h3>
                Antiguo código de seguridad
              </h3>
            </td>
            <td align="center" class="tbl">';

            if(isset($claimpasserror) && $claimpasserror != array()) {
              echo '<div class="error">Los siguientes errores ocurrieron al procesar la información: '.recurseTree($claimpasserror).'</div>';
            }

              echo '<input type="password" name="oldcode" value="">
            </td>
          </tr>
          <tr>
            <td align="center" class="sub" colspan="2">
              <input type="submit" name="claimp" value="Reclamar puntos">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>';

//Una vez mostrado todo, destruir la sesion
session_destroy();

?>