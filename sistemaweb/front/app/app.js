'use strict';

// Declare app level module which depends on views, and core components
angular.module('myApp', [
  'ngRoute',
  'ngAnimate',
  'ngMessages',
  'ngMaterial',
  'restangular',
  'ui.mask',
  'myApp.instituicao',
  'myApp.curso',
  'myApp.aluno',
]).
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');

  $routeProvider.otherwise({redirectTo: '/instituicao'});
}]).
config(['RestangularProvider', function(RestangularProvider) {
  RestangularProvider.setDefaultHeaders({Accept: "application/json"});
  RestangularProvider.setBaseUrl("http://localhost:8000/api");
}]).
config(['$mdThemingProvider', function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('green')
    .accentPalette('orange');
}]);