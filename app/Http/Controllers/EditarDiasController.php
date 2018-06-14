<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JoinTablas;
use App\Fechas;
use App\Partidos;
use Auth;

class EditarDiasController extends Controller
{
  public function index(){
    $helper = new JoinTablas();
    $fechas = $helper->juntarTablas(Fechas::all());
    return view('editarDias', [ 'title' => 'Admin Torneos URS',
                                  'fechas' => $fechas,'admin'=>Auth::user()->name]);
  }

  public function guardar(){
    $partidoAgregarDiaDeJuego = Partidos::where('_id', new \MongoDB\BSON\ObjectId(request('partido')))->first();
    $time = strtotime(request('dia')) * 1000;
    $partidoAgregarDiaDeJuego->dia = new \MongoDB\BSON\UTCDateTime($time);
    $partidoAgregarDiaDeJuego->hora = request('hora');
    $partidoAgregarDiaDeJuego->save();
    return redirect('/editarDias');
  }

}
