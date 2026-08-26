app.controller('mint', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.mem_title = 'wef'
    $scope.mem_price = '12'
    $scope.mem_image = 'file/17eee9a660f4190128cd8e26e66ebc7ac3893a84.png'

    $scope.close = function () {
        $mdDialog.hide()
    }

    $scope.confirmMint = function () {
        $mdToast.show(
            $mdToast.simple().textContent('Успешно').hideDelay(3000)
        )
        $scope.close()
    }

    $scope.upload = function () {
      
        var blob = new Blob([data], {type: 'application/octet-stream'})
        $http.post('/api/upload.php', blob).then(function (response) {
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
                $mdToast.simple().textContent('Ощибка').hideDelay(3000)
            )
        })
    }

})
