<?php

namespace App\Http\Controllers;

use App;
use App\Restaurante;
use App\Menu;
use App\Plato;
use App\RestaurantePendiente;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Prest;
use Illuminate\Support\Facades\Auth;

include_once (app_path().'/key.php');
include_once (app_path().'/funcionesGlobales.php');
class RestauranteController extends Controller
{
  //

public function index(Request $request)
{

//PETICION DE DATOS A LA API DE GOOGLE DEL RESTAURANTE
$manejadorREST = new Prest("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$request->placeid."&language=".App::getLocale()."&key=".getKey());
$datos_restaurante = $manejadorREST->realizarPeticion();

//SACAMOS DE LA BBDD DATOS DEL RESTAURANTE
$restaurante = DB::table('restaurantes')
->join('menus', 'menus.id_restaurante', '=', 'restaurantes.id_restaurante')
->join('platos', 'platos.id_menu', '=', 'menus.id_menu')
->join('tipo_restaurante', 'tipo_restaurante.id_tipo' , '=', 'restaurantes.tipo')
->where('restaurantes.id_restaurante', '=', $request->placeid)
->get();

//si esta logueado con facebook actualizamos stats, CAMBIAR!!
$userExtra = session('userExtra');
if(Auth::check() && isset($userExtra)){

    DB::table('platos')->increment($userExtra['gender'], 1);
    if(isset($userExtra['age_range']['min'])){
        if($userExtra['age_range']['min']<18){
            DB::table('platos')->increment('menor_edad', 1);
        }else{
            DB::table('platos')->increment('mayor_edad', 1);
        }
    }
}


//OBTENCION DE LA IMAGEN CABECERA
$datos_imagen = url('/assets/imagenes/cross.png');
if(isset($restaurante[0]->indice_foto)){
  if($restaurante[0]->indice_foto!==null){
      $manejadorREST->setUrl("https://maps.googleapis.com/maps/api/place/photo?maxwidth=2000&photoreference=".$datos_restaurante["result"]["photos"][$restaurante[0]->indice_foto]["photo_reference"]."&key=".getKey());
      $datos_imagen = $manejadorREST->getUrl();
  }
}

//obtenemos los datos meteorologicos
$manejadorREST = new Prest("http://api.wunderground.com/api/".getWeatherKey()."/conditions/forecast/alert/q/".$datos_restaurante['result']['geometry']['location']['lat'].",".$datos_restaurante['result']['geometry']['location']['lng'].".json");
$datos_meteorologicos = $manejadorREST->realizarPeticion();

//DATOS PROCESADOS PARA VISTA //DATOS PROCESADOS PARA VISTA //DATOS PROCESADOS PARA VISTA
//obtencion del precio como string
if(isset($datos_restaurante["result"]["price_level"])){
  $datos_restaurante["result"]["price_level"] = getStringPrice($datos_restaurante["result"]["price_level"]);
}
//obtencion de los servicios ofrecidos como array
$servicios = [];
if(isset($restaurante[0])){
  if($restaurante[0]->domicilio === 1) array_push($servicios,"Servicio a domicilio");
  if($restaurante[0]->terraza === 1) array_push($servicios,"Terraza");
  if($restaurante[0]->parking === 1) array_push($servicios,"Parking");
  if($restaurante[0]->eventos_deportivos === 1) array_push($servicios,"Eventos deportivos");
  $restaurante[0]->servicios = $servicios;
}

//RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
$returnHTML = view('restaurante.index')->with(array('restaurante'=> $restaurante, 'datos_restaurante' => $datos_restaurante, 'datos_imagen' => $datos_imagen,'datos_meteorologicos' => $datos_meteorologicos))->render();
  return response()->json( array('success' => true, 'html'=>$returnHTML) );
}



public function create()
{
  return view('projects.create');
}

/**
 * Store a newly created resource in storage.
 *
 * @return Response
 */
public function store()
{
  //
}

/**
 * Display the specified resource.
 *
 * @param  \App\Project $project
 * @return Response
 */
public function show()
{
   $user= Auth::user()->id;
   $restaurantes = Restaurante::where('restaurantes.id_admin', '=', $user)->get();
   return view('restaurante.show', compact('restaurantes'));
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Project $project
 * @return Response
 */
public function edit(Request $request)
{
  $id_restaurante =$request->input('prueba');
     $user= Auth::user()->id;
    $restaurantes =Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)->get();
    $menus = Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)
  ->leftJoin('menus', 'menus.id_restaurante', '=', 'restaurantes.id_restaurante')
  ->leftJoin('platos', 'platos.id_menu', '=', 'menus.id_menu')
    ->get();
    return view('restaurante.edit', compact('restaurantes','menus'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \App\Project $project
 * @return Response
 */
public function update(Request $request)
{
  $datosRestaurante = $request->input('Datos');
  $datosPlatos = $request->except('Datos');

$id_restaurante = $request->input('id_restaurante');
if($datosRestaurante['Domicilio']=="on"){
  $datosRestaurante['Domicilio']=1;
};
if($datosRestaurante['Terraza']=="on"){
  $datosRestaurante['Terraza']=1;
};
if($datosRestaurante['Parking']=="on"){
  $datosRestaurante['Parking']=1;
};
if($datosRestaurante['Eventos']=="on"){
  $datosRestaurante['Eventos']=1;
};

  Restaurante::where('restaurantes.id_restaurante','=', $id_restaurante)
            ->update(['tipo' => $datosRestaurante['TipoRestaurante'],
          'domicilio' =>$datosRestaurante['Domicilio'],
          'terraza' => $datosRestaurante['Terraza'],
          'parking' =>$datosRestaurante['Parking'],
          'eventos_deportivos' => $datosRestaurante['Eventos'],
  ]);

  foreach($datosPlatos as $id_plato => $arrayValores){
      if (is_array($arrayValores)){

          foreach($arrayValores as $columna => $valor){
              plato::where('platos.id_plato','=', $id_plato)->update([$columna =>$valor]);
        }

      }
}


return redirect()->action('HomeController@index');
}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Project $project
 * @return Response
 */
 public function destroy(Project $project)
 {
   //
 }

 public function platosRestauranteConcreto(Request $request)
 {
   $id_restaurante =$request->input('prueba');
   $restaurante =Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)
   ->join('menus', 'menus.id_restaurante', '=', 'restaurantes.id_restaurante')
   ->get();
   return view('plato.new', compact('restaurante'));
 }

 public function buscarRestaurantesAdmin(Request $request)
 {

   $lugar = $request->input('busqueda');
     $radio = $request->input('radio');
     $contador= 0;

     $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($lugar)."&components=country:ES&key=".getKey());
                 $datosDIR = $manejadorREST->realizarPeticion();
                 $coordenadas = $datosDIR["results"][0]["geometry"]["location"];
                 $lat  =  $coordenadas["lat"];
                 $lng =  $coordenadas["lng"];

                 //pedimos que nos busque locales en la zona delimitada con ciertas coordenadas
                 $manejadorREST->setUrl("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$coordenadas["lat"].",".$coordenadas["lng"]."&radius=".$radio."&types=food&language=es&key=".getKey());
                 $restaurantes_cercanos = $manejadorREST->realizarPeticion();
                 //comprobamos si ya esta activo ese sito en la bd
                 foreach ($restaurantes_cercanos["results"] as $restaurante_cercano){

                 //comprobamos si ya esta activo ese sito en la bd

                 $prueba =  RestaurantePendiente::where('id_restaurante', '=', $restaurante_cercano['place_id'])->get();
                 $prueba2 =  Restaurante::where('id_restaurante', '=', $restaurante_cercano['place_id'])->get();

                 if($prueba->isEmpty() && $prueba2->isEmpty() ){
                   $restaurantes_cercanos["results"][$contador]['fichado'] = false;
                 }else {
                   $restaurantes_cercanos["results"][$contador]['fichado']= true;
                 }
                 $contador++;
                     }


     return view('administracion.busquedaRestaurantes', compact('restaurantes_cercanos'));

 }
 public function buscarRestaurantesMasivo(Request $request)
 {

   $lugar = $request->input('busqueda');
     $radio = $request->input('radio');
     $contador= 0;

     $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/place/textsearch/json?query=".urlencode($_POST["busqueda"])."&key=".getKey());
                $restaurantes_cercanos = $manejadorREST->realizarPeticion();
                 $coordenadas = $restaurantes_cercanos["results"][0]["geometry"]["location"];
                 $lat  =  $coordenadas["lat"];
                 $lng =  $coordenadas["lng"];

                  //comprobamos si ya esta activo ese sito en la bd
                 foreach ($restaurantes_cercanos["results"] as $restaurante_cercano){

                 //comprobamos si ya esta activo ese sito en la bd

                 $prueba =  RestaurantePendiente::where('id_restaurante', '=', $restaurante_cercano['place_id'])->get();
                 $prueba2 =  Restaurante::where('id_restaurante', '=', $restaurante_cercano['place_id'])->get();

                 if($prueba->isEmpty() && $prueba2->isEmpty() ){
                   $restaurantes_cercanos["results"][$contador]['fichado'] = false;
                 }else {
                   $restaurantes_cercanos["results"][$contador]['fichado']= true;
                 }
                 $contador++;
                     }


     return view('administracion.busquedaRestaurantesM', compact('restaurantes_cercanos'));

 }


 public function ficharRestaurante(Request $request)
 {

   $placeId = $request->placeid;
     $nombre = $request->nombre;
       $direccion = $request->direccion;
   $user= Auth::user()->id;
   RestaurantePendiente::insert(['id_restaurante'=>$placeId , 'id_admin' =>$user , 'nombre' => $nombre, 'direccion' => $direccion]);


 }


 public function verFichados()
 {
   $user= Auth::user()->id;
   $pendientes = RestaurantePendiente::where('id_admin', '=', $user)
   ->join('users', 'users.id', '=', 'restaurante_pendientes.id_admin')
   ->get();
   return view('administracion.fichados', compact('pendientes'));
 }


 public function introducirMenuRestaurantePendiente(Request $request)
 {
     $placeId = $request->input('id_restaurante');
     $user= Auth::user()->id;
     $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$placeId."&key=".getKey());
     $datos_restaurante = $manejadorREST->realizarPeticion();




 return view('administracion.introducirMenu', compact('datos_restaurante', 'placeId'));
 }

 public function introducirPendienteBBDD(Request $request)
 {

   $datosRestaurante = $request->input('Datos');

   $datosPlatos = $request->except('Datos');

   if($datosRestaurante['Domicilio']=="on"){
     $datosRestaurante['Domicilio']=1;
   };
   if($datosRestaurante['Terraza']=="on"){
     $datosRestaurante['Terraza']=1;
   };
   if($datosRestaurante['Parking']=="on"){
     $datosRestaurante['Parking']=1;
   };
   if($datosRestaurante['Eventos']=="on"){
     $datosRestaurante['Eventos']=1;
   };
 $imagen = $request->get('imagen');
     $user= Auth::user()->id;
   Restaurante::insert(['id_restaurante'=>$datosRestaurante['id_restaurante'] , 'id_admin' =>$user , 'lat' => $datosRestaurante['lat'], 'lng' => $datosRestaurante['lng'], 'nombre_restaurante' => $datosRestaurante['NombreRestaurante'], 'tipo' =>$datosRestaurante['TipoRestaurante'] ,'domicilio' => $datosRestaurante['Domicilio'] ,
   'terraza' => $datosRestaurante['Terraza'] ,'parking' => $datosRestaurante['Parking'],'eventos_deportivos' => $datosRestaurante['Eventos']]);
   Menu::insert(['id_restaurante'=>$datosRestaurante['id_restaurante']]);
   RestaurantePendiente::where(['id_restaurante'=>$datosRestaurante['id_restaurante']])->delete();
   $idMenu = Menu::where(['id_restaurante'=>$datosRestaurante['id_restaurante']])->first();

   foreach($datosPlatos as $id_plato => $arrayValores){
       if (is_array($arrayValores)){
     Plato::insert(['id_menu' => $idMenu->id_menu, 'nombre' => $arrayValores['nombre'], 'precio' => $arrayValores['precio'], 'categoria_plato' => $arrayValores['categoria_plato'], 'icono' => $arrayValores['imagen']]);

       }
 }
 return view('administracion.ingreso');
 }


 public function verFichadosParaMasivo()
 {
     $user= Auth::user()->id;

   $pendientes = RestaurantePendiente::where('id_admin', '=', $user)->get();

 return view('administracion.fichadosMasivo', compact('pendientes'));
 }

 public function seleccionRestaurantesMasivo(Request $request)
 {
     $restaurantesSeleccionados = $request->except('_token');
     $contador= 0;

       foreach($restaurantesSeleccionados as $restauranteConcreto){

       if(count($restauranteConcreto)==2){
         $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$restauranteConcreto['id_restaurante']."&key=".getKey());
         $datos_restaurante[$contador] = $manejadorREST->realizarPeticion();
 $contador++;
       }

           }




 return view('administracion.introducirMenuMasivo', compact('datos_restaurante'));
 }

