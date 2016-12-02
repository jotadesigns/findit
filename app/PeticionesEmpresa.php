<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeticionesEmpresa extends Model
{
    //    //
        protected $fillable = ['id_admin','id_restaurante','mensaje'];
    //

public function restaurante()
{
  return $this->belongsTo('App\Restaurante');
}
public function user(){
    return $this->belongsTo(User::class);
}

}
