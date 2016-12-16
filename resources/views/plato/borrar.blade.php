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
        <div class="col-md-10 col-md-offset-1">

            @foreach ($restaurantes as $restaurante)
            <p class="restaurant_settings-subtitle">Borrado de platos para {{ $restaurante->nombre_restaurante }}</p>
            @endforeach

@if ( !$menus->count() )
  No tienes platos asociados
@else
<div class="cartaMenu" style="background:#f2e6ff;overflow:auto;">
    <h3 style="margin-bottom:20px;color:#c32020;margin-bottom:25px;font-weight:600;">Platos</h3>
@foreach ($menus as $plato)
@if($plato->id_plato ==null)
NO tienes platos asociados
@else

    <div class="borrado-plato-cont col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <form action="{{ url('/borrarPlatos')}}" method="POST">
        <p><span>Nombre plato:</span> {{ $plato->nombre }}</p>
        <p><span>Precio plato:</span> {{ $plato->precio }}€</p>
        <p><span>Categoria Plato:</span> {{ $plato->categoria_plato }}</p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_restaurante" value="{{ $restaurante->id_restaurante }}">
        <input type="hidden" name="id_plato" value="{{ $plato->id_plato }}">
        <input type="submit" value="BORRAR PLATO"  class="boton_remove">
        </form>
    </div>
    @endif
@endforeach
    </div>

    </div>
</div>



@endif
<div style="width:100%; height:120px;">
</div>
</div>
@endif





@endsection
