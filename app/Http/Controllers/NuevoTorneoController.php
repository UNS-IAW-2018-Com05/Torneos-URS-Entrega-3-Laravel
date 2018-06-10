<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clubes;
use App\Fechas;
use App\Partidos;
use App\Helpers\Arbitro;
use Auth;

class NuevoTorneoController extends Controller
{

    public function index(){

      return view('nuevoTorneo', [ 'title' => 'Admin Torneos URS','clubes' => Clubes::all(),'admin'=>Auth::user()->name]);
    }

    public function guardar(){
      Fechas::truncate();
      Partidos::truncate();
      $clubes = request('clubes');
      $roundrobin = array();
      $cantClubes = count($clubes);
      for($i=0; $i<$cantClubes; $i++){
        $roundrobin[$i] = $clubes[$i];
      }
      if($cantClubes % 2 != 0){
        $roundrobin[$cantClubes] = "";
        $cantClubes = count($roundrobin);
      }

      $diaDeJuego1 = strtotime('first saturday');
      $diaDeJuego2 = strtotime("+1 day", $diaDeJuego1);
      for($i=1; $i<$cantClubes; $i++){
        $fechaNueva = new Fechas;
        $fechaNueva->numero = $i;
        $fechaNueva->diasDeJuego = array(new \MongoDB\BSON\UTCDateTime($diaDeJuego1*1000),new \MongoDB\BSON\UTCDateTime($diaDeJuego2*1000));
        $id_partidos = array();
        $principio = 0; $fin = $cantClubes-1;
        while($principio<$fin){
          if($roundrobin[$principio] != "" && $roundrobin[$fin] != ""){
            if($principio == 0){
              if($i % 2 !=0){
                $equipoLocal = $roundrobin[$principio];
                $equipoVisitante = $roundrobin[$fin];
              }
              else{
                $equipoLocal = $roundrobin[$fin];
                $equipoVisitante = $roundrobin[$principio];
              }
            }
            else{
              $equipoLocal = $roundrobin[$principio];
              $equipoVisitante = $roundrobin[$fin];
            }

            $partidoNuevo = new Partidos;
            $partidoNuevo->dia='';
            $partidoNuevo->hora='';
            $partidoNuevo->local=new \MongoDB\BSON\ObjectId($equipoLocal);
            $partidoNuevo->visitante=new \MongoDB\BSON\ObjectId($equipoVisitante);
            $partidoNuevo->puntosLocal=0;
            $partidoNuevo->puntosVisitante=0;
            $partidoNuevo->estado="no iniciado";

            $arbitro =  new Arbitro();
            $arbitro->nombre = "Nestor";
            $arbitro->apellido = "Pitana";

            $partidoNuevo->arbitro=$arbitro;
            $partidoNuevo->editor="";
            $partidoNuevo->save();
            $id_partidos[$principio] = new \MongoDB\BSON\ObjectId($partidoNuevo->_id);
          }
          $principio++; $fin--;
        }

        $fechaNueva->partidos = $id_partidos;
        $fechaNueva->save();

        $diaDeJuego1 = strtotime("+7 day", $diaDeJuego1);
        $diaDeJuego2 = strtotime("+1 day", $diaDeJuego1);

        $primero = $roundrobin[1];
        for($k=1; $k<$cantClubes-1; $k++){
          $roundrobin[$k] = $roundrobin[$k+1];
        }
        $roundrobin[$cantClubes-1] = $primero;
      }
      return redirect('/editarTorneo');
    }
}
