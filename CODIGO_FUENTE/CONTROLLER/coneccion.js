
function getConeccion(){
		var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
						    alert(this.responseText);
						    let jsonObject = JSON.parse(this.responseText);
						    var json = this.responseText.evalJSON(true);
  
						    
						    $.each(json,function(index, value){
							    alert('My array has at position ' + index + ', this value: ' + value);
							});
						    
						    
						    
						    
						    
						}
					};
					xmlhttp.open("GET", "../MODEL/obtenerServicios.php", true);
					xmlhttp.send();
					
		
	}
	
	/**
	 *	Función del controlador para eliminar un servicio de la aplicación
	 */
	function eliminarServicios(){
		var inputElements = document.getElementsByName('ServiciosChecked');
		for(var i=0; inputElements.length; ++i){
			if(inputElements[i].checked){
				var CondicionElimina = confirm(" Desea eliminar a : " + inputElements[i].id);
				if (CondicionElimina){
					llamadoActualizarDatos("eliminarServicios.php","?nom="+inputElements[i].id,null);
				
					
				}
				}
			}
	}
	
	/**
	 * Función para realizar una petición POST al servidor. Los datos de la peticiión se realiza
	 * por un encapsulamiento enviado por le método send de AJAX.
	 * P_Servicio : Dirección al API para realizar la petición
	 * P_Parametros : Encapsulamiento de los parámetros del POST. De tipo FormData.
	 * Callback: Referencia a la función que se desea realizar durante la petición asincrónica de AJAX.
	 */
	function realizarPeticion_POST(P_Servicio,P_Parametros, Callback) 
	{
		var HttpRequest = new XMLHttpRequest();
		
	
		HttpRequest.ontimeout = function()
		{
			alert("La petición al servidor no se realizó");	
		};
		HttpRequest.onload = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				Callback(this.responseText);
			}
		};
		
		HttpRequest.open("POST", "../MODEL/"+P_Servicio, true);
		HttpRequest.timeout = 20000;
		HttpRequest.send(P_Parametros);
	
	}
	
	/**
	 * Función controladora para agregar un nuevo servicio al sistema.
	 */
	function agregarServicios()	
	{
		
		var Imagen_Dir = "";
		
		var Imagen = document.getElementById("service_image_input_field").files[0];
		var ImageWrapper = new FormData();
		ImageWrapper.append("FILE", Imagen);
		ImageWrapper.append("FUNCTION", "ImageSaver");
		ImageWrapper.append("TARGET_DIR", "../Images/services/")
		
		realizarPeticion_POST("subirImagenes.php", ImageWrapper, function(response) {

			Imagen_Dir = "../Images/services/" + Imagen.name;
			var ContenidoTexto = document.getElementsByName('contenidoTexto')[0].value;
			var NombreServicio = document.getElementById("serviceName").value;
			
			agregarServiciosAux(Imagen_Dir);
		//	llamadoActualizarDatos("agregarServicio.php","?nom="+NombreServicio+"&imag="+Imagen_Dir+"&contenidoTexto="+ContenidoTexto,null);
		
					
		});
	

	}
	function agregarServiciosAux(Imagen_Dir)
	{
		
			var ContenidoTexto = document.getElementsByName('contenidoTexto')[0].value;
			var NombreServicio = document.getElementById("serviceName").value;
			
			//alert(ContenidoTexto);
			
			
			var http = new XMLHttpRequest();
			
			http.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					    alert(this.responseText);
					}
			};
		
			http.open("POST", "../MODEL/agregarServicio.php", true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
			http.setRequestHeader("Content-Length", ContenidoTexto.length);
			http.send("nom="+NombreServicio+"&imag="+Imagen_Dir+"&contenidoTexto="+encodeURIComponent(ContenidoTexto));
			
		
	}
	
	
	function agregarSecciones()	{
		var SeccionNueva = document.getElementById("sectionPlace").value;
		//Cargar imagen-Juntar con lo de Mario y pasar link
		var Imagen = "No hay";
		//Eliminación de información de la imagen
		

		llamadoActualizarDatos("agregarSecciones.php","?nom="+SeccionNueva,null);
		
		window.location.reload(true);
		
	
		
		
	}
	
	
	function eliminarSecciones(){
		var Secciones = document.getElementsByName('SeccionesChecked');
		for(var i=0; Secciones.length; ++i){
			if(Secciones[i].checked){
				var CondicionElimina = confirm(" Desea eliminar a : " + Secciones[i].id);
				if (CondicionElimina)
				{
					
					llamadoActualizarDatos("eliminarSecciones.php","?nom="+Secciones[i].id,null);
					
					window.location.reload(true);
					
				
					}
				}
			}
				
	}
	
	function agregarNoticia()	{
		var TituloNuevo = document.getElementById("newsName").value;
		var Link = document.getElementById("link").value;
		var FechaNoticia = document.getElementById("fecha").value;
		var DetalleNoticia = document.getElementsByName("detalleTexto")[0].value;
		//Cargar imagen-Juntar con lo de Mario y pasar link detalleTexto
		var Imagen = "No hay";
		//Eliminación de información de la imagen
		if(TituloNuevo.length < 90 && TituloNuevo.length > 0)/*Por la base de datos, verificación*/{
			if(FechaNoticia.length !=0 && DetalleNoticia.length != 0 ){
				var Link = (Link == null ? "" : Link);
				llamadoActualizarDatos("agregarNoticias.php","?nom="+TituloNuevo+"&link="+Link+"&desc="+DetalleNoticia+"&fec="+FechaNoticia+"&img="+"No hay",null);
				agregarNoticiaAuxiliar();
				window.location.reload(true);
				
			}
			else{
				
				alert("Hace falta algún dato, la noticia no se puede agregar");
			}
			
		}
		else{
			alert("No se puede agregar, el titulo es muy largo, debe ser de máximo 100 caracteres o no ha agregado nada");
			
		}
		
	
		
		
	}
	function agregarNoticiaAuxiliar(){
		var TituloNuevo = document.getElementById("newsName").value;
		var inputElements = document.getElementsByName('SeccionesAgregaNot');
		
		for(var i=0; inputElements.length; ++i){
			var Seccion=inputElements[i].id;
			if(inputElements[i].checked){
				llamadoActualizarDatos("agregarNoticiasSeccion.php","?sec="+Seccion+"&nom="+TituloNuevo,null);
			
				}
				
			}
	
		
		
	}
	function actualizarDatos() {
		var DatosHistoria = document.getElementById("historia").value;
		var DatosFilosofia = document.getElementById("filo").value;
		var DatosMision = document.getElementById("mision").value;
		var DatosVision = document.getElementById("vision").value;
		var DatoActualizar = "";
		if(DatosHistoria != ""){
			DatoActualizar =("Historia");
			llamadoActualizarDatos("actualizarDatosInf.php","?nom="+DatoActualizar+"&det="+DatosHistoria,null);
		}
		if(DatosFilosofia != ""){
			DatoActualizar =("Filosofia");
			llamadoActualizarDatos("actualizarDatosInf.php","?nom="+DatoActualizar+"&det="+DatosFilosofia,null);
		}
		if(DatosMision != ""){
			DatoActualizar =("Mision");
			llamadoActualizarDatos("actualizarDatosInf.php","?nom="+DatoActualizar+"&det="+DatosMision,null);
		}
		if(DatosVision != ""){
			DatoActualizar =("Vision");
			llamadoActualizarDatos("actualizarDatosInf.php","?nom="+DatoActualizar+"&det="+DatosVision,null);
		}
		
		
		window.location.reload(true);
		
	}
	
	function eliminarNoticias() {
		var NoticiasChecked = document.getElementsByName('NoticiasChecked');
	
		for(var i=0; NoticiasChecked.length; ++i){
			var Noticia=NoticiasChecked[i].id;
			if(NoticiasChecked[i].checked){
				
				var CondicionElimina = confirm(" Desea eliminar a : " + Noticia);
				if (CondicionElimina)
				{
					
					llamadoActualizarDatos("eliminarNoticias.php","?nom="+Noticia,null);
					
					window.location.reload(true);
					
				
					}
				//llamadoActualizarDatos("agregarNoticiasSeccion.php","?sec="+Seccion+"&nom="+TituloNuevo,null);
				
				}
				
			}
	}
	
	
	function llamadoActualizarDatos(LlamarFuncion,Parametros,ParametrosSend) {
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			    alert(this.responseText);
			}
		};
	//	alert(Parametros);
		xmlhttp.open("GET", "../MODEL/"+LlamarFuncion+Parametros, true);
		xmlhttp.send(ParametrosSend);
					
	}
	
	function eliminarAgregarUsuarios(desicion) {
		if(desicion == "1"){
			var Contra = document.getElementById('Contraseña').value;
			var ContraRep = document.getElementById('ContraseñaRep').value;
			var Usuario = document.getElementById('Usuario').value;
			if(Usuario.length >0){
				if(Contra == ContraRep){
						llamadoActualizarDatos("actualizarDatosUsuar.php","?tip=1"+"&usu="+Usuario+"&pass="+Contra);
						window.location.reload(true);
				}
				else{
					
					alert("Las contraseñas no coinciden");
				}
			}else{
				alert("El usuario no puede ser en blanco.");
			}
		}
		else{
			
				var UsuariosChecked = document.getElementsByName('UsuariosChecked');
				//alert(inputElements.length);
				for(var i=0; UsuariosChecked.length; ++i){
					var Usuario=UsuariosChecked[i].id;
					if(UsuariosChecked[i].checked){
						if(Usuario == "user"){
							alert("No se puede eliminar al usuario Administrador");
							
						}
						else{
							var CondicionElimina = confirm(" Desea eliminar a : " + Usuario);
							if (CondicionElimina)
							{
								
								llamadoActualizarDatos("actualizarDatosUsuar.php","?tip=2"+"&usu="+Usuario,null);
								
								window.location.reload(true);
								
							
								}
							
							}
						}
						
					}	
			
		}
					
	}
	
	
		
		
function obtenerServicio(){
	var Servicio = "";
	var selected = $("input[type='radio'][name='ServicioChecked']:checked");
	if (selected.length > 0) {
		var Servicio = selected.val();
		document.getElementById("serviceName").value = Servicio; 
		document.getElementById("serviceNameNuevo").value = Servicio;
		
		// Aquí no se usa la llamadoActualizarDatos() debido a que se ocupa el return, la obtención de los datos, lo cual la función solo indica con un alert el retorno
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			    tinymce.activeEditor.setContent(JSON.parse(this.responseText)[1]['detalle']);
			}
		};
	//	alert(Parametros);
		xmlhttp.open("GET", "../MODEL/obtenerDatosServicios.php?serv="+Servicio, true);
		xmlhttp.send();
		
		
	}
	else{
		
		alert("Debe seleccionar un servicio a editar");
	}

	
}
				
				
		