@extends('layouts.appadmin')

@section('content')
<div class="container">
<div id="contenedor_insercción" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="perfil_bread" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <h2 class="profile_title">Ingreso Masivo</h2>
  <h3 id="perfil_titulo">Administracion</h3>
  </div>
  </div>
    </div>
@if ( !$pendientes->count() )
  No hemos encontrado locales cercanos
@else
<div class="container">

  <form action="{{ url('/seleccionRestaurantesMasivo')}}" method="POST">

  @foreach( $pendientes as $restaurante )
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="panelResultados panelResultadosNoFichado">
      <div class="pendientes-data">
        <p class="tituloResultado">{{ $restaurante['nombre'] }}</p>
        <p class="direccionResultado">{{ $restaurante['direccion'] }}</p>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="{{ $restaurante['id_restaurante'] }}[id_restaurante]" value="{{ $restaurante['id_restaurante'] }}">
      <label style="text-align:center;display:block;margin-bottom:0;margin-top:5px;"><input type="checkbox" name="{{ $restaurante['id_restaurante'] }}[seleccion]" class="checkbox_animado">
              <span class="label-text"></span>
      </label>
    </div>
  </div>
  @endforeach

  <input type="submit" value="INTRODUCIR MENU"  class="boton_login">
  </form>
</div>
@endif


@endsection
