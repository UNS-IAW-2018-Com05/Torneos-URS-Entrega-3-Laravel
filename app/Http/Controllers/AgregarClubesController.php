<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clubes;

class AgregarClubesController extends Controller
{

  public function show(){

    return view('AgregarClubesView', [ 'title' => 'Admin Torneos URS','clubes' => Clubes::all()]);
  }
}
