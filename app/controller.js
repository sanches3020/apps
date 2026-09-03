var app = angular.module('app', ['ngMaterial', 'ngAnimate', 'ngAria'])

app.controller('main', function ($scope, $http, $mdToast, $mdDialog) {

    $scope.user = {
        user_hash: localStorage.getItem("user_hash")
    }

    $scope.submit2 = function () {
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

    $scope.mem_id = 1

    $scope.like = function (mem) {
        let fd = new FormData()
        fd.append("mem_id", mem.mem_id)
        fd.append("user_hash", $scope.user.user_hash)

        $http.post("api/like.php", fd, {
            headers: { 'Content-Type': undefined }
        }).then(function (response) {

            if (!response.data.success) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.error)
                        .hideDelay(3000)
                )
                return
            }

            mem.likes_count++

            $mdToast.show(
                $mdToast.simple()
                    .textContent('Лайк поставлен')
                    .hideDelay(3000)
            )

        }, function () {
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Ошибка сервера')
                    .hideDelay(3000)
            )
        })
    }



    $scope.getMatches = function (text) {

        if (!$scope.mems || !text) {
            return []
        }

        var query = text.toLowerCase()

        return $scope.mems.filter(function (item) {
            return item.mem_title &&
                item.mem_title.toLowerCase().indexOf(query) !== -1
        })
    }

    $scope.buy = function (mem) {

        let fd = new FormData()
        fd.append("mem_id", mem.mem_id)
        fd.append("user_hash", $scope.user.user_hash)

        $http.post("api/oplata.php", fd, {
            headers: { 'Content-Type': undefined }
        }).then(function (response) {

            if (!response.data.success) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.error)
                        .hideDelay(3000)
                )
                return
            }

            mem.user_id = response.data.buyer_id

            if (response.data.new_balance !== undefined) {
                $scope.user.user_balance = response.data.new_balance
            }

            $mdToast.show(
                $mdToast.simple()
                    .textContent('Мем куплен')
                    .hideDelay(3000)
            )

        }, function () {
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Ошибка сервера')
                    .hideDelay(3000)
            )
        })
    }

    $scope.percent = function (mem) {


        $http.post("api/percent.php", {mem_id:mem.mem_id, user_hash:localStorage.getItem("user_hash")}).then(function (response) {
            $scope.reload()

            $mdToast.show(
                $mdToast.simple()
                    .textContent('успешно')
                    .hideDelay(3000)
            )

        }, function () {
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Ошибка сервера')
                    .hideDelay(3000)
            )
        })
    }

    $scope.reload = function () {
        $http.get("api/mems.php").then(function (response) {
            $scope.mems = response.data
        })
        $http.get("api/profile.php?user_hash="+ localStorage.getItem("user_hash")).then(function (response) {

            $scope.user = response.data

        })
    }

    $scope.reload()
})
