@extends('layouts.perfil')

@section('perfil')

                      <h3>@lang('profile.title_restaurants')</h3>
                  </div>
              </div>

@if ( !$restaurantes->count() )
  No tienes restaurantes asociados
@else

<div class="container">
    <div class="row" style="padding:0;">
        @foreach ($restaurantes as $restaurante)
        <div class="Terminosfusionfinal col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="restaurant_settings-title">{{ $restaurante->nombre_restaurante }}</h2>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form action="{{ url('/DatosModificadosRestaurante')}}" method="POST">
            <p class="restaurant_settings-subtitle">Datos del restaurante</p>
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

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="restaurant_settings-subtitle">Foto principal</h2>
        </div>

        <div class="cartaMenu">
              @foreach( $datos_imagen as $key=>$imagen )
              <div style="display: inline-block;margin-right:10px">
              <img style="    width: 100%;" src='{{ $imagen }}') ></img>
              <input id="CheckImg{{$key}}" type="checkbox" name="Datos[{{$key}}]"  onclick='selectOnlyImg({{$key}},{{$cuentaFotos}})'>
              </div>
              @endforeach
        </div>


        @endforeach


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


            <div class="cartaMenu">
                <p class="restaurant_settings-subtitle">PLATOS</p>

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

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id_restaurante" value="{{ $restaurante->id_restaurante }}">
   <input style="margin-top:20px;margin-bottom:100px;" type="submit" value="ENVIA TUS DATOS"  class="boton_login">
  </form>

</div>



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
