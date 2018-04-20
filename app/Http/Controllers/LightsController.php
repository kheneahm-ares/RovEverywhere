<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LightsController extends Controller
{
    public function lightsOn() {
        $color = $_GET['rgb'];
        echo $color;
        exec('cgi-bin/lighton.cgi'. $color);
    }

    public function lightsOff() { 
        echo "lights off"; 
        exec('cgi-bin/lightoff.cgi');
    }
}