liceoRobleApp.controller('homeController', function($scope, $http){
	
	$http.get("MODEL/noticia.php")
	.then(function (response) 
	{
	    $scope.news = response.data;
	    
	});
	
	$http.get("MODEL/obtenerFilosofia.php")
	.then(function (response) 
	{
	    $scope.filosofia = response.data[0]['filosofia'];;
	    
	}, function errorCallback(response) 
    { 
        
        alert("Error "+response.status + " Filosofía del centro no encontrada");
        
    });

});

liceoRobleApp.controller('misionvisionController', function($scope, $http) {
    
    $http.get('MODEL/obtenerMisionVision.php')
    .then(function(response)
    {
        $scope.content_mision = response.data[0]['mision'];
        $scope.content_vision = response.data[1]['vision'];
    }, function errorCallback(response) 
    { 
        
        alert("Error "+response.status + " Misión y Visión no encntrado");
        
    });

});



liceoRobleApp.controller('historiaController', function($scope, $http) {
    
    $http.get('MODEL/obtenerHistoria.php')
    .then(function(response)
    {
        $scope.content_historia = response.data[0]['historia'];
       // alert(response.data.length);
    }, function errorCallback(response) 
    { 
        
        alert("Error "+response.status + " Historia no encontrada.");
        
    });

});


liceoRobleApp.controller("serviciosController", function ($scope, $routeParams,$http) {
    
    $scope.service_name = $routeParams.id;
    $http.get('../MODEL/obtenerDatosServicios.php?serv=' + $routeParams.id )
    .then(function successCallback(response)
    {
        document.getElementById("contenido").innerHTML = response.data[1]['detalle'];
        $scope.service_image = response.data[0]['imagen'];
        
    }, function errorCallback(response) 
    { 
        
        alert("Error "+response.status + " Servicio no econtrado");
        
    })
    ;
   
});


liceoRobleApp.controller('galeriaController', function($scope,$http) {
    
    var modal = new Model("myModal");
    
    $http.get('../MODEL/obtenerFotosGaleria.php')
    .then(function successCallback(response)
    {
           $scope.photos = response.data;
                        
    }, function errorCallback(response) 
    { 
        alert("Error "+response.status);
    })
    ;
    
    $scope.zoomImage = function(ImageSrc)
    {
        var modalImg = document.getElementById("modal-img");
        var captionText = document.getElementById("caption");
        modalImg.src = ImageSrc.direccion;
        captionText.innerHTML = ImageSrc.detalle;
        modal.showModal();
        
    };
    
    $scope.closeZoom = function()
    {
        modal.closeModal();
    }
});


liceoRobleApp.controller('loadServicesToNavCTRL', function($scope,$http) {
    
   
    $http.get('../MODEL/obtenerServicios.php')
    .then(function successCallback(response)
    {
           $scope.servicesLinks = response.data;
                        
    }, function errorCallback(response) { 
        
        alert("Error "+response.status+", al cargar los sericios");
        
    })
    ;
});

liceoRobleApp.controller('noticiasController', function($scope,$http){
   
   $http.get('../MODEL/obtenerNoticias.php')
    .then(function successCallback(response)
    {
           $scope.news = response.data;
                        
    }, function errorCallback(response) { 
        
        alert("Error "+response.status+", al cargar las noticias");
        
    });
   
});

liceoRobleApp.controller("noticiaController", function ($scope, $routeParams,$http) {
    
    $scope.new_name = $routeParams.id;

    $http.get('../MODEL/obtenerDatosNoticia.php?nombreNoticia=' + $routeParams.id )
    .then(function successCallback(response)
    {
       $scope.news_content = response.data[0].descripcion;
       $scope.news_image = "http://1.bp.blogspot.com/-NTnfbCBzKQ4/U2uwl1uQ7iI/AAAAAAAADBI/K8CxR6dsxog/s1600/Extra.png";//response.data[0].imagen;
        
    }, function errorCallback(response) 
    { 
        
        alert("Error "+response.status + " Servicio no econtrado");
        
    });
   
});





