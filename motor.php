<?php

include ('Settings.php');

function connect() 
{

	global $localhost, $dbuser, $dbpass, $dbname; 

	// ################################################
	// ######### connect + select  database ###########
	// ################################################

	mysqli_connect($localhost, $dbuser, $dbpass) or die('Could not connect: ' . mysqli_error());
	
	$conn = mysqli_select_db($dbname) or die ("Can't use database $dbname! : " . mysqli_error());
	//mysqli_set_charset('utf8',$conn);

	return $conn;

}

function addinfo()
{ 

	global $dbtableinfo; 
	
// #################################################################
// ######### add IP and user-agent and time or update it ###########
// #################################################################


// gather user data
$ip = $_SERVER["REMOTE_ADDR"]; 
$id = getmyreferid();
$agent = $_SERVER["HTTP_USER_AGENT"];
$datetime = time();
(int)$refer = mysqli_real_escape_string($_GET['ref']);
if(empty($refer)) {$refer=null;}

if(!mysqli_num_rows(mysqli_query("SELECT ip_address FROM $dbtableinfo WHERE ip_address = '$ip'"))) // check if the IP is in database
{
	//If not , add it.	

	mysqli_query("INSERT INTO $dbtableinfo (ip_address, user_agent, datetime, refer_id, lastconn) VALUES('$ip', '$agent', '$datetime', '$refer', '$datetime')") or die('Could not add IP: ' . mysqli_error());

} else {

	//Else, update some rows

	$row = mysqli_fetch_assoc(mysqli_query("SELECT * FROM $dbtableinfo WHERE id='$id'"));

	$exp = $row['exp'];
	$lvl = $row['lvl'];
	$lastconn = $row['lastconn'];
	$multiplier = $row['multiplier'];

	//Edit the lastconn entry...

	$remainingvisits = 3 * $multiplier;

	//if(time() - (int)$lastconn > 600) { //If last connection is greater than ten mintutes update it.
	
		mysqli_query("UPDATE $dbtableinfo SET lastconn='$datetime' WHERE ip_address='$ip'") or die('Could not update user info: ' . mysqli_error());

	//}

	//Restore everything if today is a new day.

	if(!stilltoday($lastconn))
	{
		//Dialy bonus
		mysqli_query("UPDATE $dbtableinfo SET remainingvisits='$remainingvisits' WHERE ip_address='$ip'") or die('Could not update user info: ' . mysqli_error());
	}

	$proceed = false;

	if($refer != null) //There is a referer, and a refered user
	{

		//Refer data

		$row2 = mysqli_fetch_assoc(mysqli_query("SELECT * FROM $dbtableinfo WHERE id='$refer'"));
		$rexp = $row2['exp'];
		$rlvl = $row2['lvl'];
		$rmultiplier = $row2['multiplier'];		

		//There is the part that checks the cheats...

		if($refer != getmyreferid()) //The simplest thing is check that the current user is the same in the variable index.php?ref=id
		{

			if(!checkisbanned($ip) && maxviewsperday() && userexists($refer)) //Check if the current visitor's ip is banned and the maxviewsperday is actually available.
			{

				//For Debugging...
				/*setpoints($refer, 1);
				newvisited($refer, time());*/

				if($row['visitarray'] == null) //If the visit array is empty that means that the user didn't visited anything yet.
				{
					$proceed = true;
				} else //The user has visited something.
				{
					$visitarray = (array)unserialize($row['visitarray']); //Unserialize the data and convert into a Array

					if(time() - $visitarray[$refer] > 86400) //Check if the refer has been visited before and compare with the actual time with the last visit, if the last visit is greater than 1 day add the points.
					{
						$proceed = true;
					}
				}

			}

		} //Else for pusishment, maybe? haha :3

		//Other checks (Functions: bannedip() (for proxies and bad boys), (Hecho)
		//Checklastconn() (Checks the last connection to some user, and if it's greater than X seconds add points, if not wait) (Hecho)
		//MaxViewsperDay() (If that function return false, no points will be added) (Hecho)) 

	}

	if($proceed) 
	{
		setpoints($refer, 1*$rmultiplier);
		setexperience($refer, 1*$rmultiplier);
		setexperience($id, 1*$multiplier/$rmultiplier);
		newvisited($refer, time());
		removeremvisit();
		recalculatelvl($refer, $rlvl, $rexp);
		recalculatelvl($id, $lvl, $exp);
		sumvisit($refer);
	}

}


} 

