angular.module('UserService', [])
		.factory('User', function($http){
			return {
				get: function() {
					return $http.get('users');
				},
				save: function(userdata) {
					return $http({ 
						method: 'POST',
						url: 'api/register',
						headers: {'Content-Type':'Application/x-www-form-urlencoded'},
						data: $.param(userdata)
					});
				}
			};
		});
