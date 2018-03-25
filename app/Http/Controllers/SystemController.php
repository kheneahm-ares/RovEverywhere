<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    //
    public function index(){
      return view('system.index');
    }

    public function restart(Request $request){
      //exec command to restart

      return "restarted!";
    }
    public function shutdown(Request $request){
      //exec command to shut down
      return "shutting down!";
    }

    public function refresh(Request $request){
      $system_data = array(
                    'systime' => 1,
                    'uptime' => 2,
                    'cpu_usage' => 3,
                    'internet' => False );
      return $system_data;
    }
}
