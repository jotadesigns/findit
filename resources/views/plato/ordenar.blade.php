@extends('dummy')

@section('content')


                        @if ( count($restaurantes_cercanos) < 1 )
                           <p class="search-noresult">@lang('search.no-results')</p>
                        @else

                        @foreach( $restaurantes_cercanos as $plato )


                        <div class="row">

                                @if($plato["destacado"]==1)
                                <div class="producto p_destacado col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                @else
                                <div class="producto col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                @endif
                                    <a class="trigger-overlay" data-placeid="{{{ $plato['id_restaurante'] }}}" href="#">
                                    <div  class="col-xs-12 col-sm-10 col-md-10 col-lg-10">

                                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                                <img class="icono_producto" src="{{{ asset('assets/imagenes/' . $plato['icono']) }}}">
                                                <p class="producto_nombre">{{{ $plato['nombre'] }}}</p>
                                                <p class="local_nombre">{{{ $plato['nombre_restaurante'] }}}</p>

                                            </div>
                                            <div class="search-extra-data col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                                @if (!Auth::guest())
                                                <div class="product-star col-xs-2 col-sm-4 col-md-4 col-lg-4">
                                                    <div class="product-separator"></div>
                                                    @if($plato["favorito"]==0)
                                                        <i data-placeid="{{{ $plato['id_restaurante'] }}}" data-idplato="{{{ $plato['id_plato'] }}}" class="p_favorito ion-android-star-outline"></i>
                                                    @else
                                                        <i data-placeid="{{{ $plato['id_restaurante'] }}}" data-idplato="{{{ $plato['id_plato'] }}}" class="p_favorito ion-android-star-outline p_votado"></i>
                                                    @endif
                                                </div>
                                                @endif


                                                @if (!Auth::guest())
                                                    <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4">
                                                @else
                                                    <div class="col-xs-7 col-sm-4 col-md-4 col-lg-4 col-xs-offset-0 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
                                                @endif
                                                    <div class="product-separator"></div>
                                                        <div class="producto_distancia_padding">
                                                            <p class="producto_distancia"><i class="ion-android-time"></i>{{{  $plato['tiempoReal'] }}}</p>
                                                            <p class="producto_distancia"><i class="ion-model-s"></i>{{{ $plato['distanciaReal'] }}}</p>
                                                        </div>
                                                </div>
                                                <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4">
                                                    <div class="product-separator"></div>
                                                    <p class="producto_precio">{{{ $plato['precio'] }}} €</p>
                                                </div>
                                            </div>

                                    </div>
                                    </a>
                                    <div  class="search-button-gps col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                        <a href="{{{ $plato['urlNavigate'] }}}" target="_blank" >@lang('search.navigate')</a>
                                    </div>

                                </div>

                        </div>


                        @endforeach

                        @endif
