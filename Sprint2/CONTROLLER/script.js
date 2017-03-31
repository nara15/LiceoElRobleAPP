
var liceoRobleApp = angular.module('liceoRobleApp', ['ngRoute']);

// Configuración de las rutas de la aplicación
liceoRobleApp.config(function($routeProvider) {
	$routeProvider
		.when('/', {
			templateUrl : 'pages/home.html',
			controller : 'homeController'
		})
		.when('/galeria', {
			templateUrl : 'pages/galeria.html',
			controller: 'galeriaController'
		})
		.when('/historia', {
			templateUrl : 'pages/historia.html',
			controller : 'historiaController'
		})
		.when('/misionvision', {
			templateUrl : 'pages/misionvision.html' ,
			controller : 'misionvisionController'
		})
		.when('/contacto', {
			templateUrl : 'pages/contacto.html'

		})
		.when('/servicio/:id', {
			controller: 'serviciosController',
			templateUrl : 'pages/servicio.html'  
		})
		;
});
