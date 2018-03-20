<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function takePicture(){
      $fileName = time();
      exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null &');
    }

      public function panMovement() {
        $freq=$_GET['freq'];
        exec('cgi-bin/panMovement.cgi"' . $freq . '" &> /dev/null &');
        
        return $freq;
      }

      public function tiltMovement() {
        $freq=$_GET['freq'];
        exec('cgi-bin/tiltMovement.cgi"' . $freq . '" &> /dev/null &');

        return $freq;
      }

      public function panTiltNeutral(){
        exec('cgi-bin/panTiltNeutral.cgi');
        echo("Stop Horiz");

      }
}
