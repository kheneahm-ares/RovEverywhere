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
  Route::post('/system/restartNetwork', 'SystemController@restartNetwork')->name('restartNetwork');



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
  Route::post('/features/speak/{phrase}/{range}', 'FeatureController@speak')->name('speak');

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

  /*Honk Routes*/
  Route::get('/features/honkSound', 'HonkController@honkSound')->name('honkSound');

  /*Lights Routes*/
  Route::get('/features/lightsOn/{rgb}', 'LightsController@lightsOn')->name('lightsOn');
  Route::get('/features/lightsOff', 'LightsController@lightsOff')->name('lightsOff');

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

  /*Network Routes*/
  Route::get('/network', 'NetworkManager@index')->name('network');
  Route::get('/network/add', 'NetworkManager@add')->name('addnetwork');
  Route::get('/network/edit', 'NetworkManager@edit')->name('editnetwork');
  Route::get('/network/destroy', 'NetworkManager@destroy')->name('destroynetwork');

  Route::get('/network/add/new/none', 'NetworkManager@newnone')->name('newnonenetwork');
  Route::get('/network/add/new/wpapsk', 'NetworkManager@newwpapsk')->name('newwpapsknetwork');
  Route::get('/network/add/new/mschapv2', 'NetworkManager@newmschapv2')->name('newmschapv2network');

  Route::post('/network/edit/current', 'NetworkManager@editCurrent')->name('editform');


  Route::post('/network/add/none', 'NetworkManager@none')->name('addnonenetwork');
  Route::post('/network/add/wpapsk', 'NetworkManager@wpapsk')->name('addwpapsknetwork');
  Route::post('/network/add/mschapv2', 'NetworkManager@mschapv2')->name('addmschapv2network');

  Route::post('/network/edit/none', 'NetworkManager@editNone')->name('editnone');
  Route::post('/network/edit/wpa', 'NetworkManager@editWPA')->name('editwpa');
  Route::post('/network/edit/mschapv2', 'NetworkManager@editMSCHAPV2')->name('editmschapv2');

  Route::post('/network/destroy/wipe', 'NetworkManager@destroyOne')->name('destorynetworknow');
});