function sumvisit($id) 
{

	global $dbtableinfo;

	mysqli_query("UPDATE $dbtableinfo SET numvsts = numvsts + 1 WHERE id='$id'");

}

function getdailybonus() 
{
	global $dbtableinfo;

	$row = mysqli_fetch_assoc(mysqli_query("SELECT remainingvisits as remvsts, lvl as lvl, multiplier as mult FROM $dbtableinfo WHERE id='$id'"));

	if(!$row['remvsts']) 
	{
		$lvl = $row['lvl'];
		$mult = $row['mult'];
		$morepoints = round(pow(120*$mult, 1+$lvl/100));
		setpoints($id, $morepoints);
	}

}

function newvisited($user, $date) {

	global $dbtableinfo;

	$id = getmyreferid();

	$row = mysqli_fetch_assoc(mysqli_query("SELECT visitarray FROM $dbtableinfo WHERE id='$id'"));

	if($row['visitarray'] != null) {
		$visitarray = (array)unserialize($row['visitarray']);
		$visitarray[$user] = $date;
		$svisit = serialize($visitarray);
	} else {
		$visitarray = array($user => $date);
		$svisit = serialize($visitarray);
	}

	mysqli_query("UPDATE $dbtableinfo SET visitarray='$svisit' WHERE id='$id'");

}

function removeremvisit() 
{

	global $dbtableinfo;

	$id = getmyreferid();

	mysqli_query("UPDATE $dbtableinfo SET remainingvisits = remainingvisits - 1 WHERE id='$id'");
}

function maxviewsperday() 
{

	global $dbtableinfo;

	$id = getmyreferid();

	$row = mysqli_fetch_assoc(mysqli_query("SELECT remainingvisits FROM $dbtableinfo WHERE id='$id'"));

	if($row['remainingvisits']) //The actual visits is true because it's greater than 1
	{
		return true;
	} else 
	{
		return false;
	}
}

function uptlastclaim() 
{

	global $dbtableinfo;

	$id = getmyreferid();
	$now = time();

	mysqli_query("UPDATE $dbtableinfo SET lastclaim = '$now' WHERE id='$id'");

}

function checkisbanned($ip) 
{
	if(mysqli_num_rows(mysqli_query("SELECT id FROM bannedips WHERE ip='$ip'")))
	{
		return true;
	} else 
	{
		return false;
	}
}

function stilltoday($date) //Comprueba si la fecha está todavía dentro de este rango horario. (00:00:00 - 23:59:59)
{
	$dateFrom = date("Y-m-d", $date);
	$dateTo = date("Y-m-d", time());

	if($dateTo==$dateFrom){
		return true;
	}else{
		return false;
	}
}

function thisexists() //Check if there is any account with the current visitor's IP
{

	global $dbtableinfo;

	$id = getmyreferid();

	if(mysqli_num_rows(mysqli_query("SELECT id FROM $dbtableinfo WHERE id='$id'"))) {
		return true;
	} else {
		return false;
	}
}

function userexists($id) //Check if there is any account with the current visitor's IP
{

	global $dbtableinfo;

	if(mysqli_num_rows(mysqli_query("SELECT id FROM $dbtableinfo WHERE id='$id'"))) {
		return true;
	} else {
		return false;
	}
}

function getmyreferid() 
{

	global $dbtableinfo;

	$ip = $_SERVER["REMOTE_ADDR"]; 

	$query = mysqli_query("SELECT id FROM $dbtableinfo WHERE ip_address='$ip' AND acc_prior > -3 LIMIT 0,1");

	if(mysqli_num_rows($query)) {
		$row = mysqli_fetch_assoc($query);
		return $row['id'];
	} /*else {
		die('Hubo un error al procesar la información. #0001');
	}*/

	return 0;

}

function formatnumber($number, $dots = true) {
	if($dots) //Commas to dots
	{
		$str = str_replace(',', '.', $number);
		return $str;
	} else //Dots to commas
	{
		$str = str_replace('.', ',', $number);
		return $str;
	}
}

function getpointsbyid($id) 
{

	global $dbtableinfo;

	$query = mysqli_query("SELECT points FROM $dbtableinfo WHERE id='$id'");

	$row = mysqli_fetch_assoc($query);
	$rowd = $row['points'];

	return (int)$rowd;
}

function getexpbyid($id) 
{

	global $dbtableinfo;

	$query = mysqli_query("SELECT exp FROM $dbtableinfo WHERE id='$id'");

	$row = mysqli_fetch_assoc($query);
	$rowd = $row['exp'];

	return (int)$rowd;
}

