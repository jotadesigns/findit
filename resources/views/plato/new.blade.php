@extends('layouts.perfil')
@section('perfil')

                      <h3>@lang('profile.title_restaurants')</h3>
                  </div>
              </div>
@if ( !$restaurante->count() )
  No tienes restaurantes asociados
@else

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">


@foreach ($restaurante as $datos)
<div class="panel-heading"><h2>Añadir platos para {{ $datos->nombre_restaurante }}</h2></div>

@endforeach
      </div>
<form action="{{ url('/añadirMasPlatosRestaurante')}}" method="POST">
  <div class="panel panel-default">
    <div class="panel-heading"><h5>Categorias para los platos</h5></div>
    <input type="text" class="form-control" id="categorias_plato" placeholder="ej: ENTRANTES Y PRIMER PLATO;BEBIDAS;POSTRES" name="categorias_plato" required>
    <a onclick="añadirCategorias()" id="enviarCategoria" class="btn btn-primary" >Añadir Categoria</a>


  <div  id='tabla_categorias' class='col-xs-12 col-sm-12 col-md-12 col-lg-12  tablaCategorias'></div>

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="datos[id_restaurante]" value="{{ $datos->id_restaurante }}">
  <input type="hidden" name="datos[id_menu]" value="{{ $datos->id_menu }}">
    <input type="submit" value="ENVIA TUS DATOS"  class="btn btn-primary">
    </div>
  </form>
</div></div>












@endif
  @endsection



  <script>

  var txt2 = "";
  var  categorias = ['postres','pescado','comida rapida','carne','copas','pasta','arroz','pizza','otro','verdura','tapa','ensalada','entrantes'];
        for(var f=0;f<categorias.length;f++){
          var ruta = '{!! asset("assets/imagenes/icono'+(f+1)+'.png") !!}';
  txt2+= "<option data-img-src="+ruta+" value='icono"+(f+1)+".png'>"+categorias[f]+"</option>";
  }
  txt2 += "</select></div>";

  function  añadirCategorias(){
    categorias = $( "#categorias_plato" ).val().split(";");
              for (var i=0; i<categorias.length; i++) {
                $("#tabla_categorias").append("<div class='panel-heading'><h2 id='nombreCategoria' style='margin-top:15px;'>Categoria "+categorias[i]+"</h5></div><a onclick=añadirPlatos('"+categorias[i]+"')  class='btn btn-primary' >+ plato</a><div  id='tabla_productos"+categorias[i]+"' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'></div>");
              };
  $("#categorias_plato").prop('disabled', true);
  $("#enviarCategoria").prop("onclick", false);


  }
  var count = 1;

  function  añadirPlatos(param){
  $("#tabla_productos"+param+"").append("<h6>Plato "+count+"</h6><label>Nombre plato</label><input type='text' name='"+count+"[nombre]' class='form-control' required><label>Precio plato</label><input type='text' name='"+count+"[precio]' class='form-control' required><label>Categoria Plato</label><input type='text' name='"+count+"[categoria_plato]' value="+param+"  class='form-control' readonly><label>Icono del plato</label><select name='"+count+"[imagen]'>"+txt2 );
  count++;
  }

      </script>
