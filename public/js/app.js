var app = angular.module('UsersManagment', [ 'AuthCtrl', 'AuthService', 'UserService']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
