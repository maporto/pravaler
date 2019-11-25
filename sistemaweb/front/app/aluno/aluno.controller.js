'use strict';

angular.module('myApp.aluno', ['ngRoute'])

  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/aluno', {
      templateUrl: 'aluno/aluno.html',
      controller: 'alunoController'
    });
  }])

  .controller('alunoController', function ($scope, Restangular, $mdDialog) {
    $scope.instituicoes = [];
    $scope.instituicao = null;

    function init() {
      Restangular.all('instituicao').getList({}).then(function (instituicoes) {
        $scope.instituicoes = instituicoes;
      });
    }

    $scope.buscaCursos = function (instituicao) {
      if (!instituicao) {
        $scope.cursos = [];
        return;
      }
      Restangular.all('curso').getList({
        instituicao: instituicao.id
      }).then(function (cursos) {
        $scope.cursos = cursos;
      });
    }

    $scope.buscaAlunos = function (curso) {
      if (!curso) {
        $scope.alunos = [];
        return;
      }
      Restangular.all('aluno').getList({
        curso: curso.id
      }).then(function (alunos) {
        $scope.alunos = alunos;
      });
    }

    $scope.novo = function () {
      let aluno = Restangular.restangularizeElement(null, {
        'status': 'A',
        'curso': $scope.curso,
      }, 'aluno');
      abreModal(aluno, function (aluno) {
        $scope.alunos.push(aluno);
      });
    }

    $scope.editar = function (aluno, $index) {
      abreModal(aluno, function (aluno) {
        $scope.alunos[$index] = aluno;
      });
    }

    $scope.excluir = function (aluno, $index) {
      var confirm = $mdDialog.confirm()
        .title('Tem certeza que deseja deletar?')
        .ariaLabel('Deletar aluno')
        .cancel('Não')
        .ok('Sim');

      $mdDialog.show(confirm).then(function () {
        aluno.remove().then(function () {
          $scope.alunos.splice($index, 1);
        })
      }, function () {});
    }

    function abreModal(aluno, callback = () => {}) {
      var copia = angular.copy(aluno);
      $mdDialog.show({
          controller: 'alunoModalController',
          templateUrl: 'aluno/aluno-modal.html',
          parent: angular.element(document.body),
          clickOutsideToClose: true,
          fullscreen: true,
          resolve: {
            aluno: function () {
              return copia;
            }
          }
        })
        .then(function (aluno) {
          callback(aluno)
        }, function () {});
    }

    init();
  })
  .controller('alunoModalController', function ($scope, Restangular, aluno, $mdDialog) {
    $scope.aluno = aluno;
    $scope.estados = [];
    
    $scope.cancel = function () {
      $mdDialog.cancel();
    };
    
    $scope.estadoChange = function (estado) {
      if (! estado) {
        $scope.cidades = [];
        $scope.bairros = [];
        return;
      }

      console.log(estado);

      Restangular.all('municipios').withHttpConfig({cache:true}).getList({uf: estado.uf}).then(function (cidades) {
        $scope.cidades = cidades;  
      });

      Restangular.all('bairros').withHttpConfig({cache:true}).getList({uf: estado.uf}).then(function (bairros) {
        $scope.bairros = bairros;  
      });
    }

    $scope.salvar = function (aluno) {
      if (!aluno.id) {
        Restangular.all('aluno').post(aluno).then(function (alunoNova) {
          $mdDialog.hide(alunoNova);
        })
      } else {
        Restangular.one('aluno', aluno.id).customPUT(aluno).then(function (alunoNova) {
          $mdDialog.hide(alunoNova);
        })
      }
    };

    function init() {
      $scope.aluno.dataNascimento = $scope.aluno.dataNascimento ? new Date($scope.aluno.dataNascimento) : null;
      Restangular.all('estados').withHttpConfig({cache:true}).getList({}).then(function (estados) {
        $scope.estados = estados;
      });

      if ($scope.aluno.id) {
        $scope.estadoChange($scope.aluno.estado);
      }
    }

    init();
  });