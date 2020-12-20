<?

require_once($_SERVER['DOCUMENT_ROOT'] . '/jdownloader.php');
include ('motor.php');
timequery();
connect();
addinfo();

if(empty($_COOKIE["TMDCookie"])) 
{
  setcookie("TMDCookie", '', time()+365*86400);
}

$TMDCookie = unserialize(perdec($_COOKIE['TMDCookie']));

(int)$id = getmyreferid();
(int)$mylvl = getlvlbyid($id);
(int)$myexp = getexpbyid($id);
(int)$mult = getmultbyid($id);

//IN-RUN SETTINGS

$web_creation = 1392734684;

//Global variables requested from all includes and requires

$row = mysqli_fetch_assoc(mysqli_query("SELECT * FROM users WHERE id='$id'"));

$refernum =  mysqli_num_rows(mysqli_query("SELECT * FROM users WHERE refer_id='$id'"));
$nickname = $row['nickname'];
$ip = $row['ip_address'];
$code = $row['password'];
$email = $row['email'];
$gender = $row['gender'];
(int)$points = $row['points'];
(int)$money = $row['money'];
$acc_prior = $row['acc_prior'];
$acc_type = $row['acc_type'];
(int)$remainingvisits = $row['remainingvisits'];
(int)$multiplier = $row['multiplier'];
(int)$visitas = $row['numvsts'];
(int)$discount = $row['discount'];
(int)$lastclaim = $row['lastclaim'];
(int)$reg_days = round((time() - $row['datetime']) / 86400);

$visitstodo = ceil(pow(3*$mult, 1/1.1))-2; 
$minvisits = ceil(pow($remainingvisits, 1/1.1))-2;
$dailybonus = 120*$mult;

if($acc_type == null) {
  $acc_type = "free";
}

$nick = '';

if($nickname != null) 
{
  $nick = $nickname;
} else 
{
  $nick = '#user'.$id;
}

setcookie("jdownloader", "", time()-3600);

//$row = mysqli_fetch_assoc(mysqli_query("SELECT visitarray FROM users WHERE id='1'"));

//$visitarray = (array)unserialize($row['visitarray']);


echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Índice</title>
<link rel="stylesheet" type="text/css" href="resources/main.css">
<link rel="stylesheet" type="text/css" href="resources/menu_styles.css">
<link rel="stylesheet" type="text/css" href="resources/dd.css" />
<link rel="stylesheet" type="text/css" href="resources/flags.css" />
<!--- <script>
	function innerChange() {
		if(document.getElementById(\'inner\')) {
			var NavWidth = document.body.offsetWidth;
			var OffsetMargin = NavWidth*0.51;
			document.getElementById(\'inner\').style.width = 228 * parseInt(OffsetMargin / 228);
		}
	}
	window.setInterval(function(){innerChange();}, 100);
</script> -->
<link rel="shortcut icon" href="ico/favicon1.ico">
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

  function submitformbyid(id) {
    document.getElementById(id).submit();return false;
  }

  function sended(id) 
  {
    document.getElementById("id").value = id;
    document.getElementById("google").submit();return false;
  }
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="resources/menu_jquery.js"></script>
<script src="resources/jquery.dd.js"></script>
<script language="javascript">
$(document).ready(function(e) {
try {
$("body select").msDropDown();
} catch(e) {
alert(e.message);
}
});
</script>
</head>';


echo '<body>';

jdcheck();

//<!--- Top/Header -->

$weirdway = 'style="margin-top:30px;"';

//Avisos

//Claim daily points bonus
if(!stilltoday($lastclaim) && $minvisits == 0) 
{
  echo '<div class="success" style="margin-top:10px;"><a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=dbonus"><u>Ya puedes reclamar tus puntos diarios.</u></a></div>';
  $weirdway = '';
}

if((empty($email) || empty($code)) && $points > 10) 
{
  echo '<div class="error" style="margin-top:10px;">Te recomendamos vigorosamente que <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?action=account" title="Se requiere que pongas un email y una contraseña."><u>protejas tu cuenta</u></a>, por que en caso de que tu IP se reseteé perderas tus <b title="'.getmypoints().'">'.getmypoints(true).'</b>.</div>';
  $weirdway = '';
}

$percentage = (calculateexpfromlvl($mylvl) - (calculateexpfromlvl($mylvl, true) - $myexp))/calculateexpfromlvl($mylvl)*100;

echo '<div class="contenido" '.$weirdway.'>
  <div class="inside">
		<div class="boxinside">
			<div style="width:50%;margin:auto;padding-bottom: 5px;" onmouseover="show(\'lvl\')" onmouseout="hide(\'lvl\')">
				<!--- <div class="circle" style="position: relative;top: 38px;left: -35px;"></div> -->
				<div id="progressbar" style="height: 20px;">
					<div style="width:'.$percentage.'%;height:20px;">
      					<div></div>
      					<div style="background-image:url(imgs/stripe_background.png)!important;margin-top: -20px;opacity: 0.5;"></div>
      				</div>
      				<div style="position: relative; top: -22px;left: -35px;" class="levels">'.specialnumformat($mylvl).'</div>
      				<span style="position: relative; top: -44px;display: block;width: 40px;left: 50%;margin-left: -20px;">'.round($percentage, 1).'%</span>
      				<div style="position: relative; top: -63px;left: 100%;margin-left: 10px;" class="levels">'.specialnumformat($mylvl+1).'</div>
    			</div>
    		<div class="bubble" id="lvl" style="position:absolute;width:50%!important;margin-top:15px;z-index:1;display:none;padding:5px;">
				<div class="pointer"></div>
				<div class="pointerBorder" style="display: none"></div>
				<table>
				<tr style="color:#BA9700;">
					<td style="width:100%;"><b>Experiencia:</b></td>
					<td>'.(calculateexpfromlvl($mylvl) - (calculateexpfromlvl($mylvl, true) - $myexp)).'/'.calculateexpfromlvl($mylvl).'</td>
				</tr>
				<tr>
					<td style="width:100%;"><b>Requerido hasta el nivel '.($mylvl+1).':</b></td>
					<td>'.(calculateexpfromlvl($mylvl, true) - $myexp).'</td>
				</tr>
				<tr>
					<td style="width:100%;"><b>Experiencia acumulada:</b></td>
					<td>'.$myexp.'</td>
				</tr>
			</table>
			</div>
    		</div>
			<div class="groupbutton" style="height:40px;float:left;">
				<div class="iconbutton">';

				if(getmypoints(false, false) >= 10000000) {
					echo '<img title="Platino" src="imgs/point-platinum.png" style="margin-top:12px;" />';
				} else if(getmypoints(false, false) >= 100000) {
					echo '<img title="Oro" src="imgs/point-gold.png" style="margin-top:12px;" />';
				} else if(getmypoints(false, false) >= 1000) {
					echo '<img title="Plata" src="imgs/point-silver.png" style="margin-top:12px;" />';
				} else {
					echo '<img title="Cobre" src="imgs/point-bronze.png" style="margin-top:12px;" />';
				} 

				echo '</div>
				<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="'.getmypoints().'">'.getmypoints(true).'</a></div>
			</div>
			<div style="float:right;height:40px;">
				<input class="referlink" type="text" style="width:50%;height:40px;float:right;min-width:282px;" readonly="readonly" value="http://'.$_SERVER['SERVER_NAME'].'/?ref='.$id.'" />
				<span style="color:#999;font-size:23px;position: relative;left: -5px;top:6.5px;float:right;">Link de referido =></span>
				<br class="clear">
			</div>
			<!--- <center style="clear:both;margin-left: 3px;">
			<img src="imgs/chart.png" style="position: relative; top: 2px;left: -3px;">
				<a href="#">Más estadísticas</a>
			</center> -->

			<div style="margin-left: 3px;margin-top: 45px;position: relative;top: 7px;">
				<img src="imgs/chart.png" style="position: relative; top: 2px;left: -3px;">
				<a href="index.php?action=stats">Más estadísticas</a>
			</div>

      <div style="position: relative;float: right;left: -3px;margin-top: -20px;margin-bottom: -10px;">';
        
      include('langs.php');

      echo '</div>

      <br class="clear">

			<!--- <div class="bubble" style="clear: both;float:left; margin-top:15px;width: 180px;height: 20px;color:#000;font-size:10px;text-shadow:0 0 0 #000;">
				<div class="pointer"></div>
				<div class="pointerBorder" style="display: none"></div>
				<span style="padding-left:5px;position: relative;top: -3px;">Haz click para mostrar más info. <img src="https://cdn1.iconfinder.com/data/icons/nuove/16x16/actions/fileclose.png" style="position: relative;top: 5px;right: -6px;"></span>
			</div> -->
		</div>
	</div>
</div>';

//<!--- Menús -->

echo "<div id='cssmenu'>
<ul>
   <li><a href='index.php'><span>Inicio</span></a></li>
   <li><a href='index.php?action=account'><span>Mi cuenta</span></a></li>
   <li><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=feedback'><span>Tablón</span></a></li>
   <li class='has-sub'><a href='#'><span>Tienda</span></a>
      <ul>
         <li><a href='#'><span>Donaciones</span></a></li>
         <li><a href='#'><span>Cupones</span></a></li>
         <li><a href='#'><span>Premium</span></a></li>
         <li><a href='#'><span>Comprar VIP</span></a></li>
         <li><a href='#'><span>Comprar puntos</span></a></li>
         <li><a href='#'><span>Reclamar puntos diarios</span></a></li>
         <li class='last'><a href='#'><span>Intercambiar puntos por dinero</span></a></li>
         <!--- <li class='last'><a href='#'><span>Ir a la tienda</span></a></li> -->
      </ul></li>
   <li><a href='index.php?action=faq'><span>FAQ</span></a></li>
   <li class='has-sub last'><a href='#'><span>Soporte</span></a>
      <ul>
         <li><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=ticket&go=create'><span>Crear ticket</span></a></li>
         <li><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=ticket'><span>Ver mis tickets</span></a></li>
         <li><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=report'><span>Reportar usuario</span></a></li>
         <li><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=share'><span>Compartir contenido</span></a></li>
         <li class='last'><a href='http://".$_SERVER['SERVER_NAME']."/forum/'><span>Ir al foro</span></a></li>
      </ul>
   </li>";

   if($acc_prior >= getprior("admin")) {
      echo "<li class='adminlist'><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=admin-login'><span>Admin</span></a></li>";
   }

   if($acc_prior >= getprior("moderator")) {
      echo "<li class='modlist'><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=admin-login&go=mod'><span>Moderación</span></a></li>";
   }

   if($acc_prior <= getprior('free')) {
      echo "<li class='loginlist'><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=login'><span>Login</span></a></li>
            <li class='activatelist'><a href='http://".$_SERVER['SERVER_NAME']."/index.php?action=activate'><span>Activar</span></a></li>";
   }

echo "</ul>
</div>";

//Charge main body

$action = @$_GET['action'];
if(empty($action)){$action='index';}
 
switch($action){

  //Index (hecho)
  case 'index':
    include_once('inicio.php');
    break;
 
  //See my account and edit it (hecho)
  case 'account':
    include_once('profile.php');
    break;

  //See my current stats (hecho: 70%) [Faltan links y algunos detalles]
  case 'stats':
  	include_once('stats.php');
  	break;

  //Search something (hecho: 50%)
  case 'search':
  	include_once('search.php');
  	break;

  //Do an advanced search (hecho: 20%)
  case 'advsearch':
    include_once('advanced-search-filter.php');
    break;

  //Create a ticket or see the current ticket (hecho: 90%) [Falta: Administración]
  case 'ticket':
    include_once('ticket.php');
    break;

  //[TICKET] To create a new ticket add a new parameter called 'go=create', to see my tickets add 'go=mytickets'

  //See the FAQ (Frequently asked question) (hecho)
  case 'faq':
    include_once('faq.php');
    break;

  //See other profile (hecho: 70%) [Amigos, MPs]
  case 'profile':
  	include_once('profile.php');
  	break;

  //Admin part (hecho: 15%) [Falta: Editar items, añadir IP baneada]
  case 'admin':
  	include_once('admin/index.php');
  	break;

  //Log into admin (hecho)
  case 'admin-login':
  	include_once('admin/login.php');
  	break;

  //See the feedback page (hecho)
  case 'feedback':
    include_once('feedback.php');
    break;

  //Report user (hecho)
  case 'report':
    include_once('report.php');
    break;

  //[REPORT] Parametro 'go=user|bug' (no hace bug, porque ya existen tickets)

  //Share content (sin realizar)
  case 'share':
    include_once('share.php');
    break;

  //Dialy bonus (hecho)
  case 'dbonus':
    include_once('dbonus.php');
    break;

  //User list (sin realizar)
  case 'ulist':
    include_once('ulist.php');
    break;

  //Refer list (sin realizar)
  case 'rlist':
    include_once('rlist.php');
    break;

  //Friend list (sin realizar)
  case 'flist':
    include_once('flist.php');
    break;

  //Sistema de objetivos (sin realizar)
  case 'quests':
    include_once('quests.php');
    break;

  //Buy or sell anything (sin realizar)
  case 'shop':
    include_once('shop.php');
    break;

  //There you can buy anything by using a new parameter called 'buy=points|money|vip|premium|coupon'

  //Activate your account (sin realizar)
  case 'activate':
    include_once('activate.php');
    break;  

  //Login (algo así como reclamar puntos) (sin realizar)
  case 'login':
    include_once('login.php');
    break;  

  //Datasheet
  case 'itemdata':
    include_once('itemdata.php');
    break;  

  //Getting started
  case 'getstarted':
    include_once('getstarted.php');
    break;  
 
 //Not found (hecho: 10%)
  default:
    include_once('404.php');
    break;
}

//<!--- Bottom/Footer -->

echo '<div class="contenido" style="margin-bottom:30px;">
	<div class="inside">

  </div>
</div>';

timequery();

echo '<form id="google" action="download.php" method="post"><input type="hidden" name="game_id" id="id"></form>';

echo '</body>
</html>';

?>