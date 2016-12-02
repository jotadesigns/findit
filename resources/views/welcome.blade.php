@extends('layouts.app')

@section('content')

@if(old('borrado')!==null)
    <div class="alert alert-success">
        <i class='ion-checkmark'></i>
        {{trans('profile.save_success', ['name' => Auth::user()->name])}}
    </div>
@endif

<section id="buscador_msg">
    <article class="msg_bienvenida">
      @if(!empty($tiempo))
          @if($tiempo == "dia")
              <p class="saludo">@lang('welcome.hello-day')</p>
              <h3>@lang('welcome.hello-pharagraph-day')</h3>
          @else
              <p class="saludo">@lang('welcome.hello-night')</p>
              <h3>@lang('welcome.hello-pharagraph-night')</h3>
          @endif
        @else
        <p class="saludo">@lang('welcome.hello-day')</p>
        <h3>@lang('welcome.hello-pharagraph-day')</h3>
        @endif
    </article>
</section>
</section id="buscador_main">
        <div id="main-img" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img src="{{asset('/assets/imagenes/design/icon-cocinero.png')}}"/>
        </div>
        <div id="main-form" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
             <form id="form_busqueda" action="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale()) }}/buscar" method="POST">
                 <div class="search-form search-direction">
                     <i class="ion-android-search"></i>
                     <input id="direccion" type="text"  name="direccion" placeholder="@lang('welcome.placeholder_direccion')" required/>
                 </div>
                 <div class="search-form">
                     <i class="ion-android-search"></i>
                     <input id="busqueda_alimento" type="text" name="buscador" placeholder="@lang('welcome.placeholder_buscador')" required/>
                 </div>
                 <div id="main-form-slider">
                     <div class="range-slider" id="range-slider-1">
                         <span></span>
                     </div>
                       <h3 id="kilometros"></h3><span class="span-km">
                           km
                       </span>
                       <p class="main-form-distancia">@lang('welcome.distancia')</p>
                      <p id="slider_draggable"></p>
                 </div>
                 <input type="hidden" value="" id="direccion_gps_lat" name="direccion_gps_lat" />
                 <input type="hidden" value="" id="direccion_gps_lng" name="direccion_gps_lng" />
                 <input type="hidden" id="distancia" name="distancia"/>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="submit" class="boton_full btn btn-primary" value="@lang('welcome.boton_buscar_platos')"/>

             </form>
        </div>

</section>


<div class="container">
    <div class="row" style="display:none;">
        <div id="login" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <form  style="margin-top:4px;" action="{{ url('/buscar') }}" method="POST">
                <div  class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div data-estado="off" id="gps_main" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <i class="gps ion-pinpoint"></i>
                        <p class="gps_text">
                            gps<span> off</span>
                        </p>
                    </div>
                </div>

             </form>
        </div>
    </div>
</div>


</form>

<script src="{{url('js/main.js')}}" type="text/javascript"></script>
<script>
//cuando cargue el DOM
$(function() {

});

//GPS
$( "#gps_main" ).click(function() {

    function success(position) {
    $( "#direccion_gps_lat" ).val(position.coords.latitude);
    $( "#direccion_gps_lng" ).val(position.coords.longitude);
  };

  function error() {
      $(".gps_text span").text(' off');
      $("#gps_main").attr('data-estado', 'off');
      $(".gps_text span").toggleClass( "red" );
      $("#direccion").prop('disabled', false);
      $("#direccion").fadeIn();
  };
//si lo activa
 if($(this).attr('data-estado')=="off"){
     $(".gps_text span").text(' on');
      $(".gps_text span").toggleClass( "red" );
      $("#direccion").prop('disabled', true);
      $("#direccion").fadeOut();
     $(this).attr('data-estado', 'on');
     navigator.geolocation.getCurrentPosition(success, error);

  }
//si lo desactiva
  else{
      $(".gps_text span").text(' off');
      $(this).attr('data-estado', 'off');
      $(".gps_text span").toggleClass( "red" );
      $("#direccion").prop('disabled', false);
      $("#direccion").fadeIn();
  }



});


function initMap() {

  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('direccion'));

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();

}

// creating `min` and `max` value in range slider
   var min = 0, max = 20,
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
           $("#kilometros").text(Math.round(percentToPixel(value)) );
       }
   });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKnNdNpSrpOmbBRMUZ9p75Mfj6Dg86MMw&signed_in=true&libraries=places&callback=initMap"
        async defer></script>

@endsection
