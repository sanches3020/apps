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

    $scope.showMint = function () {
        showDialog('mint', 'dialogs/mint')
    }

    $scope.mem_id = 1;

    $scope.like = function () {
        $http.post("api/like.php", { mem_id: $scope.mem_id, user_hash: $scope.user_hash })
            .then(function(response) {
                if (response.data.success) {
                    $mdToast.show(
                        $mdToast.simple().textContent('Лайк поставлен').hideDelay(3000)
                    )
                } else {
                    $mdToast.show(
                        $mdToast.simple().textContent('Ошибка: ' + response.data.error).hideDelay(3000)
                    )
                }
            }, function(error) {
                $mdToast.show(
                    $mdToast.simple().textContent('Ошибка сервера').hideDelay(3000)
                )
            });
    }
})