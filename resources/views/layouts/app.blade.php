<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Users Managment System</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/angular.js') !!}
</head>
<body id="app-layout" ng-app="UsersManagmentApp">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="#users">
                    Users Managment System
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href ui-sref="users" ng-if="authenticated">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#login"  ng-if="!authenticated" ui-sref="login">Login</a></li>
                    <li><a href ui-sref="register" ng-if="!authenticated">Register</a></li>
                    <li><a href ng-click="logout();" ng-if="authenticated"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h3>Welcome [[ currentUser.name ]]</h3>
        <div ui-view></div>
    </div>

    <!-- JavaScripts -->
    {!! Html::script('js/angular-resource.js') !!}
    {!! Html::script('js/angular-ui-router.min.js') !!}
    {!! Html::script('../node_modules/satellizer/satellizer.js') !!}
    {!! Html::script('js/services/User.js') !!}
    {!! Html::script('js/app.js') !!}
    {!! Html::script('js/controllers/authController.js') !!}
    {!! Html::script('js/controllers/userController.js') !!}
    {!! Html::script('js/controllers/userEditController.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
</body>
</html>
