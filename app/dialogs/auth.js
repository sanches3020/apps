app.controller('login', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.login = ''
    $scope.pass = ''
    $scope.close = function (){
        $mdDialog.hide()
    }

    $scope.enter = async function () {
        let response = await fetch("api/login.php", {
            method: "POST",
            body: JSON.stringify({
                login: $scope.login,
                pass: $scope.pass,
            })
        })

        if (response.ok) {
            $mdToast.show(
                $mdToast.simple().textContent('Успешный вход').hideDelay(3000)
            )
            $scope.close()
        }

    }
})