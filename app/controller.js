var app = angular.module('app', ['ngMaterial', 'ngAnimate', 'ngAria'])

app.controller('main', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.submit2 = function (){
        $mdToast.show(
            $mdToast.simple()
                .textContent('Simple Toast!').hideDelay(3000)
        )
    }

    function showDialog(controller_name, index_path, params) {
        $mdDialog.show({
            controller: controller_name,
            templateUrl: index_path + '/index.html',
            locals: {
                params: params || {}
            }
        })
    }

    $scope.showLogin = function () {
        showDialog('login', 'dialogs/login')
    }

})