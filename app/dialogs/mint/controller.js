app.controller('mint', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.mem_title = ''
    $scope.mem_price = ''
    $scope.mem_image = ''

    $scope.close = function () {
        $mdDialog.hide()
    }

    $scope.confirmMint = function () {
        $mdToast.show(
            $mdToast.simple().textContent('Успешно').hideDelay(3000)
        )
        $scope.close()
    }

    $scope.upload = function (file) {
        $http.post('/api/upload.php', file).then(function (response) {
            $scope.mem_image = response.data.filename
        }).catch(function () {

        })

    }

    $scope.save = function () {
        $http.post('/api/mint.php', {
            mem_title: $scope.mem_title,
            mem_price: $scope.mem_price,
            mem_image: $scope.mem_image,
            user_hash: localStorage.getItem('user_hash'),
        }).then(function (response) {
            $mdToast.show(
                $mdToast.simple().textContent('Успешно').hideDelay(3000)
            )
            $mdDialog.hide()
        }).catch(function () {
            $mdToast.show(
                $mdToast.simple().textContent('Ошибка').hideDelay(3000)
            )
        })
    }

})