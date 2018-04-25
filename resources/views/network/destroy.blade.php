
@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<h1 style="text-align:center">Choose Network to Remove</h1>

	<div class="col-md-6 col-md-offset-3">
		{{ Form::open(array('route' => 'destorynetworknow', 'method' => 'POST')) }}

		<div class="form-group">
			{{ Form::label("ssid", "SSID", array('class' => 'control-label')) }}
			<select class="form-control" name="ssid">
				@foreach ($ssids as $ssid)
					@foreach ($ssid as $sd)
						<option value={{ $sd }}>{{ $sd }}</option>
					@endforeach
				@endforeach
			</select>
		</div>
		<br />
		<div class="form-group">
			{{ Form::label("networktype", "Network Type", array('class' => 'control-label')) }}
			{{ Form::select('networktype', array('none' => 'Unsecured', 'wpa-psk' => 'WPA PSK', 'mschapv2' => 'MSCHAPV2')) }}
		</div>
		<br />
		<div class="form-group pull-right">
			<button type="submit" name="button" class="btn btn-success btn-lg">
				Remove
		 </button>
		</div>
	</div>
	{{ Form::close() }}
	</div>
</div>
@endsection
