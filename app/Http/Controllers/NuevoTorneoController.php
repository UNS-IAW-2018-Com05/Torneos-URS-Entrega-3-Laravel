<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clubes;
use App\Fechas;
use App\Partidos;
use App\Helpers\Arbitro;

class NuevoTorneoController extends Controller
{

    public function index(){

      return view('nuevoTorneo', [ 'title' => 'Admin Torneos URS','clubes' => Clubes::all()]);
    }

    public function guardar(){
      $clubes = request('clubes');
      $roundrobin = array();
      $cantClubes = count($clubes);
      for($i=0; $i<$cantClubes; $i++){
        $roundrobin[$i] = $clubes[$i];
      }
      for($i=1; $i<$cantClubes; $i++){
        $fechaNueva = new Fechas;
        $fechaNueva->numero = $i;
        $fechaNueva->diasDeJuego = array(new \MongoDB\BSON\UTCDateTime(),new \MongoDB\BSON\UTCDateTime());
        $id_partidos = array();

        for($j=0; $j<$cantClubes/2; $j++){

          $equipoLocal = $roundrobin[$j];
          $equipoVisitante = $roundrobin[$j+$cantClubes/2];

          $partidoNuevo = new Partidos;
          $partidoNuevo->dia=new \MongoDB\BSON\UTCDateTime();;
          $partidoNuevo->hora='16.00';
          $partidoNuevo->local=new \MongoDB\BSON\ObjectId($equipoLocal);
          $partidoNuevo->visitante=new \MongoDB\BSON\ObjectId($equipoVisitante);
          $partidoNuevo->puntosLocal=0;
          $partidoNuevo->puntosVisitante=0;
          $partidoNuevo->estado="no iniciado";

          $arbitro =  new Arbitro();
          $arbitro->nombre = "Nestor";
          $arbitro->apeliido = "Pitana";

          $partidoNuevo->arbitro=$arbitro;
          $partidoNuevo->editor="";
          $partidoNuevo->save();
          $id_partidos[$j] = new \MongoDB\BSON\ObjectId($partidoNuevo->_id);
        }
        $fechaNueva->partidos = $id_partidos;
        $fechaNueva->save();
        for($i=1; $i<$cantClubes; $i++){
          for($k=1; $k<$cantClubes; $k++){
            $roundrobin[$k % $cantClubes] = $roundrobin[($k+1) % $cantClubes];
          }
        }
      }
      //return redirect('/editarTorneo');
    }
}
