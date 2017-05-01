
var liceoRobleApp = angular.module('liceoRobleApp', ['ngRoute','ui.tinymce']);


// Configuración de las rutas de la aplicación
liceoRobleApp.config(function($routeProvider) {
	$routeProvider

		.when('/', {
			templateUrl : 'pages/home.html',
			controller : 'homeController'
		})
		.when('/galeria', {
			templateUrl : 'pages/gestion_galeria_agregar.html',
			controller : 'gestion_galeriaController'
		})
		.when('/galeriaVer', {
		    templateUrl : 'pages/gestion_galeria_eliminar.html',
		    controller : 'gestion_galeria_edicion_Controller'
		})
		.when('/historia', {
			templateUrl : 'pages/historia.html'
		})
		.when('/misionvision', {
			templateUrl : 'pages/misionvision.html' ,
			controller : 'misionvisionController'
		})
		.when('/contacto', {
			templateUrl : 'pages/contacto.html'

		})
		.when('/servicio', {
			templateUrl : 'pages/servicio.html',
			controller: 'TinyMceController'

		})
		.when('/noticia',{
			templateUrl: 'pages/noticias.html',
			controller: 'TinyMceController'
		})
		.when('/noticiasEliminar',{
			templateUrl: 'pages/noticiasEliminar.html',
			controller: 'noticiasEliminarnController'
		})
		.when('/usuario',{
			templateUrl: 'pages/usuarios.php',
			controller: 'usuariosController'
		})
		.when('/servicioEd',{
			templateUrl: 'pages/servicioEd.html',
			controller: 'TinyMceController'
		})
		;
});





liceoRobleApp.controller('misionvisionController', function($scope) 
{

	$scope.content_mision = "Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.";
	$scope.content_vision = "Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.";

});



liceoRobleApp.controller('noticiasEliminarnController', function($scope,$http) {
    
   
    $http.get('../MODEL/obtenerNoticias.php')
    .then(function successCallback(response)
    {
           $scope.noticiasLinks = response.data;
                        
    }, function errorCallback(response) { 
        
        alert(response.status);
        
    })
    ;
});



