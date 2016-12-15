@extends('layouts.appadmin')

@section('content')

<div class="container">
  <div class="cartaMenu">

<form action="{{ url('/introducirMasivoPendienteBBDD')}}" method="POST">
@foreach( $datos_restaurante as $key => $restaurante )
<div class="datosIndividual">
<label class="labelAdm">Nombre de restaurante</label><input type="text" name="Datos[{{ $key }}][NombreRestaurante]" value="{{ $restaurante['result']['name'] }}"  class="form-control">
<label class="labelAdm">Tipo de restaurante</label>

<select name="Datos[{{ $key }}][TipoRestaurante]" class="form-control">
@foreach( $tipos as $tipo )
<option value="{{ $tipo->id_tipo }}">{{ $tipo->Nombre }}</option>
@endforeach
</select>


<label class="labelAdm">Entrega a domicilio</label>
 <input type="hidden" name="Datos[{{ $key }}][Domicilio]" value="0">
 <input type="checkbox" name="Datos[{{ $key }}][Domicilio]" class="form-control">



<label class="labelAdm">Terraza</label>

    <input type="hidden" name="Datos[{{ $key }}][Terraza]" value="0">
   <input type="checkbox" name="Datos[{{ $key }}][Terraza]" class="form-control">


<label class="labelAdm">Parking propio</label>
  <input type="hidden" name="Datos[{{ $key }}][Parking]" value="0">
  <input type="checkbox" name="Datos[{{ $key }}][Parking]" class="form-control">


<label class="labelAdm">Retransmite eventos deportivos</label>

  <input type="hidden" name="Datos[{{ $key }}][Eventos]" value="0">
  <input type="checkbox" name="Datos[{{ $key }}][Eventos]" class="form-control">

<input type="hidden" name="Datos[{{ $key }}][id_restaurante]" value="{{ $restaurante['result']['place_id'] }}">
<input type="hidden" name="Datos[{{ $key }}][lat]" value="{{ $restaurante['result']['geometry']['location']['lat'] }} ">
<input type="hidden" name="Datos[{{ $key }}][lng]" value="{{ $restaurante['result']['geometry']['location']['lng'] }}">
</div>
@endforeach



<div class="panel panel-default">
  <div class="panel-heading"><h4>Categorias para los platos</h4></div>
  <input type="text" class="form-control" id="categorias_plato" placeholder="ej: ENTRANTES Y PRIMER PLATO;BEBIDAS;POSTRES" name="categorias_plato" required>
  <a onclick="añadirCategorias()" id="enviarCategoria" class="btn btn-primary" >Añadir Categoria</a>


<div  id='tabla_categorias' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 tablaCategorias'></div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <input type="submit" value="ENVIA TUS DATOS"  class="btn btn-primary">
</form>
</div>
</div>
</div>
<div style="width:100%; height:120px;">
</div>
</div>


@endsection


<script>
var count = 1;

var txt2 = "";
var  categorias = ['postres','pescado','comida rapida','carne','copas','pasta','arroz','pizza','otro','verdura','tapa','ensalada','entrantes'];
var longitud  = categorias.length;
      for(var f=0;f<categorias.length;f++){
        var ruta = '{!! asset("assets/imagenes/iconob'+(f+1)+'.png") !!}';
txt2+= "<option id='icono"+(f+1)+"' value='icono"+(f+1)+".png'>"+categorias[f]+"</option>";
}

txt2 += "</select>";


function  añadirCategorias(){
  var valor = document.getElementById("categorias_plato").value;
  if(valor==null || valor==""){
    document.getElementById("categorias_plato").style.border="solid 2px red";
}else{

  categorias = $( "#categorias_plato" ).val().split(";");
            for (var i=0; i<categorias.length; i++) {
              $("#tabla_categorias").append("<div class='panel-heading'><h2 id='nombreCategoria' style='margin-top:15px; text-align: center;'>Categoria "+categorias[i]+"<a onclick=añadirPlatos('"+categorias[i]+"')  class='btn btn-primary' style='margin-left: 15px;'>+ plato</a></h5></div><div  id='tabla_productos"+categorias[i]+"' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'></div>");
            };
            document.getElementById("categorias_plato").style.border="solid 2px green";
$("#categorias_plato").prop('disabled', true);
$("#enviarCategoria").prop("onclick", false);
}


}




function  añadirPlatos(param){
  txt3= "<div id='div"+count+"'>";
  for(var f=0;f<longitud;f++){
         var ruta = '{!! asset("assets/imagenes/iconob'+(f+1)+'.png") !!}';
     txt3+= "<li idSelect='"+(f+1)+"' onClick='javascript:asignarValor(this,"+count+");' style='display:inline;cursor:pointer;'><img src='"+ruta+"' id='imagen"+count+(f+1)+"' value='icono"+(f+1)+".png'  onclick=valorImagenes('icono"+(f+1)+"')/></li>";
     }
  txt3 += "</div></div>";
$("#tabla_productos"+param+"").append("<h6>Plato "+count+"</h6><label  class='labelAdm'>Nombre plato</label><input type='text' name='"+count+"[nombre]' class='form-control' required><label class='labelAdm'>Precio plato</label><input type='number' onkeyup='funcionComprobarPrecio(this)' name='"+count+"[precio]' class='form-control' required><div><label class='labelAdm'>¿Es su producto estrella?      </label><input type='checkbox' class='form-control' id='Check"+count+"' name='"+count+"[estrella]' onclick='selectOnlyThis(this.id)' /></div><label class='labelAdm'>Categoria Plato</label><input type='text' name='"+count+"[categoria_plato]' value="+param+"  class='form-control' readonly><div><label class='labelAdm'>Icono del plato</label></div><select class='selectComidas' name='"+count+"[imagen]'>"+txt2+txt3 );
count++;

}

function funcionComprobarPrecio(elem){
var valor = elem.value;
if(valor<1 || valor > 9999){
  elem.style.border="solid 2px red"
  elem.value="";
}
else{
    elem.style.border="solid 2px green";
}
}

function asignarValor(elem,cuenta){

  var div = document.getElementById("div"+cuenta+"");
  if(  div.getElementsByClassName("bordeRojoIconoAdmin")[0]){
      div.getElementsByClassName("bordeRojoIconoAdmin")[0].className="";
  }


var select = document.getElementsByName(""+cuenta+"[imagen]");
var numeroIcono = elem.getAttribute("idSelect")-1;


  select[0][numeroIcono].selected=true;
elem.children[0].className="bordeRojoIconoAdmin";

}


function selectOnlyThis(id) {
  if(  document.getElementById(id).checked = true){
    for (var i = 1;i < count; i++)
    {
        document.getElementById("Check" + i).checked = false;
    }
    document.getElementById(id).checked = true;
  }else{
    document.getElementById(id).checked = false;
  }

}





    </script>
