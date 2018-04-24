<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snapshot;
use App\Activity;
use Auth;
use File;
use Session;



class SnapshotController extends Controller
{
    //
    public function index(){
      $user = Auth::user();

      $snapshots = Snapshot::where('user_id', $user->id)
                            ->orderby('created_at', 'desc')
                            ->paginate(8);


      return view('snapshots.index')->with('snapshots', $snapshots);
    }

    public function delete($id){
      $snapshot = Snapshot::find($id);


      $file = 'uploads/snapshots/' . $snapshot->path;

      //check if file does or does not exist (bc snapshot was not taken on rover)
      if(File::exists($file)){
        //delete file
        unlink($file);
      }

      //delete from database
      $snapshot->delete();

      Session::flash('success', 'The snapshot has been deleted!');

      return redirect()->route('snapshots');


    }
}