 public function introducirMasivoPendienteBBDD(Request $request)
 {

   $datosRestaurante = $request->input('Datos');

   $datosPlatos = $request->except('Datos');
   $imagen = $request->get('imagen');
       $user= Auth::user()->id;
       $contador= 0;

 foreach($datosRestaurante as  $restauranteConcreto){
   if($restauranteConcreto['Domicilio']=="on"){
     $restauranteConcreto['Domicilio']=1;
   };
   if($restauranteConcreto['Terraza']=="on"){
   $restauranteConcreto['Terraza']=1;
   };
   if($restauranteConcreto['Parking']=="on"){
   $restauranteConcreto['Parking']=1;
   };
   if($restauranteConcreto['Eventos']=="on"){
   $restauranteConcreto['Eventos']=1;
   };

   Restaurante::insert(['id_restaurante'=>$restauranteConcreto['id_restaurante'] , 'id_admin' =>$user , 'lat' => $restauranteConcreto['lat'], 'lng' => $restauranteConcreto['lng'], 'nombre_restaurante' => $restauranteConcreto['NombreRestaurante'], 'tipo' =>$restauranteConcreto['TipoRestaurante'] ,'domicilio' => $restauranteConcreto['Domicilio'] ,
   'terraza' => $restauranteConcreto['Terraza'] ,'parking' => $restauranteConcreto['Parking'],'eventos_deportivos' => $restauranteConcreto['Eventos']]);
   Menu::insert(['id_restaurante'=>$restauranteConcreto['id_restaurante']]);
   RestaurantePendiente::where(['id_restaurante'=>$restauranteConcreto['id_restaurante']])->delete();
   $idMenu[$contador] = Menu::where(['id_restaurante'=>$restauranteConcreto['id_restaurante']])->first();
 $contador++;
 }




   foreach($datosPlatos as $id_plato => $arrayValores){

       if (is_array($arrayValores)){
         foreach($idMenu as $idMenuIndividual){


           Plato::insert(['id_menu' => $idMenuIndividual->id_menu, 'nombre' => $arrayValores['nombre'], 'precio' => $arrayValores['precio'], 'categoria_plato' => $arrayValores['categoria_plato'], 'icono' => $arrayValores['imagen']]);

         }

       }
 }
 return view('administracion.ingreso');
 }



 }
