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
	public function
	public function edit(){
		return view('network.edit');
	}
	public function destroy(){
		return view('network.destroy');
	}

}
