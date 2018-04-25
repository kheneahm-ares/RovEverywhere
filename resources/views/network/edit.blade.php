@extends('layouts.app')
@section('content')
</style>

<div class="col-md-12">
	{{ Form::open(array('url' => '/network/edit/none')) }}
	<select name='type'>
		@foreach ($unconn as $ssids)
			@foreach ($ssids as $ssid)
				<option value={{ $ssid }}>{{ $ssid }}</option>
			@endforeach
		@endforeach
	</select>
	{{ Form::button('Unsecured', array('type' => 'submit')) }}	
	{{ Form::close() }}
	<br>
	{{ Form::open(array('url' => '/network/edit/wpa')) }}
	<select name='type'>
		@foreach ($wpa as $ssids)
			@foreach ($ssids as $ssid)
				<option value={{ $ssid }}>{{ $ssid }}</option>
			@endforeach
		@endforeach
	</select>
	{{ Form::button('WPA-PSK', array('type' => 'submit')) }}	
	{{ Form::close() }}
	<br>
	{{ Form::open(array('url' => '/network/edit/mschapv2')) }}
	<select name='type'>
		@foreach ($mschapv2 as $ssids)
			@foreach ($ssids as $ssid)
				<option value={{ $ssid }}>{{ $ssid }}</option>
			@endforeach
		@endforeach
	</select>
	{{ Form::button('MSCHAPV2', array('type' => 'submit')) }}	
	{{ Form::close() }}
</div>
@endsection
