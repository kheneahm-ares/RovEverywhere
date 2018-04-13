<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekognition;
use Aws\Rekognition\RekognitionClient;


class ImageRecognitionController extends Controller
{
    //

    protected $client;

    public function __construct(){
       $this->args = [
           'credentials' => config('actualrekognition.credentials'),
           'region' => config('actualrekognition.region'),
           'version' => config('actualrekognition.version')
       ];

       $this->client = new RekognitionClient($this->args);
    }

    public function index(){

      return view('features.imagerecognition');
    }

    public function detectimage(){


      $fileName = time();
      exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null');
      //sleep(2);
      //print_r(file_get_contents("snapshots/".$fileName.".jpg"));
     // exit(1);
      $result = $this->client->detectLabels([
        'Image' => [
          'Bytes' => file_get_contents("snapshots/".$fileName.".jpg"),
        ],
        'MaxLabels' => 10,
        'MinConfidence' => 20,

      ]);


      $file = "snapshots/". $fileName.".jpg";
      unlink($file);



      return $result["Labels"];

    }

    public function detectface(){

      //$fileName = time();
      //exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null');
	    //file_get_contents("/snapshots/".$fileName.".jpg"
	    //)
      $fileName = time();
      exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null');


      $result = $this->client->detectFaces([
        'Attributes' => ['ALL'],
        'Image' => [
          'Bytes' => file_get_contents("snapshots/".$fileName.".jpg"),
        ]

      ]);


      $file = "snapshots/". $fileName.".jpg";
      unlink($file);




      return $result["FaceDetails"];

    }
}
