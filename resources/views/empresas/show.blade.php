@extends('layouts.appempresas')

@section('content')

    <div class="container">
        <div id="form_empresa_titular">
            <h3 id="titular_restaurante">Pasa a controlar tu restaurante {{ $datos_local["result"]["name"] }}</h3>
            <p>{{ $datos_local["result"]["vicinity"] }}</p>
        </div>

        <div id="form_empresa" class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
            <form  action="{{url('/empresas/send')}}" method="post">

                <div class="form-group">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <p class="form_empresa_text_desc">CIF:</p>
                    <input type="text" name="" class="empresa-input" value="" required placeholder="CIF">
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <p class="form_empresa_text_desc">CIF:</p>
                    <input type="text" name="" class="empresa-input" value="" placeholder="CIF">
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="form_empresa_text_desc">Mensaje:</p>
                    <textarea required class="form-control" rows="5" required name="mensaje" id="comment"></textarea>
                  </div>
                </div>
                <input type="hidden" name="id_admin" value="{{ Auth::user()->id }}">
                <input type="hidden" name="id_restaurante" value="{{ $datos_local['result']['place_id'] }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <button class="bussiness-button full-btn-empresas" type="submit" >Enviar solicitud</button>
                </div>
            </form>
        </div>

        @if(old('controlado')!==null)
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Ya hay en curso una solicitud, porfavor espere a que se tramite</p>
        </div>
        @endif
    </div>

@endsection
