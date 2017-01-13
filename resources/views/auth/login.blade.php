@extends('layouts.app_simple')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="login-box">
                <div id="login-box-holder">
                    <div class="row">
                        <div class="col-xs-12">
                            <header id="login-header">
                                <div id="login-logo">
                                    <img src="img/logo.png" alt=""/>
                                </div>
                            </header>
                            <div id="login-box-inner">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <div class="input-group reset-pass-input {{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 0; padding: 0 0;">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="{{trans('reset.mail_address')}}" required autofocus>
                                                    </div>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <div class="input-group reset-pass-input {{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 0; padding: 0 0;">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                        <input id="password" type="password" class="form-control" name="password" placeholder="{{trans('reset.password')}}" required>
                                                    </div>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="remember-me-wrapper">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox-nice">
                                                    <input type="checkbox" id="remember" name="remember"/>
                                                    <label for="remember">
                                                        {{trans('auth.rememberme')}}
                                                    </label>
                                                </div>
                                            </div>
                                            <a href="{{ url('/password/reset') }}" id="login-forget-link" class="col-xs-6">
                                                {{trans('reset.forgot_password')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-success col-xs-12">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="login-box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            Do not have an account?
                            <a href="registration.html">
                                Register now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
