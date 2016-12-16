@extends('layouts.perfil')

@section('perfil')

        <h3>@lang('profile.title_favorites')</h3>
    </div>


    @if (Auth::guest())

    @else
                      @if(!$favoritos->count() > 0)
                          <p class="warning-empty">No tienes favoritos</p>
                      @else

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                          @foreach($favoritos as $favorito)

                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
                                  <div class="producto producto-padding">
                                      <div class="no-padding col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                      <a class="trigger-overlay" data-placeid="{{ $favorito->id_restaurante }}" href="#">
                                          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                              <img class="icono_producto" src="{{ asset('assets/imagenes/' . $favorito->icono) }}">
                                          </div>
                                          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                              <p class="producto_nombre">{{ $favorito->nombre }}</p>
                                               <p class="local_nombre">{{ $favorito->nombre_restaurante }}</p>
                                          </div>
                                      </a>
                                      </div>
                                      <div class="no-padding col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                          <div class="no-padding col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                              <p class="producto_precio center">{{ $favorito->precio }} €</p>
                                          </div>

                                          <div class="no-padding product-starfav  col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                              <div class="product-separator"></div>
                                              @if($favorito->favorito==1)
                                                  <i data-placeid="{{ $favorito->id_restaurante }}" data-idplato="{{ $favorito->id_plato }}" class="p_favorito ion-android-star-outline p_votado"></i>
                                              @else
                                                  <i data-placeid="{{ $favorito->id_restaurante }}" data-idplato="{{ $favorito->id_plato }}" class="p_favorito ion-android-star-outline "></i>
                                              @endif
                                          </div>
                                      </div>

                                  </div>
                              </div>

                          @endforeach
                          </div>

                          <div class="overlay overlay-slidedown">
                    <button type="button" class="overlay-close">Close</button>
                                  <div id="modal_content"></div>
                </div>


  <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
                <script>
                      //votacion de favorito
                      $( ".p_favorito" ).click(function() {
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
                                   $( element ).toggleClass( "p_votado" );
                              }
                          });
                      });
                      //bindeamos la modal a el evento click
                      $( document ).on( "click", ".trigger-overlay", function() {
                          $(".overlay").toggleClass( "open" );
                      });
                      $( document ).on( "click", ".overlay-close", function() {
                          $(".overlay").removeClass( "open" );
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

                      @endif

    @endif

@endsection
