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
<div class="panel-heading" style="border-radius: 32px;color: #FFE;background-color: #7d6199;border-color: #554268;"><h2>{{ $restaurante->nombre_restaurante }}</h2></div>

<form action="{{ url('/DatosModificadosRestaurante')}}" method="POST">
  <div class="cartaMenu" >
      <label>Tipo de restaurante</label>
      <select name="Datos[TipoRestaurante]" class="form-control">

      @foreach( $tipos as $tipo )
      @if ( $tipo->Nombre == $tipoConcreto->Nombre )
      <option value="{{ $tipo->id_tipo }}" selected>{{ $tipo->Nombre }}</option>
      @else
        <option value="{{ $tipo->id_tipo }}">{{ $tipo->Nombre }}</option>
      @endif
      @endforeach
      </select>
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
      <div class="panel panel-default"  style="border-radius: 32px;    border-color: #b73a3a;background: #b73a3a;">

        <div class="panel-heading" style="border-radius: 32px;color: #FFE;background-color: #7d6199;border-color: #554268;">
<h4>FOTO PRINCIPAL</h4></div>
<div class="cartaMenu">
      @foreach( $datos_imagen as $key=>$imagen )
      <div style="display: inline-block;margin-right:10px">
      <img style="    width: 100%;" src='{{ $imagen }}') ></img>

        <input id="CheckImg{{$key}}" type="checkbox" name="Datos[{{$key}}]"  onclick='selectOnlyImg({{$key}},{{$cuentaFotos}})'>
      </div>
      @endforeach
      </div>
</div>
<div class="panel panel-default"  style="border-radius: 32px;    border-color: #b73a3a;background: #b73a3a;">

  <div class="panel-heading" style="border-radius: 32px;color: #FFE;background-color: #7d6199;border-color: #554268;">
<h4>PLATOS</h4></div>
<div class="cartaMenu">
@foreach ($menus as $key=>$plato)
<script>count++;</script>
<div class="divPlatos">
<label>Nombre plato</label>  <input type="text" name="{{ $plato->id_plato }}[nombre]" value="{{ $plato->nombre }}" class="form-control">
<label>Precio plato</label>  <input type="text" name="{{ $plato->id_plato }}[precio]" value="{{ $plato->precio }}" class="form-control">

<label>¿Es su producto estrella?</label>

@if ( $plato->estrella == 0 )

<input class='form-control' type='checkbox' id='Check{{ $key }}' name='{{ $plato->id_plato }}[estrella]' onclick='selectOnlyThis(this.id,{{ $cuenta }})' />
  @else
  <input class='form-control' type='checkbox' id='Check{{ $key }}' name='{{ $plato->id_plato }}[estrella]' checked onclick='selectOnlyThis(this.id,{{ $cuenta }})' />

@endif

<label>Categoria Plato</label> <input type="text" name="{{ $plato->id_plato }}[categoria_plato]" value="{{ $plato->categoria_plato }}" class="form-control">
<hr size="7"  />
</div>
@endforeach
</div>
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

<script>

var count=1;
function selectOnlyThis(id,cuenta) {
  if(  document.getElementById(id).checked = true){
    for (var i = 0;i < cuenta-1; i++)
    {
      document.getElementById("Check" + i).checked = false;
    }
    document.getElementById(id).checked = true;
  }else{
    document.getElementById(id).checked = false;
  }

}

function selectOnlyImg(key,cuenta) {
  if(  document.getElementById("CheckImg" + key).checked = true){
    for (var i = 0;i <= cuenta-1; i++)
    {
        document.getElementById("CheckImg" + i).checked = false;
    }

      document.getElementById("CheckImg" + key).checked = true;
  }else{
      document.getElementById("CheckImg" + key).checked = false;
  }


}

    </script>
