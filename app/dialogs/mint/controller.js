var app = angular.module('app');
app.controller('mint', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.amount = 1;
    $scope.price = '';

    $scope.close = function () {
        $mdDialog.hide()
    }

    $scope.confirmMint = function () {
        $mdToast.show(
            $mdToast.simple().textContent('Успешно').hideDelay(3000)
        )
        $scope.close()
    }
});