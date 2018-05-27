<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditarTorneoController extends Controller
{
    public function index(){
      return view('editarTorneo', [ 'title' => 'Admin Torneos URS']);
    }
}
