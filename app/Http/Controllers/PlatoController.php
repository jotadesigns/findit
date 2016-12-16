<?php

namespace App\Http\Controllers;

use App\Restaurante;
use App\Menu;
use App\Plato;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Prest;
use Illuminate\Support\Facades\Auth;

include_once (app_path().'/key.php');
include_once (app_path().'/funcionesGlobales.php');


class PlatoController extends Controller
{
  //
  public function index()
  {
    return view('platos.index');
  }

  public function buscarProductos(Request $request) {

      function getOr(&$var, $default) {
            if (isset($var)) {
                return $var;
            } else {
                return $default;
            }
        }
        //si introduce direccion
      if(isset($request->direccion)){
          $direccion = urlencode($request->direccion);
          $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/geocode/json?address=".$direccion."&components=country:ES&key=".getKey());
          $datosDIR = $manejadorREST->realizarPeticion();
          $coordenadas = $datosDIR["results"][0]["geometry"]["location"];
      }else{
          $coordenadas["lat"]=$request->direccion_gps_lat;
          $coordenadas["lng"]=$request->direccion_gps_lng;
      }
      if(isset($request->buscador)){
          $busqueda = $request->buscador;
      }
      $request->session()->forget('productos_filtrados');
      $distancia = $request->distancia;
      $lat  =  $coordenadas["lat"];//lat ubicacion deseada
      $GLOBALS['lat'] = $lat;
      $lng =  $coordenadas["lng"];//lng ubicacion deseada
      $GLOBALS['lng'] = $lng;
      $distance = $distancia; // Sitios que se encuentren en un radio de Xkm
      $GLOBALS['distance'] = $distance;
      $GLOBALS['api_key'] = getKey();
      $box = getBoundaries($lat, $lng, $distance);//Calculamos las coordenadas en un cuadrado de X distancia para no saturar la BBDD

      //Realizamos la consulta principal
      $restaurantes_cercanos = DB::table('restaurantes')
      ->select('*', DB::raw('6371 * ACOS(
                                                  SIN(RADIANS(lat))
                                                  * SIN(RADIANS(' . $lat . '))
                                                  + COS(RADIANS(lng - ' . $lng . '))
                                                  * COS(RADIANS(lat))
                                                  * COS(RADIANS(' . $lat . '))
                                                  )
                                      as distance'))
                  ->join('menus', 'menus.id_restaurante', '=', 'restaurantes.id_restaurante')
                  ->join('platos', 'platos.id_menu', '=', 'menus.id_menu')
                  ->whereBetween('restaurantes.lat', array($box['min_lat'], $box['max_lat']))
                  ->whereBetween('restaurantes.lng', array($box['min_lng'], $box['max_lng']))
                  ->where('platos.nombre', 'LIKE', '%' . $request->buscador . '%')
                  ->having('distance', '<', $distance)
                  ->orderBy('distance', 'asc')
                  ->get();


              //miramos si el usuario esta logueado y cogemos el modo de navegacion
              $GLOBALS['mode']="walking";
              if(Auth::check()){
                  $user = Auth::user();
                  $GLOBALS['mode'] = $user->conf_modonav;
              }
              //calculamos distancias y filtramos x distancia REAL (enrutamiento)
              $restaurantes_cercanos = $restaurantes_cercanos->filter(function ($value, $key) {
                  $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$GLOBALS['lat'].",".$GLOBALS['lng']."&destinations=".$value->lat.",".$value->lng."&mode=".$GLOBALS['mode']."&language=es&key=".$GLOBALS['api_key']);
                  $distancia_datos = $manejadorREST->realizarPeticion();
                    //si sigue cumpliendo la distancia requerida
                    if($distancia_datos["rows"][0]["elements"][0]["distance"]["value"]<=($GLOBALS['distance']*1000)){
                        //ingresamos datos necesarios al array de objetos
                        $value->distanciaReal=$distancia_datos["rows"][0]["elements"][0]["distance"]["text"];
                        $value->tiempoReal=$distancia_datos["rows"][0]["elements"][0]["duration"]["text"];
                        $value->destacado = 0;
                        $value->favorito = 0;
                        $value->urlNavigate = "http://maps.google.com/?saddr=".$GLOBALS['lat'].",".$GLOBALS['lng']."&daddr=".$value->lat.",".$value->lng;

                      return TRUE;
                    }
                    return FALSE;
              });

              $restaurantes_cercanos->all();

              //si esta logueado
              if(Auth::check()){
                  $GLOBALS['user'] = Auth::user();
                 //lentisimo, MEJORAR !!
                  $restaurantes_cercanos = $restaurantes_cercanos->each(function ($value, $key) {
                      $votado = DB::table("likes")
                      ->where('id', '=', $GLOBALS['user']->id)
                      ->where('id_restaurante', '=', $value->id_restaurante)
                      ->where('id_plato', '=', $value->id_plato)
                      ->first();
                      if(isset($votado)){
                          $value->favorito = 1;
                      }
                  });

                //si viene de una cuenta social y lo tiene activado realizamos busqueda personalizada
                $GLOBALS['userExtra'] = session('userExtra');

                if(isset($GLOBALS['userExtra']) && $GLOBALS['user']->conf_destacados==1){
                    //si es chica
                    if($GLOBALS['userExtra']["gender"]==='female'){
                         $restaurantes_cercanos = $restaurantes_cercanos->map(function ($value, $key) {

                             if((($value->female*100)/($value->male+$value->female))>=70){
                                 //si es menor_edad
                                 if($GLOBALS['userExtra']["age_range"]["min"]<18){
                                     if((($value->menor_edad*100)/($value->menor_edad+$value->mayor_edad))>=70){
                                         $value->destacado = 1;
                                     }
                                 }
                                //si es mayor_edad
                                 else{
                                     if((($value->mayor_edad*100)/($value->menor_edad+$value->mayor_edad))>=70){
                                         $value->destacado = 1;
                                     }
                                 }
                             }
                             return $value;
                        });
                     }
                    //si es chico
                     else{
                         $restaurantes_cercanos = $restaurantes_cercanos->map(function ($value, $key) {

                             if((($value->male*100)/($value->male+$value->female))>=70){
                                 //si es menor_edad
                                 if($GLOBALS['userExtra']["age_range"]["min"]<18){
                                     if((($value->menor_edad*100)/($value->menor_edad+$value->mayor_edad))>=70){
                                         $value->destacado = 1;
                                     }
                                 }
                                //si es mayor_edad
                                 else{
                                     if((($value->mayor_edad*100)/($value->menor_edad+$value->mayor_edad))>=70){
                                         $value->destacado = 1;
                                     }
                                 }
                             }
                             return $value;
                        });
                     }

                }

              }

              //guardamos en sesion los resultados, convertido a array
              session(['restaurantes_cercanos' => json_decode(json_encode($restaurantes_cercanos), true)]);

              //paginamos los restaurantes una vez ingresados en sesion
              $restaurantes_cercanos = $restaurantes_cercanos->slice(0, env('LIMIT'));
              $restaurantes_cercanos->all();

              //pasamos los datos necesarios extra
              $platos_extra = [
                  "lat" => $lat,
                  "lng" => $lng,
                  "busqueda" => $busqueda,
              ];
              //pasamos el tiempo al css
              $tiempo = getTiempo();

      return view('plato.buscar', compact('restaurantes_cercanos','platos_extra','tiempo'));
  }
  public function getMoreProducts(Request $request){
          $LIMIT = env('LIMIT');
          if(session('productos_filtrados')!==null){
              $restaurantes_cercanos = session('productos_filtrados');
          }else{
              $restaurantes_cercanos = session('restaurantes_cercanos');

          }


          if(count($restaurantes_cercanos) >= $request->offset){
              //comprobamos que no nos pasemos del numero de resultados
             if(count($restaurantes_cercanos) < $request->offset + $LIMIT){
                $diferencia = count($restaurantes_cercanos) - $request->offset;
                $restaurantes_cercanos = array_slice($restaurantes_cercanos, $request->offset, $diferencia);

             }else{
                  $restaurantes_cercanos = array_slice($restaurantes_cercanos, $request->offset, $LIMIT);
              }

              //RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
              $returnHTML = view('plato.ordenar')->with(array('restaurantes_cercanos' => $restaurantes_cercanos))->render();
                return response()->json( array('success' => true, 'html'=>$returnHTML) );

            }else{
                return response()->json( array('success' => false) );
            }
  }

