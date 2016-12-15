@extends('dummy')
@section('content')
@if ( !$restaurante->count() )
No tenemos más información de ese restaurante
@else
<div id="restaurante">

               <div id="imagen_restaurante" style="background-image: url('{{ $datos_imagen }}');" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <h2 id="titular_restaurante">{{ $restaurante[0]->nombre_restaurante }}</h2>
               </div>


               <div id="datos_restaurante" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                   <div class="container">

                       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                           <h6 id="nombre_restaurante">{{ $restaurante[0]->nombre_restaurante }}</h6>

                           <p id="direccion_restaurante">{{ $datos_restaurante["result"]["vicinity"] }}</p>

                       </div>

                       <div style="text-align:right;" class="datos_restaurante_extra col-xs-12 col-sm-6 col-md-6 col-lg-6">

                           <p id="distancia_restaurante">1,8km distancia</p>

                           <p id="preciomedio_restaurante">13,7€ precio estimado</p>

                       </div>

                      @if(isset($datos_restaurante["result"]["rating"]))
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <p id="puntuacion_restaurante">{{ $datos_restaurante["result"]["rating"] }}<span style="font-size:18px;">/5</span></p>
                       </div>
                       @endif

                       <div class="menunav_restaurante_no-padding col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

                                <ul id="menunav_restaurante">

                                    <div class="cuadromenu_restaurante col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                        <li>

                                            @if(isset($datos_restaurante["result"]["opening_hours"]["open_now"]))

                                            @if($datos_restaurante["result"]["opening_hours"]["open_now"]===true)
                                            <i class="iconoestado_restaurante ion-ionic"></i>
                                            <p class="descmenu_restaurante">abierto</p>
                                            @else
                                             <i class="iconoestado_restaurante_cerrado ion-ionic"></i>
                                            <p class="descmenu_restaurante">cerrado</p>
                                            @endif

                                            @else
                                            <i class="iconoestado_restaurante_desconocido ion-ionic"></i>
                                            <p class="descmenu_restaurante">desconocido</p>
                                            @endif

                                        </li>

                                    </div>

                                    <div class="cuadromenu_restaurante col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                        <li>
                                            <a href="tel:{{$datos_restaurante['result']['international_phone_number']}}" class="descmenu_restaurante">
                                            <i class="iconollamar_restaurante ion-ios-telephone"></i>

                                            llamar</a>

                                        </li>

                                    </div>

                                    <div class="cuadromenu_restaurante col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                         <li>

                                             <i class="icononavegacion_restaurante ion-ios-navigate-outline"></i>

                                             <p class="descmenu_restaurante">llévame</p>

                                         </li>

                                    </div>

                                </ul>

                           </div>

                       </div>

                   </div>



               </div>





           <div class="container">


                   <div id="menu_restaurante" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="menu_restaurante-nopadding col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                           <p id="letreromenu_restaurante">menú</p>
                           @if($restaurante->count() > 0)
                           @for($i=0;$i<$restaurante->count();$i++)
                                    @if($i!==0)
                                        @if($restaurante[$i-1]->categoria_plato!==$restaurante[$i]->categoria_plato)
                                        <div class="categoria_plato">
                                            <p class="nombre_categoria"> {{ $restaurante[$i]->categoria_plato }}</p>
                                        </div>
                                        @endif
                                    @else
                                        <div class="categoria_plato">
                                            <p class="nombre_categoria"> {{ $restaurante[$i]->categoria_plato }}</p>
                                        </div>
                                    @endif
                                    <div class="plato_restaurante">
                                        <div class="platoleft_restaurante col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                            {{ $restaurante[$i]->nombre }}
                                        </div>
                                        <div class="platoright_restaurante col-xs-4 col-sm-3 col-md-3 col-lg-3">
                                            {{ $restaurante[$i]->precio }} €
                                        </div>
                                    </div>
                          @endfor
                          @endif
                       </div>
                   </div>

                   <section id="restaurant_extrainfo" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div id="restaurant_extrainfo-content">
                            <p class="restaurant_extrainfo-opener"><span>Ver información práctica</span> <i class="ion-chevron-down"></i></p>
                            <div class="restaurant_extrainfo-closed">
                                @if(isset($datos_restaurante["result"]["website"]))
                                  <article class="restaurant_extrainfo-website">
                                      <p class="restaurant_extrainfo-title">Website</p>
                                      <a style="display:block;" class="restaurant_extrainfo-desc"  href="{{$datos_restaurante['result']['website' ]}}">{{$datos_restaurante['result']['website' ]}}</a>
                                  </article>
                                @endif
                                @if(isset($datos_restaurante["result"]["opening_hours"]["weekday_text"]))
                                  <article class="restaurant_extrainfo-time">
                                      <p class="restaurant_extrainfo-title">Horarios de apertura</p>
                                      <p class="restaurant_extrainfo-desc">

                                      </p>
                                      <p class="restaurant_extrainfo-desc" >De martes a sábado: comidas 13:30 a 18:00 y cenas de 21:00h a 01:00h</p>
                                      <p class="restaurant_extrainfo-desc" >Domingos y lunes cerrados</p>
                                  </article>
                                @endif
                                @if(isset($datos_restaurante["result"]["price_level"]))
                                <article class="restaurant_extrainfo-rangeprice">
                                    <p class="restaurant_extrainfo-title">Nivel de precios</p>
                                    <p class="restaurant_extrainfo-desc" >{{$datos_restaurante["result"]["price_level"]}}</p>
                                </article>
                                @endif
                                @if(isset($restaurante[0]->servicios))
                                <article class="restaurant_extrainfo-services">
                                    <p class="restaurant_extrainfo-title">Servicios</p>
                                    <p class="restaurant_extrainfo-desc" >
                                      @foreach($restaurante[0]->servicios as $servicio)
                                        {{$servicio}},
                                      @endforeach
                                    </p>
                                </article>
                                @endif
                                <article class="restaurant_extrainfo-cocina">
                                    <p class="restaurant_extrainfo-title">Tipo de cocina</p>
                                    <p class="restaurant_extrainfo-desc" >{{$restaurante[0]->Nombre}}</p>
                                </article>
                                <article class="restaurant_extrainfo-populares">
                                    <p class="restaurant_extrainfo-title">Platos más populares</p>
                                    <p class="restaurant_extrainfo-desc" >Prueba Bufalo 7, Prueba Bufalo 5, Prueba Bufalo 5</p>
                                </article>

                            </div>
                        </div>

                   </section>



                   <section id="restaurant_comments_global" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @if(!isset($datos_restaurante["result"]["reviews"]))
                            <p>No existen comentarios</p>
                        @else
                            <h6>Opiniones</h6>
                            <div id="restaurant_comments">
                                @foreach($datos_restaurante["result"]["reviews"] as $review)
                                    @if(LaravelLocalization::getCurrentLocale() == $review["language"] && isset($review["text"]))
                                        <div class="restaurant_comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="restaurant_comment_header col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                                    @if(isset($review["profile_photo_url"]))
                                                        <img width="50" height="50" class="circle" src="{{$review['profile_photo_url']}}" alt="">
                                                    @else
                                                        <img width="50" height="50" class="circle" src="http://anzpartners.com/wp-content/uploads/2015/03/no-avatar-female.png" alt="">
                                                    @endif
                                                    <p class="restaurant_comment_author">{{$review["author_name"]}}</p>
                                                </div>
                                                <div class="restaurant_comment_time-position col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                    <p class="restaurant_comment_time">{{$review["relative_time_description"]}}</p>
                                                </div>
                                                <span>
                                                    <div class="c100 p{{$review['rating']*10*2}} small">
                                                        <span>{{$review["rating"]}}</span>
                                                        <div class="slice">
                                                            <div class="bar"></div>
                                                            <div class="fill"></div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="restaurant_comment_content col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <p class="restaurant_comment_text">{{$review["text"]}}</p>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            </div>

                        @endif
                   </section>


                   @if(isset($datos_meteorologicos))
                   <section id="restaurant_weather_extrainfo" class="col-xs-12 col-sm-10 col-md-4 col-lg-4 col-xs-offset-0 col-sm-offset-1 col-md-offset-4 col-lg-offset-4">

                        <h6>Tiempo</h6>
                        <div id="restaurant_weather_container">
                            <p class="weather_display_location">{{$datos_meteorologicos['current_observation']['display_location']['city']}}</p>
                            <img src="{{$datos_meteorologicos['current_observation']['icon_url']}}" alt="">
                            <p class="weather_display_feelslike">{{$datos_meteorologicos['current_observation']['feelslike_c']}}°<span>min {{$datos_meteorologicos['current_observation']['dewpoint_c']}}°</span></p>

                       </div>

                   </section>
                   @endif

                   <div style="padding-left:35%; margin-top:15px; margin-bottom:15px;">
                     <a class="btn btn-warning" style="color:black; font-weight: bold;" href="{{url('/empresas/'.$datos_restaurante['result']['place_id'])}}">¿Quieres controlar este restaurante? FIND IT Empresas</a>
                  </div>

                <div class="restaurant-business-control col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <a href="{{url('/empresas/'.$datos_restaurante['result']['place_id'])}}">Controla el  restaurante</a>
               </div>
               
            </div>


   </div>
<script type="text/javascript">
    jQuery(document).ready(function($) {

        jQuery.fn.extend({
    toggleText: function (a, b){
        var that = this;
            if (that.text() != a && that.text() != b){
                that.text(a);
            }
            else
            if (that.text() == a){
                that.text(b);
            }
            else
            if (that.text() == b){
                that.text(a);
            }
        return this;
    }
});
        //funcion para abrir informacion práctica
        $( ".restaurant_extrainfo-opener" ).click(function() {
            $( ".restaurant_extrainfo-opener span" ).toggleText('Ocultar información práctica' , 'Ver información práctica' );
           $(".restaurant_extrainfo-closed").toggleClass( "restaurant_extrainfo-open" );
       });

    });

</script>

@endif
@endsection
