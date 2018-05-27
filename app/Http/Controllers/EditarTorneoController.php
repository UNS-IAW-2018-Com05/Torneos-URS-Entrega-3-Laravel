<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fechas;

class EditarTorneoController extends Controller
{
    public function index(){
      Fechas::all();
      return view('editarTorneo', [ 'title' => 'Admin Torneos URS','fechas' => Fechas::all()]);
    }
}
