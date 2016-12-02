@extends('layouts.appadmin')

@section('content')

<div class="container">
    <div id="contenedor_insercción" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="perfil_bread" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h2 class="profile_title">Busqueda</h2>
      <h3 id="perfil_titulo">Administracion</h3>
      </div>



        <form id="form_busqueda" action="{{ url('/buscarRestaurantesAdmin') }}" method="POST">
          <div class="search-form search-direction">
              <i class="ion-android-search"></i>
              <input id="direccion" type="text"  name="busqueda" placeholder="@lang('welcome.placeholder_direccion')" required/>
          </div>

            <h2>Radio en metros </h2>
            <div class="search-form search-direction">
              <input type="number" value="1000" name="radio"  required/>
                </div>
            <input class="boton_full btn btn-primary" type="submit" name="enviarbusqueda" value="Buscar"/>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
        <form id="form_busqueda" action="{{ url('/buscarRestaurantesMasivo') }}" method="POST">
          <h2>masivo</h2>
          <div class="search-form search-direction">
              <i class="ion-android-search"></i>
              <input id="direccion" type="text"  name="busqueda" placeholder="@lang('welcome.placeholder_direccion')" required/>
          </div>
            <input class="boton_full btn btn-primary" type="submit" name="enviarbusqueda" value="Buscar"/>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>


    </div>
 </div>


@endsection
