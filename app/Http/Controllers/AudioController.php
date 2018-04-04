<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function playSound() {
      $selectOption = $_GET['mp3Files'];
      echo $selectOption;
      exec('sudo omxplayer /var/www/Roveverywhere/publicsounds/'.$selectOption);
    }

    public function pauseSound() {
      $selectOption = $_GET['mp3Files'];
      echo $selectOption;
      exec('sudo omxplayer /var/www/Roveverywhere/publicsounds/'.$selectOption);
    }
}
