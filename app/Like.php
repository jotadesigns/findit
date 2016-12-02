<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    //
    public function plato()
{
  return $this->belongsTo('App\Plato');
}

public function restaurante()
{
  return $this->belongsTo('App\Restaurante');
}
public function user(){
    return $this->belongsTo(User::class);
}

}
