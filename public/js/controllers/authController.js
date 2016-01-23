(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('AuthCtrl', AuthController);


    function AuthController($auth,$scope, $state) {

        if(localStorage.getItem('auth'))
        {
            $state.go('users');
        }
        $scope.login = function() {

            var credentials = {
                email: vm.email,
                password: vm.password
            }
            
            // Use Satellizer's $auth service to login
            $auth.login(credentials)
                 .then(function(data) {
                localStorage.setItem('auth', true);
                // If login is successful, redirect to the users state
                $state.go('users', {});
            });
        }

    }

})();