<?php

namespace App\Helpers;
use App\Partidos;
use App\Clubes;

class JoinTablas{

  public function juntarTablas($fechas){
    foreach ($fechas as &$fecha) {
      $fecha->partidos = Partidos::findMany($fecha->partidos);
      foreach ($fecha->partidos as &$partido){
        $partido->local = Clubes::where('_id', new \MongoDB\BSON\ObjectId($partido->local))->first()->nombre;
        $partido->visitante = Clubes::where('_id', new \MongoDB\BSON\ObjectId($partido->visitante))->first()->nombre;
      }
    }
    return $fechas;
  }

}

 ?>
