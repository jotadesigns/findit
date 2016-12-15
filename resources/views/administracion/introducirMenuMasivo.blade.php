@extends('layouts.appadmin')

@section('content')

<div class="container">
  <div class="cartaMenu">

<form action="{{ url('/introducirMasivoPendienteBBDD')}}" method="POST">
@foreach( $datos_restaurante as $key => $restaurante )
<div class="datosIndividual">
<label>Nombre de restaurante</label><input type="text" name="Datos[{{ $key }}][NombreRestaurante]" value="{{ $restaurante['result']['name'] }}"  class="form-control">
<label>Tipo de restaurante</label><input type="text" name="Datos[{{ $key }}][TipoRestaurante]"  class="form-control">

<label>Entrega a domicilio</label>
 <input type="hidden" name="Datos[{{ $key }}][Domicilio]" value="0">
 <input type="checkbox" name="Datos[{{ $key }}][Domicilio]" class="form-control">



<label>Terraza</label>

    <input type="hidden" name="Datos[{{ $key }}][Terraza]" value="0">
   <input type="checkbox" name="Datos[{{ $key }}][Terraza]" class="form-control">


<label>Parking propio</label>
  <input type="hidden" name="Datos[{{ $key }}][Parking]" value="0">
  <input type="checkbox" name="Datos[{{ $key }}][Parking]" class="form-control">


<label>Retransmite eventos deportivos</label>

  <input type="hidden" name="Datos[{{ $key }}][Eventos]" value="0">
  <input type="checkbox" name="Datos[{{ $key }}][Eventos]" class="form-control">

<input type="hidden" name="Datos[{{ $key }}][id_restaurante]" value="{{ $restaurante['result']['place_id'] }}">
<input type="hidden" name="Datos[{{ $key }}][lat]" value="{{ $restaurante['result']['geometry']['location']['lat'] }} ">
<input type="hidden" name="Datos[{{ $key }}][lng]" value="{{ $restaurante['result']['geometry']['location']['lng'] }}">
</div>
@endforeach



<div class="panel panel-default">
  <div class="panel-heading"><h5>Categorias para los platos</h5></div>
  <input type="text" class="form-control" id="categorias_plato" placeholder="ej: ENTRANTES Y PRIMER PLATO;BEBIDAS;POSTRES" name="categorias_plato" required>
  <a onclick="añadirCategorias()" id="enviarCategoria" class="btn btn-primary" >Añadir Categoria</a>


<div  id='tabla_categorias' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 tablaCategorias'></div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <input type="submit" value="ENVIA TUS DATOS"  class="btn btn-primary">
</form>
</div>
</div>



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
