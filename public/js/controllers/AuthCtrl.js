angular.module('AuthCtrl', [])
	.controller('AuthCtrl', ['$http', '$scope', 'Auth', function(http, scope, Auth){
		scope.emailError = '';
		scope.passwordError = '';
		scope.login = function() {
			Auth.signIn(scope.userCred)
			   .success( function(response) {
			   		scope.emailError = false;
			   		scope.credsError = false;
			   		scope.passwordError = false;
			   		if(response.success)
			   		{
			   			
			   		} else
			   		{
			   			if(response.authError) {
			   				scope.credsError = response.authError;
			   				return;
			   			}
			   			if(response.messages.email){
			   				scope.emailError = response.messages.email[0];
			   			}
			   			if(response.messages.password){
			   				scope.passwordError = response.messages.password[0];
			   			}

			   		}
			   });
			}
	}]);