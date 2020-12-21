<?php

//All the tinglao... xD

if (!session_id() == 'listo') //Comprueba si se ha establecido la conexión en el login.php, si no, vuelve a login.php (mirar check.php)
{
    session_start();
}
require 'check.php';
//continua en el siguiente bloque

if ($_REQUEST['action'] != 'admin') {
    header('location: index.php?action=admin');
}

// CONEXIÓN A LA BASE DE DATOS
//require_once($_SERVER['DOCUMENT_ROOT'] . '/motor.php'); //De aquí se saca la conexión a la BD y algunas funciones

$now = time();
$atime = $now - 600;
$get_all_users = mysqli_query($db, "SELECT * FROM users");
$get_connected_users = mysqli_query($db, "SELECT * FROM users WHERE lastconn > $atime AND acc_prior > -3");
$get_total_points = mysqli_query($db, "SELECT SUM(points) as totalpoints FROM users WHERE acc_prior < 4");
$get_all_items = mysqli_query($db, "SELECT * FROM items");
$get_total_downloads = mysqli_query($db, "SELECT SUM(downloads) as totaldowns FROM items");
$users_num = mysqli_num_rows($get_all_users);
$connected_users = mysqli_num_rows($get_connected_users);
$total_points = mysqli_fetch_array($get_total_points);
$items_num = mysqli_num_rows($get_all_items);
$total_downs = mysqli_fetch_array($get_total_downloads);

//<!--- Styles -->

echo '<style>
.linka {color:#fff;text-decoration:none;}
</style>

<!-- Scripts -->

<script type="text/javascript">
  function show(id) {
    document.getElementById(id).style.display = \'block\';
  }

  function hide(id) {
    document.getElementById(id).style.display = \'none\';
  }

  function switchview(id) {
    if(document.getElementById(id).style.display == \'none\') {
      show(id);
    } else {
      hide(id);
    }
  }

  function deleteConfirm() {
    if (confirm(\'\u00BFEst\u00e1s seguro de que quieres borrar este Item de la Base de Datos?\')) {
      document.getElementById(\'delete\').submit();return false;
    } 
  }

  function restart(url) {
    var cururl = document.getElementById(\'frame\').src;
    if(url != cururl) {
      document.getElementById(\'frame\').src = url;
    }
  }
</script>
<script type="text/javascript" src="resources/adminmenu.js"></script>';

//<!--- Iframes -->

/*echo '<div id="content" style="background: url(imgs/fondot.png) 0 0 repeat fixed; width:100%; height:100%; position:fixed; left:0; top:0; z-index:20; display:none;" onclick=\'hide("content")+restart(\'http://'.$_SERVER['SERVER_NAME'].'>/admin/itemAdder.php\')">
  <img style="position:absolute; right: 50%; top: 50%; margin-right: -424px; margin-top: -324px; z-index:30;" src="imgs/RedCross.png" onclick="hide(\'content\')+restart(\'http://'.$_SERVER['SERVER_NAME'].'/admin/itemAdder.php\')" />
  <div id="boxt" class="transbox" style="z-index:25; position: absolute; left: 50%; top: 50%; width: 800px; height: 600px; margin-top: -300px; margin-left: -400px; overflow: auto; background: #fff; border: 1px #000 solid;">
    <iframe id="frame" style="width:100%;height:100%;border:none;"></iframe>
  </div>
</div>';*/

//<!--- Body -->

echo '<div class="contenido" style="padding-bottom:20px;">
  <div class="inside">';

//Main menu

echo "<div id='adminmenu'>
<ul>
   <li class='has-sub active'><a href='#'><span>Controles del sitio</span></a>
   <ul>
         <li><a href='#'><span>Soporte y Créditos</span></a>
   </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Configuración del sitio</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Gestor de items</span></a>
            <ul>
               <li><a href='index.php?action=admin&go=items&new=item'><span>Añadir</span></a></li>
               <li><a href='index.php?action=admin&go=items'><span>Editar y eliminar</span></a></li>
               <li class='last'><a href='index.php?action=admin&go=items#approved'><span>Administrar peticiones</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Gestor de tickets</span></a>
            <ul>
               <li><a href='#'><span>Revisar</span></a></li>
               <li class='last'><a href='#'><span>Papelera</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Gestor de idiomas</span></a>
            <ul>
               <li class='last'><a href='#'><span>Instalar</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Gestor de feedback</span></a>
            <ul>
               <li><a href='index.php?action=admin&go=feedback#approved'><span>Revisar</span></a></li>
               <li class='last'><a href='index.php?action=admin&go=feedback#deleted'><span>Papelera</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Controles de temas y diseño</span></a>
      <ul>
         <li class='last'><a href='#'><span>Emoticonos</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Controles de los usuarios</span></a>
      <ul>
         <li class='last'><a href='#'><span>Control de IPs</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='#'><span>Mantenimiento</span></a></li>
</ul>
</div>
<br><br>";

$action = @$_GET['go'];
if (empty($action)) {
    $action = 'index';
}

switch ($action) {

    //Index (hecho)
    case 'index':
        include_once('includes/main.php');
        break;

    case 'ticket':
        include_once('includes/tickets.php');
        break;

    case 'who':
        include_once('includes/who.php');
        break;

    case 'report':
        include_once('includes/reports.php');
        break;

    case 'feedback':
        include_once('includes/feedback.php');
        break;

    case 'items':
        include_once('includes/items.php');
        break;

    //Not found (hecho: 10%)
    default:
        include_once('404.php');
        break;
}

/*<a href="logout.php" style="float:right;font-size:12px;" class="linka">Cerrar sesión</a>
  <?php <h3>
    <a href="#" onclick='show("content")+restart("http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/itemAdder.php")' class="linka" onlick="document.getElementById('frame').src = 'formulario.php';">+ Añadir item</a>
    <br>
    <a href="#" style="color:#fff;text-decoration:none;" onclick="switchview('options')">- Editar items</a>
  </h3>

  <div id="options" style="display:none;color:#fff;">

<?

$query = "SELECT * FROM items ORDER BY id ASC"; //aquí se lee * (todo) de demo
$result = mysqli_query($db, $query) or die(mysqli_error()); //Aquí se muestra el resultado que está listo para ser mostrado con un while linea: 19

if(mysqli_num_rows($result)) {
while($rs=mysqli_fetch_array($result))  {
  echo $rs['id'].'.- '.$rs['name'].' [Editar] [<form id="delete" style="display:inline;" action="http://'.$_SERVER['SERVER_NAME'].'/forms/ItemManager.php"><a href="#" onclick="javascript:deleteConfirm();">Quitar</a><input type="hidden" name="delete_id" value="'.$rs['id'].'" /></form>]<br>';
}
} else {
echo 'No hay ningún resultado disponible, añade un nuevo item para que esta lista no esté vacía.';
}

?>

  </div>*/

echo '</div>
</div>';

?>