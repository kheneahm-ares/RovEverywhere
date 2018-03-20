<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snapshot;
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

        exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null &');
    }

<<<<<<< HEAD
      public function panMovement() {
        $freq=$_GET['freq'];
        exec('cgi-bin/panMovement.cgi"' . $freq . '" &> /dev/null &');
        
        return $freq;
      }

      public function tiltMovement() {
        $freq=$_GET['freq'];
        exec('cgi-bin/tiltMovement.cgi"' . $freq . '" &> /dev/null &');

        return $freq;
      }

      public function panTiltNeutral(){
=======
    public function panRight()
    {
        exec('cgi-bin/panRight.cgi');
        echo("Right");
    }

    public function panLeft()
    {
        exec('cgi-bin/panLeft.cgi');
        echo("Left");
    }

    public function panNeutral()
    {
        exec('cgi-bin/panNeutral.cgi');
        echo("Horizontal Middle");
    }

    public function tiltLeft()
    {
        exec('cgi-bin/tiltLeft.cgi');
        echo("Up");
    }

    public function tiltRight()
    {
        exec('cgi-bin/tiltRight.cgi');
        echo("Down");
    }

    public function tiltNeutral()
    {
        exec('cgi-bin/panTiltNeutral.cgi');
        echo("Vertical Middle");
    }

    public function panStop()
    {
        exec('cgi-bin/panStop.cgi');
        echo("Stop Horiz");
    }

    public function tiltStop()
    {
        exec('cgi-bin/tiltStop.cgi');
        echo("Stop Vertic");
    }

    public function panTiltNeutral()
    {
>>>>>>> 0ddeea2be95078d57f7a3125ae19aef13332d070
        exec('cgi-bin/panTiltNeutral.cgi');
        echo("Stop Horiz");
    }
}
