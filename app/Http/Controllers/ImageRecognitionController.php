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
           'credentials' => config('rekognition.credentials'),
           'region' => config('rekognition.region'),
           'version' => config('rekognition.version')
       ];

       $this->client = new RekognitionClient($this->args);
    }

    public function index(){
      return view('features.imagerecognition');
    }

    public function detectimage(){

      //$fileName = time();
      //exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null');
      //file_get_contents("/snapshots/".$fileName.".jpg")


      $result = $this->client->detectLabels([
        'Image' => [
          'Bytes' => file_get_contents("images/obama.jpg"),
        ],
        'MaxLabels' => 10,
        'MinConfidence' => 20,

      ]);


      // $file = '/snapshots/' . $fileName;
      // unlink($file);




      return $result["Labels"];

    }

    public function detectface(){

      //$fileName = time();
      //exec('cgi-bin/takePic.cgi "'. ($fileName) . '" &> /dev/null');
      //file_get_contents("/snapshots/".$fileName.".jpg")


      $result = $this->client->detectFaces([
        'Attributes' => ['ALL'],
        'Image' => [
          'Bytes' => file_get_contents("images/obama.jpg"),
        ]

      ]);


      // $file = '/snapshots/' . $fileName;
      // unlink($file);




      return $result["FaceDetails"];

    }
}
