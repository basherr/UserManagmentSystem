(function() {

    'use strict';

    angular
        .module('authApp', ['ui.router', 'satellizer', 'UserService'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider, $interpolateProvider) {

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
                });
        })
        .directive('onSubmitFocus', function() {
        	return {
        		link: function(scope, element, attrs) {
        			element[0].focus();
        		}
        	}
        })
})();
