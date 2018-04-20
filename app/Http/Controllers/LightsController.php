<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LightsController extends Controller
{
    public function lightsOn() {  
        exec('cgi-bin/lighton.cgi');
    }

    public function lightsOff() {  
        exec('cgi-bin/lightoff.cgi');
    }
}