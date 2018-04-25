@extends('layouts.app')
@section('content')

<div class="col-md-12">
	<h1 style="text-align: center">Add new WPA-PSK Network</h1>

{{ Form::open(array('url' => '/network/add/wpapsk', 'class' => 'form-horizontal')) }}

<div class="col-md-6 col-md-offset-3">
	<div class="form-group">
		{{ Form::label('ssid', 'SSID', array('class' => 'control-label')) }}
		{{ Form::text('ssid',  null, array('class' => 'form-control')) }}
	</div>
	<br />
	<div class="form-group">
		{{ Form::label('psk', 'Password', array('class' => 'control-label')) }}
		<input name="psk" type="password" class="form-control" id="psk">
	</div>
	<br />
	<div class="form-group pull-right">
		<button type="submit" name="button" class="btn btn-success btn-lg">
			Add
	 </button>

	</div>
</div>
{{ Form::close() }}
</div>
@endsection