function getlvlbyid($id) 
{

	global $dbtableinfo;

	$query = mysqli_query("SELECT lvl FROM $dbtableinfo WHERE id='$id'");

	$row = mysqli_fetch_assoc($query);
	$rowd = $row['lvl'];

	return (int)$rowd;
}

function getmultbyid($id) 
{

	global $dbtableinfo;

	$query = mysqli_query("SELECT multiplier FROM $dbtableinfo WHERE id='$id'");

	$row = mysqli_fetch_assoc($query);
	$rowd = $row['multiplier'];

	return (int)$rowd;
}

function givepointsinactivation($quantity) 
{
	$id = getmyreferid();
	setpoints($id, $quantity);
}

function recurseTree($var)
{
  $out = '<li>';
  foreach($var as $v){
    if(is_array($v)){
      $out .= '<ul>'.recurseTree($v).'</ul>';
    }else{
      $out .= $v;
    }
  }
  return $out.'</li>';
}

function getmypoints($round = false, $texted = true, $commas = true, $dots = true) 
{

	global $dbtableinfo;

	$ip = $_SERVER["REMOTE_ADDR"]; 

	$query = mysqli_query("SELECT points FROM $dbtableinfo WHERE ip_address='$ip'");

	$string = "";

	if(thisexists()) {

		$row = mysqli_fetch_assoc($query);
		$rowd = $row['points'];

		if($texted) {
			if($round) {
				if((int)$rowd == 1) {
					$string = $rowd." point";
				} else if((int)$rowd >= 1000000000000000000000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000000000000000000000, 1), $dots)."D points";
				} else if((int)$rowd >= 1000000000000000000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000000000000000000, 1), $dots)."N points";
				} else if((int)$rowd >= 1000000000000000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000000000000000, 1), $dots)."O points";
				} else if((int)$rowd >= 1000000000000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000000000000, 1), $dots)."Spt points";
				} else if((int)$rowd >= 1000000000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000000000, 1), $dots)."Sx points";
				} else if((int)$rowd >= 1000000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000000, 1), $dots)."Q points";
				} else if((int)$rowd >= 1000000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000000, 1), $dots)."Ct points";
				} else if((int)$rowd >= 1000000000000) {
					$string = formatnumber(round((int)$rowd/1000000000000, 1), $dots)."T points";
				} else if((int)$rowd >= 1000000000) {
					$string = formatnumber(round((int)$rowd/1000000000, 1), $dots)."B points";
				} else if((int)$rowd >= 1000000) {
					$string = formatnumber(round((int)$rowd/1000000, 1), $dots)."M points";
				} else if((int)$rowd >= 1000) {
					$string = formatnumber(round((int)$rowd/1000, 1), $dots)."k points";
				} else {
					$string = $rowd." points";
				}
				return $string;
			} else {
				if($commas || $dots) {
					if($commas) {
						if($rowd == 1) {
							$string = number_format($rowd, 0, ',', '.')." point";
						} else {
							$string = number_format($rowd, 0, ',', '.')." points";
						}
					} else if($dots) {
						if($rowd == 1) {
							$string = number_format($rowd, 0, '.', ',')." point";
						} else {
							$string = number_format($rowd, 0, '.', ',')." points";
						}
					}
					return $string;
				} else {
					if((int)$rowd == 1) {
						$string = $rowd." point";
					} else {
						$string = $rowd." points";
					}
					return $string;
				}
			}
		} else {
			return (int)$rowd;
		}
	} else {
		die('Hubo un error al procesar la información. #0002');
	}

}

function specialnumformat($num, $dots = false) 
{

	$string = "";

	if($num >= 1000000000000000000000000000000000) {
		$string = formatnumber(round($num/1000000000000000000000000000000000, 1), $dots)."D";
	} else if($num >= 1000000000000000000000000000000) {
		$string = formatnumber(round($num/1000000000000000000000000000000, 1), $dots)."N";
	} else if($num >= 1000000000000000000000000000) {
		$string = formatnumber(round($num/1000000000000000000000000000, 1), $dots)."O";
	} else if($num >= 1000000000000000000000000) {
		$string = formatnumber(round($num/1000000000000000000000000, 1), $dots)."Spt";
	} else if($num >= 1000000000000000000000) {
		$string = formatnumber(round($num/1000000000000000000000, 1), $dots)."Sx";
	} else if($num >= 1000000000000000000) {
		$string = formatnumber(round($num/1000000000000000000, 1), $dots)."Q";
	} else if($num >= 1000000000000000) {
		$string = formatnumber(round($num/1000000000000000, 1), $dots)."Ct";
	} else if($num >= 1000000000000) {
		$string = formatnumber(round($num/1000000000000, 1), $dots)."T";
	} else if($num >= 1000000000) {
		$string = formatnumber(round($num/1000000000, 1), $dots)."B";
	} else if($num >= 1000000) {
		$string = formatnumber(round($num/1000000, 1), $dots)."M";
	} else if($num >= 1000) {
		$string = formatnumber(round($num/1000, 1), $dots)."k";
	} else {
		$string = $num;
	}

	return $string;

}

