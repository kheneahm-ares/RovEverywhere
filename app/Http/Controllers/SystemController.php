<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    //
    public function index(){
      //exec command to store user information in text file
      exec('cgi-bin/addresses.cgi');
      $ips = array();
      $macs = array();
      $brands = array();
      $lines = file(storage_path('addresses.txt'));
      foreach ($lines as $line) {
        $ips[] = explode(" ", $line)[0];
        $macs[] = explode(" ", $line)[1];
        $brands[] = explode(" ", $line)[2];
      }

      return view('system.index', compact('ips', 'macs', 'brands', 'lines'));
    }

    public function restartNetwork(){
	    shell_exec("/root/restartNetwork.sh");

      return "network restarted!";
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

    public function networkInfo() {
      //exec command to store user information in text file
      exec('cgi-bin/addresses.cgi');
      $ip = array();
      $mac = array();
      $brand = array();
      $lines = file(storage_path('addresses.txt'));
      $count = -1;
      echo "<table>";
        echo "<tr>";
          echo "<th> IP Address </th>";
          echo "<th> MAC Address </th>";
          echo "<th> Brand </th>";
        echo "</tr>";
      foreach ($lines as $line) {
        $count +=1;
        echo "<tr>";
          $ip[] = explode(" ", $line)[0];
          echo "<td>$ip[$count]</td>";
          $mac[] = explode(" ", $line)[1];
          echo "<td>$mac[$count]</td>";
          $brand[] = explode(" ", $line)[2];
          echo "<td>$brand[$count]</td>";
        echo "</tr>";
      }
      echo "</table>";

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
