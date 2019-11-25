'use strict';

angular.module('myApp.curso', ['ngRoute'])

  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/curso', {
      templateUrl: 'curso/curso.html',
      controller: 'cursoController'
    });
  }])

  .controller('cursoController', function ($scope, Restangular, $mdDialog) {
    $scope.instituicoes = [];
    $scope.instituicao = null;

    function init() {
      Restangular.all('instituicao').getList({}).then(function (instituicoes) {
        $scope.instituicoes = instituicoes;
      });
    }
    
    $scope.buscaCursos = function (instituicao) {
      console.log(instituicao);
      if (! instituicao) {
        $scope.cursos = [];
        return;
      }
      Restangular.all('curso').getList({instituicao: instituicao.id}).then(function (cursos) {
        $scope.cursos = cursos;
      });
    }

    $scope.novo = function () {
      let curso = Restangular.restangularizeElement(null, {
        'status': 'A',
        'instituicao': $scope.instituicao,
      }, 'curso');
      abreModal(curso, function (curso) {
        $scope.cursos.push(curso);
      });
    }

    $scope.editar = function (curso, $index) {
      abreModal(curso, function (curso) {
        $scope.cursos[$index] = curso;
      });
    }

    $scope.excluir = function (curso, $index) {
      var confirm = $mdDialog.confirm()
        .title('Tem certeza que deseja deletar?')
        .ariaLabel('Deletar curso')
        .cancel('Não')
        .ok('Sim');

      $mdDialog.show(confirm).then(function () {
        curso.remove().then(function () {
          $scope.cursos.splice($index, 1);
        })
      }, function () {});
    }

    function abreModal(curso, callback = () => {}) {
      var copia = angular.copy(curso);
      $mdDialog.show({
          controller: 'cursoModalController',
          templateUrl: 'curso/curso-modal.html',
          parent: angular.element(document.body),
          clickOutsideToClose: true,
          fullscreen: true,
          resolve: {
            curso: function () {
              return copia;
            }
          }
        })
        .then(function (curso) {
          callback(curso)
        }, function () {});
    }

    init();
  })
  .controller('cursoModalController', function ($scope, Restangular, curso, $mdDialog) {
    $scope.curso = curso;

    $scope.cancel = function () {
      $mdDialog.cancel();
    };

    $scope.salvar = function (curso) {
      if (!curso.id) {
        Restangular.all('curso').post(curso).then(function (cursoNova) {
          $mdDialog.hide(cursoNova);
        })
      } else {
        Restangular.one('curso', curso.id).customPUT(curso).then(function (cursoNova) {
          $mdDialog.hide(cursoNova);
        })
      }
    };
  });