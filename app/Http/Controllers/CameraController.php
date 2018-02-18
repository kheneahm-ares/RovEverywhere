<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller 
{
    public function panRight(){
        exec('cgi-bin/panRight.cgi');
        echo("Right");

      }
  
      public function panLeft(){
        exec('cgi-bin/panLeft.cgi');
        echo("Left");

      }
  
      public function panNeutral(){
        exec('cgi-bin/panNeutral.cgi');
        echo("Horizontal Middle");

      }
  
      public function tiltLeft(){
        exec('cgi-bin/tiltLeft.cgi');
        echo("Up");

      }
  
      public function tiltRight(){
        exec('cgi-bin/tiltRight.cgi');
        echo("Down");
      }
  
      public function tiltNeutral(){
        exec('cgi-bin/panTiltNeutral.cgi');
        echo("Vertical Middle");

      }
  
      public function panStop(){
        exec('cgi-bin/panStop.cgi');
        echo("Stop Horiz");

      }

      public function tiltStop() {
        exec('cgi-bin/tiltStop.cgi');
        echo("Stop Vertic");

      }

      public function panTiltStop(){
        exec('cgi-bin/panTiltStop.cgi');
        echo("Stop Horiz");

      }
}