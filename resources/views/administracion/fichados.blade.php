@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div id="contenedor_insercción" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="perfil_bread" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h2 class="profile_title">Locales Pendientes</h2>
      <h3 id="perfil_titulo">Administracion</h3>
      </div>
    </div>
</div>

@if ( !$pendientes->count() )
  <h3 style="color:white">  No hemos encontrado locales cercanos</h3>
@else
<div class="container">

  @foreach( $pendientes as $restaurante )
  <form action="{{ url('/introducirMenuRestaurantePendiente')}}" method="POST">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      <div class="panelResultados panelResultadosNoFichado ">
        <div class="pendientes-data">
          <p class="tituloResultado">{{ $restaurante['nombre'] }}</p>
          <p class="direccionResultado">{{ $restaurante['direccion'] }}</p>
          <p class="pendientes-admin">Admin - <span>{{ $restaurante['name'] }}</span></p>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_restaurante" value="{{ $restaurante['id_restaurante'] }}">
        <input type="submit" value="INTRODUCIR MENU"  class="boton_login">

      </div>
    </div>
    </form>
  @endforeach

</div>
@endif


@endsection
