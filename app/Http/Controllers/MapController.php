<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    //
    public function create(){
      return view('map.create');
    }

    public function store(Request $request){

    }
}
