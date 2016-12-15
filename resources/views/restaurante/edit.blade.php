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
<div class="panel-heading"><h2>{{ $restaurante->nombre_restaurante }}</h2></div>


<form action="{{ url('/DatosModificadosRestaurante')}}" method="POST">
  <div class="cartaMenu">
      <label>Tipo de restaurante</label><input type="text" name="Datos[TipoRestaurante]" value="{{ $restaurante->tipo }}" class="form-control">

      <label>Entrega a domicilio</label>
      @if ( $restaurante->domicilio == 0 )
       <input type="hidden" name="Datos[Domicilio]" value="0">
       <input type="checkbox" name="Datos[Domicilio]" class="form-control">

       @else
       <input type="checkbox" name="Datos[Domicilio]" checked class="form-control">

@endif

      <label>Terraza</label>
       @if ( $restaurante->terraza == 0 )
          <input type="hidden" name="Datos[Terraza]" value="0">
         <input type="checkbox" name="Datos[Terraza]" class="form-control">

         @else
         <input type="checkbox" name="Datos[Terraza]" checked class="form-control">
  @endif

      <label>Parking propio</label>
      @if ( $restaurante->parking == 0 )
        <input type="hidden" name="Datos[Parking]" value="0">
        <input type="checkbox" name="Datos[Parking]" class="form-control">

        @else
        <input type="checkbox" name="Datos[Parking]" checked class="form-control">
   @endif

      <label>Retransmite eventos deportivos</label>
      @if ( $restaurante->eventos_deportivos == 0 )
        <input type="hidden" name="Datos[Eventos]" value="0">
        <input type="checkbox" name="Datos[Eventos]" class="form-control">

        @else
        <input type="checkbox" name="Datos[Eventos]" checked class="form-control">
   @endif

  </div>
@endforeach
      </div>

<div class="panel panel-default">
<div class="panel-heading"><h5>PLATOS</h5></div>
@foreach ($menus as $plato)
<div class="divPlatos">
<label>Nombre plato</label>  <input type="text" name="{{ $plato->id_plato }}[nombre]" value="{{ $plato->nombre }}" class="form-control">
<label>Precio plato</label>  <input type="text" name="{{ $plato->id_plato }}[precio]" value="{{ $plato->precio }}" class="form-control">

 {{--<p>Producto estrella</p>

@if ( $restaurante->estrella == 0 )
  <input type="hidden" name="{{ $plato->id_plato }}[estrella]" value="0" class="form-control">
  <input type="radio" name="estrella">

  @else
  <input type="checkbox" name="{{ $plato->id_plato }}[estrella]" checked value="1" class="form-control">
@endif--}}

<label>Categoria Plato</label> <input type="text" name="{{ $plato->id_plato }}[categoria_plato]" value="{{ $plato->categoria_plato }}" class="form-control">
<hr size="7"  />
</div>
@endforeach
    </div>
  </div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id_restaurante" value="{{ $restaurante->id_restaurante }}">
  <input type="submit" value="ENVIA TUS DATOS"  class="btn btn-primary">
</form>

</div>

@endif






@endsection
