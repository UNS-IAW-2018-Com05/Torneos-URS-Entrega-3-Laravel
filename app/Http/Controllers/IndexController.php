<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
  public function index(){
    return view('layout', [ 'title' => 'Admin Torneos URS' , 'admin'=>Auth::user()->name]);
  }
}
