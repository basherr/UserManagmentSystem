angular.module('AuthService', [])
		.factory('Auth', function($http){
			return {
				signIn: function( userCreds ) {
					return $http({
						method : 'POST',
						url : 'login',
						headers : {'Content-Type' : 'application/x-www-form-urlencoded'},
						data : $.param( userCreds )
					})
				}
			};
		});