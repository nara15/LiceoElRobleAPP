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
	    
	});

});

liceoRobleApp.controller('misionvisionController', function($scope, $http) {
    
    $http.get('MODEL/obtenerMisionVision.php')
    .then(function(response)
    {
        $scope.content_mision = response.data[0]['mision'];
        $scope.content_vision = response.data[1]['vision'];
    });

});



liceoRobleApp.controller('historiaController', function($scope, $http) {
    
    $http.get('MODEL/obtenerHistoria.php')
    .then(function(response)
    {
        $scope.content_historia = response.data[0]['historia'];
       // alert(response.data.length);
    });

});


liceoRobleApp.controller("serviciosController", function ($scope, $routeParams,$http) {
    
    $scope.service_name = $routeParams.id;
    $http.get('../MODEL/obtenerDatosServicios.php?serv=' + $routeParams.id )
    .then(function successCallback(response)
    {
        document.getElementById("contenido").innerHTML = response.data[1]['detalle'];
 
                       
    }, function errorCallback(response) { 
        
        alert("Error "+response.status);
        
    })
    ;
   
});


liceoRobleApp.controller('galeriaController', function($scope,$http) {
    
   
    $http.get('../MODEL/obtenerFotosGaleria.php')
    .then(function successCallback(response)
    {
           $scope.photos = response.data;
                        
    }, function errorCallback(response) 
    { 
        
        alert(response.status);
        
    })
    ;
});


liceoRobleApp.controller('loadServicesToNavCTRL', function($scope,$http) {
    
   
    $http.get('../MODEL/obtenerServicios.php')
    .then(function successCallback(response)
    {
           $scope.servicesLinks = response.data;
                        
    }, function errorCallback(response) { 
        
        alert(response.status);
        
    })
    ;
});





