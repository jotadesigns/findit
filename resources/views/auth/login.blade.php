@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-xs-12	col-sm-12	col-md-6	col-lg-6 login-cont col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3">
        <form class="" role="form" action="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/login' }}" method="post">
          {{ csrf_field() }}
          <h3>@lang('login.login-title')</h3>
          <input id="email" type="email" class="form-control login-input" name="email" value="{{ old('email') }}" placeholder="@lang('login.email')" required autofocus>
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
          <input id="password" type="password" class="form-control login-input" name="password" placeholder="@lang('login.password')" required>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <input class="boton_login" type="submit" name="" value="@lang('login.button-login')">
          <div class="bar-separator">
            <span>@lang('login.other')</span>
          </div>
          <div class="connectionFacebook">
              <a href="redirect" class="connectionFacebook-loginButton icon-auth-facebook js-facebook-login" tabindex="0">
                  <i class="login-facebook-icon ion-social-facebook"></i>
                  <span class="connectionFacebook-loginContent">
                      <span class="connectionFacebook-loginBg"></span>
                      <span class="connectionFacebook-loginText">@lang('login.facebook')</span>
                  </span>
              </a>
              <div><i class="ion-plane connectionFacebook-beneficits"></i>@lang('login.beneficio1')</div>
              <div><i class="ion-person connectionFacebook-beneficits"></i>@lang('login.beneficio2')</div>
          </div>
          <a class="btn btn-link" href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/password/reset' }}">
              @lang('login.forgotpassword')
          </a>

        </form>
      </div>









<!--   FORMULARIO  DE LOGIN ANTIGUO
        <div class="col-xs-12	col-sm-12	col-md-12	col-lg-12 login-cont">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/login' }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/password/reset' }}">
                                    Forgot Your Password?
                                </a>

                                <a class="btn btn-link" href="redirect">
                                    FACEBOOK
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        -->
    </div>
</div>
@endsection
