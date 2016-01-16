@extends('layouts.app')

@section('content')
<div class="container" ng-controller="AuthCtrl">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" ng-submit="login()" >
                        {!! csrf_field() !!}

                        <span class="help-block alert alert-danger" ng-if="credsError ? true : false ">
                            <strong>{[{ credsError }]}</strong>
                        </span>
                        <div class="form-group {[{ emailError }]}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" ng-model="userCred.email" value="{{ old('email') }}">
                                <span class="help-block alert alert-danger" ng-if="emailError ? true : false ">
                                    <strong>{[{ emailError }]}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" ng-model="userCred.password" >

                                <span class="help-block alert alert-danger" ng-if="passwordError ? true : false ">
                                    <strong>{[{ passwordError }]}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" ng-model="userCred.remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
{!! Html::script('js/controllers/AuthCtrl.js') !!}
@endsection