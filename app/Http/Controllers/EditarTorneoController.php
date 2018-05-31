<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fechas;
use App\Partidos;
use App\Usuarios;
use App\Helpers\JoinTablas;

class EditarTorneoController extends Controller
{
    public function index(){
      $helper = new JoinTablas();
      $fechas = $helper->juntarTablas(Fechas::all());
      $editores = Usuarios::where('editor',true)->get();
      return view('editarTorneo', [ 'title' => 'Admin Torneos URS',
                                    'fechas' => $fechas,
                                  'editores' => $editores]);
    }
}
