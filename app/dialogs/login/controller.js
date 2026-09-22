app.controller('login', function ($scope, api, toast, $mdDialog, dialog) {

    $scope.user_email = ''
    $scope.user_hash = ''

    $scope.close = function () {
        $mdDialog.hide()
    }

    $mdDialog.hide($scope.user_email)

    dialog("wefwe", "wef")

    $scope.enter = async function () {
        api.post("api/login.php", {
            user_email: $scope.user_email,
            user_hash: $scope.user_hash,
        }).then(function () {
            localStorage.setItem("user_hash", $scope.user_hash)
            toast.success("Успешный вход")
            $mdDialog.hide()
            location.reload()

        }).catch(function (error) {
            toast.error(error.data.message)
        })
    }
})