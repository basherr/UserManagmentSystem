<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Users Managment System</title>

    <!-- Fonts -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> --}}
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> --}}
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/angular.js') !!}
</head>
<body id="app-layout" ng-app="authApp">
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
                <a class="navbar-brand" href="#/">
                    Users Managment System
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="#/" >Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    
                        <li><a href="#login" ng-if="!authenticated">Login</a></li>
                        <li><a href="#register" ng-if="!authenticated">Register</a></li>
                    
                        <li class="dropdown" ng-if="authenticated">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#logout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div ui-view></div>

    <!-- JavaScripts -->
    {!! Html::script('js/angular-resource.js') !!}
    {!! Html::script('js/angular-ui-router.min.js') !!}
    {!! Html::script('../node_modules/satellizer/satellizer.js') !!}
    {!! Html::script('js/services/User.js') !!}
    {!! Html::script('js/app.js') !!}
    {!! Html::script('js/controllers/authController.js') !!}
    {!! Html::script('js/controllers/userController.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
</body>
</html>
