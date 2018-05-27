<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Fechas extends Eloquent {

    protected $collection = 'fechas';

    public function partidos() {
      return $this->hasMany(Partidos::class);
    }

}
