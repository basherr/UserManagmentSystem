( function() {
	'use strict';

	angular
	.module('UsersManagmentApp')
	.controller('UserEditCtrl', ['User','$stateParams', '$scope', '$state','$timeout', function(User, stateParams, scope, state, $timeout){		
		var id = stateParams.id;

		scope.userdata = {};

		User.getById( id )
		.success( function( user ) {
			//If somebudy try to access id that's not exist
			if(user !== undefined)
			{
				scope.userdata = user;
			} else {
				state.go('users');
			}
		});

		scope.updateUser = function() {
			scope.errors = [];
			scope.success_message = false;
			scope.userdata._method = 'Put';
			User
				.update(scope.userdata)
				.success( function(response) {
					scope.success_message = response.message;
					$timeout( function() {
	                    scope.success_message = null;
	                }, 6000);
				})
				.error(function( response_errors ) {
					jQuery.each(response_errors, function(index, val) {
						scope.errors.push(  val[0] ); 
					});
				});;
		}
	}]);
})();