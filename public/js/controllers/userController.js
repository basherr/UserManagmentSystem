(function() {

    'use strict';

    angular
        .module('UsersManagmentApp')
        .controller('UserCtrl', UserController);  

    function UserController($scope, $http, User, $state, $timeout, $auth, $rootScope, $stateParams ) {
           $scope.userdata = {};

           User.get().success( function( users ) {
                $scope.users = users;
            });


            $scope.createUser = function()  {
                $scope.errors = [];
                User.save($scope.userdata)
                    .success(function(response) {
                        handleSuccess( response );
                    })
                    .error( function( response_errors ) {
                        handleErrors( response_errors );
                    });   
            }

            $scope.edit = function(id) {
                $state.go('edit', {'id' : id });
            }

            $scope.delete = function(id) {
                var cnfrm = confirm('Are you sure you want to delete this user?');
                if(cnfrm) {
                    User.delete(id).success( function( response) {
                        $scope.success_message = response.message;
                        $timeout( function() {
                            $scope.success_message = null;
                        }, 6000);
                    })
                    .then( function() {
                        User.get().success( function( users ) {
                            $scope.users = users;
                        })
                    });
                }
            }

            //handle errors for add / edit
            function handleErrors( response_errors ) {
                jQuery.each( response_errors, function(index, val) {
                     $scope.errors.push( val[0] );
                });
            }
            // handle success for add / delete
            function handleSuccess( response ) {
                $scope.userdata = {};
                $scope.success_message = response.message;
                $timeout( function() {
                    $scope.success_message = null;
                }, 6000);
            }
        }

    
    
})();