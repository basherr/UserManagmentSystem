angular.module('UserService', [])
		.factory('User', function($http){
			return {
				get: function() {
					// return $http.get('home');
				}
			};
		});