function setpoints($id, $pointsquantity, $type = 0) 
{

	global $dbtableinfo;

	$allpoints = getpointsbyid($id);

	if($type == 0) //Add
	{
		$allpoints += $pointsquantity;
	} else if($type == 1) //Substract
	{
		$allpoints -= $pointsquantity;
	} else if($type == 2) //Multiply
	{
		$allpoints *= $pointsquantity;
	} else if($type == 3) //Divide
	{
		$allpoints /= $pointsquantity;
	}

	if(thisexists()) {
		mysqli_query("UPDATE $dbtableinfo SET points = $allpoints WHERE id='$id'");
	} else {
		die('Hubo un error al procesar la información. #0003');
	}

}

function setexperience($id, $expquantity, $type = 0) 
{

	global $dbtableinfo;

	$allexp = getexpbyid($id);
	$cexpq = ceil($expquantity);

	if($type == 0) //Add
	{
		$allexp += $cexpq;
	} else if($type == 1) //Substract
	{
		$allexp -= $cexpq;
	} else if($type == 2) //Multiply
	{
		$allexp *= $cexpq;
	} else if($type == 3) //Divide
	{
		$allexp /= $cexpq;
	}

	if(thisexists()) {
		mysqli_query("UPDATE $dbtableinfo SET exp = $allexp WHERE id='$id'");
	} else {
		die('Hubo un error al procesar la información. #0003');
	}

}

function recalculatelvl($id, $actualvl, $exp) 
{

	global $dbtableinfo;

	$newlvl = $actualvl;

	$reachednewlvl = false;

	if(calculateexpfromlvl($actualvl, true) < $exp) 
	{
		for($i = $actualvl; $i < 1000; $i++) //Check with the next 1000 lvls
		{
			if(calculateexpfromlvl($i, true) > $exp) 
			{
				$newlvl = $i;
				$reachednewlvl = true;
				break;
			} 
		}
	}

	mysqli_query("UPDATE $dbtableinfo SET lvl = '$newlvl' WHERE id='$id'");

	$row = mysqli_fetch_assoc(mysqli_query("SELECT multiplier FROM $dbtableinfo WHERE id='$id'"));;

	$actualmulty = $row['multiplier'];
	$newmulti = calculatemultfromlvl($newlvl);

	if($newmulti > $actualmulty) 
	{
		mysqli_query("UPDATE $dbtableinfo SET multiplier = '$newmulti' WHERE id='$id'");
	}

	/*if(strlen($newlvl) > 1) {
		$roundedlvl = (int)substr($newlvl, -1);
	} else {
		$roundedlvl = (int)$newlvl;
	}
	$templvl = (int)$newlvl;
	$tempmulty = 1;

	if($roundedlvl < 5) 
	{
		$templvl = $newlvl - $roundedlvl;
	} else if($roundedlvl > 5) 
	{
		$templvl = $newlvl - $roundedlvl + 5;
	}

	if($templvl % 5 === 0) 
	{
		if($templvl/5+1 >= $multiplier) 
		{
			$newmult = $templvl/5+1;
			mysqli_query("UPDATE $dbtableinfo SET multiplier = '$newmult' WHERE id='$id'");
		}
	} else 
	{
		die('Hubo un error matemático. #0001');
	}*/

	if($reachednewlvl) 
	{
		$points = getpointsbyid($id);

		$points = calculatebonusptsfromlvl($newlvl, true);

		setpoints($id, $points);
	}

	//We have to set the multiplier (1 more) each five levels

}

function calculateexpfromlvl($lvl, $accumulative = false) 
{

	//3 is the exp of the lvl 0
	(int)$number = 0;

	if($accumulative) 
	{
		for($i = 0; $i<=$lvl; ++$i) 
		{
			if($i < 130) {
				$number += round(3 + $i * pow(($i+1), (1+$i/100)), 0);
			} else {
				$number += 9630913;
			}
		}
	} else 
	{
		if($lvl < 130) {
			$number = round(3 + $lvl * pow(($lvl+1), (1+$lvl/100)), 0);
		} else {
			$number = 9630913;
		}
	}

	return $number;
}

