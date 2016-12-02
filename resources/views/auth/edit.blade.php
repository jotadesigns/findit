@extends('layouts.perfil')

@section('perfil')


        <h3 id="perfil_titulo">Editar perfil de {{ Auth::user()->name }}</h3>
    </div>

<div id="profile-data-forms" class="row">
    <section  class="perfil_padding col-xs-12 col-sm-12 col-md-6 col-lg-6">
         <div class="perfil_light">

              {!! Form::model($user, ['method' => 'POST', 'route' => ['user.save']]) !!}
                @include('auth/partials/_form', ['submit_text' => 'Guardar perfil'])
            {!! Form::close() !!}

            {!! Form::model($user, ['method' => 'GET', 'route' => ['user.borrar']]) !!}
                @include('auth/partials/form_borrar', ['submit_text' => 'Borrar perfil'])
            {!! Form::close() !!}
        </div>
    </section>
    <section class="perfil_padding col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="perfil_light">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="profile-data-title">Cambiar contraseña</h2>
            </div>
            <form class="" action="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/perfil/config_pass' }}" method="post">
                <div class="perfil-form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="password" placeholder="******" name="password" required />
                </div>
                <div class="perfil-form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="password" placeholder="******" name="password_confirmation" required >
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input class="btn-profile-data" type="submit" name="change" value="Cambiar">
                </div>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </section>
</div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(old('correcto')!==null)
        <div class="alert alert-success">
            <i class='ion-checkmark'></i>
            {{trans('profile.save_success', ['name' => Auth::user()->name])}}
        </div>
    @endif



</div>

@endsection
