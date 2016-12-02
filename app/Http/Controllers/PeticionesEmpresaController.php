<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurante;
use App\Menu;
use App\Plato;
use App\PeticionesEmpresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Prest;
use Illuminate\Support\Facades\Auth;

include_once (app_path().'/key.php');
include_once (app_path().'/funcionesGlobales.php');


class PeticionesEmpresaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresas.index');
    }
    public function save(Request $request)
    {
        $data = $request->all();
        //bloqueamos que pueda meter varias veces el mismo restaurante
        $peticion_previa = PeticionesEmpresa::where('id_admin', $data["id_admin"])
               ->where('id_restaurante', $data["id_restaurante"])
               ->first();
        $local = DB::table("restaurantes")
               ->where('id_restaurante', '=', $data["id_restaurante"])
               ->first();
        //si tenemos el local //sino ha exo peticion previa
        if(isset($local) && (!isset($peticion_previa))){
                $peticion = new PeticionesEmpresa($data);
                $peticion->save();
            return view('empresas.aviso',compact('data'));
        }else{
            return back()->withInput(['controlado'=>'controlado']);
        }
    }


    public function show($id)
    {
        //PETICION DE DATOS A LA API DE GOOGLE DEL RESTAURANTE
        $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$id."&key=".getKey());
        $datos_local = $manejadorREST->realizarPeticion();
        $local = DB::table("restaurantes")
        ->where('id_restaurante', '=', $id)
        ->first();
        if($local->id_admin==null){
            return view('empresas.show',compact('datos_local'));
        }else{
            return view('empresas.index',compact('datos_local'));
        }
    }

    public function buscarLocales(Request $request)
    {
        $locales = DB::table("restaurantes")
        ->where('nombre_restaurante', 'LIKE', '%' . $request->nombre_local . '%')
        ->where('franquicia', '=', '0')
        ->limit(10)
        ->get();

        if($locales->count() > 0){
            //modificamos el array con mas datos , miles de peticiones x el puto google
            $locales = $locales->map(function ($local, $key) {
                //PETICION DE DATOS A LA API DE GOOGLE DEL RESTAURANTE
                $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$local->id_restaurante."&key=".getKey());
                $datos_local = $manejadorREST->realizarPeticion();
                $local->telefono = $datos_local["result"]["formatted_phone_number"];
                $local->direccion = $datos_local["result"]["vicinity"];
                $local->website = "";
                if(isset($datos_local["result"]["website"])){
                    $local->website=$datos_local["result"]["website"];
                }

                //OBTENCION DE LA IMAGEN
                $local->imagen = "http://www.hotelatalaia.com/images/restaurante.jpg";
                if(isset($datos_local["result"]["icon"])){
                    $local->imagen = $datos_local["result"]["icon"];
                }

                return $local;
            });

            $locales->all();
        }

        //RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
        $returnHTML = view('empresas.resultados')->with(array('locales' => $locales))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
}