function calculatebonusptsfromlvl($lvl, $accumulative = false) 
{

	//5 is the points gave in the lvl 0
	(int)$number = 0;

	if($accumulative) 
	{
		for($i = 0; $i<=$lvl; $i++) 
		{
			if($i < 100) {
				$number += round(5 + pow($i, 2 + $i/100)); //Nan when $i = -1
			} else {
				$number += 1000000;
			}
		}
	} else 
	{
		if($lvl < 100) {
			$number = round(5 + pow($lvl, 2 + $lvl/100));
		} else {
			$number = 1000000;
		}
	}

	return $number;

}

function calculatemultfromlvl($lvl) 
{

	$number = floor($lvl/5);

	if($number == 0) 
	{
		$number = 1;
	}

	return $number;
}

function calculatevisitstoreachlvl($lvl, $accumulative = false) 
{

	(int)$number = 0;

	if($accumulative) 
	{
		for($i = 0; $i<=$lvl; $i++) 
		{
			if($i < 130) {
				$number += calculateexpfromlvl($i)/calculatemultfromlvl($i);
			} else {
				$number += 9630913/calculatemultfromlvl($i);
			}
		}
	} else 
	{
		if($lvl < 130) {
			$number = calculateexpfromlvl($lvl)/calculatemultfromlvl($lvl);
		} else {
			$number = 9630913/calculatemultfromlvl($lvl);
		}
	}

	return $number;

}

function strdate($date) {

	$str_time = "";

	if($date == null) {
		$date = time();
	}

	$diff = time() - $date;

	if($diff < 3) {
		$str_time = 'unos instantes.'; 
	} else if($diff < 10) {
		$str_time = 'unos segundos.';
	} else if($diff < 60) {
		$str_time = $diff.' segundos.';
	} else if($diff >= 60 && $diff < 120) {
        	$str_time = floor($diff/60).' minuto';		
	} else if($diff < 3600) {
        	$str_time = floor($diff/60).' minutos';		
	} else if($diff >= 3600 && $diff < 7200) {
        	$str_time = floor($diff/3600).' hora';		
	} else if($diff < 86400) {
        	$str_time = floor($diff/3600).' horas';		
	} else if($diff >= 86400 && $diff < 86400*2) {
        	$str_time = floor($diff/86400).' día';		
	} else if($diff < 604800) {
        	$str_time = floor($diff/86400).' días';		
	} else if($diff >= 604800 && $diff < 604800*2) {
        	$str_time = floor($diff/604800).' semana';		
	} else if($diff < 2592000) {
        	$str_time = floor($diff/604800).' semanas';		
	} else if($diff >= 2592000 && $diff < 2592000*2) {
        	$str_time = floor($diff/2592000).' mes';		
	} else if($diff < 31536000) {
        	$str_time = floor($diff/2592000).' meses';		
	} else if($diff >= 31536000 && $diff < 31536000*2) {
        	$str_time = floor($diff/31536000).' año';		
	} else {
        	$str_time = floor($diff/31536000).' años';		
	} 

	return $str_time;

}

function getcssclassbyreporttype($type_report) {
	return 0;
}

