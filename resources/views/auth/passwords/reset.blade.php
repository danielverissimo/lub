@extends('layouts.app_simple')

<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="login-box" style="max-width: 600px; min-width: 180px;">
                    <div id="login-box-holder">
                        <div class="row">
                            <div class="col-xs-12">
                                <header id="login-header">
                                    <div id="login-logo">
                                        <img src="img/logo.png" alt=""/>
                                    </div>
                                </header>
                                <div id="login-box-inner" class="with-heading">

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                        <br/>
                                    @endif

                                    @if ($errors->has('token'))

                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{ $errors->first('token') }}</strong>
                                        </div>
                                        <br/>
                                    @endif


                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">

                                        {{ csrf_field() }}

                                        <input type="hidden" name="token" value="{{ $token }}">

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

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">

                                                        <div class="input-group reset-pass-input {{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-bottom: 0; padding: 0 0;">
                                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{trans('reset.password_confirm')}}" required>
                                                        </div>

                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn btn-success col-xs-12">{{trans('reset.reset_password')}}</button>
                                            </div>
                                            <div class="col-xs-12">
                                                <br/>
                                                <a href="/login" id="login-forget-link" class="forgot-link col-xs-12">{{trans('reset.back_login')}}</a>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


