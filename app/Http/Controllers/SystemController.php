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
      exec('cgi-bin/restart.cgi');

      return "restarted!";
    }
    public function shutdown(Request $request){
      //exec command to shut down
      exec('cgi-bin/shutdown.cgi');

      return "shutting down!";
    }

    public function refresh(Request $request){
      $sysTime = $this->getSysTime();
      $uptime = $this->getUpTime();

      // print_r($sysTime);
      // print_r($uptime);



      $system_data = array(
                    'systime' => $sysTime,
                    'uptime' => $uptime,
                    'cpu_usage' => 3,
                    'internet' => False );
      return $system_data;
    }


    private function getSysTime(){
      $output = shell_exec('cgi-bin/sys_time.cgi');

      if($output != ""){
        return $output;
      }

      return -1;
    }

    private function getUpTime(){
      $output = shell_exec('cgi-bin/uptime.cgi');

      if($output != ""){
        return $output;
      }

      return -1;
    }
}
