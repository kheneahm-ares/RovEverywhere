<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WheelController extends Controller
{
    //
    public function forward(){
      $pwm = $_GET['pwm'];

      exec('cgi-bin/forward.cgi "'. ($pwm) . '" &> /dev/null &');

      return $pwm;

    }

    public function reverse(){
      $pwm = $_GET['pwm'];

      exec('cgi-bin/reverse.cgi "'. ($pwm) . '" &> /dev/null &');

      return $pwm;

    }

    public function left(){
      $pwm = $_GET['pwm'];

      exec('cgi-bin/left.cgi "'. ($pwm) . '" &> /dev/null &');

      return $pwm;

    }

    public function right(){
      $pwm = $_GET['pwm'];

      exec('cgi-bin/right.cgi "'. ($pwm) . '" &> /dev/null &');

      return $pwm;

    }

    public function stop(){

      exec('cgi-bin/stop.cgi &> /dev/null &');
      
      return 1;

    }
}
