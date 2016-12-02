<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    public function plato()
{
  return $this->hasMany('App\Plato');
}

public function restaurante()
{
  return $this->belongsTo('App\Restaurante');
}
}
