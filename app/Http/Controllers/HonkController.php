<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HonkController extends Controller
{
    public function honkSound() {  
        exec('cgi-bin/playSound.cgi');
      }
}