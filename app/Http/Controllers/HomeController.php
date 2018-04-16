<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadedPicture;
use App\Snapshot;
use App\Activity;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $user = Auth::user();


        //get all uploads
        $uploadedPictures = UploadedPicture::where('user_id', $user->id)
                            ->orderby('created_at', 'desc')
                            ->get();

        $date_today = date('d/m/Y');
        //6 days and not 7 bc we are including today
        $date_six_days_ago = date('d/m/Y', strtotime('-6 days'));
        $date_five_days_ago = date('d/m/Y', strtotime('-5 days'));
        $date_four_days_ago = date('d/m/Y', strtotime('-4 days'));
        $date_three_days_ago = date('d/m/Y', strtotime('-3 days'));
        $date_two_days_ago = date('d/m/Y', strtotime('-2 days'));
        $date_one_days_ago = date('d/m/Y', strtotime('-1 days'));

        $dates = array($date_six_days_ago, $date_five_days_ago,
                      $date_four_days_ago, $date_three_days_ago,
                      $date_two_days_ago, $date_one_days_ago,
                      $date_today);


        $size = count($uploadedPictures);
        $dateArray = array(
          $date_six_days_ago => 0,
          $date_five_days_ago => 0,
          $date_four_days_ago => 0,
          $date_three_days_ago => 0,
          $date_two_days_ago  => 0,
          $date_one_days_ago => 0,
          $date_today => 0
        );

        //compute uploaded picture array ($dateArray) values
        foreach($uploadedPictures as $uploaded){
            $picDate = date_create((string)$uploaded->created_at);
            $dateFormat = date_format($picDate,'d/m/Y');

            switch($dateFormat){
              case $date_six_days_ago : $dateArray[$date_six_days_ago]++;break;
              case $date_five_days_ago : $dateArray[$date_five_days_ago]++;break;
              case $date_four_days_ago : $dateArray[$date_four_days_ago]++;break;
              case $date_three_days_ago : $dateArray[$date_three_days_ago]++;break;
              case $date_two_days_ago : $dateArray[$date_two_days_ago]++;break;
              case $date_one_days_ago : $dateArray[$date_one_days_ago]++;break;
              case $date_today : $dateArray[$date_today]++;break;
            }

        }
        //print_r($dateArray);

        //get all Snapshots
        $snapshots = Snapshot::where('user_id', $user->id)
                            ->orderby('created_at', 'desc')
                            ->get();

        //compute snapshots array ($dateArray) values
        $snapshotsArray = array(
          $date_six_days_ago => 0,
          $date_five_days_ago => 0,
          $date_four_days_ago => 0,
          $date_three_days_ago => 0,
          $date_two_days_ago  => 0,
          $date_one_days_ago => 0,
          $date_today => 0
        );

        foreach($snapshots as $snaps){
            $picDate = date_create((string)$snaps->created_at);
            $dateFormat = date_format($picDate,'d/m/Y');

            //if the date has already past the date six days ago,
            //since we ordered desc, we know that everything past that
            //is also less so no need to traverse anymore
            if($dateFormat < $date_six_days_ago){
              break;
            }
            
            switch($dateFormat){
              case $date_six_days_ago : $snapshotsArray[$date_six_days_ago]++;break;
              case $date_five_days_ago : $snapshotsArray[$date_five_days_ago]++;break;
              case $date_four_days_ago : $snapshotsArray[$date_four_days_ago]++;break;
              case $date_three_days_ago : $snapshotsArray[$date_three_days_ago]++;break;
              case $date_two_days_ago : $snapshotsArray[$date_two_days_ago]++;break;
              case $date_one_days_ago : $snapshotsArray[$date_one_days_ago]++;break;
              case $date_today : $snapshotsArray[$date_today]++;break;
            }

        }

        //get 3 most recent activities
        $activities = Activity::orderBy('created_at', 'desc')->take(3)->get();


      	//get temp
        $temp_string = exec('cgi-bin/temperature.cgi');
        if(empty($temp_string)){
          $fahr = 0.0;
        	$humid = 0.0;
          $internal = 0.0;
        }
        else{
          $temps = explode(" ", $temp_string); //split by spaces
          $fahr = $temps[0];
          $humid = $temps[1];
          $internal = exec('cgi-bin/internal_temp.cgi');
        }

        return view('home')->with('dateArray', $dateArray)
                          ->with('dates', $dates)
                          ->with('snapshots', $snapshotsArray)
			  ->with('activities', $activities)
			  ->with('fahr', $fahr)
			  ->with('humid', $humid)
        ->with('internal', $internal);
    }
}
