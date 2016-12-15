@extends('layouts.perfil')

@section('perfil')

        <h3>@lang('profile.title_favorites')</h3>
    </div>


    @if (Auth::guest())

    @else
                      @if(!$favoritos->count() > 0)
                          No tienes favoritos
                      @else

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                          @foreach($favoritos as $favorito)
                          <div class="row">
                              <div class="producto col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                  <a class="trigger-overlay" data-placeid="{{ $favorito->id_restaurante }}" href="#" onclick="realizaProceso($(this).attr('data-placeid'));return false;">
                                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                          <img class="icono_producto" src="{{ asset('assets/imagenes/' . $favorito->icono) }}">
                                      </div>
                                      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                          <p class="producto_nombre">{{ $favorito->nombre }}</p>
                                           <p class="local_nombre">{{ $favorito->nombre_restaurante }}</p>
                                      </div>
                                  </a>
                                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                      <p class="producto_precio">{{ $favorito->precio }} €</p>
                                      @if($favorito->favorito==1)
                                          <i data-placeid="{{ $favorito->id_restaurante }}" data-idplato="{{ $favorito->id_plato }}" class="p_favorito ion-android-star-outline p_votado"></i>
                                      @else
                                          <i data-placeid="{{ $favorito->id_restaurante }}" data-idplato="{{ $favorito->id_plato }}" class="p_favorito ion-android-star-outline "></i>
                                      @endif
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
                      //funcion para sacar un restarante
                      //funcion para sacar un restarante
                          function realizaProceso(placeid){
                                  var parametros = {
                                          "placeid" : placeid
                                  };

                                  $.ajax({
                                     type:'POST',
                                     url:"{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/getrestaurante' }}",
                                     data: {'_token': '<?php echo csrf_token() ?>', 'placeid': placeid },
                                     success:function(data){
                                       (function() {
                                          $( ".trigger-overlay" ).click(function() {
                                              $(".overlay").toggleClass( "open" );
                                          });
                                           $( ".overlay-close" ).click(function() {
                                              $(".overlay").removeClass( "open" );
                                          });
                                         console.log(data.html);
                                        $("#modal_content").html(data.html);

                                         })();
                                     }
                                  });
                          }
                    </script>

                      @endif

    @endif

@endsection
