
<?php
use Carbon\Carbon;

function getBoundaries($lat, $lng, $distance = 1, $earthRadius = 6371)
{
    $return = array();

    // Los angulos para cada dirección
    $cardinalCoords = array('north' => '0',
                            'south' => '180',
                            'east' => '90',
                            'west' => '270');
    $rLat = deg2rad($lat);
    $rLng = deg2rad($lng);
    $rAngDist = $distance/$earthRadius;
    foreach ($cardinalCoords as $name => $angle)
    {
        $rAngle = deg2rad($angle);
        $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
        $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
         $return[$name] = array('lat' => (float) rad2deg($rLatB),
                                'lng' => (float) rad2deg($rLonB));
    }
    return array('min_lat'  => $return['south']['lat'],
                 'max_lat' => $return['north']['lat'],
                 'min_lng' => $return['west']['lng'],
                 'max_lng' => $return['east']['lng']);
}
function addToArray($indice,$valor,$array){
    return $array[$indice] = $valor;
}
//funcion para determinar si es de dia o de noche
function getTiempo()
{
    $locale = App::getLocale();
    $zona = langToZone($locale);

    $dt = Carbon::now('Europe/'.$zona);
    $HORACAMBIO = -1;
    $tiempo;

    if($dt->hour <= $HORACAMBIO ){
        $tiempo = "noche";
    }else{
        $tiempo = "dia";
    }
     return $tiempo;
}
//funcion para devolver la zona horaria en funcion del lenguaje
function langToZone($lang){
    $zone;
    switch ($lang) {
        case 'es':
            $zone = "Madrid";
            break;
        case 'en':
            $zone = "London";
            break;

        default:
            $zone = "Madrid";
            break;
    }
    return $zone;
}
//funcion para sacar el nivel de precio de un restaurante
function getStringPrice($price){
  $resultado = "";
  switch ($price) {
    case 0:
      $resultado = "gratis";
      break;
    case 1:
      $resultado = "barato";
      break;
    case 2:
      $resultado = "moderado";
      break;
    case 3:
      $resultado = "caro";
      break;
    case 4:
      $resultado = "muy caro";
      break;
    default:
      $resultado = "desconocido";
      break;
  }
  return $resultado;
}
?>
