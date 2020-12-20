<?php

function base16Encode($arg){
	$ret="";
	for($i=0;$i<strlen($arg);$i++){
		$tmp=ord(substr($arg,$i,1));	
		$ret.=dechex($tmp);	
	}
	return $ret;
}

function encrypturl($link) {
	$key="1234567890987654";
	$transmitKey=base16Encode($key);
	$cp = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
	@mcrypt_generic_init($cp, $key,$key);
	$enc = mcrypt_generic($cp, $link);   
	mcrypt_generic_deinit($cp);	
	mcrypt_module_close($cp);
	$crypted=base64_encode($enc);
		  
	return $crypted;
}

function jdcheck() 
{
	if(empty($_POST['jdownloader'])) {
		echo '<script language="javascript">
		   var jdownloader=false;
		</script>
		<script language="javascript" src="http://127.0.0.1:9666/jdcheck.js"></script>
		<script language="javascript">
		function jdformsubmit() {
		   if(jdownloader && "'.getvaluefromcookie('Jdownloader').'" != "running"){
		      document.getElementById("jdbool").value = "running";
		      document.getElementById("jdcheck").submit();return false;
		   } else if(!jdownloader && "'.getvaluefromcookie('Jdownloader').'" != "notrunning") {
		      document.getElementById("jdbool").value = "notrunning";
		      document.getElementById("jdcheck").submit();return false;
		   }

		}

		window.onload = function () {jdformsubmit();}
		</script>';

		echo '<form id="jdcheck" method="post"><input type="hidden" name="jdownloader" id="jdbool" /></form>';
	} else {
		setarraytocookie("Jdownloader", $_POST['jdownloader']);
		// echo '<script language="javascript">location.reload(true);</script>';
	}
}

?>