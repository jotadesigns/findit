@extends('dummy')
@section('content')
@if ( !$restaurante->count() )
No tenemos más información de ese restaurante
@else
<div id="restaurante" class="row">

           <div class="row">

               <div id="imagen_restaurante" style="background-image: url('{{ $datos_imagen }}');" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                   <h2 id="titular_restaurante">{{ $restaurante[0]->nombre_restaurante }}</h2>

               </div>

           </div>





           <div class="row">

               <div id="datos_restaurante" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                   <div class="container">

                       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                           <h6 id="nombre_restaurante">{{ $restaurante[0]->nombre_restaurante }}</h6>

                           <p id="direccion_restaurante">{{ $datos_restaurante["result"]["vicinity"] }}</p>

                       </div>

                       <div style="text-align:right;" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                           <p id="distancia_restaurante">1,8km distancia</p>

                           <p id="preciomedio_restaurante">13,7€ precio estimado</p>

                       </div>

                      @if(isset($datos_restaurante["result"]["rating"]))
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <p id="puntuacion_restaurante">{{ $datos_restaurante["result"]["rating"] }}<span style="font-size:18px;">/5</span></p>
                       </div>
                       @endif

                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

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

                                            <i class="iconollamar_restaurante ion-ios-telephone"></i>

                                            <p class="descmenu_restaurante">llamar</p>

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

           </div>



           <div class="container">

               <div class="row">

                   <div id="menu_restaurante" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                       <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

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

                                        <div class="platoleft_restaurante col-xs-9 col-sm-9 col-md-9 col-lg-9">

                                            {{ $restaurante[$i]->nombre }}

                                        </div>

                                        <div class="platoright_restaurante col-xs-3 col-sm-3 col-md-3 col-lg-3">

                                            {{ $restaurante[$i]->precio }} €

                                        </div>

                                    </div>

                          @endfor

                          @endif

                       </div>

                   </div>

               </div>
               <a href="{{url('/empresas/'.$datos_restaurante['result']['place_id'])}}">Controla el  restaurante</a>

            </div>













   </div>


@endif
@endsection