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

@foreach( $pendientes as $restaurante )
<div class="container">
<form action="{{ url('/introducirMenuRestaurantePendiente')}}" method="POST">
  <div class="panelResultados panelResultadosNoFichado">
    <p class="tituloResultado">{{ $restaurante['nombre'] }}</p>
    <p class="direccionResultado">{{ $restaurante['direccion'] }}</p>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id_restaurante" value="{{ $restaurante['id_restaurante'] }}">
  <input type="submit" value="INTRODUCIR MENU"  class="btn btn-primary">
  </div>
  </form>
</div>

@endforeach

@endif


@endsection
