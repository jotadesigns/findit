@extends('dummy')

@section('content')

@if ( !$locales->count() )
No se han encontrado resultados
@else

    @foreach($locales as $local)
    <div class='row'>
        <div  class="local_resultado col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                    <img class="img-thumb-small" alt="{{ $local->nombre_restaurante }}" class="photo-box-img" width="80" height="80" src="{{ $local->imagen }}">
                </div>

                    <div class="local_resultado_datos col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div><h3>{{ $local->nombre_restaurante }}</h3></div>
                        <div><img width="80" class="local-puntuacion" src="{{secure_asset('/assets/imagenes/design/stars.png')}}" alt="puntuacion"></div>
                        <div class="bussiness-link">
                            <a href="{{ $local->website }}" target="_blank">
                                @if(strlen($local->website) > 30)
                                    {{ substr("$local->website", 0, 30) }} ...
                                @else
                                    {{$local->website}}
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="local_resultado_datos col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <p>{{ $local->direccion }}</p>
                        <p><i class="ion-ios-telephone"></i> {{ $local->telefono }}</p>
                    </div>
                    <div class="local_resultado_datos col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        @if(!isset($local->id_admin))
                            <a style="margin-top:20px;" class="btn btn-danger" href="{{url('/empresas/'.$local->id_restaurante)}}">Controlar este negocio</a>
                        @else
                            <a style="margin-top:20px;" class="btn btn-default" disabled>Controlado</a>
                        @endif
                    </div>



        </div>
    </div>
    @endforeach
@endif



@endsection