liceoRobleApp.controller('homeController', function($scope){

	$scope.news = [
					{title:'Noticia 1 - El titulo puede ser de este tamaño! una noticia importante', date : '25 de marzo', content : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.'},
					{title:'Noticia 2', date : '10 de enero de 3010', content : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat...'}
				];
});





liceoRobleApp.controller('usuariosController', function($scope, $http){


 $http.get('../MODEL/obtenerUsuarios.php')
    .then(function successCallback(response)
    {
           $scope.usuariosLinks = response.data;
                        
    }, function errorCallback(response) { 
        
        alert(response.status);
        
    })
    ;

});




liceoRobleApp.controller('TinyMceController', function($scope, $http) 
{
	$scope.tinymceModel = 'Initial content';

  $scope.getContent = function()
  {
    console.log('Editor content:', $scope.tinymceModel);
  };

  $scope.setContent = function() 
  {
    $scope.tinymceModel = 'Time: ' + (new Date());
  };

  $scope.tinymceOptions = 
  {
    plugins: 'link image code',
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    height: "200"
  };
  
  
  $http.get('../MODEL/obtenerSecciones.php')
    .then(function(response)
        {
           
            
                $scope.sections = response.data;     
                    });
  
  $http.get('../MODEL/obtenerServicios.php')
    .then(function(response)
        {
           
            
                $scope.servicesLinks = response.data;
                        
                    });
});



/**
 *  Controlador para la gestión de la galería - AGREGAR
 * 
 **/

liceoRobleApp.controller('gestion_galeriaController', function($scope, $http) {
    
    $scope.previewsModel = [];
    var files_to_Upload = [];
   
    // Función Para mostrar el previo de las imágenes por ingresar al servidor.
    // Entrada: Un evento del form
    $scope.showPreview = function(event)
    {
    	var files = event.target.files; //Lista de archivos
    	for (var i = 0; i < files.length; i++)
    	{
             var file = files[i];
             files_to_Upload.push(file);
             var reader = new FileReader();
             reader.onload = $scope.imageIsLoaded; 
             reader.readAsDataURL(file);
         }
    };
    
    // Función para refrescar las imágenes en el preview.
    // Entrada: La imagen obtenida del evento readAsDataURL
    $scope.imageIsLoaded = function(e)
    {
        $scope.$apply(function() 
        {
            $scope.previewsModel.push(e.target.result);
        });
    }; 
    
    $scope.showPopUp = function(element)
    {
        $scope.popUpImage = element.step;
        $scope.popoverIsVisible = true; 
    }
    
    $scope.hidePopUp = function()
    {
        $scope.popoverIsVisible = false; 
    }
    
    // Función para realizar el submit y guardar las imágenes en el servidor.
    $scope.submit = function()
    {
        if (files_to_Upload.length > 0)
        {
            var formdata = new FormData();
            var files = document.getElementById("files").files;
            const caption_areas = document.getElementsByName("comment");
            
            for (var i = 0; i < files.length; i ++)
        	{
        		formdata.append(i, files[i]);
        	}
            formdata.append("TARGET_DIR", "../Images/test/");
            
            var uploader = new Upload(formdata);
    	    uploader.uploadFiles("../MODEL/subirImagenes1.php", function(data){
    	        
    	        var JSONData = JSON.parse(data);
    	        var captions = [];
    	        
                for (var i = 0; i < JSONData.length; i++)
                {
                   captions.push({id:i, caption:caption_areas[JSONData[i].id].value, dir:JSONData[i].dir});
                }

    	        var dataJSON = JSON.stringify(captions);

    	        var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        alert(this.responseText);
                    }
                  };
                  xhttp.open("POST", "../MODEL/agregarImagenes.php", true);
                  xhttp.send(dataJSON);
    	        
    	        
    	    });
    	    
    	    
            /*
            var captions = [];
            const caption_areas = document.getElementsByName("comment");
           
            var formdata = new FormData();
          
            angular.forEach(files_to_Upload, function (value, key) 
            {
                var index = files_to_Upload.indexOf(value)
                formdata.append(key, value);
                captions.push({id:key, value:caption_areas[index].value});
                
            });
            
            formdata.append("FUNCTION", "GalleryImageSaver");
            formdata.append("CAPTIONS", JSON.stringify(captions));
            formdata.append("TARGET_DIR", "../Images/gallery/");
            
            var request = {
                method: 'POST',
                url: '../MODEL/subirImagenes.php',
                data: formdata,
                headers: {'Content-Type': undefined},
                transformRequest: angular.identity
            };
            
           
            $http(request).then (
                function successCallback(response)
                {
                    alert("Se subieron las imágenes " + response.data);
                    
                    //------------bloque función-----------
                    const elements = document.getElementsByClassName("box");
                    while (elements.length > 0) elements[0].remove();
                    document.getElementById("formContainer").reset();
                    $scope.previewsModel = [];
                    files_to_Upload = [];
                    //------------------------------------
                    
                },
                function(response)
                {
                    alert("Hubo un error: " + response.data + "\n");
                },
                function(progress)
                {
                   console.log('uploading: ' + Math.floor(progress) + '%');
                }
            );*/
            
        }
        else
        {
            alert("No hay seleccionado ninguna imagen");
        }
 
    };
    
    // Función para eliminar una imagen del preview
    $scope.removePreviewImage = function(image)
    {
        var index = $scope.previewsModel.indexOf(image);
        document.getElementById(index.toString()).remove();
        $scope.previewsModel.splice(index, 1);
        files_to_Upload.splice(index, 1);
    }
    
}); //**************************************************************************


/**
 *  Controlador para la gestión de la galería - EDICIÓN
 * 
 **/
liceoRobleApp.controller('gestion_galeria_edicion_Controller', function($scope, $http){
    
    var modal = new Model("notificationModal");
    
    $http.get('../MODEL/obtenerFotosGaleria.php')
        .then(function successCallback(response)
        {
            $scope.gallery = response.data;
                            
        }, function errorCallback(response) 
        { 
            alert("Error "+response.status);
        });
    
    /**
     * Función para modificar el caption de una imagen de la galería
     * Entrada: img (Imagen actual del $scope que se está editando)
     *          index (indice de localización de la imagen)
     */
    $scope.modifyCaption = function(img, index)
    {
        document.getElementById("closeModal").addEventListener("click", function(){
            modal.closeModal();
        });
        
        var textarea = "<textarea id='captionText' class='textarea' rows='4' cols='50'>"+img.detalle+"</textarea> ";
       
        modal.showModal_with_content(textarea);
        
        modal.addEvent("bntGuardar", "click", function()
        {
            var newCaption = document.getElementById("captionText").value;
            document.getElementById("img-caption"+index).innerHTML = newCaption;
            document.getElementById("tooltip"+index).innerHTML = newCaption;
            modal.closeModal();
            
        });
        
    };
    
    $scope.removeImage = function(img)
    {
        var index = $scope.gallery.indexOf(img);
        $scope.gallery.splice(index,1);
        console.log(img);
        
        var data = {id:img.id, dir:img.direccion};
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         
        }
        };
        xhttp.open("POST", "../MODEL/eliminarImagenes.php", true);
        xhttp.send(JSON.stringify(data));
        
    };
    
    
});