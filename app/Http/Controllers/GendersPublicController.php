<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GendersPublicController extends Controller
{
    public function Gender(){
        return view('client.genders');
    }
}
