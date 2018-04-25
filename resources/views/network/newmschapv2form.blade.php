@extends('layouts.app')
@section('content')

<div class="col-md-12">
	<h1 style="text-align: center">Add new MSCHAPV2</h1>

{{ Form::open(array('url' => '/network/add/mschapv2', 'class' => 'form-horizontal' )) }}

	<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
					{{ Form::label('ssid', "SSID", array('class' => 'control-label')) }}
					{{ Form::text('ssid', null,array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('eap', 'EAP', array('class' => 'control-label')) }}
				{{ Form::text('eap', null,array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('identity', 'Identity', array('class' => 'control-label')) }}
				{{ Form::text('identity', null,array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
				<input name="psk" type="password" class="form-control" id="psk">
			</div>
			<div class="form-group">
				{{ Form::label('phase1', 'PHASE1', array('class' => 'control-label')) }}
				{{ Form::text('phase1', null,array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('phase2', 'PHASE2', array('class' => 'control-label')) }}
				{{ Form::text('phase2', null,array('class' => 'form-control')) }}
			</div>
			<div class="form-group pull-right">
				<button type="submit" name="button" class="btn btn-success btn-lg">
					Add
			 </button>

			</div>
	</div>
{{ Form::close() }}
</div>
@endsection