function getLocationInfoByIp($ip){

	if($ip == null) {
		$ip = $_SERVER["REMOTE_ADDR"];
	}

    $ip_data = @json_decode
(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
    if($ip_data && $ip_data->geoplugin_countryName != null){
    	$result['city'] = $ip_data->geoplugin_city;
		$result['region'] = $ip_data->geoplugin_region;
		$result['areaCode'] = $ip_data->geoplugin_areaCode;
		$result['dmaCode'] = $ip_data->geoplugin_dmaCode;
		$result['countryCode'] = $ip_data->geoplugin_countryCode;
		$result['country'] = $ip_data->geoplugin_countryName;
		$result['continentCode'] = $ip_data->geoplugin_continentCode;
		$result['latitude'] = $ip_data->geoplugin_latitude;
		$result['longitude'] = $ip_data->geoplugin_longitude;
		$result['regionCode'] = $ip_data->geoplugin_regionCode;
		$result['region'] = $ip_data->geoplugin_regionName;
		$result['currencyCode'] = $ip_data->geoplugin_currencyCode;
		$result['currencySymbol'] = $ip_data->geoplugin_currencySymbol;
		$result['currencySymbol_UTF8'] = $ip_data->geoplugin_currencySymbol_UTF8;
		$result['currencyConverter'] = $ip_data->geoplugin_currencyConverter;
    }
    return $result;
}

function getprior($rango) 
{
	switch ($rango) {

		case 'deleted':
			return -3;
			break;

		case 'banned':
			return -2;
			break;

		case 'troll':
			return -1;
			break;

		case 'user':
		case 'free':
			return 0;
			break;

		case 'ureg':
		case 'registered':
		case 'actived':
		case 'richman':
		case 'rich':
		case 'celebrity':
		case 'noted-user':
			return 1;
			break;

		case 'colaborator':
		case 'tvip':
		case 'helper':
		case 'wiki':
		case 'recruiter':
		case 'youtuber':
		case 'super-user':
		case 'superu':
		case 'superuser':
		case 'abon':
			return 2;
			break;

		case 'vip':
		case 'premium':
		case 'temp-mod':
			return 3;
			break;

		case 'moderator':
		case 'mod':
		case 'temp-admin':
		case 'scripter':
		case 'programmer':
		case 'bug-reporter':
		case 'bug-fixer':
		case 'webopt':
			return 4;
			break;

		case 'supermod':
		case 'admin':
		case 'administrator':
		case 'temp-boss':
		case 'admi':
			return 5;
			break;

		case 'superadmin':
		case 'boss':
		case 'adm-jefe':
		case 'co-owner':
			return 6;
			break;

		case 'owner':
		case 'temp-hacker':
			return 7;
			break;

		case 'hacker':
			return 8;
			break;

		default:
			return 0;
			break;
	}
}

function isnew($post_type) {

	global $dbtableinfo;

	$id = getmyreferid();

	$row = mysqli_fetch_assoc(mysqli_query("SELECT notifications FROM $dbtableinfo WHERE id='$id'"));

	$notarray = (array)unserialize($row['notifications']);
	if($notarray[$post_type]) {
		return false;
	} else {
		return true;
	}
}

function setreaded($post_type) {

	global $dbtableinfo;

	$id = getmyreferid();

	$row = mysqli_fetch_assoc(mysqli_query("SELECT notifications FROM $dbtableinfo WHERE id='$id'"));

	$notarray = (array)unserialize($row['notifications']);
	$notarray[$post_type] = true;
	$snot = serialize($notarray);

	mysqli_query("UPDATE $dbtableinfo SET notifications='$snot' WHERE id='$id'");

}

function timequery(){
   static $querytime_begin;
   list($usec, $sec) = explode(' ',microtime());
    
       if(!isset($querytime_begin))
      {   
         $querytime_begin= ((float)$usec + (float)$sec);
      }
      else
      {
         $querytime = (((float)$usec + (float)$sec)) - $querytime_begin;
         echo sprintf('<center style="position:relative;top:-15px;">La consulta tardó %01.5f segundos</center>', $querytime);
      }
}

function getrand($array, $cur, $max) 
{
		
	$num = rand(1, $max);
		
	while(true) 
	{
		if(!in_array($num, $array, true)) 
		{
			if($cur > $max) 
			{
				die('El valor máximo es menor que el valor actual.');
			}
			break;
		} else 
		{
			$num = rand(1, $max);
		}
			
	}
		
	$array[$cur] = $num;
	return $array;
		
}

function perenc($str) 
{
	$newstr = "";
	for($i = 0; $i < strlen($str); $i++) 
	{
		$newstr .= "%".dechex(ord(substr($str, $i, 1)));
	}
	return $newstr;
}

function perdec($dec) 
{
	$newstr = "";
	$decarray = explode("%", $dec);
	for($i = 0; $i < count($decarray); $i++) 
	{
		$newstr .= chr(hexdec($decarray[$i]));
	}
	return $newstr;
}

function mb_unserialize($string) {
    $string = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $string);
    return unserialize($string);
}

function setarraytocookie($str_index, $content) 
{
	$carray = unserialize($_COOKIE['TMDCookie']);
	$carray[$str_index] = $content;
	$carray = serialize($carray);
	setcookie("TMDCookie", "", time()-3600);
	setcookie("TMDCookie", $carray, time()+365*86400);
}

function getvaluefromcookie($index_to_search) 
{
	$carray = unserialize($_COOKIE['TMDCookie']);
	return $carray[$index_to_search];
}

?>
