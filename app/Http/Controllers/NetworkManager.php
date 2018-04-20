<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NetworkManager extends Controller
{
    //

	public function index(){

		return view('network.index');
	}
	//Adding controlllers
	public function add(){
		return view('network.add');
	}
	public function newnone(){
		return view('network.newnoneform');
	}
	public function none(Request $request){

		$ssid = $request->input('ssid');

		$output = shell_exec('java -cp .:/home/pi/NetMan/roveverywhere Main new none ' . $ssid);	
		echo $output;

		return view('network.index');
	}
	public function newwpapsk(){
		return view('network.newwpapskform');
	}
	public function wpapsk(Request $request){
		$ssid = $request->input('ssid');
		$psk = $request->input('psk');

		$output = shell_exec('java -cp .:/home/pi/NetMan/roveverywhere Main new wpa-psk ' . $ssid . ' ' . $psk);

		return view('network.index');
	}
	public function newmschapv2(){
		return view('network.newmschapv2form');
	}
	public function mschapv2(Request $request){

		$ssid = $request->input('ssid');
		$eap = $request->input('eap');
		$identity = $request->input('identity');
		$password = $request->input('password');
		$phase1 = $request->input('phase1');
		$phase2 = $request->input('phase2');


		return view('network.index');
	}

	//Editing controllers
	public function edit(){
		return view('network.edit');
	}

	//Destroying controllers
	public function destroy(){
		return view('network.destroy');
	}

}
