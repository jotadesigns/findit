@extends('layouts.app')

@section('content')

        <div id="cabecera_filtros" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="container">
                <div class="row">
                    <form action="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/buscar' }}" method="POST">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <i class="search-icon-2nav ion-android-search"></i>
                         <input id="buscador_producto" type="text" class="form-control" required name="buscador" placeholder="@lang('search.nav-search')"/>
                        </div>
                        <div class="slider-no-padding col-xs-4 col-sm-4 col-md-4 col-lg-4">
                             <div class="nav2-slider-global-slider col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <div class="range-slider" id="range-slider-1">
                                    <span></span>
                                </div>
                                 <p id="slider_draggable"></p>
                             </div>
                             <div class="nav2-slider-global-distance col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                 <h3 id="kilometros2"></h3>
                                 <p>
                                     @lang('search.nav-distance')
                                 </p>
                             </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                             <input id="boton_buscar_producto" type="submit" class="boton_full btn btn-primary" value="@lang('search.nav-search-text')"/>
                             <input type="hidden" id="distancia" name="distancia"/>
                             <input type="hidden" name="direccion_gps_lng" value="{{ $platos_extra["lng"] }}">
                             <input type="hidden" name="direccion_gps_lat" value="{{ $platos_extra["lat"] }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <main>
            <div class="container">
                <div id="resultados" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="perfil_bread">

                            <h2 class="profile_title">@lang('search.results') {{ $platos_extra["busqueda"] }}</h2>
                            <h3>{{ count(Session::get('restaurantes_cercanos')) }} @lang('search.results-count')</h3>
                    </div>


                    <div class="row filters-ordenacion">
                        <div  class="col-xs-12 col-sm-8 col-md-8 col-lg-8"><p id="open-filters">@lang('search.filters-title-close')</p></div>
                        <div  class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <select id="ordenacion" class="form-control">
                                <option value="DISTANCIA_ASC">@lang('search.select-distance-down')</option>
                                <option value="DISTANCIA_DESC">@lang('search.select-distance-up')</option>
                                <option value="PRECIO_ASC">@lang('search.select-price-down')</option>
                                <option value="PRECIO_DESC">@lang('search.select-price-up')</option>
                                <option value="NOMBRE_ASC">@lang('search.select-name-down')</option>
                                <option value="NOMBRE_DESC">@lang('search.select-name-up')</option>
                            </select>

                        </div>
                    </div>
                    <div class=" row">

                        <div id="more_filters" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div id="modo_navegacion">
                                <select name='modo_navegacion_escogida' id="modo_navegacion_escogida" class="image-picker show-html">
                                  <option value=""></option>
                                  @if(!Auth::guest())
                                      @if(Auth::user()->conf_modonav==="walking")
                                          <option selected data-img-src="{{asset('assets/imagenes/design/andando.png')}}" value="walking">andando</option>
                                      @else
                                          <option data-img-src="{{asset('assets/imagenes/design/andando.png')}}" value="walking">andando</option>
                                      @endif

                                      @if(Auth::user()->conf_modonav==="bicycling")
                                          <option selected data-img-src="{{asset('assets/imagenes/design/bici.png')}}" value="bicycling">bicicleta</option>
                                      @else
                                          <option data-img-src="{{asset('assets/imagenes/design/bici.png')}}" value="bicycling">bicicleta</option>
                                      @endif

                                      @if(Auth::user()->conf_modonav==="driving")
                                          <option selected data-img-src="{{asset('assets/imagenes/design/coche.png')}}" value="driving">coche</option>
                                      @else
                                          <option data-img-src="{{asset('assets/imagenes/design/coche.png')}}" value="driving">coche</option>
                                      @endif
                                  @else
                                    <option selected data-img-src="http://image.flaticon.com/icons/png/128/76/76865.png" value="walking">andando</option>
                                    <option data-img-src="http://image.flaticon.com/icons/png/128/31/31307.png" value="driving">coche</option>
                                    <option data-img-src="http://gcba.github.io/iconos/Iconografia_PNG/bici.png" value="bicycling">bicicleta</option>
                                  @endif
                                </select>
                            </div>

                            <div id="filtros" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <form id="formularioFiltros">
                                    <div class="filter-form-food col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <h6>@lang('search.filters-food')</h6>
                                        <ul>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="estrella" class="filtros checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-food-star')</p>
                                            </div></li>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="favorito" class="filtros checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-food-favorites')</p>
                                            </div></li>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="destacado" class="filtros checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-food-destacado')</p>
                                            </div></li>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="" class="checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">Lorem Ipsum</p>
                                            </div></li>

                                        </ul>
                                    </div>
                                    <div class="filter-form-food col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <h6>@lang('search.filters-food-type')</h6>
                                        <ul>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="" class="checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">Lorem Ipsum</p>
                                            </div></li><li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="" class="checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">Lorem Ipsum</p>
                                            </div></li><li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="" class="checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">Lorem Ipsum</p>
                                            </div></li><li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="" class="checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">Lorem Ipsum</p>
                                            </div></li>
                                        </ul>
                                    </div>
                                    <div class="filter-form-food col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <h6>@lang('search.filters-restaurant')</h6>
                                        <ul>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="domicilio" class="checkbox_animado filtros"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-restaurant-house')</p>
                                            </div></li>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="terraza" class="filtros checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-restaurant-terraza')</p>
                                            </div></li>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="eventos_deportivos" class="filtros checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-restaurant-sports')</p>
                                            </div></li>
                                            <li><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <label><input type="checkbox"  name="parking" class="filtros checkbox_animado"/>
                                                    <span class="label-text"></span></label>
                                                </div>
                                                <div style="padding-left:0;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <p class="filter-text">@lang('search.filters-restaurant-parking')</p>
                                            </div></li>
                                        </ul>
                                    </div>



                                </form>

                            </div>
                        </div>
                    </div>
                <div id="full-resultados">
                    <div id="loadingDiv">
                        <div id="modal-ajax">
                            <img id="loader" src="{{asset('assets/imagenes/design/ring.gif')}}" />
                        </div>
                    </div>
                    <div id="resultados_busqueda">




                        @if ( !$restaurantes_cercanos->count() )
                          <p class="search-noresult">@lang('search.no-results')<p>
                        @else

                        @foreach( $restaurantes_cercanos as $plato )

                                <div class="row">

                                        @if($plato->destacado==1)
                                        <div class="producto p_destacado col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                        @else
                                        <div class="producto col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                        @endif
                                            <a class="trigger-overlay" data-placeid="{{ $plato->id_restaurante }}" href="#" >
                                            <div  class="col-xs-12 col-sm-10 col-md-10 col-lg-10">

                                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                                        <img class="icono_producto" src="{{ asset('assets/imagenes/' . $plato->icono) }}">
                                                        <p class="producto_nombre">{{ $plato->nombre }}</p>
                                                        <p class="local_nombre">{{ $plato->nombre_restaurante }}</p>

                                                    </div>
                                                    <div class="search-extra-data col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                                        @if (!Auth::guest())
                                                        <div class="product-star col-xs-2 col-sm-4 col-md-4 col-lg-4">
                                                            <div class="product-separator"></div>
                                                            @if($plato->favorito==0)
                                                                <i data-placeid="{{ $plato->id_restaurante }}" data-idplato="{{ $plato->id_plato }}" class="p_favorito ion-android-star-outline"></i>
                                                            @else
                                                                <i data-placeid="{{ $plato->id_restaurante }}" data-idplato="{{ $plato->id_plato }}" class="p_favorito ion-android-star-outline p_votado"></i>
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
                                                                    <p class="producto_distancia"><i class="ion-android-time"></i>{{  $plato->tiempoReal }}</p>
                                                                    <p class="producto_distancia"><i class="ion-model-s"></i>{{ $plato->distanciaReal }}</p>
                                                                    </div>
                                                        </div>
                                                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4">
                                                            <div class="product-separator"></div>
                                                            <p class="producto_precio">{{ $plato->precio }} €</p>
                                                        </div>
                                                    </div>

                                            </div>
                                            </a>
                                            <div  class="search-button-gps col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                <a href="{{$plato->urlNavigate}}" target="_blank" >@lang('search.navigate')</a>
                                            </div>

                                        </div>

                                </div>


                            @endforeach

                            @endif

                </div>


            </div>
        </div>
            <div class="overlay overlay-slidedown">
                <button type="button" class="overlay-close">Close</button>
                            <div id="modal_content"></div>
            </div>
        </main>
        <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
         <script>
         // creating `min` and `max` value in range slider
            var min = 1, max = 20,
                p = document.getElementById('slider_draggable');
                input = document.getElementById('distancia');

            function pixelToPercent(pixel) {
                return ((pixel - min) / (max - min)) * 100;
            }
            function percentToPixel(percent) {
                return ((percent / 100) * (max - min)) + min;
            }
           RS(p, {
                value: pixelToPercent(10),
                drag: function(value) {
                    input.value = Math.round(percentToPixel(value));
                    $("#kilometros2").text(Math.round(percentToPixel(value)) + 'Km');
                }
            });
        </script>

        <script>

        var NUMERORESULTADOS = {{env('LIMIT')}},
        offset = NUMERORESULTADOS;
        var busy = false;
        //cuando cargue el DOM
        $(function() {

            //activamos el select para seleccionar el modo de navegacion
            $("#modo_navegacion select").imagepicker();
            $("#open-filters").click(function(){
                $("#more_filters").toggle();
            });
            //funcion para la carga de ajax
            var $loading = $('#loadingDiv').hide();
            $(document)
              .ajaxStart(function () {
                $loading.show();
              })
              .ajaxStop(function () {
                $loading.hide();
             });
                //bindeamos la modal a el evento click
                $( document ).on( "click", ".trigger-overlay", function() {
                    $(".overlay").toggleClass( "open" );
                });
                $( document ).on( "click", ".overlay-close", function() {
                    $(".overlay").removeClass( "open" );
                });

             //cuando hace scroll pedimos más resultados
             $(window).scroll(function() {
                  if ((($(window).scrollTop() + $(window).height()) > ($("#resultados_busqueda").height()+700)) && !busy) {
                      busy=true;
                    displayProducts(offset);
                  }
            });

        });

    //funcion para paginacion de resultados
    function displayProducts(off) {
        var parametros = {
                    "_token": "<?php echo csrf_token() ?>",
                    "offset": off,
            };
            $.ajax({
              type: "POST",
              async: false,
              url: "{{url('/moreproducts')}}",
              data: parametros,
              cache: false,

              success: function(data) {
                  console.log(busy);
                if(data.success){
                    $("#resultados_busqueda").append(data.html);
                    offset += NUMERORESULTADOS;
                }

              }
            });
            busy = false;
    }




        //funcion para votar un producto
        $( document ).on( "click", ".p_favorito", function() {
            var parametros = {
                        "_token": "<?php echo csrf_token() ?>",
                        "id_plato": $(this).attr('data-idplato'),
                        "id_restaurante": $(this).attr('data-placeid'),
                };
                var element = this;
            $.ajax({
                type: "POST",
                url: "{{url('accion/votar')}}",
                data: parametros,

                success: function(data){
                    console.log('votado');
                     $( element ).toggleClass( "p_votado" );
                }
            });
        });


        //funcion para filtrar resultados
        $( ".filtros" ).change(function() {
            var parametros = {
                        "_token": "<?php echo csrf_token() ?>",
                        "formFiltros": $("#formularioFiltros").serialize(),

                };
                var element = this;
            $.ajax({
                type: "POST",
                url: "{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/filtrarProductos' }}",
                data: parametros,

                success: function(data){
                    offset = NUMERORESULTADOS;
                     $("#resultados_busqueda").html(data.html);
                }
            });
        });

        //si cambia la navegacion
        $( "#modo_navegacion select" ).change(function() {
            var parametros = {
                        "_token": "<?php echo csrf_token() ?>",
                        "modo_navegacion": $(this).val(),
                        "lat": {{ $platos_extra["lat"] }},
                        "lng": {{ $platos_extra["lng"] }},
                };
            $.ajax({
                type: "POST",
                url: "{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/ordenarproductos' }}",
                data: parametros,

                success: function(data){
                      offset = NUMERORESULTADOS;
                      console.log(data.html);
                     $("#resultados_busqueda").html(data.html);
                }
            });
        });

        //funcion para ordenar resultados
        $( "#ordenacion" ).change(function() {
            var parametros = {
                        "_token": "<?php echo csrf_token() ?>",
                        "tipo_ordenacion": $(this).val()
                };
            $.ajax({
                type: "POST",
                url: "{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/ordenarproductos' }}",
                data: parametros,

                success: function(data){
                    offset = NUMERORESULTADOS;
                     $("#resultados_busqueda").html(data.html);
                }
            });
        });

        //funcion para sacar un restarante
                $( document ).on( "click", ".trigger-overlay", function() {
                    var parametros = {
                                "_token": "<?php echo csrf_token() ?>",
                                "placeid": $(this).attr('data-placeid'),
                        };
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/getrestaurante' }}",
                        data: parametros,

                        success: function(data){
                            console.log(data.html);
                             $("#modal_content").html(data.html);
                        }
                    });
                });
</script>



@endsection
