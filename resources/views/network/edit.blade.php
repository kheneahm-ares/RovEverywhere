@extends('layouts.app')
@section('content')

<div class="col-md-12">
	<div class="col-md-6 col-md-offset-3">
			{{ Form::open(array('url' => '/network/edit/none')) }}
			<div class="form-group">
				<select class="form-control" name='type'>
					@foreach ($unconn as $ssids)
						@foreach ($ssids as $ssid)
							<option value={{ $ssid }}>{{ $ssid }}</option>
						@endforeach
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::button('Unsecured', array('type' => 'submit', 'class' => 'btn btn-success btn-lg')) }}
			</div>
			{{ Form::close() }}
			<br />
			{{ Form::open(array('url' => '/network/edit/wpa')) }}
			<div class="form-group">
				<select class="form-control" name='type'>
					@foreach ($wpa as $ssids)
						@foreach ($ssids as $ssid)
							<option value={{ $ssid }}>{{ $ssid }}</option>
						@endforeach
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::button('WPA-PSK', array('type' => 'submit', 'class' => 'btn btn-success btn-lg')) }}
			</div>
			{{ Form::close() }}
			<br />
			{{ Form::open(array('url' => '/network/edit/mschapv2')) }}
			<div class="form-group">
				<select class="form-control" name='type'>
					@foreach ($mschapv2 as $ssids)
						@foreach ($ssids as $ssid)
							<option value={{ $ssid }}>{{ $ssid }}</option>
						@endforeach
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::button('MSCHAPV2', array('type' => 'submit','class' => 'btn btn-success btn-lg')) }}
			</div>
			{{ Form::close() }}
	</div>
</div>
@endsection
