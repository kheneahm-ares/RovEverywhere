<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snapshot;
use Auth;

class SnapshotController extends Controller
{
    //
    public function index(){
      $user = Auth::user();

      $snapshots = Snapshot::where('user_id', $user->id)
                            ->orderby('created_at', 'desc')
                            ->get();
      return view('snapshots.index')->with('snapshots', $snapshots);
    }
}
