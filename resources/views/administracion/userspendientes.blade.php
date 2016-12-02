@extends('layouts.appadmin')

@section('content')



<div class="container">
    <div id="contenedor_insercción" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="perfil_bread" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2 class="profile_title">Dueños pendientes de aprobacion</h2>
        <h3 id="perfil_titulo">Administracion</h3>
        </div>

        @if ( !$peticiones->count() )
        No existen users pendientes
        @else

            @foreach($peticiones as $peticion)
            <div class="peticion_user" data-id="{{$peticion->id}}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <h4>{{$peticion->nombre_restaurante}}  >>>>>>>>>>> {{$peticion->name}}</h4>
                    Mensaje: {{$peticion->mensaje}}
                </div>
                <div  class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <p id="aprobar-empresa" class="btn btn-success">Aprobar</p>
                    <p class="btn btn-danger">Rechazar</p>
                </div>
            </div>
            @endforeach


        @endif

    </div>
 </div>
 <script>
       //votacion de favorito
       $( "#aprobar-empresa" ).click(function() {
           var peticion =  $(this).parent().parent();
           var parametros = {
                       "_token": "<?php echo csrf_token() ?>",
                       "id": $(this).parents().closest(".peticion_user").attr('data-id'),
               };
           $.ajax({
               type: "POST",
               url: "{{url('administracion/aprobarempresa')}}",
               data: parametros,

               success: function(data){
                    peticion.fadeOut();
               }
           });
       });
</script>

@endsection
