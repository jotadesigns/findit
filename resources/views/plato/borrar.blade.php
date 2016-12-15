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
          <div class="panel panel-default"  style="border-radius: 32px;    border-color: #b73a3a;background: #b73a3a;">



@foreach ($restaurantes as $restaurante)
<div class="panel-heading" style="border-radius: 32px;color: #FFE;background-color: #7d6199;border-color: #554268;"><h2>Borrado de platos para {{ $restaurante->nombre_restaurante }}</h2></div>
@endforeach

      </div>

  <div class="cartaMenu" style="background:wheat;">

<div class="panel-heading"><h3 style="text-align:center;">PLATOS</h3></div>
@if ( !$menus->count() )
  No tienes platos asociados
@else
<div class="cartaMenu" style="background:#f2e6ff;">
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
<div style="width:100%; height:120px;">
</div>
</div>
@endif





@endsection
