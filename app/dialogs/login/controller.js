app.controller('login', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.user_email = ''
    $scope.user_hash = ''

    $scope.close = function () {
        $mdDialog.hide()
    }

    $scope.enter = async function () {
        $http.post("api/login.php", {
            user_email: $scope.user_email,
            user_hash: $scope.user_hash,
        }).then(function () {
            localStorage.setItem("user_hash", $scope.user_hash)
            $mdToast.show(
                $mdToast.simple().textContent("Успешный вход").hideDelay(3000)
            )
            $mdDialog.hide()
        }).catch(function (error) {
            $mdToast.show(
                $mdToast.simple().textContent(error.data.message).hideDelay(3000)
            )
        })
    }
})