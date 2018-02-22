<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Picture;
use Session;
use Auth;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class MapController extends Controller
{

    public function index(){
        //get user
        $user = Auth::user();
        //grab all pictures in pictures table belonging to user
        $picturesData = Picture::where('user_id', $user->id)->get();

        return view('map.index')->with('picturesData', $picturesData);
    }


    //creating
    public function create(){
      return view('map.create');
    }

    //post request to store picture data to database
    public function store(Request $request){
        //validate the database
        //if there is an error, it jumps back to create fxn and show errors
        $this->validate($request, array(
          'name' => 'required|max:255',
          'address' => 'required',
          'lat' => 'required',
          'lng' => 'required',
          'path' => 'required'
        ));

      //create new picture
      $picture = new Picture;
      $picture->name = $request->name;
      $picture->address = $request->address;
      $picture->lat = $request->lat;
      $picture->lng = $request->lng;

      //get user
      $user = Auth::user();
      $picture->user_id = $user->id;

      $imageName = time().'.'.request()->path->getClientOriginalExtension();

      request()->path->move(public_path('uploads/pictures'), $imageName);
      $picture->path = $imageName;
      $picture->save();

      Session::flash('success', 'The picture has been stored!');


      return redirect()->route('map.index', $user->id); //url only not actual "html" page

    }
}
