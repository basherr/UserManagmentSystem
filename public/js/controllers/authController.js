(function() {

    'use strict';

    angular
        .module('UsersManagmentApp')
        .controller('AuthCtrl', AuthController);


    function AuthController($auth, $scope, $state,$rootScope, $http) {

        if(localStorage.getItem('auth') !== undefined)
        {
            // $state.go('users');
        }
        $scope.login = function() {
            $auth.login($scope.auth)
                 .then( function(data) {

                return $http.get('authenticate/user');
                // If login is successful, redirect to the users state
            }, function(errors) {
                console.log(errors);
            })
            .then(function(response) {
                var user = JSON.stringify(response.data.user);

                localStorage.setItem('user', user);
                $rootScope.authenticated = true;
                $rootScope.currentUser = response.data.user;

                $state.go('users', {});
            });
        }

    }

})();