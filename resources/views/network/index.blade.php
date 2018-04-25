@extends('layouts.app')
@section('content')
	<style>
		#network_options > div > a{
			text-align: center;
			font-size: 30px;
		}
	</style>
<div id="network_options" class="col-md-12" style="margin-top: 15%;">
	<div class="col-md-4">
		<a style="width: 400px;" class="btn btn-lg btn-success"href="/network/add" >Add</a>
	</div>
	<div class="col-md-4">
		<a style="width: 400px;"  class="btn btn-lg btn-warning" href="/network/edit">Edit</a>
	</div>
	<div class="col-md-4">
		<a style="width: 400px;"  class="btn btn-lg btn-danger" href="/network/destroy">Remove</a>
	</div>
</div>
@endsection
