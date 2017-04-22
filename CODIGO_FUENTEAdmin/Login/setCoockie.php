<?php
$ejecucion = $_GET['nom'];
$cookie_name = "user";
$cookie_value = "no";


if (strcmp($ejecucion, '1')==0) {
	$cookie_value = crypt($cookie_value,"Secreta");
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	echo "Todo en orden";
	  }
else{
	if(!isset($_COOKIE["user"])) {
			echo "Cookie named '" . $cookie_name . "' is not set!";
		} 
	else {
			echo strcmp($_COOKIE[$cookie_name],crypt($cookie_value,"Secreta"));
}
	
}

?>