<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller 
{
    public function panRight(){
        exec('cgi-bin/panRight.cgi');
  
        return 1;
  
      }
  
      public function panLeft(){
        exec('cgi-bin/panLeft.cgi');
  
        return 1;
  
      }
  
      public function panNeutral(){
        exec('cgi-bin/panNeutral.cgi');
  
        return 1;
  
      }
  
      public function tiltUp(){
        exec('cgi-bin/tiltUp.cgi');
  
        return 1;
  
      }
  
      public function tiltDown(){
        exec('cgi-bin/tiltDown.cgi');
  
        return 1;
  
      }
  
      public function panTiltNeutral(){
        exec('cgi-bin/panTiltNeutral.cgi');
  
        return 1;
  
      }
  
      public function panStop(){
        exec('cgi-bin/panStop.cgi');
  
        return 1;
  
      }
}