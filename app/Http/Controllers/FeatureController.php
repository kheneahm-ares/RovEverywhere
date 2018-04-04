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

    public function playSound() {
      $selectOption = $_GET['mp3Files'];
      echo $selectOption;
      //exec('sudo omxplayer sounds/'.$selectOption);
    }

    public function pauseSound() {
      $selectOption = $_GET['mp3Files'];
      echo $selectOption;
      //exec('sudo omxplayer sounds/'.$selectOption);
    }
}
