@extends('layouts.app_simple')

<!-- Main Content -->
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
                                <div id="login-box-inner" class="with-heading">

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                        <br/>
                                    @endif

                                    <h4>{{trans('reset.forgot_password')}}</h4>
                                    <p>
                                        {{trans('reset.enter_mail_recover')}}
                                    </p>
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">

                                        {{ csrf_field() }}

                                        <div class="input-group reset-pass-input {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input class="form-control" id="email" type="email" placeholder="{{trans('reset.mail_address')}}" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
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

