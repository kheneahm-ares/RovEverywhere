<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "HomeController@index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Map Routes*/
Route::get('/map', 'MapController@index')->name('map.index')->middleware('auth');
Route::get('/map/details/{id}', 'MapController@details')->name('map.details')->middleware('auth');
Route::get('/map/edit/{id}', 'MapController@edit')->name('map.edit')->middleware('auth');
Route::get('/map/create', 'MapController@create')->name('map.create')->middleware('auth');
Route::get('/map/search', 'MapController@search')->name('map.search')->middleware('auth');
Route::post('/map/store', 'MapController@store')->name('map.store')->middleware('auth');
Route::put('/map/update/{id}', 'MapController@update')->name('map.update')->middleware('auth');
Route::delete('/map/delete/{id}', 'MapController@delete')->name('map.delete')->middleware('auth');


Route::middleware('auth')->group(function(){
  /*System Routes*/
  Route::post('/system/restart', 'SystemController@restart')->name('restart');
  Route::post('/system/shutdown', 'SystemController@shutdown')->name('shutdown');
  Route::post('/system/refresh', 'SystemController@refresh')->name('refresh');


  /*Wheel Routes*/
  Route::get('/forward/{pwm}', 'WheelController@forward')->name('forward');
  Route::get('/reverse/{pwm}', 'WheelController@reverse')->name('reverse');
  Route::get('/left/{pwm}', 'WheelController@left')->name('left');
  Route::get('/right/{pwm}', 'WheelController@right')->name('right');
  Route::get('/takePic', 'CameraController@takePicture')->name('takePic');


  /*Snapshot Routes */
  Route::get('/snapshots/index', 'SnapshotController@index')->name('snapshots');
  Route::delete('/snapshots/{id}', 'SnapshotController@delete')->name('snapshots.delete');

  /*Feature Rover Routes*/
  Route::get('/features/rover', 'FeatureController@rover')->name('rover');
  Route::post('/features/speak/{phrase}', 'FeatureController@speak')->name('speak');

  /*Feature Audio Player Routes*/
  Route::get('/features/playSound', 'AudioController@playSound')->name('playSound');
  Route::get('/features/pauseSound', 'AudioController@pauseSound')->name('pauseSound');

  /*Feature Image Recognition Routes*/
  Route::get('/features/imagerecognition', 'ImageRecognitionController@index')->name('imagerec');
  Route::post('/features/imagerecognition/detectimage', 'ImageRecognitionController@detectimage')->name('detectimage');
  Route::post('/features/imagerecognition/detectface', 'ImageRecognitionController@detectface')->name('detectface');

  /*Wheel Routes*/
  Route::get('/forward/{pwm}', 'WheelController@forward')->name('forward');
  Route::get('/reverse/{pwm}', 'WheelController@reverse')->name('reverse');
  Route::get('/left/{pwm}', 'WheelController@left')->name('left');
  Route::get('/right/{pwm}', 'WheelController@right')->name('right');
  Route::get('/stop', 'WheelController@stop')->name('stop');

  /*Cam Routes*/
  Route::get('/takePic', 'CameraController@takePicture')->name('takePic');
  Route::get('/panMovement/{freq}', 'CameraController@panMovement')->name('panMovement');
  Route::get('/tiltMovement/{tiltFreq}', 'CameraController@tiltMovement')->name('tiltMovement');
  Route::get('/panTiltNeutral', 'CameraController@panTiltNeutral')->name('panTiltNeutral');
  Route::get('/panStop', 'CameraController@panStop')->name('panStop');
  Route::get('/tiltStop', 'CameraController@tiltStop')->name('tiltStop');
  Route::get('/stop', 'WheelController@stop')->name('stop');

  /*System Routes*/
  Route::get('/system', 'SystemController@index')->name('system');
});
