
var liceoRobleApp = angular.module('liceoRobleApp', ['ngRoute']);


// configure our routes
liceoRobleApp.config(function($routeProvider) {
	$routeProvider

		// route for the home page
		.when('/', {
			templateUrl : 'pages/home.html'
		})

		.when('/galeria', {
			templateUrl : 'pages/galeria.html'
		})

		.when('/historia', {
			templateUrl : 'pages/historia.html'
		})
		.when('/misionvision', {
			templateUrl : 'pages/misionvision.html'
		});
	
});