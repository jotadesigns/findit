@extends('layouts.appempresas')

@section('content')

<div class="container">
    <section id="business-search">
        <h2><b>Busca tu negocio</b> y <b>toma el control</b> de tu página en Find it</h2>
        <div id="form_busqueda">
            <form action="#" method="post">
                <div class="search-form search-form-nomargin search-direction col-xs-12 col-sm-10 col-md-10 col-lg-10">
                    <i class="ion-android-search"></i>
                    <input onKeyPress="if (event.which == 13) return false;" id="nombre_local" type="text"  name="nombre_local" placeholder="Nombre del negocio" required/>
                </div>
                <div class="bussiness-button-nopadding col-xs-12 col-sm-2 col-md-2 col-lg-2" >
                    <p id="buscar_locales" class="bussiness-button"><i class="ion-search"></i></p>
                </div>


            </form>
            <section id="business-results" >

            </section>
        </div>
    </section>




</div>
<script>
//votacion de favorito
$( "#buscar_locales" ).click(function() {
    if($('#nombre_local').val()!==""){
        var parametros = {
                    "_token": "<?php echo csrf_token() ?>",
                    "nombre_local": $('#nombre_local').val(),
            };
        $.ajax({
            type: "POST",
            url: "empresas/buscar",
            data: parametros,

            success: function(data){
                console.log(data.html)
                 $( '#business-results' ).html( data.html );
            }
        });
    }
});
</script>
@endsection
