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
				},
				getAuthUser: function() {
					return $http.get('authenticate/user');
				},
				getById: function(id) {
					return $http.get('user/'+id);
				},
				update: function(userdata) {
					return $http({
						method: 'Post',
						url: 'user/update',
						headers: {'Content-Type' : 'Application/x-www-form-urlencoded'},
						data: $.param(userdata)
					});
				},
				delete: function(id) {
					var userdata = {};
					userdata._method = 'delete';
					// console.log(userdata);
					return $http({
						method: 'Post',
						url: 'user/delete/'+id,
						headers: {'Content-Type' : 'Application/x-www-form-urlencoded'},
						data: $.param( userdata )
					});
				}
			};
		});
