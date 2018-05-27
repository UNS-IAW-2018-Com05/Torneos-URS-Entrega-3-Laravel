<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fechas;
use App\Partidos;

class EditarTorneoController extends Controller
{
    public function index(){
      $partidos = Fechas::first();
      return view('editarTorneo', [ 'title' => 'Admin Torneos URS',
                                    'fechas' => Fechas::all(),
                                  'partidos' => $partidos->_id]);
    }
}
