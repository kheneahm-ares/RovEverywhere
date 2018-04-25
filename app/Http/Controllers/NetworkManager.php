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

		shell_exec('java -cp .:/home/pi/NetMan/roveverywhere Main new mschapv2 ' . $ssid . " " . $eap . " " . $identity . " " . $password . " " . $phase1 . " " . $phase2);

		return view('network.index');
	}

	//Editing controllers
	public function edit(){
		
		$unconn = array(DB::table('UNSECUREDCONNECTION')->pluck('SSID'));
		$wpa = array(DB::table('WPA_PSK')->pluck('SSID'));
		$mschapv2 = array(DB::table('MSCHAPv2')->pluck('SSID'));

		return view('network.edit', ['unconn' => $unconn, 'wpa' => $wpa, 'mschapv2' => $mschapv2]);
	}
	public function editCurrent(Request $request){
		$ssidOld = $request->input('ssid');
		$ssid = $request->input('ssidNew');
		$type = $request->input('nettype');

		if ($type==='none') {
			DB::table('UNSECUREDCONNECTION')->where('SSID', $ssidOld)->update(['SSID' => $ssid]);
		}
		else if ($type==='wpa') {
			$psk = $request->input('pskNew');
			DB::table('WPA_PSK')->where('SSID', $ssidOld)->update(['SSID' => $ssid, 'PSK' =>$psk]);
		}
		else {
			$eap = $request->input('eap');
			$identity = $request->input('identity');
			$password = $request->input('password');
			$phase1 = $request->input('phase1');
			$phase2 = $request->input('phase2');

			DB::table('MSCHAPv2')->where('SSID', $ssidOld)->update(['SSID' => $ssid, 'eap' => $eap, 'identity' => $identity, 'password' => $password, 'phase1' => $phase1, 'phase2' => $phase2]);
		}
		shell_exec('java -cp .:/home/pi/NetMan/roveverywhere Main');
		return view('network.index');
	}
	public function editNone(Request $request){
		$network = $request->input('type');
		$choice = "none";
		return view('network.editform', ['choice' => $choice, 'network' => $network]);
	}
	public function editWPA(Request $request){
		$network = $request->input('type');
		$psk = DB::table('WPA_PSK')->where('SSID', $network)->pluck('PSK')->first();
		$choice = "wpa";
		return view('network.editform', ['choice' => $choice, 'network' => $network, 'psk' => $psk]);
	}
	public function editMSCHAPV2(Request $request){
		$network = $request->input('type');
		$eap = DB::table('MSCHAPv2')->where('SSID', $network)->pluck('EAP')->first();
		$identity = DB::table('MSCHAPv2')->where('SSID', $network)->pluck('IDENTITY')->first();
		$password = DB::table('MSCHAPv2')->where('SSID', $network)->pluck('PASSWORD')->first();
		$phase1 = DB::table('MSCHAPv2')->where('SSID', $network)->pluck('PHASE1')->first();
		$phase2 = DB::table('MSCHAPv2')->where('SSID', $network)->pluck('PHASE2')->first();
		$choice = "mschapv2";
		return view('network.editform', ['choice' => $choice, 'network' => $network, 'eap' => $eap, 'identity' => $identity, 'password' => $password, 'phase1' => $phase1, 'phase2' => $phase2]);
	}


	//Destroying controllers
	public function destroy(){
		$unconn = array(DB::table('UNSECUREDCONNECTION')->pluck('SSID'));
		$wpa = array(DB::table('WPA_PSK')->pluck('SSID'));
		$mschapv2 = array(DB::table('MSCHAPv2')->pluck('SSID'));
		$ssids = array_merge($unconn, $mschapv2);
		$ssids = array_merge($ssids, $wpa);
		
		return view('network.destroy', ['ssids' => $ssids]);
	}
	public function destroyOne(Request $request){
		$ssid = $request->input('ssid');
		$type = $request->input('networktype');


		shell_exec("java -cp .:/home/pi/NetMan/roveverywhere/ Main delete " . $type . " " . $ssid);	

		return view('network.index');
	}	
}
