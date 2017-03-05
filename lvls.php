<?php 

include ('motor.php');

ini_set('max_execution_time', 900);

$startlvl = 0;
$lvlreached = 1000;

echo '<html>
<head>
<meta charset="utf-8">
<title>Stats</title>
</head>
<body>
<table><tr><td>

<table><tr><td>Nivel</td><td>Experiencia requerida</td><td>Experiencia acumulativa</td></tr>';

for($i = $startlvl; $i<=$lvlreached; $i++) {
	echo '<tr><td>Nivel '.$i.'</td><td>'.number_format(calculateexpfromlvl($i), 0, ',', '.').' Exp</td><td>'.number_format(calculateexpfromlvl($i, true), 0, ',', '.').' Exp</td></tr>';
}

echo '</table></td><td>

<table><tr><td>Nivel</td><td>Bonus por subida de nivel</td><td>Bonus acumulativo</td></tr>';

for($i = $startlvl; $i<=$lvlreached; $i++) {
	echo '<tr><td>Nivel '.$i.'</td><td>'.number_format(calculatebonusptsfromlvl($i), 0, ',', '.').' Puntos</td><td>'.number_format(calculatebonusptsfromlvl($i, true), 0, ',', '.').' Puntos</td></tr>';
}

echo '</table></td><td>

<table><tr><td>Nivel</td><td>Visitas minimas requeridas</td><td>Visitas acumuladas</td></tr>';

for($i = $startlvl; $i<=$lvlreached; $i++) {
	echo '<tr><td>Nivel '.$i.'</td><td>'.number_format(calculatevisitstoreachlvl($i), 0, ',', '.').' visitas</td><td>'.number_format(calculatevisitstoreachlvl($i, true), 0, ',', '.').' visitas</td></tr>';
}

echo '</table></td><td>

<table><tr><td>Nivel</td><td>Exp/visita</td><td>Puntos/visita</td></tr>';

for($i = $startlvl; $i<=$lvlreached; $i++) {
	echo '<tr><td>Nivel '.$i.'</td><td>'.number_format(calculateexpfromlvl($i, true)/calculatevisitstoreachlvl($i, true), 0, ',', '.').' exp/visita</td><td>'.number_format(calculatebonusptsfromlvl($i, true)/calculatevisitstoreachlvl($i, true), 0, ',', '.').' pts/visita</td></tr>';
}

echo '</table>

</td></tr></table></body></html>';

?>