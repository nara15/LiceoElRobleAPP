
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
	
	function realizarPeticion_POST(P_Servicio,P_Parametros, Callback) 
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
			    Callback(this.responseText);
			}
			
		};
		xmlhttp.open("POST", "../MODEL/"+P_Servicio, true);
		xmlhttp.send(P_Parametros);
	}
	
	function agregarServicios()	
	{
		var ContenidoTexto = document.getElementsByName("contenidoTexto")[0].value;
		var NombreServicio = document.getElementById("serviceName").value;
		var Imagen_Dir = "";
		
		var Imagen = document.getElementById("service_image_input_field").files[0];
		var ImageWrapper = new FormData();
		ImageWrapper.append("FILE", Imagen);
		ImageWrapper.append("FUNCTION", "ImageSaver");
		ImageWrapper.append("TARGET_DIR", "../Images/services/")
		
		realizarPeticion_POST("subirImagenes.php", ImageWrapper, function(response){

			Imagen_Dir = "../Images/services/" + Imagen.name;
			
			console.log(ContenidoTexto);
			console.log(NombreServicio);
			console.log(Imagen_Dir);
			llamadoActualizarDatos("agregarServicio.php","?nom="+NombreServicio+"&imag="+Imagen+"&contenidoTexto="+ContenidoTexto,null)
			
		});
	
		
		//llamadoActualizarDatos("agregarServicio.php","?nom="+NombreServicio+"&imag="+Imagen+"&contenidoTexto="+ContenidoTexto,null);
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
				llamadoActualizarDatos("agregarNoticias.php","?nom="+TituloNuevo+"&link="+Link+"&desc="+DetalleNoticia+"&fec="+FechaNoticia,null);
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
		//alert(inputElements.length);
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
		//alert(inputElements.length);
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
		xmlhttp.open("GET", "../MODEL/"+LlamarFuncion+Parametros, true);
		xmlhttp.send(ParametrosSend);
					
	}
	
		
				
				
		