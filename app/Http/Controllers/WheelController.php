<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WheelController extends Controller
{
    //
    public function forward(Request $request){

      exec('cgi-bin/forward.cgi');

      return 1;

    }

    public function stop(Request $request){

      exec('cgi-bin/stop.cgi');

      return 1;

    }
}
