<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WheelController extends Controller
{
    //
    function forward(Request $request){

      exec('/cgi-bin/forward.cgi');

      return 1;

    }

    function stop(Request $request){

      exec('/cgi-bin/stop.cgi');

      return 1;

    }
}
