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
            <div class="panel panel-default">


@foreach ($restaurantes as $restaurante)
<div class="panel-heading"><h2>Borrado de platos para {{ $restaurante->nombre_restaurante }}</h2></div>
@endforeach

      </div>


<div class="panel panel-default">
<div class="panel-heading"><h5>PLATOS</h5></div>
@if ( !$menus->count() )
  No tienes platos asociados
@else

@foreach ($menus as $plato)
<<<<<<< Updated upstream
<form action="{{ url('/borrarPlatos')}}" method="POST">
<p>Nombre plato: {{ $plato->nombre }}</p>
<p>Precio plato: {{ $plato->precio }}</p>
<p>Categoria Plato: {{ $plato->categoria_plato }}</p>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id_restaurante" value="{{ $restaurante->id_restaurante }}">
<input type="hidden" name="id_plato" value="{{ $plato->id_plato }}">
<input type="submit" value="BORRAR PLATO"  class="btn btn-danger">
<hr size="7"  />
</form>
=======
@if($plato->id_plato ==null)
No tienes platos asociados a este restaurante
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
>>>>>>> Stashed changes
@endforeach
    </div>
  </div>
</div>

</div>


@endif
@endif






@endsection
