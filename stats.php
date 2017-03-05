<?php 

$acc_prior_string = "";

if($acc_type == "free")
{
	$acc_prior_string = "<b style='color:indianred;'>FREE USER</b>";
} else if($acc_type == "prem")
{
	$acc_prior_string = "<b style='color:green;'>PREMIUM</b>";
} else if($acc_type == "ureg")
{
	$acc_prior_string = "<b style='color:yellow;'>REGISTERED USER</b>";
} else if($acc_type == "abon")
{
	$acc_prior_string = "<b style='color:yellow;'>USUARIO ABONADO</b>";
}


echo '<div class="contenido">
	<div class="inside" style="display:table;margin: 10px auto;text-align:center;">
		<h1 style="color:aquamarine;margin-bottom: 5px;">Estadísticas</h1>
		Observe aquí sus estadísticas.
		<br><br>
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
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
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="'.getmypoints().' [Media por día: '.round(getmypoints(false, false)/$reg_days, 1).' puntos]">'.getmypoints(true).'</a></div>
		</div>
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/coins.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Cantidad de dinero [Media por día: '.round($money/$reg_days, 1).' $]">'.$money.' $</a></div>
		</div>
		<br class="clear">
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/refer.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Número de referidos [Media por día: '.round($refernum/$reg_days, 1).' refers]">'.$refernum.' refers</a></div>
		</div>
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/prem.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;" title="Tipo de cuenta">'.$acc_prior_string.'</a></div>
		</div>
		<br class="clear">
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/remaining.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Nº de visitas contables: cuando este número se agote tus visitas a otros usuarios no darán puntos">'.$remainingvisits.' vsts rest</a></div>
		</div>
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/ip.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Numero de visitas recibidas">'.$visitas.' visitas</a></div>
		</div>
		<br class="clear">
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/mult.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Multiplier: este número representa la cantidad por la que se amplifica ciertas medidas y números">x'.$multiplier.'</a></div>
		</div>
		<div class="groupbutton" style="height:40px;float:left;margin: 0 5px 5px 0;">
			<div class="iconbutton"><img src="imgs/discount.png" style="width:16px;height:16px;margin-top:12px;" /></div>
			<div class="button"><a href="#" style="line-height:40px;text-decoration:none;font-size:23px;color:yellowgreen;" title="Descuento en descargas">-'.$discount.'%</a></div>
		</div>
		<br class="clear">
		<!--- Puntos por día, niveles por día, experiencia por día, dinero por día, referidos por día, Exp, Lvl, Visitas -->
	</div>
</div>';

?>