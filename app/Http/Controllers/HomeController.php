<?php

namespace App\Http\Controllers;

include_once (app_path().'/funcionesGlobales.php');

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $tiempo = getTiempo();
          return view('welcome',compact('tiempo'));
    }

}
