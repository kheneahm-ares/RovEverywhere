<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UploadedPicture;
use App\Activity;
use Session;
use Auth;
use Image;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class MapController extends Controller
{

    public function index(){
        //get user
        $user = Auth::user();
        //grab all pictures in pictures table belonging to user
        $picturesData = UploadedPicture::where('user_id', $user->id)->paginate(5);

        return view('map.index')->with('picturesData', $picturesData);
    }

    public function details($id){
      //get uploaded picture based on pic id
      $picture = UploadedPicture::where('id','=',$id)->first();
      return view('map.details')->with('picture', $picture);
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
      $picture = new UploadedPicture;
      $picture->name = $request->name;
      $picture->address = $request->address;
      $picture->lat = $request->lat;
      $picture->lng = $request->lng;
      $picture->date_taken = date('Y-m-d', strtotime($request->date_taken));


      //get user
      $user = Auth::user();
      $picture->user_id = $user->id;

      $imageName = time().'.'.request()->path->getClientOriginalExtension();


      //we need a conditional statement to check if picture is bigger than x*x
      //then we need to resize
      request()->path->move(public_path('uploads/pictures'), $imageName);
      $picture->path = $imageName;


      //everytime we make an upload successfully, we create an activity for it also
      $newActivity = new Activity;
      $newActivity->user_id = $user->id;
      $newActivity->type = "upload";


      //save to database
      $picture->save();
      $newActivity->save();

      Session::flash('success', 'The picture has been stored!');


      return redirect()->route('map.index'); //url only not actual "html" page

    }

    public function edit($id){
      $uploadedPicture = UploadedPicture::find($id);

      return view('map.edit')->with('uploadedPicture', $uploadedPicture);
    }

    public function update(Request $request, $id){
      $this->validate($request, array(
        'name' => 'required|max:255',
        'address' => 'required',
        'lat' => 'required',
        'lng' => 'required',
      ));


      //edit specified picture based on id
      $picture = UploadedPicture::find($id);

      $picture->name = $request->name;
      $picture->address = $request->address;
      $picture->lat = $request->lat;
      $picture->lng = $request->lng;
      $picture->date_taken = date('Y-m-d', strtotime($request->date_taken));


      //get user
      $user = Auth::user();
      $picture->user_id = $user->id;

      $file = 'uploads/pictures/' . $picture->path;


      //if the user updated the browse input
      if(!File::exists($file)){

        $imageName = time().'.'.request()->path->getClientOriginalExtension();

        //delete the older picture
        $file = 'uploads/pictures/' . $picture->path;
           if (File::exists($file)) {
             unlink($file);
        }

        request()->path->move(public_path('uploads/pictures'), $imageName);
        $picture->path = $imageName;
      }
      //else keep the image in there and just change everything else
      $picture->touch();
      $picture->save();



      Session::flash('success', 'The picture has been updated!');

      return redirect()->route('map.index'); //url only not actual "html" page

    }

    public function delete($id)
    {
      // find post in database
      $picture = UploadedPicture::find($id);
      //delete post and pictures
      $file = 'uploads/pictures/' . $picture->path;

      if(File::exists($file)){
        unlink($file);
      }
      //delete from db
      $picture->delete();
      //show that it deleted using flash Session
      Session::flash('success', 'The picture has been deleted!');
      //redirect to all posts aka index
      return redirect()->route('map.index');
    }

    public function search(Request $request){
      $picturesData = UploadedPicture::where('name', 'like', '%'.$request->search.'%')->paginate(5);

      return view('map.search')->with("picturesData", $picturesData);
    }
}
