<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clubes;
use App\Helpers\Jugador;

class AgregarClubesController extends Controller
{

  public function show(){

    return view('AgregarClubesView', [ 'title' => 'Admin Torneos URS','clubes' => Clubes::all()]);
  }

  public function guardar(){
    $clubNuevo = new Clubes;
    $clubNuevo->nombre = request('nombre');
    $clubNuevo->descripcion = request('descripcion');
    $clubNuevo->link = request('link');

    $image = request()->file('escudo');
    $name = time().'.'.$image->getClientOriginalExtension();
    $destinationPath = public_path('/images');
    $image->move($destinationPath, $name);
    $clubNuevo->escudo = $name;

    $nombresJugadores = request('nombres');
    $apellidoJugadores = request('apellido');
    $posicionJugadores = request('posicion');
    $jugadores = array();
    for($i=0 ; $i<count($posicionJugadores) ; $i++) {
      $jugador =  new Jugador();
      if(!is_null($nombresJugadores[$i])){
        $jugador->nombre = $nombresJugadores[$i];
      }
      if(!is_null($apellidoJugadores[$i])){
        $jugador->apellido = $apellidoJugadores[$i];
      }
      $jugador->posicion = $posicionJugadores[$i];
      $jugadores[$i] = $jugador;
    }

    $clubNuevo->jugadores = $jugadores;
    $clubNuevo->save();
  }
}
