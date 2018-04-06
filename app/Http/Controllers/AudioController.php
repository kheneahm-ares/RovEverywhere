<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function playSound() {
      $selectOption = $_GET['mp3Files'];
      echo $selectOption;

      exec('cgi-bin/playSound.cgi ' .$selectOption);
    }

    public function pauseSound() {
      $selectOption = $_GET['mp3Files'];
      echo $selectOption;

      exec('cgi-bin/playSound.cgi ' .$selectOption);
    }
}
