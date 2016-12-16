@extends('layouts.appadmin')

@section('content')


<div class="container">
  <div class="cartaMenu">
<<<<<<< Updated upstream
<form action="{{ url('/introducirPendienteBBDD')}}" method="POST">

<label>Nombre de restaurante</label><input type="text" name="Datos[NombreRestaurante]" value="{{ $datos_restaurante['result']['name'] }}"  class="form-control">
<label>Tipo de restaurante</label><input type="text" name="Datos[TipoRestaurante]"  class="form-control">

=======
<form action="{{ url('/introducirPendienteBBDD')}}" method="POST" onsubmit="return validacion()">

  <div class="Terminosfusionfinal col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h2 class="restaurant_settings-title">{{ $datos_restaurante['result']['name'] }}</h2><input type="text" id="formNombreRestaurante" name="Datos[NombreRestaurante]" value="{{ $datos_restaurante['result']['name'] }}"  class="form-control"/>

  </div>

<label class="labelAdm"></label>
<p class="restaurant_settings-subtitle">Datos del restaurante</p>
<label class="labelAdm">Tipo de restaurante</label>
<select name="Datos[TipoRestaurante]" class="form-control">
@foreach( $tipos as $tipo )

      <option value="{{ $tipo->id_tipo }}">{{ $tipo->Nombre }}</option>

@endforeach
</select>

>>>>>>> Stashed changes
<label>Entrega a domicilio</label>
 <input type="hidden" name="Datos[Domicilio]" value="0">
 <input type="checkbox" name="Datos[Domicilio]" class="form-control">



<label>Terraza</label>

    <input type="hidden" name="Datos[Terraza]" value="0">
   <input type="checkbox" name="Datos[Terraza]" class="form-control">


<label>Parking propio</label>
  <input type="hidden" name="Datos[Parking]" value="0">
  <input type="checkbox" name="Datos[Parking]" class="form-control">


<label>Retransmite eventos deportivos</label>

  <input type="hidden" name="Datos[Eventos]" value="0">
  <input type="checkbox" name="Datos[Eventos]" class="form-control">

<input type="hidden" name="Datos[id_restaurante]" value="{{ $placeId }}">
<<<<<<< Updated upstream




<div class="panel panel-default">
  <div class="panel-heading"><h5>Categorias para los platos</h5></div>
=======
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h2 class="restaurant_settings-subtitle">Foto principal</h2>
</div>

<div class="cartaMenu">
      @foreach( $datos_imagen as $key=>$imagen )
      <div style="display: inline-block;margin-right:10px">
      <img style="    width: 100%;" src='{{ $imagen }}') ></img>
      <input type="hidden" name="Datos[indiceImagen]" value="{{$key}}">
      <input id="CheckImg{{$key}}" type="checkbox" name="Datos[{{$key}}]"  onclick='selectOnlyImg({{$key}},{{$cuentaFotos}})'>
      </div>
      @endforeach
</div>


  <h2 class="restaurant_settings-subtitle">Categorias platos</h2>
>>>>>>> Stashed changes
  <input type="text" class="form-control" id="categorias_plato" placeholder="ej: ENTRANTES Y PRIMER PLATO;BEBIDAS;POSTRES" name="categorias_plato" required>
  <a onclick="añadirCategorias()" id="enviarCategoria" class="btn btn-primary" >Añadir Categoria</a>


<div  id='tabla_categorias' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 tablaCategorias'></div>
<input type="hidden" name="Datos[lat]" value="{{ $datos_restaurante['result']['geometry']['location']['lat'] }} ">
<input type="hidden" name="Datos[lng]" value="{{ $datos_restaurante['result']['geometry']['location']['lng'] }}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <input type="submit" value="ENVIA TUS DATOS"  class="btn btn-primary">
</form>
<input type="hidden" id="valor_select" value=""/>
</div>

</div>



@endsection


<script>

var txt2 = "";
var  categorias = ['postres','pescado','comida rapida','carne','copas','pasta','arroz','pizza','otro','verdura','tapa','ensalada','entrantes'];
var longitud  = categorias.length;
      for(var f=0;f<categorias.length;f++){
        var ruta = '{!! asset("assets/imagenes/iconob'+(f+1)+'.png") !!}';
txt2+= "<option id='icono"+(f+1)+"' value='icono"+(f+1)+".png'>"+categorias[f]+"</option>";
}
txt2 += "</select>";


function  añadirCategorias(){
  categorias = $( "#categorias_plato" ).val().split(";");
            for (var i=0; i<categorias.length; i++) {
<<<<<<< Updated upstream
              $("#tabla_categorias").append("<div class='panel-heading'><h2 id='nombreCategoria' style='margin-top:15px;'>Categoria "+categorias[i]+"</h5></div><a onclick=añadirPlatos('"+categorias[i]+"')  class='btn btn-primary' >+ plato</a><div  id='tabla_productos"+categorias[i]+"' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'></div>");
=======
              $("#tabla_categorias").append("<div class='panel-heading'><p id='nombreCategoria' class='restaurant_settings-subtitle' style='margin-top:15px; text-align: center;'>Categoria "+categorias[i]+"<a onclick=añadirPlatos('"+categorias[i]+"')  class='btn btn-primary' style='margin-left: 15px;'>+ plato</a></p></div><div  id='tabla_productos"+categorias[i]+"' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'></div>");
>>>>>>> Stashed changes
            };
$("#categorias_plato").prop('disabled', true);
<<<<<<< Updated upstream
$("#enviarCategoria").prop("onclick", false);
=======
$("#enviarCategoria").prop("onclick", false);   
}
>>>>>>> Stashed changes


}


var count = 1;

function  añadirPlatos(param){
  txt3= "<div>";
  for(var f=0;f<longitud;f++){
         var ruta = '{!! asset("assets/imagenes/iconob'+(f+1)+'.png") !!}';
     txt3+= "<li idSelect='"+(f+1)+"' onClick='javascript:asignarValor(this);' style='display:inline;cursor:pointer;'><img src='"+ruta+"' id='imagen"+count+(f+1)+"' value='icono"+(f+1)+".png'  onclick=valorImagenes('icono"+(f+1)+"')/></li>";
     }
  txt3 += "</div></div>";
$("#tabla_productos"+param+"").append("<h6>Plato "+count+"</h6><label>Nombre plato</label><input type='text' name='"+count+"[nombre]' class='form-control' required><label>Precio plato</label><input type='text' name='"+count+"[precio]' class='form-control' required><label>Categoria Plato</label><input type='text' name='"+count+"[categoria_plato]' value="+param+"  class='form-control' readonly><div><label>Icono del plato</label></div><select class='selectComidas' name='"+count+"[imagen]'>"+txt2+txt3 );
count++;

}

function asignarValor(elem){


  document.getElementById("valor_select").value=elem.getAttribute("idSelect");
    document.getElementById("icono"+elem.getAttribute("idSelect")+"").selected=true;


  console.log(document.getElementById("valor_select").value);
}





    </script>