  //SUBRUTINA PARA ordenar los resultados de la busqueda
  public function ordenarProductos(Request $request) {

      function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
          $position = array();
          $newRow = array();
          foreach ($toOrderArray as $key => $row) {
                  $position[$key]  = $row[$field];
                  $newRow[$key] = $row;
          }
          if ($inverse) {
              arsort($position);
          }
          else {
              asort($position);
          }
          $returnArray = array();
          foreach ($position as $key => $pos) {
              $returnArray[] = $newRow[$key];
          }
          return $returnArray;
      }

      //GLOBALES
      $LIMIT = env('LIMIT');
      if(session('productos_filtrados')!==null){
          $productos_filtrados = session('productos_filtrados');
      }
      $restaurantes_cercanos = session('restaurantes_cercanos');

      // ORDENACION ORDENACION            // ORDENACION ORDENACION          // ORDENACION ORDENACION
      if(isset($request->tipo_ordenacion)){
          //cogemos el tipo de ordenacion
          $tipo_ordenacion = $request->tipo_ordenacion;

          switch($tipo_ordenacion){
              case 'DISTANCIA_DESC': $restaurantes_cercanos = orderMultiDimensionalArray($restaurantes_cercanos, "distanciaReal",$inverse = true);
              if(session('productos_filtrados')!==null){$productos_filtrados = orderMultiDimensionalArray($productos_filtrados, "distanciaReal",$inverse = true);}break;
              case 'DISTANCIA_ASC': $restaurantes_cercanos = orderMultiDimensionalArray($restaurantes_cercanos, "distanciaReal",$inverse = false);
                    if(session('productos_filtrados')!==null){$productos_filtrados = orderMultiDimensionalArray($productos_filtrados, "distanciaReal",$inverse = false);}break;
              case 'PRECIO_ASC': $restaurantes_cercanos = orderMultiDimensionalArray($restaurantes_cercanos, "precio",$inverse = false);
              if(session('productos_filtrados')!==null){$productos_filtrados = orderMultiDimensionalArray($productos_filtrados, "precio",$inverse = false);}break;
              case 'PRECIO_DESC': $restaurantes_cercanos = orderMultiDimensionalArray($restaurantes_cercanos, "precio",$inverse = true);
              if(session('productos_filtrados')!==null){$productos_filtrados = orderMultiDimensionalArray($productos_filtrados, "precio",$inverse = true);}break;
              case 'NOMBRE_ASC': $restaurantes_cercanos = orderMultiDimensionalArray($restaurantes_cercanos, "nombre",$inverse = false);
              if(session('productos_filtrados')!==null){$productos_filtrados = orderMultiDimensionalArray($productos_filtrados, "nombre",$inverse = false);}break;
              case 'NOMBRE_DESC': $restaurantes_cercanos = orderMultiDimensionalArray($restaurantes_cercanos, "nombre",$inverse = true);
              if(session('productos_filtrados')!==null){$productos_filtrados = orderMultiDimensionalArray($productos_filtrados, "nombre",$inverse = true);}break;
              default :break;
          }
      }
      //CAMBIO NAVEGACION CAMBIO NAVEGACION           //CAMBIO NAVEGACION CAMBIO NAVEGACION      //CAMBIO NAVEGACION CAMBIO NAVEGACION
      else if(isset($request->modo_navegacion)){
          //hacemos el array de coordenadas destino
          $coordenadas_destino = "";
          foreach($restaurantes_cercanos as $plato){
              $coordenadas_destino .= $plato['lat'].",".$plato['lng']."|";
          }

          $manejadorREST = new Prest("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$request->lat.",".$request->lng."&destinations=".$coordenadas_destino."&mode=".$request->modo_navegacion."&language=es&key=".getKey());
          $distancia_datos = $manejadorREST->realizarPeticion();
          $contador = 0;
          foreach($restaurantes_cercanos as $index => $plato){
              if(session('productos_filtrados')!==null){
                    foreach($productos_filtrados as $key => $platoFiltrado){
                        if( $restaurantes_cercanos[$index]['id_restaurante']==$platoFiltrado['id_restaurante']){
                                $productos_filtrados[$key]['distanciaReal']=$distancia_datos["rows"][0]["elements"][$contador]["distance"]["text"];
                                $productos_filtrados[$key]['tiempoReal']=$distancia_datos["rows"][0]["elements"][$contador]["duration"]["text"];
                        }
                    }
                }
              $restaurantes_cercanos[$index]['distanciaReal']=$distancia_datos["rows"][0]["elements"][$contador]["distance"]["text"];
              $restaurantes_cercanos[$index]['tiempoReal']=$distancia_datos["rows"][0]["elements"][$contador]["duration"]["text"];
              $contador++;
          }
      }
      //GLOBALES
      if(session('productos_filtrados')!==null){
          session(['productos_filtrados' => $productos_filtrados]);
      }
       session(['restaurantes_cercanos' => $restaurantes_cercanos]);



       if(session('productos_filtrados')!==null){
          //RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
          $productos_filtrados = array_slice($productos_filtrados, 0,$LIMIT);
          $returnHTML = view('plato.ordenar')->with(array('restaurantes_cercanos' => $productos_filtrados))->render();
          }else{
          //RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
              //paginamos los restaurantes una vez ingresados en sesion
          $restaurantes_cercanos = array_slice($restaurantes_cercanos, 0,$LIMIT);
          $returnHTML = view('plato.ordenar')->with(array('restaurantes_cercanos' => $restaurantes_cercanos))->render();
      }
      return response()->json( array('success' => true, 'html'=>$returnHTML) );

  }
public function filtrarProductos(Request $request){

    //GLOBALES
    $LIMIT = env('LIMIT');
    $restaurantes_cercanos = session('restaurantes_cercanos');
    $claves_filtros = $request->formFiltros;

if(!isset($claves_filtros) || $claves_filtros==""){
    $request->session()->forget('productos_filtrados');
    //paginamos los restaurantes una vez ingresados en sesion
    $restaurantes_cercanos = array_slice($restaurantes_cercanos, 0, $LIMIT);
    //RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
    $returnHTML = view('plato.ordenar')->with(array('restaurantes_cercanos' => $restaurantes_cercanos))->render();
    return response()->json( array('success' => true, 'html'=>$returnHTML) );
}else{

    //FUNCIONES DE FILTROS
    function filtroCheckBox($arrayTodosRestaurantes,$tipo,$valor){
        $resultado = [];
        foreach($arrayTodosRestaurantes as $restaurante){
            if($restaurante[$tipo] == 1){
                array_push($resultado,$restaurante);
            }
        }
        return $resultado;
    }

        //Separamos los valores que nos llegan, vienen en forma de texto
        $filtros_split=explode("&",$claves_filtros);
        $filtros_split_definitivo = [];
        foreach($filtros_split as $name => $values){
            //recorremos el array creado al hacer el explode y volvemos a hacer otro
            $filtros_split2=explode("=",$values);
            //agregamos a un objeto el indice del nombre checkbox y si esta ON o no
            $filtros_split_definitivo[$filtros_split2[0]]=$filtros_split2[1];
        }

        foreach($filtros_split_definitivo as $nombreF => $valueF){
                switch ($nombreF) {

                    case 'estrella':
                    case 'domicilio':
                    case 'parking':
                    case 'terraza':
                    case 'favorito':
                    case 'destacado':
                    case 'eventos_deportivos':
                                if(isset($resultado)){
                                    $resultado = filtroCheckBox($resultado,$nombreF,$valueF);
                                }else{
                                    $resultado = filtroCheckBox($restaurantes_cercanos,$nombreF,$valueF);
                                }
                                    break;
                    default:
                        $resultado=null;
                        break;
                }
        }
}
        //guardamos en sesion los resultados filtrados
        session(['productos_filtrados' => $resultado]);
        //paginamos los restaurantes una vez ingresados en sesion
        $resultado = array_slice($resultado, 0,$LIMIT);
        //RETORNAMOS UN JSON CON LA VISTA RENDERIZADA
        $returnHTML = view('plato.ordenar')->with(array('restaurantes_cercanos' => $resultado))->render();


    return response()->json( array('success' => true, 'html'=>$returnHTML) );

}


public function create(Project $project)
{
  return view('platos.create', compact('project'));
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \App\Project $project
 * @return Response
 */
public function store(Project $project)
{
  //
}

/**
 * Display the specified resource.
 *
 * @param  \App\Project $project
 * @param  \App\Task    $task
 * @return Response
 */
public function show(Project $project, Task $task)
{
  return view('platos.show', compact('project', 'task'));
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Project $project
 * @param  \App\Task    $task
 * @return Response
 */
public function edit(Project $project, Task $task)
{
  return view('platos.edit', compact('project', 'task'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \App\Project $project
 * @param  \App\Task    $task
 * @return Response
 */
public function update(Project $project, Task $task)
{
  //
}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Project $project
 * @param  \App\Task    $task
 * @return Response
 */
 public function destroy(Request $request)
 {

      $id_plato =$request->input('id_plato');
      $id_restaurante =$request->input('id_restaurante');
      Plato::where('id_plato', '=', $id_plato)->delete();
      $restaurantes =Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)->get();
      $menus = Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)
    ->leftJoin('menus', 'menus.id_restaurante', '=', 'restaurantes.id_restaurante')
    ->leftJoin('platos', 'platos.id_menu', '=', 'menus.id_menu')
      ->get();



   return view('plato.borrar', compact('restaurantes','menus'));

 }
 public function mostrarPlatosBorrar(Request $request)
 {
   $id_restaurante =$request->input('prueba');


     $restaurantes =Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)->get();
     $menus = Restaurante::where('restaurantes.id_restaurante', '=', $id_restaurante)
   ->leftJoin('menus', 'menus.id_restaurante', '=', 'restaurantes.id_restaurante')
   ->leftJoin('platos', 'platos.id_menu', '=', 'menus.id_menu')
     ->get();


     return view('plato.borrar', compact('restaurantes','menus'));



 }
 public function crearPlatosRestauranteYaCreado(Request $request)
 {
   $datosRestaurante = $request->input('datos');
   $datosPlatos = $request->except('datos');
   $imagen = $request->get('imagen');
    $tiempo ="dia";


 foreach($datosPlatos as $arrayValores){
     if (is_array($arrayValores)){

             plato::insert(['id_menu' => $datosRestaurante['id_menu'], 'nombre' => $arrayValores['nombre'], 'precio' => $arrayValores['precio'], 'categoria_plato' => $arrayValores['categoria_plato'], 'icono' => $arrayValores['imagen']]);


     }
 }



return redirect()->action('HomeController@index');
 }

 }
