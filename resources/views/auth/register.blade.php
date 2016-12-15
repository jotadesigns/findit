@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-xs-12	col-sm-12	col-md-6	col-lg-6 login-cont col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3">
        <form role="form" method="POST" action="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/register' }}">
          {{ csrf_field() }}
          <h3>@lang('login.register-title')</h3>

          <input id="name" type="text" class="form-control login-input" name="name" value="{{ old('name') }}" placeholder="@lang('login.name')" required autofocus>
          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif

          <input id="email" type="email" class="form-control login-input" name="email" value="{{ old('email') }}" placeholder="@lang('login.email')" required>
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

          <input id="password-confirm" type="password" class="form-control login-input" name="password_confirmation" placeholder="@lang('login.password_confirm')" required>
          @if ($errors->has('password_confirmation'))
              <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
          @endif

          <input type="submit" class="boton_login" name="" value="@lang('login.button-register')">

          <div class="register-termsOfUse">
            He leído y acepto <a href="/legal" target="_blank" tabindex="0">la política de privacidad y las condiciones legales</a> de FINDIT
          </div>

        </form>
      </div>




<!--

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/register' }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
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
