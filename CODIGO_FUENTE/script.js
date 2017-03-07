
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

		.when('/misionvision', {
			templateUrl : 'pages/misionvision.html' ,
			controller : 'misionvisionController'
		})
		.when('/contacto', {
			templateUrl : 'pages/contacto.html'

		})
		.when('/servicio', {
			templateUrl : 'pages/servicio.html'

		})
		;
});


liceoRobleApp.controller('misionvisionController', function($scope) {

	$scope.content_mision = "Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.";
	$scope.content_vision = "Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.";

});