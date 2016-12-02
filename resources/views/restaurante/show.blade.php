@extends('layouts.perfil')

@section('perfil')

                      <h3>@lang('profile.title_restaurants')</h3>
                  </div>
              </div>

@if ( !$restaurantes->count() )
  No tienes restaurantes asociados
@else
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMINISTRACION DE TUS RESTAURANTES</div>
@foreach ($restaurantes as $restaurante)
  <div class="panelResultados panelResultadosNoFichado">
                <div class="panel-body">

              <p class="tituloResultado">{{ $restaurante->nombre_restaurante }}</p>
              <form action="{{ url('/editarRestauranteConcreto')}}" method="POST">
              <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" value="Modificar Restaurante" class="btn btn-primary">
              </form>
              <form action="{{ url('/añadirPlatos')}}" method="POST">
              <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" value="Añadir Platos" class="btn btn-primary">
              </form>
              <form action="{{ url('/mostrarPlatosBorrar')}}" method="POST">
              <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" value="Borrar Platos" class="btn btn-primary">
              </form>
              <form action="{{ url('/desvincularRestaurante')}}" method="POST">
              <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" value="Desvincular Restaurante" class="btn btn-primary">
              </form>
              </div>
</div>
@endforeach
</div>
</div>
</div>
</div>
@endif

@endsection
