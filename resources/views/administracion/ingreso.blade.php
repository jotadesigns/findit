@extends('layouts.appadmin')

@section('content')

<div class="container">
    <div id="contenedor_insercción" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="perfil_bread" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h2 class="profile_title">Busqueda</h2>
      <h3 id="perfil_titulo">Administracion</h3>
      </div>




  <div class="panel panel-primary">
    <div class="panel-heading formBuscarAdmin ">  <h2>Busqueda por direccion</h2></div>

  <div class="panel-body formSubBuscarAdmin">
        <form id="form_busqueda" action="{{ url('/buscarRestaurantesAdmin') }}" method="POST">

          <div class="search-form search-direction">
              <i class="ion-android-search"></i>
              <input id="direccion" type="text"  name="busqueda" placeholder="@lang('welcome.placeholder_direccion')" required/>
          </div>

            <h4 style="margin-top:30px;font-weight:bold;margin-left:23px;">Radio en metros </h4>
            <div class="search-form search-direction">
              <input type="number" value="1000" name="radio"  required/>
                </div>
            <input class="boton_full btn btn-primary" type="submit" name="enviarbusqueda" value="Buscar"/>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
</div>
      </div>
    <div class="panel panel-primary">
            <div class="panel-heading formBuscarAdmin ">  <h2>Busqueda masiva por establecimiento</h2></div>
<div class="panel-body formSubBuscarAdmin">
        <form id="form_busqueda" action="{{ url('/buscarRestaurantesMasivo') }}" method="POST">

          <div class="search-form search-direction">
              <i class="ion-android-search"></i>
              <input id="direccion" type="text"  name="busqueda" placeholder="@lang('welcome.placeholder_direccion')" required/>
          </div>
            <input class="boton_full btn btn-primary" type="submit" name="enviarbusqueda" value="Buscar"/>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>


    </div>
 </div>
  </div>
   </div>
   <div style="width:100%; height:120px;">
   </div>
   </div>



@endsection
