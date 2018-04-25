@extends('layouts.app')
@section('content')
	<style>
		#networks > div > a{
			text-align: center;
			font-size: 30px;
		}
	</style>
<div id="networks" class="col-md-12" style="margin-top: 15%;">
	<div class="col-md-4">
		<a class="btn btn-lg btn-info"href="/network/add/new/none" >Add Unsecured Network</a>
	</div>
	<div class="col-md-4">
		<a class="btn btn-lg btn-info" href="/network/add/new/wpapsk">Add WPA-PSK Network</a>
	</div>
	<div class="col-md-4">
		<a class="btn btn-lg btn-info" href="/network/add/new/mschapv2">Add mschapv2 Network</a>
	</div>
</div>
@endsection
