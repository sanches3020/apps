var app = angular.module('app', ['ngMaterial', 'ngAnimate', 'ngAria', 'ngMessages'])

app.controller('main', function ($scope, $http, $mdToast, $mdDialog, api, dialog) {

    $scope.user = {
        user_hash: localStorage.getItem("user_hash")
    }

    function event(object_type, object_id, object_action) {
        api.post("api/event.php", {
            user_hash: localStorage.getItem("user_hash"),
            object_type: object_type,
            object_id: object_id,
            object_action: object_action,
        })
    }

    event("page", "main", "open")

    $scope.submit2 = function () {
        api.error('Simple Toast!')
    }

    $scope.showLogin = function () {
        event("page", "login", "open")
        dialog('login', 'dialogs/login')
    }

    $scope.logout = function () {
        localStorage.removeItem("user_hash")
        $scope.user = null
        api.success("Успешный выход")
    }


    $scope.showMint = function () {
        dialog('mint', 'dialogs/mint')
    }


    $scope.like = function (mem) {
        event("mem", mem.mem_id, "like")

        if (mem.liked) {
            $mdToast.show(
                $mdToast.simple()
                    .textContent('Ты уже лайкала этот мем')
                    .hideDelay(3000)
            );
            return;
        }

        $http.post("api/like.php", {
            mem_id: mem.mem_id,
            user_hash: $scope.user.user_hash
        }).then(function (response) {

            if (response.data.message) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.message)
                        .hideDelay(3000)
                );
                return;
            }

            if (response.data.success === false) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.error)
                        .hideDelay(3000)
                );
                return;
            }

            mem.likes_count++;
            mem.liked = true;

            $scope.toggleLike(mem);
            toggleLikeButton(mem.mem_id, 'enable');

            $mdToast.show(
                $mdToast.simple()
                    .textContent('Лайк поставлен')
                    .hideDelay(3000)
            );

            $scope.reload();

        }, function (error) {
            $mdToast.show(
                $mdToast.simple()
                    .textContent(error.data?.message || error.data?.error || 'Ошибка сервера')
                    .hideDelay(3000)
            );
        });
    }


    $scope.getMatches = function (text) {

        if (!$scope.mems || !text) {
            return []
        }

        var query = text.trim().toLowerCase()

        if (!query) {
            return $scope.mems
        }

        return $scope.mems.filter(function (item) {
            return item.mem_title && item.mem_title.toLowerCase().indexOf(query) !== -1
        })
    }

    $scope.buy = function (mem) {
        event("mem", mem.mem_id, "buy")

        let fd = new FormData()
        fd.append("mem_id", mem.mem_id)
        fd.append("user_hash", $scope.user.user_hash)

        $http.post("api/oplata.php", {mem_id:mem.mem_id, user_hash:localStorage.getItem("user_hash")}).then(function (response) {

            $mdToast.show(
                $mdToast.simple()
                    .textContent('Мем куплен')
                    .hideDelay(3000)
            )

            $scope.reload();

        }, function (error) {
            $mdToast.show(
                $mdToast.simple()
                    .textContent(error.message)
                    .hideDelay(3000)
            )
        })
    }

    $scope.percent = function (mem) {

        event("mem", mem.mem_id, "percent")


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

        const hash = localStorage.getItem("user_hash");

        $http.get("api/mems.php?user_hash=" + hash).then(function (response) {
            $scope.mems = response.data
        })

        if (hash) {
            $http.get("api/profile.php?user_hash=" + hash).then(function (response) {
                $scope.user = response.data
            })
        }
    }

    $scope.reload()
})
