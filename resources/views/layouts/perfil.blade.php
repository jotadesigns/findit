@extends('layouts.app')

@section('content')

<div class='container'>

    <!-- @if(!empty(Session::get('userExtra')["cover"]))
        <img src="{!! Session::get('userExtra')['cover'] !!}" />
    @endif -->
    <div class="row profile-height-nav">
        <div id="perfil_leftgrid" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul>
                <li><a href="{{url('/')}}"><i class="ion-home"></i></a></li>
                <li>
                    <a href="{{url('/perfil/favoritos')}}">
                        <i alt="@lang('profile.title_favorites')" class="ion-android-star-outline profile_icons"></i>
                        <p>@lang('profile.title_favorites')</p>
                    </a>
                </li>
                <div class="nav-separator"></div>
                <li>
                    <a href="{{url('/perfil/configuracion')}}">
                        <i class="ion-settings profile_icons"></i>
                        <p>@lang('profile.title_settings')</p>
                    </a>
                </li>
                <div class="nav-separator"></div>
                <li>
                    <a href="{{url('/perfil/editar')}}">
                        <i class="ion-person profile_icons"></i>
                        <p>@lang('profile.title_data')</p>
                    </a>
                </li>
                <div class="nav-separator"></div>
                @if(Auth::user()->rango == "R")
                    <li>
                        <a href="{{ url('/editarRestaurante') }}">
                            <i class="ion-fork profile_icons"></i>
                            <p>@lang('profile.title_restaurants')</p>
                        </a>
                    </li>
                @elseif(Auth::user()->rango == "A")
                    <li>
                        <a href="{{ url('/administracion/ingresar') }}">
                            <i class="ion-briefcase profile_icons"></i>
                            <p>@lang('profile.title_admin')</p>
                        </a>
                    </li>
                @endif
                <li><a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/logout' }}"><i class="ion-power profile_icons"></i></a></li>

            </ul>
        </div>
    </div>

        <div class="perfil_bread" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2 class="profile_title">@lang('profile.profile')</h2>
        @yield('perfil')



</div>

@endsection
