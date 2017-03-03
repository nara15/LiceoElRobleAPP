
var liceoRobleApp = angular.module('liceoRobleApp', ['ngRoute']);


// Configuración de las rutas de la aplicación
liceoRobleApp.config(function($routeProvider) {
	$routeProvider

		.when('/', {
			templateUrl : 'pages/home.html'
		})

		.when('/galeria', {
			templateUrl : 'pages/galeria.html'
		})

		.when('/historia', {
			templateUrl : 'pages/historia.html'
		})

		.when('/contacto', {
			templateUrl : 'pages/contacto.html'
		});
	
});