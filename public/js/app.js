(function() {

    'use strict';

    angular
        .module('UsersManagmentApp', ['ui.router', 'satellizer', 'UserService'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider, $interpolateProvider, $httpProvider, $provide) {

            function redirectWhenLogout($q, $injector) {

                return {

                    responseError: function(rejection) {

                        var $state = $injector.get('$state');

                        var reasons = [ 'token_not_provided', 'Token_expired','Invalid_token','Token_Invalid'];

                        angular.forEach( reasons, function(value, key) {
                            if(rejection.data.error == value) {
                                localStorage.removeItem('user');
                                
                                $state.go('login');
                            }
                        });

                        return $q.reject(rejection);
                    }
                }
            }

            $provide.factory('redirectWhenLogout', redirectWhenLogout);
            $httpProvider.interceptors.push('redirectWhenLogout');

        	$interpolateProvider.startSymbol('[[').endSymbol(']]');
            $authProvider.loginUrl = '/UserManagmentSystem/public/api/authenticate';

            $urlRouterProvider.otherwise('/login');
            
            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'views/login.html',
                    controller: 'AuthCtrl as auth'
                })
                .state('users', {
                    url: '/users',
                    templateUrl: 'views/userView.html',
                    controller: 'UserCtrl as user'
                })
                .state('create', {
                    url: '/create',
                    templateUrl: 'views/create.html',
                    controller: 'UserCtrl as user'
                })
                .state('edit', {
                    url: '/edit/:id',
                    templateUrl: 'views/edit.html',
                    controller: 'UserEditCtrl as edit'
                });
        })
        .directive('onSubmitFocus', function() {
        	return {
        		link: function(scope, element, attrs) {
        			element[0].focus();
        		}
        	}
        })
        .run(function( $rootScope, $state, $auth ) {

            $rootScope.logout = function() {
                    $auth.logout().then( function() {
                    localStorage.removeItem('user');
                    $rootScope.authenticated = false;
                    $rootScope.currentUser = null;

                    $state.go('login');
                });
            }

            $rootScope.$on('$stateChangeStart', function( event, toState) {

                var user = JSON.parse( localStorage.getItem('user'));
                //If user data is set in the localstorage then we assume that user is logged in
                if(user)
                {

                    $rootScope.authenticated = true;
                    $rootScope.currentUser = user;

                    if(toState.name == "login")
                    {
                        event.preventDefault();

                        $state.go('users');
                    }
                }
            });
        });
})();
