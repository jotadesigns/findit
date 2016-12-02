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
@endforeach
    </div>
  </div>
</div>

</div>


@endif
@endif






@endsection
