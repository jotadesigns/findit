@extends('layouts.appadmin')

@section('content')

@if ( $restaurantes_cercanos['results'] < 1 )
  No hemos encontrado locales cercanos
@else

@foreach( $restaurantes_cercanos['results'] as $restaurante )
@if ( $restaurante['fichado'] == false )
<div class="container">
<div id="resultados_ajax"></div>
<form>
  <div class="panelResultados panelResultadosNoFichado">
<p class="tituloResultado">{{ $restaurante['name'] }}</p>
<p class="direccionResultado">{{ $restaurante['vicinity'] }}</p>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id_restaurante" value="{{ $restaurante['place_id'] }}">
<input type="hidden" name="nombre" value="{{ $restaurante['name'] }}">
<input type="hidden" name="direccion" value="{{ $restaurante['vicinity'] }}">
<a href="#" id="{{ $restaurante['place_id'] }}" class="btn btn-primary" onclick="realizaProceso('{{ $restaurante['place_id'] }}','{{ $restaurante['name'] }}','{{ $restaurante['vicinity'] }}');return false;">FICHAR RESTAURANTE</a>
  </div>
  </form>
  </div>
  @else
<div class="container">
  <div class="panelResultados panelResultadosFichado">
  <p class="tituloResultado">{{ $restaurante['name'] }}</p>
  <p class="direccionResultado">{{ $restaurante['vicinity'] }}</p>
  <p class="btn btn-success">RESTAURANTE YA FICHADO</p>
  </div>
    </div>
@endif
@endforeach

@endif


<script>
function realizaProceso(placeid,nombre,direccion){

                var parametros = {
                   "_token": "<?php echo csrf_token() ?>",
                        "placeid" : placeid,
                        "nombre" : nombre,
                        "direccion" : direccion,
                };
                $.ajax({
                  type: "POST",
                  url: "{{ url('/ficharRestaurante')}}",
                  data: parametros,
                  beforeSend: function () {
                                $("#resultados_ajax").html("Procesando, espere por favor...");
                        },
                        success:  function (response) {

                                $("#resultados_ajax").html(response);
                                $("#"+placeid).addClass('btn btn-success').text('RESTAURANTE FICHADO)');
                                $("#"+placeid).prop("onclick", false);

                        }
                });
        }
</script>


@endsection
