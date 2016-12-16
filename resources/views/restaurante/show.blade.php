@extends('layouts.perfil')

@section('perfil')

                      <h3>@lang('profile.title_restaurants')</h3>
                  </div>
              </div>

@if ( !$restaurantes->count() )
  No tienes restaurantes asociados
@else
<div class="container">
    <div style="padding-bottom:40px;" class="row">

        @foreach ($restaurantes as $restaurante)
        <div class="restaurant_settings col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p class="restaurant_settings-subtitle">{{ $restaurante->nombre_restaurante }}</p>
            <div class="restaurant_settings-edit col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <form action="{{ url('/editarRestauranteConcreto')}}" method="POST">

                <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="Modificar Restaurante" class="restaurant_settings-btn ">
                </form>
            </div>
            <div class="restaurant_settings-more col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <form action="{{ url('/añadirPlatos')}}" method="POST">
                <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="Añadir Platos" class="restaurant_settings-btn ">
                </form>
            </div>
            <div class="restaurant_settings-less col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <form action="{{ url('/mostrarPlatosBorrar')}}" method="POST">
            <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Borrar Platos" class="restaurant_settings-btn ">
            </form>
            </div>
            <div class="restaurant_settings-exit col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <form action="{{ url('/desvincularRestaurante')}}" method="POST">
                <input type="hidden" name="prueba" value={{$restaurante->id_restaurante}} />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="Desvincular Restaurante" class="restaurant_settings-btn ">
                </form>
            </div>
        </div>
        @endforeach


</div>
</div>
@endif

@endsection
