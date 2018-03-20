<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snapshot;
use App\Activity;
use Auth;

class CameraController extends Controller
{
    public function takePicture()
    {
        $user = Auth::user();
        $fileName = time();
        $snapshot = new Snapshot;
        $snapshot->path = $fileName;
        $snapshot->user_id = $user->id;

        $snapshot->save();

        //everytime we make a snapshot successfully, we create an activity for it also
        $newActivity = new Activity;
        $newActivity->user_id = $user->id;
        $newActivity->type = "snapshot";
        $newActivity->save();

        exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null &');
    }

      public function panMovement() {
        $freq=$_GET['freq'];
        exec('cgi-bin/panMovement.cgi "' . $freq . '" &> /dev/null &');

        return $freq;
      }

      public function tiltMovement() {
        $freq=$_GET['freq'];
        exec('cgi-bin/tiltMovement.cgi "' . $freq . '" &> /dev/null &');

        return $freq;
      }

    public function panTiltNeutral() {
        exec('cgi-bin/panTiltNeutral.cgi');
        echo("Stop Horiz");
    }
}
