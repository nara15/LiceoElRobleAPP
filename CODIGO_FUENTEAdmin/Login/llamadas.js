function llamarcoockie(param){
	
	
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			    alert(this.responseText);
			}
		};
	//	alert(Parametros);
		xmlhttp.open("POST", "setCoockie.php?nom="+param, true);
		xmlhttp.send();

}
