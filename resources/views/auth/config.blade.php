@extends('layouts.perfil')

@section('perfil')
<meta name="csrf-token" content="{{ csrf_token() }}">

                      <h3>@lang('profile.title_settings')</h3>
                  </div>
    


                              <form id="send_conf"  class="" method="post">

                                  <div class="perfil_config perfil_light col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                      <div class="perfil_config_title">
                                          <h4 >@lang('profile.conf_title_nav')</h4>
                                          <h5 >@lang('profile.conf_desc_nav')</h5>
                                      </div>
                                      <select name='conf_modonav' id="modo_navegacion_escogida" class="image-picker show-html">
                                        <option value=""></option>
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


                                      </select>
                                  </div>

                                   <!-- FACEBOOK CONFIG -->
                                  @if(!empty(Session::get('userExtra')))

                                   <div class="perfil_config perfil_light col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                       <div class="perfil_config_title">
                                           <h4>@lang('profile.conf_title_featured')</h4>
                                       </div>
                                       <!-- Rounded switch -->
                                        <div id="perfil_config_switch">
                                            <label class="switch">
                                            <input type="hidden" name="conf_destacados" value="0"/>
                                              @if(Auth::user()->conf_destacados==true)
                                                  <input value="1" name='conf_destacados' class="iswitch" checked type="checkbox">
                                              @else
                                                  <input value="1" name='conf_destacados' class="iswitch" type="checkbox">
                                              @endif

                                              <div class="islider round"></div>
                                            </label>
                                        </div>
                                        <div class="perfil_config_title_center">
                                            <h5>@lang('profile.conf_desc_featured')</h5>
                                        </div>
                                   </div>
                                   @endif
                                  @if(!empty(Session::get('userExtra')))
                                      <div id="perfil_guardar" class="perfil_config perfil_config_border-left col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                  @else
                                    <div id="perfil_guardar" class="perfil_config col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  @endif
                                      <input class="btn btn-success" type="submit" value="@lang('profile.conf_save_text')" />
                                  </div>

                              </form>




                <div id="perfil_info"></div>



                <script>
                 //cuando cargue el DOM
                 $(function() {
                     $( "#tabs" ).tabs();
                     //activamos el select para seleccionar el modo de navegacion
                     $("#modo_navegacion_escogida").imagepicker();

                 });

                 $('#send_conf').on('submit',function(e){

                     $.ajaxSetup({
                         headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                       })

                    e.preventDefault(e);

                        $.ajax({
                        type:"POST",
                        url:"{{url('/perfil/config')}}",
                        data:$(this).serialize(),
                        success: function(data){
                            $("#perfil_info").html("<div class='alert alert-success' role='alert'><i class='ion-checkmark'></i>{{trans('profile.save_success', ['name' => Auth::user()->name])}}</div>");
                            $("#perfil_info").slideDown().delay(3000).fadeOut();
                        },
                        error: function(data){

                        }
                    })
                });

                 </script>

@endsection
