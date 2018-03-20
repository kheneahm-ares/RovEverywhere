<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeatureController extends Controller
{
    //
    public function rover(){
      exec('cgi-bin/panTiltNeutral.cgi');
      return view('features.rover');
    }
}
