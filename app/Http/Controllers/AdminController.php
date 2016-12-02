<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeticionesEmpresa;
use App\User;
use App\Restaurante;



class AdminController extends Controller
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
    public function ingresar()
    {
        return view('administracion.ingreso');
    }

    public function usersPendientes()
    {
        $peticiones = PeticionesEmpresa::where('activado', 0)
        ->select('peticiones_empresas.*','users.name','restaurantes.nombre_restaurante')
        ->join('users', 'users.id', '=', 'peticiones_empresas.id_admin')
        ->join('restaurantes', 'restaurantes.id_restaurante', '=', 'peticiones_empresas.id_restaurante')
        ->get('peticiones_empresas');

        return view('administracion.userspendientes', compact('peticiones'));
    }

    public function aprobarEmpresa(Request $request)
       {
           $resultado = false;
           $peticion = PeticionesEmpresa::find($request->id);
           $peticion->activado = 1;
           $peticion_resultado = $peticion->save();
           //si todo va bien
           if($peticion_resultado){
               $restaurante = Restaurante::where('id_restaurante','=', $peticion->id_restaurante)
               ->first();
               //si no esta asignado
               if($restaurante->id_admin == null){
                   //update restaurante
                   $num_updat_res = Restaurante::where('id_restaurante','=', $peticion->id_restaurante)
                             ->update(['id_admin' => $peticion->id_admin]);
                   if($num_updat_res !==0) $resultado = true;

                   $user = User::where('id','=', $peticion->id_admin)
                   ->first();
                   //si es rango normal
                   if($user->rango==="N"){
                       //update user
                       User::where('id','=', $peticion->id_admin)
                                 ->update(['rango' => "R"]);
                   }
               }
           }

           return response()->json( array('aprobado' => $resultado,) );
       }
}
