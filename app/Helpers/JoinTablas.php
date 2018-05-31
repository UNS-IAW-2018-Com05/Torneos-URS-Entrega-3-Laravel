<?php

namespace App\Helpers;
use App\Partidos;

class JoinTablas{

  public function juntarTablas($fechas){
    foreach ($fechas as &$fecha) {
      $fecha->partidos = Partidos::findMany($fecha->partidos);
    }
    return $fechas;
  }

}

 ?>
