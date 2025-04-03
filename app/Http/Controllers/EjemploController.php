<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EjemploController extends Controller
{
    public function Ejemplo(){
        return view('admon.home');
    }
}