<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller 
{
    public function panRight(){
        exec('cgi-bin/panRight.cgi');
  
      }
  
      public function panLeft(){
        exec('cgi-bin/panLeft.cgi');
        echo("Testing left");

      }
  
      public function panNeutral(){
        exec('cgi-bin/panNeutral.cgi');

      }
  
      public function tiltUp(){
        exec('cgi-bin/tiltUp.cgi');
  
      }
  
      public function tiltDown(){
        exec('cgi-bin/tiltDown.cgi');
  
      }
  
      public function panTiltNeutral(){
        exec('cgi-bin/panTiltNeutral.cgi');
      }
  
      public function panStop(){
        exec('cgi-bin/panStop.cgi');
  
      }
}