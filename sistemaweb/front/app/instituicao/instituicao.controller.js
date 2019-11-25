'use strict';

angular.module('myApp.instituicao', ['ngRoute'])

  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/instituicao', {
      templateUrl: 'instituicao/instituicao.html',
      controller: 'instituicaoController'
    });
  }])
  .controller('instituicaoController', function ($scope, Restangular, $mdDialog) {
    $scope.instituicoes = [];

    function init() {
      Restangular.all('instituicao').getList({}).then(function (instituicoes) {
        $scope.instituicoes = instituicoes;
      });
    }

    $scope.novo = function () {
      let instituicao = Restangular.restangularizeElement(null, {
        'status': 'A'
      }, 'instituicao');
      abreModal(instituicao, function (instituicao) {
        $scope.instituicoes.push(instituicao);
      });
    }

    $scope.editar = function (instituicao, $index) {
      abreModal(instituicao, function (instituicao) {
        $scope.instituicoes[$index] = instituicao;
      });
    }

    $scope.excluir = function (instituicao, $index) {
      var confirm = $mdDialog.confirm()
        .title('Tem certeza que deseja deletar?')
        .ariaLabel('Deletar Instituicao')
        .cancel('Não')
        .ok('Sim');

      $mdDialog.show(confirm).then(function () {
        instituicao.remove().then(function () {
          $scope.instituicoes.splice($index, 1);
        })
      }, function () {
      });
    }

    function abreModal(instituicao, callback = () => {}) {
      var copia = angular.copy(instituicao);
      $mdDialog.show({
          controller: 'instituicaoModalController',
          templateUrl: 'instituicao/instituicao-modal.html',
          parent: angular.element(document.body),
          clickOutsideToClose: true,
          fullscreen: true,
          resolve: {
            instituicao: function () {
              return copia;
            }
          }
        })
        .then(function (instituicao) {
          callback(instituicao)
        }, function () {});
    }

    init();
  })
  .controller('instituicaoModalController', function ($scope, Restangular, instituicao, $mdDialog) {
    $scope.instituicao = instituicao;

    $scope.cancel = function () {
      $mdDialog.cancel();
    };

    $scope.salvar = function (instituicao) {
      if (!instituicao.id) {
        Restangular.all('instituicao').post(instituicao).then(function (instituicaoNova) {
          $mdDialog.hide(instituicaoNova);
        })
      } else {
        Restangular.one('instituicao', instituicao.id).customPUT(instituicao).then(function (instituicaoNova) {
          $mdDialog.hide(instituicaoNova);
        })
      }
    };
  });