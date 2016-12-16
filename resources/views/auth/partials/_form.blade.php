<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h2 class="profile-data-title">Cambiar datos</h2>
</div>

<div class="perfil-form-group blanco-input col-xs-12 col-sm-12 col-md-12 col-lg-12">
    {!! Form::text('name') !!}
</div>
<div class="perfil-form-group blanco-input col-xs-12 col-sm-12 col-md-12 col-lg-12">
    {!! Form::text('email') !!}
</div>

<div  class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="form-group">
        {!! Form::submit("Guardar", ['class'=>'btn-profile-data']) !!}
    </div>
</div>
