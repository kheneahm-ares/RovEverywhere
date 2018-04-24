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

    public function speak(Request $request){
      $phrase = $request->phrase;
      $range = $request->range;

      exec('sudo amixer cset numid=1 "'. ($range). '"% &> /dev/null');
      exec('cgi-bin/voice.cgi "'. ($phrase) . '" &> /dev/null');
      return $phrase;
      
    }
}
