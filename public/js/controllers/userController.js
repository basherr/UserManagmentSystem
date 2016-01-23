(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('UserCtrl', UserController);  

    function UserController($scope, $http, User, $state, $timeout ) {
            $scope.userdata = {};
            
            User.get().success( function( users ) {
                $scope.users = users;
            })
            .error(function() {
                localStorage.removeItem('auth');
                $state.go('login');
            });
            $scope.createUser = function()  {
                $scope.errors = [];
                $scope.success_message;
                User.save($scope.userdata)
                    .success(function(response) {
                        
                        $scope.userdata = {};
                        $scope.success_message = response.message;
                        $timeout( function() {
                            $scope.success_message = null;
                        }, 3000);
                    })
                    .error( function( errors ) {
                        if( errors.name != undefined )
                        {
                            $scope.errors.push( errors.name[0] );
                        }
                        if( errors.email != undefined)
                        {
                            $scope.errors.push( errors.email[0] );
                        }
                        console.log( errors );
                    });   
            }
        }

    
    
})();